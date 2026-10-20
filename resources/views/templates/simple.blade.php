{{-- resources/views/templates/simple.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $portfolio->full_name }} — Portfolio</title>
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: "Georgia", "Times New Roman", serif; background: #fafaf7; color: #2a2a2a; line-height: 1.75; -webkit-font-smoothing: antialiased; padding: 60px 24px; }
        a { color: #2a2a2a; text-decoration: none; border-bottom: 1px solid #d0d0c8; transition: border-color 0.2s ease; }
        a:hover { border-color: #2a2a2a; }
        img { max-width: 100%; display: block; }
        .container { max-width: 720px; margin: 0 auto; }
        .header { text-align: center; padding-bottom: 40px; border-bottom: 1px solid #e5e5dc; margin-bottom: 50px; }
        .avatar { width: 130px; height: 130px; border-radius: 50%; margin: 0 auto 24px; overflow: hidden; border: 4px solid #fff; box-shadow: 0 8px 24px rgba(0,0,0,0.08); }
        .avatar img { width: 100%; height: 100%; object-fit: cover; }
        .header h1 { font-size: 2.4rem; font-weight: 400; letter-spacing: -0.01em; margin-bottom: 12px; color: #1a1a1a; }
        .header .contact { color: #6a6a6a; font-size: 0.94rem; font-family: "Helvetica", sans-serif; }
        .header .contact span { margin: 0 10px; }
        .header .contact span:not(:last-child)::after { content: "·"; margin-left: 10px; color: #b0b0b0; }
        .section { margin-bottom: 48px; }
        .section-title { font-family: "Helvetica", sans-serif; font-size: 0.78rem; font-weight: 700; letter-spacing: 0.18em; text-transform: uppercase; color: #8a8a8a; margin-bottom: 20px; padding-bottom: 10px; border-bottom: 1px solid #e5e5dc; }
        .about-text { font-size: 1.05rem; color: #3a3a3a; }
        .row { margin-bottom: 24px; }
        .row:last-child { margin-bottom: 0; }
        .row-title { font-size: 1.05rem; font-weight: 600; color: #1a1a1a; margin-bottom: 4px; }
        .row-subtitle { font-size: 0.92rem; color: #6a6a6a; font-family: "Helvetica", sans-serif; }
        .skills { display: flex; flex-wrap: wrap; gap: 10px; }
        .skill { font-family: "Helvetica", sans-serif; font-size: 0.85rem; padding: 6px 14px; background: #f0f0e8; color: #3a3a3a; border-radius: 999px; }
        .project { margin-bottom: 22px; }
        .project:last-child { margin-bottom: 0; }
        .project-title { font-size: 1.05rem; font-weight: 600; color: #1a1a1a; margin-bottom: 4px; }
        .project-desc { font-size: 0.95rem; color: #4a4a4a; }
        .links { display: flex; flex-wrap: wrap; gap: 20px; font-family: "Helvetica", sans-serif; font-size: 0.92rem; }
        .empty { color: #a0a0a0; font-style: italic; font-size: 0.92rem; }
        .footer { text-align: center; margin-top: 60px; padding-top: 30px; border-top: 1px solid #e5e5dc; font-family: "Helvetica", sans-serif; font-size: 0.82rem; color: #a0a0a0; }
        .footer a { border-bottom: none; }
        @media (max-width: 600px) {
            body { padding: 40px 18px; }
            .header h1 { font-size: 1.85rem; }
            .avatar { width: 100px; height: 100px; }
            .header .contact span { display: block; margin: 4px 0; }
            .header .contact span::after { display: none; }
        }
        /* NEW FLOATING BUTTONS FOR TEACHER */
        .demo-action-bar { position: fixed; bottom: 24px; left: 50%; transform: translateX(-50%); background: #1a1a2e; padding: 12px 24px; border-radius: 999px; box-shadow: 0 10px 30px rgba(0,0,0,0.3); display: flex; gap: 16px; z-index: 9999; border: 1px solid #243049; }
        .demo-btn-back { color: #fff; text-decoration: none; font-family: sans-serif; font-size: 14px; font-weight: bold; padding: 8px 16px; border-radius: 8px; border: 1px solid #fff; transition: background 0.2s; }
        .demo-btn-back:hover { background: rgba(255,255,255,0.1); }
        .demo-btn-save { color: #fff; text-decoration: none; font-family: sans-serif; font-size: 14px; font-weight: bold; padding: 8px 16px; border-radius: 8px; background: #6366f1; transition: background 0.2s; }
        .demo-btn-save:hover { background: #4f46e5; }
    </style>
</head>
<body>

    <div class="container">
        <header class="header">
            <div class="avatar">
                <img src="{{ $portfolio->profile_picture_url }}" alt="{{ $portfolio->full_name }}">
            </div>
            <h1>{{ $portfolio->full_name }}</h1>
            <div class="contact">
                @if ($portfolio->email)<span>{{ $portfolio->email }}</span>@endif
                @if ($portfolio->contact_number)<span>{{ $portfolio->contact_number }}</span>@endif
                @if ($portfolio->address)<span>{{ $portfolio->address }}</span>@endif
            </div>
        </header>

        @if ($portfolio->about_me)
            <section class="section">
                <h2 class="section-title">About</h2>
                <p class="about-text">{{ $portfolio->about_me }}</p>
            </section>
        @endif

        @if (!empty($portfolio->education) && count($portfolio->education) > 0)
            <section class="section">
                <h2 class="section-title">Education</h2>
                @foreach ($portfolio->education as $edu)
                    @if (!empty($edu['school']) || !empty($edu['degree']))
                        <div class="row">
                            <div class="row-title">{{ $edu['degree'] ?? '' }}</div>
                            <div class="row-subtitle">{{ $edu['school'] ?? '' }}</div>
                        </div>
                    @endif
                @endforeach
            </section>
        @endif

        @if (!empty($portfolio->skills) && count($portfolio->skills) > 0)
            <section class="section">
                <h2 class="section-title">Skills</h2>
                <div class="skills">
                    @foreach ($portfolio->skills as $skill)
                        @if (!empty($skill['name']))<span class="skill">{{ $skill['name'] }}</span>@endif
                    @endforeach
                </div>
            </section>
        @endif

        @if (!empty($portfolio->projects) && count($portfolio->projects) > 0)
            <section class="section">
                <h2 class="section-title">Projects</h2>
                @foreach ($portfolio->projects as $project)
                    @if (!empty($project['title']))
                        <div class="project">
                            <div class="project-title">{{ $project['title'] }}</div>
                            @if (!empty($project['description']))<div class="project-desc">{{ $project['description'] }}</div>@endif
                        </div>
                    @endif
                @endforeach
            </section>
        @endif

        @if (!empty($portfolio->experience) && count($portfolio->experience) > 0)
            <section class="section">
                <h2 class="section-title">Experience</h2>
                @foreach ($portfolio->experience as $exp)
                    @if (!empty($exp['position']) || !empty($exp['company']))
                        <div class="row">
                            <div class="row-title">{{ $exp['position'] ?? '' }}</div>
                            <div class="row-subtitle">{{ $exp['company'] ?? '' }}</div>
                        </div>
                    @endif
                @endforeach
            </section>
        @endif

        @if (!empty($portfolio->social_links) && count($portfolio->social_links) > 0)
            <section class="section">
                <h2 class="section-title">Connect</h2>
                <div class="links">
                    @foreach ($portfolio->social_links as $link)
                        @if (!empty($link['url']) && !empty($link['label']))<a href="{{ $link['url'] }}" target="_blank" rel="noopener">{{ $link['label'] }}</a>@endif
                    @endforeach
                </div>
            </section>
        @endif

        <footer class="footer">
            Generated with <a href="{{ url('/') }}">FolioFlow</a>
        </footer>
    </div>

    <!-- NEW FLOATING BUTTONS -->
    <div class="demo-action-bar">
        <a href="{{ route('portfolio.selectTemplate', $portfolio->id) }}" class="demo-btn-back">← Change Template</a>
        <a href="{{ route('portfolio.index') }}" class="demo-btn-save">Save & Finish</a>
    </div>

</body>
</html>