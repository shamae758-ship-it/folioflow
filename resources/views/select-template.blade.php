{{-- resources/views/select-template.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Template — FolioFlow</title>
    <style>
        /* ============ RESET & BASE ============ */
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root { --bg: #0b0f19; --bg-soft: #111827; --surface: #161e2e; --surface-2: #1c2740; --border: #243049; --text: #e7ecf5; --text-muted: #9aa7bd; --primary: #6366f1; --primary-hover: #4f52e0; --accent: #22d3ee; --accent-2: #a855f7; --danger: #ef4444; --radius: 14px; --radius-sm: 10px; --shadow: 0 10px 30px rgba(0,0,0,0.35); --transition: 0.25s ease; }

        html { scroll-behavior: smooth; }

        body { font-family: "Inter", "Segoe UI", system-ui, -apple-system, sans-serif; background: var(--bg); color: var(--text); line-height: 1.6; -webkit-font-smoothing: antialiased; }

        a { text-decoration: none; color: inherit; }
        img { max-width: 100%; display: block; }

        /* ============ LAYOUT HELPERS ============ */
        .container { width: 100%; max-width: 1180px; margin: 0 auto; padding: 0 24px; }

        /* ============ NAVBAR ============ */
        .navbar { position: sticky; top: 0; z-index: 100; background: rgba(11,15,25,0.85); backdrop-filter: blur(12px); border-bottom: 1px solid var(--border); }
        .navbar-inner { display: flex; align-items: center; justify-content: space-between; height: 72px; }
        .logo { display: flex; align-items: center; gap: 10px; font-weight: 800; font-size: 1.35rem; letter-spacing: -0.02em; }
        .logo-mark { width: 34px; height: 34px; border-radius: 9px; background: linear-gradient(135deg, var(--primary), var(--accent)); display: grid; place-items: center; font-size: 1rem; color: #fff; box-shadow: 0 6px 16px rgba(99,102,241,0.45); }
        .logo span { background: linear-gradient(135deg, #fff, #b8c2ff); -webkit-background-clip: text; background-clip: text; -webkit-text-fill-color: transparent; }
        .back-link { display: inline-flex; align-items: center; gap: 8px; color: var(--text-muted); font-size: 0.92rem; font-weight: 500; transition: color var(--transition); }
        .back-link:hover { color: var(--accent); }

        /* ============ BUTTONS ============ */
        .btn { display: inline-flex; align-items: center; justify-content: center; gap: 8px; border: none; cursor: pointer; font-family: inherit; font-weight: 600; font-size: 0.95rem; padding: 13px 26px; border-radius: var(--radius-sm); transition: transform var(--transition), background var(--transition), box-shadow var(--transition), border-color var(--transition); white-space: nowrap; }
        .btn-primary { background: linear-gradient(135deg, var(--primary), var(--accent-2)); color: #fff; box-shadow: 0 8px 22px rgba(99,102,241,0.4); }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 12px 28px rgba(99,102,241,0.55); }
        .btn-primary:disabled { opacity: 0.4; cursor: not-allowed; transform: none; box-shadow: none; }
        .btn-ghost { background: transparent; color: var(--text); border: 1px solid var(--border); }
        .btn-ghost:hover { background: var(--surface); border-color: var(--primary); transform: translateY(-2px); }

        /* ============ PROGRESS STEPS ============ */
        .steps { display: flex; align-items: center; justify-content: center; gap: 14px; padding: 40px 0 10px; flex-wrap: wrap; }
        .step { display: flex; align-items: center; gap: 10px; color: var(--text-muted); font-size: 0.87rem; font-weight: 600; }
        .step-num { width: 30px; height: 30px; border-radius: 50%; display: grid; place-items: center; background: var(--surface); border: 1px solid var(--border); font-size: 0.82rem; font-weight: 700; }
        .step.done .step-num { background: linear-gradient(135deg, var(--primary), var(--accent)); border-color: transparent; color: #fff; }
        .step.active .step-num { background: rgba(99,102,241,0.16); border-color: var(--primary); color: var(--accent); }
        .step.active { color: var(--text); }
        .step-line { width: 44px; height: 2px; background: var(--border); border-radius: 2px; }
        .step-line.done { background: linear-gradient(90deg, var(--primary), var(--accent)); }

        /* ============ PAGE HEADER ============ */
        .page-head { padding: 40px 0 34px; text-align: center; position: relative; overflow: hidden; }
        .page-head::before { content: ""; position: absolute; top: -260px; left: 50%; transform: translateX(-50%); width: 700px; height: 700px; background: radial-gradient(circle, rgba(99,102,241,0.18), transparent 62%); pointer-events: none; }
        .page-head-inner { position: relative; }
        .page-head .eyebrow { color: var(--accent); font-size: 0.8rem; font-weight: 700; letter-spacing: 0.14em; text-transform: uppercase; margin-bottom: 12px; }
        .page-head h1 { font-size: clamp(1.9rem, 3.4vw, 2.6rem); font-weight: 800; letter-spacing: -0.03em; margin-bottom: 12px; }
        .page-head p { color: var(--text-muted); font-size: 1.02rem; max-width: 620px; margin: 0 auto; }

        /* ============ TEMPLATE GRID ============ */
        .templates-section { padding: 20px 0 90px; }
        .templates-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 26px; }

        /* Hide the actual radio inputs but keep them accessible */
        .template-input { position: absolute; opacity: 0; pointer-events: none; }

        .template-card { position: relative; display: flex; flex-direction: column; background: var(--surface); border: 2px solid var(--border); border-radius: var(--radius); overflow: hidden; cursor: pointer; transition: transform var(--transition), border-color var(--transition), box-shadow var(--transition); }
        .template-card:hover { transform: translateY(-8px); border-color: rgba(99,102,241,0.5); box-shadow: var(--shadow); }
        .template-input:checked + .template-card { border-color: var(--primary); box-shadow: 0 0 0 4px rgba(99,102,241,0.18), var(--shadow); transform: translateY(-8px); }

        /* ---- Selected checkmark badge ---- */
        .template-card .check-badge { position: absolute; top: 14px; right: 14px; width: 32px; height: 32px; border-radius: 50%; background: linear-gradient(135deg, var(--primary), var(--accent)); color: #fff; display: grid; place-items: center; font-size: 1rem; font-weight: 700; opacity: 0; transform: scale(0.6); transition: opacity var(--transition), transform var(--transition); z-index: 3; box-shadow: 0 6px 16px rgba(99,102,241,0.5); }
        .template-input:checked + .template-card .check-badge { opacity: 1; transform: scale(1); }

        /* ---- Preview mock area ---- */
        .template-preview { height: 210px; padding: 22px; border-bottom: 1px solid var(--border); position: relative; overflow: hidden; }

        /* ====== SIMPLE PREVIEW ====== */
        .preview-simple { background: #f7f8fb; display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 10px; }
        .preview-simple .ps-avatar { width: 46px; height: 46px; border-radius: 50%; background: #cbd5e1; }
        .preview-simple .ps-line { height: 8px; border-radius: 4px; background: #dde3ec; }
        .preview-simple .ps-line.w60 { width: 60%; }
        .preview-simple .ps-line.w80 { width: 80%; }
        .preview-simple .ps-line.w40 { width: 40%; }
        .preview-simple .ps-divider { width: 40px; height: 2px; background: #cbd5e1; margin: 4px 0; }

        /* ====== MODERN PREVIEW ====== */
        .preview-modern { background: linear-gradient(135deg, #1e1b4b, #312e81); display: grid; grid-template-columns: 1fr 1fr; gap: 12px; align-content: start; }
        .preview-modern .pm-card { background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.14); border-radius: 8px; padding: 10px; backdrop-filter: blur(4px); }
        .preview-modern .pm-bar { height: 6px; border-radius: 3px; background: rgba(255,255,255,0.32); margin-bottom: 6px; }
        .preview-modern .pm-bar.short { width: 55%; }
        .preview-modern .pm-bar.tiny { width: 35%; }
        .preview-modern .pm-badge { display: inline-block; font-size: 0.55rem; padding: 3px 8px; border-radius: 999px; background: rgba(34,211,238,0.22); color: #a5f3fc; border: 1px solid rgba(34,211,238,0.4); margin-top: 4px; }

        /* ====== CREATIVE PREVIEW ====== */
        .preview-creative { background: linear-gradient(120deg, #f97316 0%, #ec4899 55%, #8b5cf6 100%); display: flex; flex-direction: column; gap: 10px; padding: 20px; }
        .preview-creative .pc-hero { width: 78%; height: 34px; border-radius: 8px 22px 8px 8px; background: rgba(255,255,255,0.28); }
        .preview-creative .pc-row { display: flex; align-items: center; gap: 8px; }
        .preview-creative .pc-dot { width: 12px; height: 12px; border-radius: 50%; background: rgba(255,255,255,0.85); flex-shrink: 0; }
        .preview-creative .pc-line { height: 7px; border-radius: 4px; background: rgba(255,255,255,0.5); flex: 1; }
        .preview-creative .pc-line.short { flex: 0 0 45%; }
        .preview-creative .pc-timeline { width: 2px; height: 14px; background: rgba(255,255,255,0.6); margin-left: 5px; }

        /* ---- Card body ---- */
        .template-body { padding: 24px 24px 26px; flex: 1; display: flex; flex-direction: column; }
        .template-tag { align-self: flex-start; font-size: 0.68rem; font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase; padding: 5px 12px; border-radius: 999px; margin-bottom: 14px; }
        .tag-simple { background: rgba(148,163,184,0.16); color: #cbd5e1; border: 1px solid rgba(148,163,184,0.35); }
        .tag-modern { background: rgba(99,102,241,0.16); color: #c7cbff; border: 1px solid rgba(99,102,241,0.4); }
        .tag-creative { background: rgba(236,72,153,0.16); color: #fbcfe8; border: 1px solid rgba(236,72,153,0.4); }

        .template-body h3 { font-size: 1.25rem; font-weight: 800; letter-spacing: -0.01em; margin-bottom: 8px; }
        .template-body p { color: var(--text-muted); font-size: 0.92rem; margin-bottom: 16px; flex: 1; }
        .template-feats { list-style: none; display: flex; flex-direction: column; gap: 8px; }
        .template-feats li { display: flex; align-items: center; gap: 9px; font-size: 0.86rem; color: var(--text-muted); }
        .template-feats li::before { content: "✓"; color: var(--accent); font-weight: 700; font-size: 0.8rem; }

        /* ---- Footer hint ---- */
        .select-hint { text-align: center; color: var(--text-muted); font-size: 0.88rem; margin-top: 26px; }

        /* ============ STICKY ACTION BAR ============ */
        .action-bar { position: sticky; bottom: 0; z-index: 50; margin-top: 40px; background: rgba(11,15,25,0.9); backdrop-filter: blur(12px); border-top: 1px solid var(--border); padding: 18px 0; }
        .action-bar-inner { display: flex; align-items: center; justify-content: space-between; gap: 18px; flex-wrap: wrap; }
        .action-bar .selected-label { font-size: 0.9rem; color: var(--text-muted); }
        .action-bar .selected-label strong { color: var(--accent); }
        .action-bar-actions { display: flex; gap: 12px; flex-wrap: wrap; }

        /* ============ ALERTS ============ */
        .alert { border-radius: var(--radius-sm); padding: 14px 18px; font-size: 0.9rem; margin-bottom: 24px; max-width: 900px; margin-left: auto; margin-right: auto; }
        .alert-error { background: rgba(239,68,68,0.1); border: 1px solid rgba(239,68,68,0.4); color: #ffb4b4; }

        /* ============ FOOTER ============ */
        .footer { border-top: 1px solid var(--border); background: var(--bg-soft); padding: 30px 0; }
        .footer-bottom { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px; color: var(--text-muted); font-size: 0.85rem; }

        /* ============ RESPONSIVE ============ */
        @media (max-width: 960px) {
            .templates-grid { grid-template-columns: 1fr 1fr; }
        }

        @media (max-width: 680px) {
            .navbar-inner { height: 64px; }
            .templates-grid { grid-template-columns: 1fr; }
            .steps { gap: 8px; }
            .step-line { width: 22px; }
            .step span:not(.step-num) { display: none; }
            .action-bar-inner { flex-direction: column; align-items: stretch; }
            .action-bar .selected-label { text-align: center; }
            .action-bar-actions { flex-direction: column; }
            .action-bar-actions .btn { width: 100%; }
        }
    </style>
</head>
<body>

    {{-- ============ NAVBAR ============ --}}
    <header class="navbar">
        <div class="container navbar-inner">
            <a href="{{ url('/') }}" class="logo">
                <span class="logo-mark">✦</span>
                <span>FolioFlow</span>
            </a>
            <a href="{{ route('portfolio.edit', $portfolio->id) }}" class="back-link">← Back to Information</a>
        </div>
    </header>

    {{-- ============ PROGRESS STEPS ============ --}}
    <div class="container">
        <div class="steps">
            <div class="step done">
                <span class="step-num">✓</span>
                <span>Enter Information</span>
            </div>
            <span class="step-line done"></span>
            <div class="step active">
                <span class="step-num">2</span>
                <span>Select Template</span>
            </div>
            <span class="step-line"></span>
            <div class="step">
                <span class="step-num">3</span>
                <span>Preview</span>
            </div>
        </div>
    </div>

    {{-- ============ PAGE HEADER ============ --}}
    <section class="page-head">
        <div class="container page-head-inner">
            <p class="eyebrow">Step 2 of 2</p>
            <h1>Choose Your Template</h1>
            <p>Pick one of three distinct layouts. You can always change it later from the Manage Portfolios page.</p>
        </div>
    </section>

    {{-- ============ TEMPLATE SELECTION FORM ============ --}}
    <section class="templates-section">
        <div class="container">

            @if ($errors->any())
                <div class="alert alert-error">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('portfolio.updateTemplate', $portfolio->id) }}" method="POST" id="templateForm">
                @csrf
                {{-- Pass the saved portfolio ID forward --}}
                <input type="hidden" name="portfolio_id" value="{{ $portfolio->id ?? old('portfolio_id') }}">

                <div class="templates-grid">

                    {{-- ========== TEMPLATE 1: SIMPLE ========== --}}
                    <div>
                        <input type="radio" name="template" id="template-simple" value="simple" class="template-input"
                            {{ old('template', $portfolio->template ?? '') === 'simple' ? 'checked' : '' }} required>
                        <label for="template-simple" class="template-card">
                            <span class="check-badge">✓</span>

                            <div class="template-preview preview-simple">
                                <div class="ps-avatar"></div>
                                <div class="ps-line w60"></div>
                                <div class="ps-line w80"></div>
                                <div class="ps-divider"></div>
                                <div class="ps-line w40"></div>
                                <div class="ps-line w60"></div>
                            </div>

                            <div class="template-body">
                                <span class="template-tag tag-simple">Simple</span>
                                <h3>Clean &amp; Professional</h3>
                                <p>A minimalist layout with generous whitespace, clear typography, and a calm, distraction-free look.</p>
                                <ul class="template-feats">
                                    <li>Centered header</li>
                                    <li>Single-column content</li>
                                    <li>Print-friendly</li>
                                </ul>
                            </div>
                        </label>
                    </div>

                    {{-- ========== TEMPLATE 2: MODERN ========== --}}
                    <div>
                        <input type="radio" name="template" id="template-modern" value="modern" class="template-input"
                            {{ old('template', $portfolio->template ?? '') === 'modern' ? 'checked' : '' }}>
                        <label for="template-modern" class="template-card">
                            <span class="check-badge">✓</span>

                            <div class="template-preview preview-modern">
                                <div class="pm-card">
                                    <div class="pm-bar"></div>
                                    <div class="pm-bar short"></div>
                                    <span class="pm-badge">Skills</span>
                                </div>
                                <div class="pm-card">
                                    <div class="pm-bar short"></div>
                                    <div class="pm-bar tiny"></div>
                                    <span class="pm-badge">Projects</span>
                                </div>
                                <div class="pm-card">
                                    <div class="pm-bar tiny"></div>
                                    <div class="pm-bar"></div>
                                </div>
                                <div class="pm-card">
                                    <div class="pm-bar short"></div>
                                    <div class="pm-bar tiny"></div>
                                </div>
                            </div>

                            <div class="template-body">
                                <span class="template-tag tag-modern">Modern</span>
                                <h3>Cards &amp; Sections</h3>
                                <p>A structured, dual-column layout using cards, subtle gradients, and badge tags for a tech-forward feel.</p>
                                <ul class="template-feats">
                                    <li>Card-based sections</li>
                                    <li>Dual-column grid</li>
                                    <li>Gradient accents</li>
                                </ul>
                            </div>
                        </label>
                    </div>

                    {{-- ========== TEMPLATE 3: CREATIVE ========== --}}
                    <div>
                        <input type="radio" name="template" id="template-creative" value="creative" class="template-input"
                            {{ old('template', $portfolio->template ?? '') === 'creative' ? 'checked' : '' }}>
                        <label for="template-creative" class="template-card">
                            <span class="check-badge">✓</span>

                            <div class="template-preview preview-creative">
                                <div class="pc-hero"></div>
                                <div class="pc-row">
                                    <span class="pc-dot"></span>
                                    <span class="pc-line"></span>
                                </div>
                                <div class="pc-row">
                                    <span class="pc-timeline"></span>
                                    <span class="pc-line short"></span>
                                </div>
                                <div class="pc-row">
                                    <span class="pc-dot"></span>
                                    <span class="pc-line"></span>
                                </div>
                                <div class="pc-row">
                                    <span class="pc-timeline"></span>
                                    <span class="pc-line short"></span>
                                </div>
                            </div>

                            <div class="template-body">
                                <span class="template-tag tag-creative">Creative</span>
                                <h3>Bold &amp; Expressive</h3>
                                <p>An asymmetric hero banner, vibrant color gradients, and a dynamic timeline layout for standout personalities.</p>
                                <ul class="template-feats">
                                    <li>Asymmetric hero</li>
                                    <li>Timeline layout</li>
                                    <li>Bold color accents</li>
                                </ul>
                            </div>
                        </label>
                    </div>

                </div>

                <p class="select-hint">Tip: click any card to select it. You can preview before finalizing.</p>

                {{-- ========== STICKY ACTION BAR ========== --}}
                <div class="action-bar">
                    <div class="container action-bar-inner">
                        <span class="selected-label">
                            Selected: <strong id="selectedName">None</strong>
                        </span>

                        <div class="action-bar-actions">
                            <a href="{{ route('portfolio.edit', $portfolio->id) }}" class="btn btn-ghost">← Edit Information</a>
                            <button type="submit" class="btn btn-primary" id="generateBtn" disabled>
                                Generate &amp; Preview Portfolio →
                            </button>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </section>

    {{-- ============ FOOTER ============ --}}
    <footer class="footer">
        <div class="container footer-bottom">
            <span>&copy; {{ date('Y') }} FolioFlow. All rights reserved.</span>
            <span>HCI · IM · WST2 Project</span>
        </div>
    </footer>

    {{-- ============ SCRIPTS ============ --}}
    <script>
        const radios = document.querySelectorAll('.template-input');
        const generateBtn = document.getElementById('generateBtn');
        const selectedName = document.getElementById('selectedName');

        const labels = { simple: 'Simple', modern: 'Modern', creative: 'Creative' };

        function updateSelection() {
            const checked = document.querySelector('.template-input:checked');
            if (checked) {
                selectedName.textContent = labels[checked.value] || checked.value;
                generateBtn.disabled = false;
            } else {
                selectedName.textContent = 'None';
                generateBtn.disabled = true;
            }
        }

        radios.forEach(r => r.addEventListener('change', updateSelection));

        /* Run on page load to restore previous selection state */
        updateSelection();
    </script>

</body>
</html>