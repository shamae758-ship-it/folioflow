{{-- resources/views/home.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="FolioFlow — Create, preview, and host professional portfolios in minutes.">
    <title>FolioFlow — Online Portfolio Template Generator</title>
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root { --bg: #0b0f19; --bg-soft: #111827; --surface: #161e2e; --surface-2: #1c2740; --border: #243049; --text: #e7ecf5; --text-muted: #9aa7bd; --primary: #6366f1; --primary-hover: #4f52e0; --accent: #22d3ee; --accent-2: #a855f7; --radius: 14px; --radius-sm: 10px; --shadow: 0 10px 30px rgba(0, 0, 0, 0.35); --transition: 0.25s ease; }
        html { scroll-behavior: smooth; }
        body { font-family: "Inter", "Segoe UI", system-ui, -apple-system, sans-serif; background: var(--bg); color: var(--text); line-height: 1.6; -webkit-font-smoothing: antialiased; }
        a { text-decoration: none; color: inherit; }
        img { max-width: 100%; display: block; }
        .container { width: 100%; max-width: 1180px; margin: 0 auto; padding: 0 24px; }
        .navbar { position: sticky; top: 0; z-index: 100; background: rgba(11, 15, 25, 0.85); backdrop-filter: blur(12px); border-bottom: 1px solid var(--border); }
        .navbar-inner { display: flex; align-items: center; justify-content: space-between; height: 72px; }
        .logo { display: flex; align-items: center; gap: 10px; font-weight: 800; font-size: 1.35rem; letter-spacing: -0.02em; }
        .logo-mark { width: 34px; height: 34px; border-radius: 9px; background: linear-gradient(135deg, var(--primary), var(--accent)); display: grid; place-items: center; font-size: 1rem; color: #fff; box-shadow: 0 6px 16px rgba(99, 102, 241, 0.45); }
        .logo span { background: linear-gradient(135deg, #fff, #b8c2ff); -webkit-background-clip: text; background-clip: text; -webkit-text-fill-color: transparent; }
        .nav-links { display: flex; align-items: center; gap: 30px; list-style: none; }
        .nav-links a { color: var(--text-muted); font-size: 0.95rem; font-weight: 500; transition: color var(--transition); position: relative; }
        .nav-links a:hover { color: var(--text); }
        .nav-links a::after { content: ""; position: absolute; left: 0; bottom: -6px; width: 0; height: 2px; background: linear-gradient(90deg, var(--primary), var(--accent)); transition: width var(--transition); border-radius: 2px; }
        .nav-links a:hover::after { width: 100%; }
        .btn { display: inline-flex; align-items: center; justify-content: center; gap: 8px; border: none; cursor: pointer; font-family: inherit; font-weight: 600; font-size: 0.95rem; padding: 12px 22px; border-radius: var(--radius-sm); transition: transform var(--transition), background var(--transition), box-shadow var(--transition); white-space: nowrap; }
        .btn-primary { background: linear-gradient(135deg, var(--primary), var(--accent-2)); color: #fff; box-shadow: 0 8px 22px rgba(99, 102, 241, 0.4); }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 12px 28px rgba(99, 102, 241, 0.55); }
        .btn-ghost { background: transparent; color: var(--text); border: 1px solid var(--border); }
        .btn-ghost:hover { background: var(--surface); border-color: var(--primary); transform: translateY(-2px); }
        .btn-sm { padding: 9px 18px; font-size: 0.875rem; }
        .hero { position: relative; padding: 96px 0 80px; overflow: hidden; }
        .hero::before { content: ""; position: absolute; top: -220px; left: 50%; transform: translateX(-50%); width: 780px; height: 780px; background: radial-gradient(circle, rgba(99, 102, 241, 0.22), transparent 62%); pointer-events: none; }
        .hero::after { content: ""; position: absolute; bottom: -260px; right: -180px; width: 620px; height: 620px; background: radial-gradient(circle, rgba(34, 211, 238, 0.14), transparent 65%); pointer-events: none; }
        .hero-inner { position: relative; display: grid; grid-template-columns: 1.1fr 0.9fr; gap: 60px; align-items: center; }
        .hero-badge { display: inline-flex; align-items: center; gap: 8px; padding: 7px 15px; border-radius: 999px; background: rgba(99, 102, 241, 0.12); border: 1px solid rgba(99, 102, 241, 0.35); color: #c7cbff; font-size: 0.8rem; font-weight: 600; letter-spacing: 0.03em; margin-bottom: 22px; }
        .hero-badge .dot { width: 7px; height: 7px; border-radius: 50%; background: var(--accent); box-shadow: 0 0 0 4px rgba(34, 211, 238, 0.18); }
        .hero h1 { font-size: clamp(2.2rem, 4.6vw, 3.4rem); line-height: 1.12; font-weight: 800; letter-spacing: -0.03em; margin-bottom: 20px; }
        .hero h1 .gradient { background: linear-gradient(135deg, var(--primary), var(--accent)); -webkit-background-clip: text; background-clip: text; -webkit-text-fill-color: transparent; }
        .hero p { color: var(--text-muted); font-size: 1.08rem; max-width: 520px; margin-bottom: 34px; }
        .hero-actions { display: flex; flex-wrap: wrap; gap: 14px; }
        .mock-window { background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius); box-shadow: var(--shadow); overflow: hidden; transform: perspective(1200px) rotateY(-8deg) rotateX(4deg); transition: transform 0.4s ease; }
        .mock-window:hover { transform: perspective(1200px) rotateY(-3deg) rotateX(2deg) translateY(-6px); }
        .mock-bar { display: flex; align-items: center; gap: 7px; padding: 12px 16px; background: var(--surface-2); border-bottom: 1px solid var(--border); }
        .mock-bar span { width: 11px; height: 11px; border-radius: 50%; }
        .mock-bar span:nth-child(1) { background: #ff5f57; } .mock-bar span:nth-child(2) { background: #febc2e; } .mock-bar span:nth-child(3) { background: #28c840; }
        .mock-body { padding: 26px; }
        .mock-avatar { width: 62px; height: 62px; border-radius: 50%; background: linear-gradient(135deg, var(--primary), var(--accent)); margin-bottom: 16px; }
        .mock-line { height: 11px; border-radius: 6px; background: var(--surface-2); margin-bottom: 10px; }
        .mock-line.w-70 { width: 70%; } .mock-line.w-50 { width: 50%; } .mock-line.w-90 { width: 90%; } .mock-line.w-40 { width: 40%; }
        .mock-chips { display: flex; gap: 8px; flex-wrap: wrap; margin-top: 18px; }
        .mock-chips span { font-size: 0.72rem; padding: 5px 12px; border-radius: 999px; background: rgba(99, 102, 241, 0.16); border: 1px solid rgba(99, 102, 241, 0.35); color: #c7cbff; font-weight: 600; }
        .features { padding: 80px 0; position: relative; }
        .section-head { text-align: center; max-width: 620px; margin: 0 auto 54px; }
        .section-head .eyebrow { color: var(--accent); font-size: 0.82rem; font-weight: 700; letter-spacing: 0.14em; text-transform: uppercase; margin-bottom: 12px; }
        .section-head h2 { font-size: clamp(1.7rem, 3vw, 2.3rem); font-weight: 800; letter-spacing: -0.02em; margin-bottom: 14px; }
        .section-head p { color: var(--text-muted); font-size: 1.02rem; }
        .features-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px; }
        .feature-card { background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius); padding: 32px 28px; transition: transform var(--transition), border-color var(--transition), box-shadow var(--transition); position: relative; overflow: hidden; }
        .feature-card::before { content: ""; position: absolute; top: 0; left: 0; right: 0; height: 3px; background: linear-gradient(90deg, var(--primary), var(--accent)); opacity: 0; transition: opacity var(--transition); }
        .feature-card:hover { transform: translateY(-6px); border-color: rgba(99, 102, 241, 0.5); box-shadow: var(--shadow); }
        .feature-card:hover::before { opacity: 1; }
        .feature-icon { width: 52px; height: 52px; border-radius: 13px; display: grid; place-items: center; font-size: 1.4rem; margin-bottom: 20px; background: rgba(99, 102, 241, 0.14); border: 1px solid rgba(99, 102, 241, 0.3); }
        .feature-card h3 { font-size: 1.14rem; font-weight: 700; margin-bottom: 10px; }
        .feature-card p { color: var(--text-muted); font-size: 0.94rem; }
        .cta-strip { padding: 0 0 80px; }
        .cta-box { background: linear-gradient(135deg, rgba(99, 102, 241, 0.16), rgba(34, 211, 238, 0.1)); border: 1px solid var(--border); border-radius: 20px; padding: 48px 40px; text-align: center; }
        .cta-box h2 { font-size: clamp(1.5rem, 2.6vw, 2rem); font-weight: 800; letter-spacing: -0.02em; margin-bottom: 12px; }
        .cta-box p { color: var(--text-muted); max-width: 520px; margin: 0 auto 26px; }
        .footer { border-top: 1px solid var(--border); background: var(--bg-soft); padding: 48px 0 28px; }
        .footer-grid { display: grid; grid-template-columns: 1.4fr 1fr 1fr; gap: 40px; margin-bottom: 36px; }
        .footer-brand p { color: var(--text-muted); font-size: 0.92rem; margin-top: 14px; max-width: 320px; }
        .footer h4 { font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.1em; color: var(--text); margin-bottom: 16px; }
        .footer ul { list-style: none; }
        .footer ul li { margin-bottom: 10px; }
        .footer ul a { color: var(--text-muted); font-size: 0.92rem; transition: color var(--transition); }
        .footer ul a:hover { color: var(--accent); }
        .footer-bottom { border-top: 1px solid var(--border); padding-top: 22px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px; color: var(--text-muted); font-size: 0.85rem; }
        @media (max-width: 960px) { .hero-inner { grid-template-columns: 1fr; gap: 48px; } .hero p { max-width: 100%; } .hero-visual { max-width: 520px; margin: 0 auto; } .features-grid { grid-template-columns: 1fr; } .footer-grid { grid-template-columns: 1fr 1fr; } }
        @media (max-width: 640px) { .navbar-inner { height: 64px; } .nav-links { display: none; } .hero { padding: 64px 0 56px; } .hero-actions { flex-direction: column; align-items: stretch; } .btn { width: 100%; } .cta-box { padding: 36px 22px; } .footer-grid { grid-template-columns: 1fr; gap: 28px; } .footer-bottom { flex-direction: column; text-align: center; } }
    </style>
</head>
<body>

    <header class="navbar">
        <div class="container navbar-inner">
            <a href="{{ url('/') }}" class="logo">
                <span class="logo-mark">✦</span>
                <span>FolioFlow</span>
            </a>
            <nav>
                <ul class="nav-links">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li><a href="#templates">Templates</a></li>
                    <li><a href="#features">Features</a></li>
                </ul>
            </nav>
            
            {{-- NEW AUTH BUTTONS --}}
            <div style="display: flex; align-items: center;">
                @auth
                    <a href="{{ route('portfolio.index') }}" class="btn btn-primary btn-sm">My Portfolios</a>
                    <form method="POST" action="{{ route('logout') }}" style="display:inline; margin-left: 15px;">
                        @csrf
                        <button type="submit" style="background:none; border:none; color:#9aa7bd; cursor:pointer; font-weight: 500;">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn btn-ghost btn-sm" style="margin-right:10px;">Log In</a>
                    <a href="{{ route('register') }}" class="btn btn-primary btn-sm">Sign Up</a>
                @endauth
            </div>
        </div>
    </header>

    <section class="hero">
        <div class="container hero-inner">
            <div class="hero-content">
                <span class="hero-badge"><span class="dot"></span> Online Portfolio Generator</span>
                <h1>Build a portfolio that <br><span class="gradient">speaks for you.</span></h1>
                <p>FolioFlow lets you enter your information once, choose from three distinct templates, and generate a professional online portfolio in minutes — stored safely in the cloud.</p>
                <div class="hero-actions">
                    {{-- SMART GET STARTED BUTTON --}}
                    <a href="{{ auth()->check() ? route('portfolio.create') : route('register') }}" class="btn btn-primary">Get Started</a>
                    <a href="#templates" class="btn btn-ghost">View Templates</a>
                </div>
            </div>
            <div class="hero-visual">
                <div class="mock-window">
                    <div class="mock-bar"><span></span><span></span><span></span></div>
                    <div class="mock-body">
                        <div class="mock-avatar"></div>
                        <div class="mock-line w-70"></div>
                        <div class="mock-line w-50"></div>
                        <div class="mock-line w-90"></div>
                        <div class="mock-line w-40"></div>
                        <div class="mock-chips"><span>Design</span><span>Development</span><span>UI / UX</span></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="features" id="features">
        <div class="container">
            <div class="section-head">
                <p class="eyebrow">Why FolioFlow</p>
                <h2>Everything you need, nothing you don't</h2>
                <p>Three simple steps to a portfolio you'll be proud to share.</p>
            </div>
            <div class="features-grid">
                <div class="feature-card"><div class="feature-icon">☁️</div><h3>Online Storage</h3><p>Your portfolio data is saved securely to a cloud database — accessible anytime, from any device, and never lost.</p></div>
                <div class="feature-card"><div class="feature-icon">🎨</div><h3>3 Distinct Templates</h3><p>Choose from Simple, Modern, or Creative layouts — each with a completely different visual style to match your personality.</p></div>
                <div class="feature-card"><div class="feature-icon">⚡</div><h3>Easy Customization</h3><p>Fill in one form, preview instantly, and edit or delete your portfolio whenever you want. No coding required.</p></div>
            </div>
        </div>
    </section>

    <section class="cta-strip" id="templates">
        <div class="container">
            <div class="cta-box">
                <h2>Ready to build your portfolio?</h2>
                <p>It only takes a few minutes. Enter your details, pick a template, and generate your portfolio today.</p>
                <a href="{{ auth()->check() ? route('portfolio.create') : route('register') }}" class="btn btn-primary" style="margin-bottom: 30px;">Create My Portfolio</a>
                
                {{-- NEW TEMPLATE EXAMPLES FOR TEACHER --}}
                <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-top: 20px;">
                    <div style="background: rgba(0,0,0,0.2); padding: 20px; border-radius: 12px; border: 1px solid rgba(255,255,255,0.1);">
                        <h3 style="color: #fff; margin-bottom: 8px; font-size: 1.1rem;">Simple</h3>
                        <p style="color: #9aa7bd; font-size: 14px; margin: 0;">Clean, minimal, and professional.</p>
                    </div>
                    <div style="background: rgba(0,0,0,0.2); padding: 20px; border-radius: 12px; border: 1px solid rgba(255,255,255,0.1);">
                        <h3 style="color: #fff; margin-bottom: 8px; font-size: 1.1rem;">Modern</h3>
                        <p style="color: #9aa7bd; font-size: 14px; margin: 0;">Card-based, dark, and tech-forward.</p>
                    </div>
                    <div style="background: rgba(0,0,0,0.2); padding: 20px; border-radius: 12px; border: 1px solid rgba(255,255,255,0.1);">
                        <h3 style="color: #fff; margin-bottom: 8px; font-size: 1.1rem;">Creative</h3>
                        <p style="color: #9aa7bd; font-size: 14px; margin: 0;">Bold, colorful, and expressive.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-brand">
                    <a href="{{ url('/') }}" class="logo"><span class="logo-mark">✦</span><span>FolioFlow</span></a>
                    <p>An Online Portfolio Template Generator built for students, creatives, and professionals who want a portfolio — fast.</p>
                </div>
                <div>
                    <h4>Navigation</h4>
                    <ul>
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li><a href="#templates">Templates</a></li>
                        @auth<li><a href="{{ route('portfolio.index') }}">My Portfolios</a></li>@endauth
                    </ul>
                </div>
                <div>
                    <h4>Project</h4>
                    <ul><li><a href="#features">Features</a></li><li><a href="#templates">Templates</a></li></ul>
                </div>
            </div>
            <div class="footer-bottom">
                <span>&copy; {{ date('Y') }} FolioFlow. All rights reserved.</span>
                <span>HCI · IM · WST2 Project</span>
            </div>
        </div>
    </footer>
</body>
</html>