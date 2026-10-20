{{-- resources/views/templates/modern.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $portfolio->full_name }} — Portfolio</title>
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: "Inter", "Segoe UI", system-ui, -apple-system, sans-serif; background: #0a0e1a; color: #e7ecf5; line-height: 1.65; -webkit-font-smoothing: antialiased; min-height: 100vh; padding: 40px 24px 60px; position: relative; overflow-x: hidden; }
        body::before { content: ""; position: fixed; top: -260px; right: -180px; width: 700px; height: 700px; background: radial-gradient(circle, rgba(99,102,241,0.22), transparent 60%); pointer-events: none; z-index: 0; }
        body::after { content: ""; position: fixed; bottom: -300px; left: -200px; width: 700px; height: 700px; background: radial-gradient(circle, rgba(34,211,238,0.14), transparent 60%); pointer-events: none; z-index: 0; }
        a { color: #a5f3fc; text-decoration: none; transition: color 0.2s ease; }
        a:hover { color: #67e8f9; }
        img { max-width: 100%; display: block; }
        .container { max-width: 1080px; margin: 0 auto; position: relative; z-index: 1; }
        .hero { display: grid; grid-template-columns: auto 1fr; gap: 32px; align-items: center; padding: 40px 36px; background: linear-gradient(135deg, rgba(99,102,241,0.16), rgba(168,85,247,0.08)); border: 1px solid rgba(99,102,241,0.3); border-radius: 20px; backdrop-filter: blur(10px); margin-bottom: 36px; }
        .hero-avatar { width: 120px; height: 120px; border-radius: 24px; overflow: hidden; border: 3px solid rgba(255,255,255,0.1); box-shadow: 0 12px 40px rgba(99,102,241,0.3); flex-shrink: 0; }
        .hero-avatar img { width: 100%; height: 100%; object-fit: cover; }
        .hero-info h1 { font-size: 2.2rem; font-weight: 800; letter-spacing: -0.02em; margin-bottom: 10px; background: linear-gradient(135deg, #fff, #b8c2ff); -webkit-background-clip: text; background-clip: text; -webkit-text-fill-color: transparent; }
        .hero-info .tagline { color: #9aa7bd; font-size: 0.95rem; margin-bottom: 16px; }
        .hero-meta { display: flex; flex-wrap: wrap; gap: 10px; }
        .hero-meta span { font-size: 0.8rem; padding: 6px 14px; border-radius: 999px; background: rgba(99,102,241,0.14); border: 1px solid rgba(99,102,241,0.35); color: #c7cbff; font-weight: 600; }
        .grid { display: grid; grid-template-columns: 1fr 1fr; gap: 22px; }
        .grid .full { grid-column: span 2; }
        .card { background: rgba(22,30,46,0.72); border: 1px solid rgba(255,255,255,0.08); border-radius: 16px; padding: 28px; backdrop-filter: blur(8px); transition: transform 0.25s ease, border-color 0.25s ease; }
        .card:hover { transform: translateY(-4px); border-color: rgba(99,102,241,0.45); }
        .card-head { display: flex; align-items: center; gap: 12px; margin-bottom: 20px; }
        .card-icon { width: 40px; height: 40px; border-radius: 11px; display: grid; place-items: center; font-size: 1.15rem; background: rgba(99,102,241,0.16); border: 1px solid rgba(99,102,241,0.35); }
        .card h2 { font-size: 1rem; font-weight: 700; letter-spacing: 0.05em; text-transform: uppercase; color: #c7cbff; }
        .card p { color: #b8c0d0; font-size: 0.95rem; }
        .row { padding-bottom: 16px; margin-bottom: 16px; border-bottom: 1px solid rgba(255,255,255,0.06); }
        .row:last-child { padding-bottom: 0; margin-bottom: 0; border-bottom: none; }
        .row-title { font-size: 1rem; font-weight: 700; color: #fff; margin-bottom: 3px; }
        .row-sub { font-size: 0.86rem; color: #9aa7bd; }
        .badges { display: flex; flex-wrap: wrap; gap: 9px; }
        .badge { font-size: 0.8rem; font-weight: 600; padding: 6px 14px; border-radius: 999px; background: linear-gradient(135deg, rgba(99,102,241,0.2), rgba(34,211,238,0.12)); border: 1px solid rgba(99,102,241,0.4); color: #d6dcff; }
        .project { padding: 16px; border-radius: 12px; background: rgba(28,39,64,0.6); border: 1px solid rgba(255,255,255,0.06); margin-bottom: 12px; transition: border-color 0.2s ease; }
        .project:last-child { margin-bottom: 0; }
        .project:hover { border-color: rgba(34,211,238,0.4); }
        .project-title { font-size: 0.98rem; font-weight: 700; color: #fff; margin-bottom: 4px; }
        .project-desc { font-size: 0.88rem; color: #9aa7bd; }
        .links-list { display: flex; flex-wrap: wrap; gap: 10px; }
        .links-list a { font-size: 0.86rem; font-weight: 600; padding: 8px 16px; border-radius: 10px; background: rgba(99,102,241,0.12); border: 1px solid rgba(99,102,241,0.35); color: #c7cbff; transition: background 0.2s ease, transform 0.2s ease; }
        .links-list a:hover { background: rgba(99,102,241,0.22); transform: translateY(-2px); }
        .footer { text-align: center; margin-top: 48px; padding-top: 26px; border-top: 1px solid rgba(255,255,255,0.08); font-size: 0.82rem; color: #6a7690; }
        .footer a { color: #a5f3fc; }
        @media (max-width: 780px) {
            .hero { grid-template-columns: 1fr; text-align: center; padding: 32px 24px; }
            .hero-avatar { margin: 0 auto; width: 100px; height: 100px; }
            .hero-info h1 { font-size: 1.7rem; }
            .hero-meta { justify-content: center; }
            .grid { grid-template-columns: 1fr; }
            .grid .full { grid-column: span 1; }
        }
        /* NEW FLOATING BUTTONS */
        .demo-action-bar { position: fixed; bottom: 24px; left: 50%; transform: translateX(-50%); background: #1a1a2e; padding: 12px 24px; border-radius: 999px; box-shadow: 0 10px 30px rgba(0,0,0,0.5); display: flex; gap: 16px; z-index: 9999; border: 1px solid rgba(255,255,255,0.1); }
        .demo-btn-back { color: #fff; text-decoration: none; font-family: sans-serif; font-size: 14px; font-weight: bold; padding: 8px 16px; border-radius: 8px; border: 1px solid #fff; transition: background 0.2s; }
        .demo-btn-back:hover { background: rgba(255,255,255,0.1); }
        .demo-btn-save { color: #fff; text-decoration: none; font-family: sans-serif; font-size: 14px; font-weight: bold; padding: 8px 16px; border-radius: 8px; background: #6366f1; transition: background 0.2s; }
        .demo-btn-save:hover { background: #4f46e5; }
    </style>
</head>
<body>
    <div class="container">
        <section class="hero">
            <div class="hero-avatar"><img src="{{ $portfolio->profile_picture_url }}" alt="{{ $portfolio->full_name }}"></div>
            <div class="hero-info">
                <h1>{{ $portfolio->full_name }}</h1>
                @if ($portfolio->about_me)<p class="tagline">{{ Str::limit($portfolio->about_me, 140) }}</p>@endif
                <div class="hero-meta">
                    @if ($portfolio->email)<span>✉ {{ $portfolio->email }}</span>@endif
                    @if ($portfolio->contact_number)<span>📞 {{ $portfolio->contact_number }}</span>@endif
                    @if ($portfolio->address)<span>📍 {{ $portfolio->address }}</span>@endif
                </div>
            </div>
        </section>

        <div class="grid">
            @if ($portfolio->about_me)
                <div class="card full">
                    <div class="card-head"><div class="card-icon">👤</div><h2>About Me</h2></div>
                    <p>{{ $portfolio->about_me }}</p>
                </div>
            @endif
            @if (!empty($portfolio->skills) && count($portfolio->skills) > 0)
                <div class="card">
                    <div class="card-head"><div class="card-icon">💡</div><h2>Skills</h2></div>
                    <div class="badges">
                        @foreach ($portfolio->skills as $skill) @if (!empty($skill['name']))<span class="badge">{{ $skill['name'] }}</span>@endif @endforeach
                    </div>
                </div>
            @endif
            @if (!empty($portfolio->education) && count($portfolio->education) > 0)
                <div class="card">
                    <div class="card-head"><div class="card-icon">🎓</div><h2>Education</h2></div>
                    @foreach ($portfolio->education as $edu)
                        @if (!empty($edu['school']) || !empty($edu['degree']))
                            <div class="row"><div class="row-title">{{ $edu['degree'] ?? '' }}</div><div class="row-sub">{{ $edu['school'] ?? '' }}</div></div>
                        @endif
                    @endforeach
                </div>
            @endif
            @if (!empty($portfolio->experience) && count($portfolio->experience) > 0)
                <div class="card">
                    <div class="card-head"><div class="card-icon">💼</div><h2>Experience</h2></div>
                    @foreach ($portfolio->experience as $exp)
                        @if (!empty($exp['position']) || !empty($exp['company']))
                            <div class="row"><div class="row-title">{{ $exp['position'] ?? '' }}</div><div class="row-sub">{{ $exp['company'] ?? '' }}</div></div>
                        @endif
                    @endforeach
                </div>
            @endif
            @if (!empty($portfolio->projects) && count($portfolio->projects) > 0)
                <div class="card">
                    <div class="card-head"><div class="card-icon">🚀</div><h2>Projects</h2></div>
                    @foreach ($portfolio->projects as $project)
                        @if (!empty($project['title']))
                            <div class="project">
                                <div class="project-title">{{ $project['title'] }}</div>
                                @if (!empty($project['description']))<div class="project-desc">{{ $project['description'] }}</div>@endif
                            </div>
                        @endif
                    @endforeach
                </div>
            @endif
            @if (!empty($portfolio->social_links) && count($portfolio->social_links) > 0)
                <div class="card full">
                    <div class="card-head"><div class="card-icon">🔗</div><h2>Connect</h2></div>
                    <div class="links-list">
                        @foreach ($portfolio->social_links as $link)
                            @if (!empty($link['url']) && !empty($link['label']))<a href="{{ $link['url'] }}" target="_blank" rel="noopener">{{ $link['label'] }}</a>@endif
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
        <footer class="footer">Generated with <a href="{{ url('/') }}">FolioFlow</a></footer>
    </div>

    <!-- NEW FLOATING BUTTONS -->
    <div class="demo-action-bar">
        <a href="{{ route('portfolio.selectTemplate', $portfolio->id) }}" class="demo-btn-back">← Change Template</a>
        <a href="{{ route('portfolio.index') }}" class="demo-btn-save">Save & Finish</a>
    </div>
</body>
</html>