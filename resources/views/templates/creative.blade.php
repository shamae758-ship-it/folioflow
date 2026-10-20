{{-- resources/views/templates/creative.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $portfolio->full_name }} — Portfolio</title>
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: "Inter", "Segoe UI", system-ui, -apple-system, sans-serif; background: #fdf6ec; color: #1a1a2e; line-height: 1.65; -webkit-font-smoothing: antialiased; overflow-x: hidden; }
        a { color: inherit; text-decoration: none; }
        img { max-width: 100%; display: block; }
        .wrapper { max-width: 1100px; margin: 0 auto; padding: 0 24px; }
        .hero { position: relative; padding: 80px 0 60px; overflow: hidden; }
        .hero::before { content: ""; position: absolute; top: -100px; left: -120px; width: 460px; height: 460px; border-radius: 50%; background: linear-gradient(135deg, #f97316, #ec4899); opacity: 0.18; filter: blur(40px); z-index: 0; }
        .hero::after { content: ""; position: absolute; top: 200px; right: -160px; width: 500px; height: 500px; border-radius: 50%; background: linear-gradient(135deg, #8b5cf6, #ec4899); opacity: 0.16; filter: blur(50px); z-index: 0; }
        .hero-inner { position: relative; z-index: 1; display: grid; grid-template-columns: 1.3fr 1fr; gap: 50px; align-items: center; }
        .hero-tag { display: inline-block; font-size: 0.72rem; font-weight: 800; letter-spacing: 0.2em; text-transform: uppercase; color: #ec4899; padding: 8px 16px; background: rgba(236,72,153,0.1); border: 2px solid #ec4899; border-radius: 999px; margin-bottom: 22px; transform: rotate(-2deg); }
        .hero h1 { font-size: clamp(2.5rem, 5.5vw, 4rem); line-height: 1.05; font-weight: 900; letter-spacing: -0.04em; margin-bottom: 20px; color: #1a1a2e; }
        .hero h1 .accent { display: block; background: linear-gradient(120deg, #f97316, #ec4899 50%, #8b5cf6); -webkit-background-clip: text; background-clip: text; -webkit-text-fill-color: transparent; font-style: italic; }
        .hero .bio { font-size: 1.08rem; color: #4a4a5e; max-width: 520px; margin-bottom: 30px; }
        .hero-cta { display: flex; flex-wrap: wrap; gap: 12px; }
        .hero-cta a, .hero-cta span { display: inline-flex; align-items: center; gap: 8px; font-size: 0.86rem; font-weight: 700; padding: 10px 18px; border-radius: 12px; background: #1a1a2e; color: #fff; transition: transform 0.2s ease; }
        .hero-cta a:hover { transform: translateY(-3px); }
        .hero-cta .soft { background: rgba(26,26,46,0.06); color: #1a1a2e; border: 2px solid rgba(26,26,46,0.12); }
        .hero-avatar { position: relative; justify-self: end; }
        .hero-avatar .frame { width: 280px; height: 320px; border-radius: 40px 40px 40px 40px; overflow: hidden; box-shadow: 0 30px 60px rgba(236,72,153,0.25), 0 15px 30px rgba(139,92,246,0.2); border: 8px solid #fff; transform: rotate(3deg); transition: transform 0.3s ease; }
        .hero-avatar .frame:hover { transform: rotate(0deg) scale(1.02); }
        .hero-avatar .frame img { width: 100%; height: 100%; object-fit: cover; }
        .hero-avatar .sticker { position: absolute; bottom: 12px; left: -22px; background: linear-gradient(135deg, #f97316, #ec4899); color: #fff; font-size: 0.72rem; font-weight: 800; letter-spacing: 0.08em; padding: 10px 18px; border-radius: 999px; transform: rotate(-6deg); box-shadow: 0 10px 24px rgba(236,72,153,0.4); z-index: 2; }
        .section { padding: 60px 0; }
        .section-head { margin-bottom: 40px; }
        .section-num { display: inline-block; font-size: 0.72rem; font-weight: 800; letter-spacing: 0.3em; color: #ec4899; margin-bottom: 10px; }
        .section-head h2 { font-size: clamp(1.8rem, 3.5vw, 2.6rem); font-weight: 900; letter-spacing: -0.03em; color: #1a1a2e; }
        .section-head h2 em { font-style: italic; background: linear-gradient(120deg, #f97316, #ec4899); -webkit-background-clip: text; background-clip: text; -webkit-text-fill-color: transparent; }
        .about-quote { font-size: clamp(1.15rem, 2vw, 1.45rem); font-weight: 500; color: #2a2a3e; padding: 30px 0 30px 32px; border-left: 6px solid transparent; border-image: linear-gradient(180deg, #f97316, #ec4899, #8b5cf6) 1; line-height: 1.6; font-style: italic; }
        .timeline { position: relative; padding-left: 40px; }
        .timeline::before { content: ""; position: absolute; left: 12px; top: 8px; bottom: 8px; width: 3px; background: linear-gradient(180deg, #f97316, #ec4899, #8b5cf6); border-radius: 3px; }
        .timeline-item { position: relative; padding-bottom: 34px; }
        .timeline-item:last-child { padding-bottom: 0; }
        .timeline-item::before { content: ""; position: absolute; left: -34px; top: 6px; width: 16px; height: 16px; border-radius: 50%; background: #fff; border: 3px solid #ec4899; box-shadow: 0 0 0 4px rgba(236,72,153,0.15); }
        .timeline-item:nth-child(3n+1)::before { border-color: #f97316; box-shadow: 0 0 0 4px rgba(249,115,22,0.15); }
        .timeline-item:nth-child(3n+3)::before { border-color: #8b5cf6; box-shadow: 0 0 0 4px rgba(139,92,246,0.15); }
        .timeline-item .ti-title { font-size: 1.1rem; font-weight: 800; color: #1a1a2e; margin-bottom: 4px; }
        .timeline-item .ti-sub { font-size: 0.92rem; color: #6a6a7e; font-weight: 500; }
        .stickers { display: flex; flex-wrap: wrap; gap: 12px; }
        .sticker-skill { font-size: 0.86rem; font-weight: 700; padding: 10px 20px; border-radius: 999px; background: #fff; border: 2px solid #1a1a2e; color: #1a1a2e; box-shadow: 4px 4px 0 #1a1a2e; transition: transform 0.2s ease, box-shadow 0.2s ease; }
        .sticker-skill:nth-child(3n+1) { background: #fef3c7; }
        .sticker-skill:nth-child(3n+2) { background: #fce7f3; }
        .sticker-skill:nth-child(3n+3) { background: #ddd6fe; }
        .sticker-skill:hover { transform: translate(-2px, -2px); box-shadow: 6px 6px 0 #1a1a2e; }
        .projects { display: grid; grid-template-columns: 1fr 1fr; gap: 22px; }
        .project-card { padding: 28px 26px; border-radius: 24px; color: #fff; position: relative;