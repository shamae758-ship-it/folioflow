{{-- resources/views/templates/creative.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $portfolio->full_name }} — Portfolio</title>
    <style>
        /* ===== RESET ===== */
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        /* ===== BASE ===== */
        body { font-family: "Inter", "Segoe UI", system-ui, -apple-system, sans-serif; background: #fdf6ec; color: #1a1a2e; line-height: 1.65; -webkit-font-smoothing: antialiased; overflow-x: hidden; }
        a { color: inherit; text-decoration: none; }
        img { max-width: 100%; display: block; }

        /* ===== WRAPPER ===== */
        .wrapper { max-width: 1100px; margin: 0 auto; padding: 0 24px; }

        /* ===== HERO — ASYMMETRIC ===== */
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

        /* ===== AVATAR — TILTED ===== */
        .hero-avatar { position: relative; justify-self: end; }
        .hero-avatar .frame { width: 280px; height: 320px; border-radius: 40px 40px 40px 40px; overflow: hidden; box-shadow: 0 30px 60px rgba(236,72,153,0.25), 0 15px 30px rgba(139,92,246,0.2); border: 8px solid #fff; transform: rotate(3deg); transition: transform 0.3s ease; }
        .hero-avatar .frame:hover { transform: rotate(0deg) scale(1.02); }
        .hero-avatar .frame img { width: 100%; height: 100%; object-fit: cover; }
        .hero-avatar .sticker { position: absolute; bottom: 12px; left: -22px; background: linear-gradient(135deg, #f97316, #ec4899); color: #fff; font-size: 0.72rem; font-weight: 800; letter-spacing: 0.08em; padding: 10px 18px; border-radius: 999px; transform: rotate(-6deg); box-shadow: 0 10px 24px rgba(236,72,153,0.4); z-index: 2; }

        /* ===== SECTION — BIG TITLE ===== */
        .section { padding: 60px 0; }
        .section-head { margin-bottom: 40px; }
        .section-num { display: inline-block; font-size: 0.72rem; font-weight: 800; letter-spacing: 0.3em; color: #ec4899; margin-bottom: 10px; }
        .section-head h2 { font-size: clamp(1.8rem, 3.5vw, 2.6rem); font-weight: 900; letter-spacing: -0.03em; color: #1a1a2e; }
        .section-head h2 em { font-style: italic; background: linear-gradient(120deg, #f97316, #ec4899); -webkit-background-clip: text; background-clip: text; -webkit-text-fill-color: transparent; }

        /* ===== ABOUT — BIG QUOTE ===== */
        .about-quote { font-size: clamp(1.15rem, 2vw, 1.45rem); font-weight: 500; color: #2a2a3e; padding: 30px 0 30px 32px; border-left: 6px solid transparent; border-image: linear-gradient(180deg, #f97316, #ec4899, #8b5cf6) 1; line-height: 1.6; font-style: italic; }

        /* ===== TIMELINE ===== */
        .timeline { position: relative; padding-left: 40px; }
        .timeline::before { content: ""; position: absolute; left: 12px; top: 8px; bottom: 8px; width: 3px; background: linear-gradient(180deg, #f97316, #ec4899, #8b5cf6); border-radius: 3px; }
        .timeline-item { position: relative; padding-bottom: 34px; }
        .timeline-item:last-child { padding-bottom: 0; }
        .timeline-item::before { content: ""; position: absolute; left: -34px; top: 6px; width: 16px; height: 16px; border-radius: 50%; background: #fff; border: 3px solid #ec4899; box-shadow: 0 0 0 4px rgba(236,72,153,0.15); }
        .timeline-item:nth-child(3n+1)::before { border-color: #f97316; box-shadow: 0 0 0 4px rgba(249,115,22,0.15); }
        .timeline-item:nth-child(3n+3)::before { border-color: #8b5cf6; box-shadow: 0 0 0 4px rgba(139,92,246,0.15); }

        .timeline-item .ti-title { font-size: 1.1rem; font-weight: 800; color: #1a1a2e; margin-bottom: 4px; }
        .timeline-item .ti-sub { font-size: 0.92rem; color: #6a6a7e; font-weight: 500; }

        /* ===== SKILLS — STICKERS ===== */
        .stickers { display: flex; flex-wrap: wrap; gap: 12px; }
        .sticker-skill { font-size: 0.86rem; font-weight: 700; padding: 10px 20px; border-radius: 999px; background: #fff; border: 2px solid #1a1a2e; color: #1a1a2e; box-shadow: 4px 4px 0 #1a1a2e; transition: transform 0.2s ease, box-shadow 0.2s ease; }
        .sticker-skill:nth-child(3n+1) { background: #fef3c7; }
        .sticker-skill:nth-child(3n+2) { background: #fce7f3; }
        .sticker-skill:nth-child(3n+3) { background: #ddd6fe; }
        .sticker-skill:hover { transform: translate(-2px, -2px); box-shadow: 6px 6px 0 #1a1a2e; }

        /* ===== PROJECTS — LARGE COLOR CARDS ===== */
        .projects { display: grid; grid-template-columns: 1fr 1fr; gap: 22px; }
        .project-card { padding: 28px 26px; border-radius: 24px; color: #fff; position: relative; overflow: hidden; transition: transform 0.25s ease; }
        .project-card:hover { transform: translateY(-6px); }
        .project-card:nth-child(3n+1) { background: linear-gradient(135deg, #f97316, #fb923c); }
        .project-card:nth-child(3n+2) { background: linear-gradient(135deg, #ec4899, #f472b6); }
        .project-card:nth-child(3n+3) { background: linear-gradient(135deg, #8b5cf6, #a78bfa); }
        .project-card::before { content: ""; position: absolute; top: -30px; right: -30px; width: 120px; height: 120px; border-radius: 50%; background: rgba(255,255,255,0.12); }
        .project-card h3 { font-size: 1.15rem; font-weight: 800; margin-bottom: 8px; position: relative; z-index: 1; }
        .project-card p { font-size: 0.92rem; opacity: 0.92; position: relative; z-index: 1; }
        .project-card .project-num { position: absolute; bottom: 12px; right: 20px; font-size: 2.5rem; font-weight: 900; opacity: 0.15; letter-spacing: -0.05em; }

        /* ===== LINKS ===== */
        .links { display: flex; flex-wrap: wrap; gap: 14px; }
        .links a { display: inline-flex; align-items: center; gap: 10px; font-size: 0.92rem; font-weight: 700; padding: 12px 24px; border-radius: 999px; background: #1a1a2e; color: #fff; transition: transform 0.2s ease, background 0.2s ease; }
        .links a:hover { transform: translateY(-3px); background: #ec4899; }

        /* ===== FOOTER ===== */
        .footer { text-align: center; padding: 50px 0 40px; font-size: 0.85rem; color: #8a8a9a; }
        .footer a { font-weight: 700; color: #ec4899; }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 900px) {
            .hero-inner { grid-template-columns: 1fr; gap: 40px; }
            .hero-avatar { justify-self: center; }
            .hero-avatar .frame { width: 220px; height: 260px; }
            .hero-avatar .sticker { left: -8px; }
            .projects { grid-template-columns: 1fr; }
        }

        @media (max-width: 600px) {
            .hero { padding: 50px 0 40px; }
            .hero-tag { transform: rotate(0deg); }
            .about-quote { padding-left: 20px; border-left-width: 5px; font-size: 1.05rem; }
            .timeline { padding-left: 32px; }
            .timeline-item::before { left: -28px; }
        }
    </style>
</head>
<body>

    {{-- ===== HERO ===== --}}
    <section class="hero">
        <div class="wrapper hero-inner">

            <div class="hero-text">
                <span class="hero-tag">✦ Portfolio</span>

                <h1>
                    Hi, I'm
                    <span class="accent">{{ $portfolio->full_name }}</span>
                </h1>

                @if ($portfolio->about_me)
                    <p class="bio">{{ Str::limit($portfolio->about_me, 180) }}</p>
                @endif

                <div class="hero-cta">
                    @if ($portfolio->email)
                        <a href="mailto:{{ $portfolio->email }}">✉ {{ $portfolio->email }}</a>
                    @endif
                    @if ($portfolio->contact_number)
                        <span class="soft">📞 {{ $portfolio->contact_number }}</span>
                    @endif
                    @if ($portfolio->address)
                        <span class="soft">📍 {{ $portfolio->address }}</span>
                    @endif
                </div>
            </div>

            <div class="hero-avatar">
                <div class="frame">
                    <img src="{{ $portfolio->profile_picture_url }}" alt="{{ $portfolio->full_name }}">
                </div>
                <span class="sticker">Hello there! 👋</span>
            </div>

        </div>
    </section>

    {{-- ===== ABOUT ===== --}}
    @if ($portfolio->about_me)
        <section class="section" style="padding-top: 20px;">
            <div class="wrapper">
                <div class="section-head">
                    <span class="section-num">— 01 / ABOUT —</span>
                    <h2>A little bit <em>about me</em></h2>
                </div>
                <p class="about-quote">"{{ $portfolio->about_me }}"</p>
            </div>
        </section>
    @endif

    {{-- ===== SKILLS ===== --}}
    @if (!empty($portfolio->skills) && count($portfolio->skills) > 0)
        <section class="section">
            <div class="wrapper">
                <div class="section-head">
                    <span class="section-num">— 02 / SKILLS —</span>
                    <h2>Things I'm <em>good at</em></h2>
                </div>

                <div class="stickers">
                    @foreach ($portfolio->skills as $skill)
                        @if (!empty($skill['name']))
                            <span class="sticker-skill">{{ $skill['name'] }}</span>
                        @endif
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- ===== EDUCATION (TIMELINE) ===== --}}
    @if (!empty($portfolio->education) && count($portfolio->education) > 0)
        <section class="section">
            <div class="wrapper">
                <div class="section-head">
                    <span class="section-num">— 03 / EDUCATION —</span>
                    <h2>Where I <em>studied</em></h2>
                </div>

                <div class="timeline">
                    @foreach ($portfolio->education as $edu)
                        @if (!empty($edu['school']) || !empty($edu['degree']))
                            <div class="timeline-item">
                                <div class="ti-title">{{ $edu['degree'] ?? '' }}</div>
                                <div class="ti-sub">{{ $edu['school'] ?? '' }}</div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- ===== PROJECTS ===== --}}
    @if (!empty($portfolio->projects) && count($portfolio->projects) > 0)
        <section class="section">
            <div class="wrapper">
                <div class="section-head">
                    <span class="section-num">— 04 / PROJECTS —</span>
                    <h2>Things I've <em>built</em></h2>
                </div>

                <div class="projects">
                    @php $i = 1; @endphp
                    @foreach ($portfolio->projects as $project)
                        @if (!empty($project['title']))
                            <div class="project-card">
                                <h3>{{ $project['title'] }}</h3>
                                @if (!empty($project['description']))
                                    <p>{{ $project['description'] }}</p>
                                @endif
                                <span class="project-num">0{{ $i }}</span>
                            </div>
                            @php $i++; @endphp
                        @endif
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- ===== EXPERIENCE (TIMELINE) ===== --}}
    @if (!empty($portfolio->experience) && count($portfolio->experience) > 0)
        <section class="section">
            <div class="wrapper">
                <div class="section-head">
                    <span class="section-num">— 05 / EXPERIENCE —</span>
                    <h2>Where I've <em>worked</em></h2>
                </div>

                <div class="timeline">
                    @foreach ($portfolio->experience as $exp)
                        @if (!empty($exp['position']) || !empty($exp['company']))
                            <div class="timeline-item">
                                <div class="ti-title">{{ $exp['position'] ?? '' }}</div>
                                <div class="ti-sub">{{ $exp['company'] ?? '' }}</div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- ===== LINKS ===== --}}
    @if (!empty($portfolio->social_links) && count($portfolio->social_links) > 0)
        <section class="section">
            <div class="wrapper">
                <div class="section-head">
                    <span class="section-num">— 06 / CONNECT —</span>
                    <h2>Let's <em>connect</em></h2>
                </div>

                <div class="links">
                    @foreach ($portfolio->social_links as $link)
                        @if (!empty($link['url']) && !empty($link['label']))
                            <a href="{{ $link['url'] }}" target="_blank" rel="noopener">{{ $link['label'] }} →</a>
                        @endif
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- ===== FOOTER ===== --}}
    <footer class="footer">
        <div class="wrapper">
            ✦ Generated with <a href="{{ url('/') }}">FolioFlow</a>
        </div>
    </footer>

</body>
</html>