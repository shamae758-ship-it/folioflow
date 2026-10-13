{{-- resources/views/index.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Portfolios — FolioFlow</title>
    <style>
        /* ============ RESET & BASE ============ */
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root { --bg: #0b0f19; --bg-soft: #111827; --surface: #161e2e; --surface-2: #1c2740; --border: #243049; --text: #e7ecf5; --text-muted: #9aa7bd; --primary: #6366f1; --primary-hover: #4f52e0; --accent: #22d3ee; --accent-2: #a855f7; --danger: #ef4444; --success: #22c55e; --warning: #f59e0b; --radius: 14px; --radius-sm: 10px; --shadow: 0 10px 30px rgba(0,0,0,0.35); --transition: 0.25s ease; }

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

        .nav-links { display: flex; align-items: center; gap: 30px; list-style: none; }
        .nav-links a { color: var(--text-muted); font-size: 0.95rem; font-weight: 500; transition: color var(--transition); position: relative; }
        .nav-links a:hover, .nav-links a.active { color: var(--text); }
        .nav-links a.active::after { content: ""; position: absolute; left: 0; bottom: -6px; width: 100%; height: 2px; background: linear-gradient(90deg, var(--primary), var(--accent)); border-radius: 2px; }

        /* ============ BUTTONS ============ */
        .btn { display: inline-flex; align-items: center; justify-content: center; gap: 8px; border: none; cursor: pointer; font-family: inherit; font-weight: 600; font-size: 0.95rem; padding: 12px 22px; border-radius: var(--radius-sm); transition: transform var(--transition), background var(--transition), box-shadow var(--transition), border-color var(--transition); white-space: nowrap; text-decoration: none; }
        .btn-primary { background: linear-gradient(135deg, var(--primary), var(--accent-2)); color: #fff; box-shadow: 0 8px 22px rgba(99,102,241,0.4); }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 12px 28px rgba(99,102,241,0.55); }
        .btn-ghost { background: transparent; color: var(--text); border: 1px solid var(--border); }
        .btn-ghost:hover { background: var(--surface); border-color: var(--primary); transform: translateY(-2px); }
        .btn-sm { padding: 9px 16px; font-size: 0.85rem; }

        .btn-icon { display: inline-flex; align-items: center; justify-content: center; width: 38px; height: 38px; border-radius: 9px; border: 1px solid var(--border); background: transparent; color: var(--text-muted); cursor: pointer; font-size: 0.95rem; transition: background var(--transition), border-color var(--transition), color var(--transition), transform var(--transition); text-decoration: none; }
        .btn-icon:hover { transform: translateY(-2px); }
        .btn-icon.view:hover { background: rgba(34,211,238,0.12); border-color: var(--accent); color: var(--accent); }
        .btn-icon.edit:hover { background: rgba(99,102,241,0.12); border-color: var(--primary); color: #c7cbff; }
        .btn-icon.delete:hover { background: rgba(239,68,68,0.12); border-color: var(--danger); color: #ffb4b4; }

        /* ============ PAGE HEADER ============ */
        .page-head { padding: 56px 0 34px; position: relative; overflow: hidden; }
        .page-head::before { content: ""; position: absolute; top: -260px; left: 50%; transform: translateX(-50%); width: 700px; height: 700px; background: radial-gradient(circle, rgba(99,102,241,0.18), transparent 62%); pointer-events: none; }
        .page-head-inner { position: relative; display: flex; align-items: flex-end; justify-content: space-between; gap: 24px; flex-wrap: wrap; }
        .page-head .eyebrow { color: var(--accent); font-size: 0.8rem; font-weight: 700; letter-spacing: 0.14em; text-transform: uppercase; margin-bottom: 12px; }
        .page-head h1 { font-size: clamp(1.9rem, 3.4vw, 2.6rem); font-weight: 800; letter-spacing: -0.03em; margin-bottom: 8px; }
        .page-head p { color: var(--text-muted); font-size: 1.02rem; max-width: 620px; }

        /* ============ STATS BAR ============ */
        .stats { display: grid; grid-template-columns: repeat(3, 1fr); gap: 18px; padding: 8px 0 34px; }
        .stat { background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius); padding: 22px 24px; display: flex; align-items: center; gap: 16px; }
        .stat-icon { width: 46px; height: 46px; border-radius: 12px; display: grid; place-items: center; font-size: 1.3rem; background: rgba(99,102,241,0.14); border: 1px solid rgba(99,102,241,0.3); flex-shrink: 0; }
        .stat-info strong { display: block; font-size: 1.5rem; font-weight: 800; letter-spacing: -0.02em; line-height: 1.1; }
        .stat-info span { color: var(--text-muted); font-size: 0.85rem; }

        /* ============ PORTFOLIO LIST WRAP ============ */
        .portfolios-section { padding: 0 0 90px; }

        /* ---- Table view (desktop) ---- */
        .table-wrap { background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius); overflow: hidden; box-shadow: var(--shadow); }

        table { width: 100%; border-collapse: collapse; }
        thead th { text-align: left; font-size: 0.78rem; font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase; color: var(--text-muted); padding: 18px 24px; background: var(--bg-soft); border-bottom: 1px solid var(--border); }
        tbody td { padding: 18px 24px; border-bottom: 1px solid var(--border); font-size: 0.92rem; vertical-align: middle; }
        tbody tr:last-child td { border-bottom: none; }
        tbody tr { transition: background var(--transition); }
        tbody tr:hover { background: rgba(99,102,241,0.05); }

        .portfolio-name { display: flex; align-items: center; gap: 14px; }
        .portfolio-avatar { width: 44px; height: 44px; border-radius: 50%; background: linear-gradient(135deg, var(--primary), var(--accent)); display: grid; place-items: center; font-size: 1rem; font-weight: 700; color: #fff; overflow: hidden; flex-shrink: 0; }
        .portfolio-avatar img { width: 100%; height: 100%; object-fit: cover; }
        .portfolio-name strong { display: block; font-weight: 700; color: var(--text); }
        .portfolio-name span { color: var(--text-muted); font-size: 0.82rem; }

        .template-pill { display: inline-flex; align-items: center; gap: 6px; padding: 5px 12px; border-radius: 999px; font-size: 0.76rem; font-weight: 700; text-transform: capitalize; letter-spacing: 0.03em; }
        .pill-simple { background: rgba(148,163,184,0.16); color: #cbd5e1; border: 1px solid rgba(148,163,184,0.35); }
        .pill-modern { background: rgba(99,102,241,0.16); color: #c7cbff; border: 1px solid rgba(99,102,241,0.4); }
        .pill-creative { background: rgba(236,72,153,0.16); color: #fbcfe8; border: 1px solid rgba(236,72,153,0.4); }

        .status-pill { display: inline-flex; align-items: center; gap: 7px; font-size: 0.82rem; color: var(--text-muted); }
        .status-dot { width: 8px; height: 8px; border-radius: 50%; background: var(--success); box-shadow: 0 0 0 4px rgba(34,197,94,0.18); }
        .status-dot.draft { background: var(--warning); box-shadow: 0 0 0 4px rgba(245,158,11,0.18); }

        .actions-cell { display: flex; align-items: center; gap: 8px; justify-content: flex-end; }
        .actions-cell form { display: inline; }

        /* ---- Card view (mobile) ---- */
        .cards-list { display: none; flex-direction: column; gap: 16px; }
        .p-card { background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius); padding: 20px; box-shadow: var(--shadow); }
        .p-card-head { display: flex; align-items: center; gap: 14px; margin-bottom: 16px; }
        .p-card-meta { display: flex; flex-wrap: wrap; gap: 10px; align-items: center; margin-bottom: 16px; font-size: 0.85rem; color: var(--text-muted); }
        .p-card .actions-cell { justify-content: flex-start; }

        /* ============ EMPTY STATE ============ */
        .empty-state { background: var(--surface); border: 1.5px dashed var(--border); border-radius: var(--radius); padding: 72px 40px; text-align: center; box-shadow: var(--shadow); }
        .empty-icon { width: 88px; height: 88px; border-radius: 22px; display: grid; place-items: center; font-size: 2.4rem; margin: 0 auto 24px; background: rgba(99,102,241,0.12); border: 1px solid rgba(99,102,241,0.3); }
        .empty-state h2 { font-size: 1.5rem; font-weight: 800; letter-spacing: -0.02em; margin-bottom: 12px; }
        .empty-state p { color: var(--text-muted); max-width: 460px; margin: 0 auto 28px; }

        /* ============ ALERTS ============ */
        .alert { border-radius: var(--radius-sm); padding: 14px 18px; font-size: 0.9rem; margin-bottom: 24px; display: flex; align-items: center; gap: 12px; }
        .alert-success { background: rgba(34,197,94,0.1); border: 1px solid rgba(34,197,94,0.4); color: #bbf7d0; }
        .alert-error { background: rgba(239,68,68,0.1); border: 1px solid rgba(239,68,68,0.4); color: #ffb4b4; }

        /* ============ MODAL ============ */
        .modal-backdrop { position: fixed; inset: 0; background: rgba(0,0,0,0.65); backdrop-filter: blur(6px); z-index: 200; display: none; align-items: center; justify-content: center; padding: 24px; }
        .modal-backdrop.open { display: flex; }
        .modal { background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius); padding: 32px; max-width: 440px; width: 100%; box-shadow: 0 30px 60px rgba(0,0,0,0.5); }
        .modal-icon { width: 60px; height: 60px; border-radius: 16px; display: grid; place-items: center; font-size: 1.7rem; margin-bottom: 20px; background: rgba(239,68,68,0.12); border: 1px solid rgba(239,68,68,0.35); }
        .modal h3 { font-size: 1.3rem; font-weight: 800; margin-bottom: 10px; letter-spacing: -0.02em; }
        .modal p { color: var(--text-muted); font-size: 0.94rem; margin-bottom: 26px; }
        .modal p strong { color: var(--text); }
        .modal-actions { display: flex; gap: 12px; justify-content: flex-end; flex-wrap: wrap; }

        /* ============ FOOTER ============ */
        .footer { border-top: 1px solid var(--border); background: var(--bg-soft); padding: 30px 0; }
        .footer-bottom { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px; color: var(--text-muted); font-size: 0.85rem; }

        /* ============ RESPONSIVE ============ */
        @media (max-width: 860px) {
            .stats { grid-template-columns: 1fr; }
            .page-head-inner { align-items: flex-start; }
            .table-wrap { display: none; }
            .cards-list { display: flex; }
        }

        @media (max-width: 640px) {
            .navbar-inner { height: 64px; }
            .nav-links { display: none; }
            .page-head { padding: 40px 0 26px; }
            .empty-state { padding: 56px 24px; }
            .modal-actions { flex-direction: column-reverse; }
            .modal-actions .btn { width: 100%; }
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

            <nav>
                <ul class="nav-links">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li><a href="{{ url('/portfolios') }}" class="active">My Portfolios</a></li>
                </ul>
            </nav>
        </div>
    </header>

    {{-- ============ PAGE HEADER ============ --}}
    <section class="page-head">
        <div class="container page-head-inner">
            <div>
                <p class="eyebrow">Dashboard</p>
                <h1>Manage Portfolios</h1>
                <p>View, edit, preview, or delete any portfolio you've created.</p>
            </div>
            <a href="{{ route('portfolio.create') }}" class="btn btn-primary">＋ Create New Portfolio</a>
        </div>
    </section>

    {{-- ============ FLASH MESSAGES ============ --}}
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success">
                <span>✓</span>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-error">
                <span>⚠</span>
                <span>{{ session('error') }}</span>
            </div>
        @endif
    </div>

    {{-- ============ MAIN CONTENT ============ --}}
    <section class="portfolios-section">
        <div class="container">

            @if (isset($portfolios) && $portfolios->count() > 0)

                {{-- ========== STATS BAR ========== --}}
                <div class="stats">
                    <div class="stat">
                        <div class="stat-icon">📁</div>
                        <div class="stat-info">
                            <strong>{{ $portfolios->total() }}</strong>
                            <span>Total Portfolios</span>
                        </div>
                    </div>
                    <div class="stat">
                        <div class="stat-icon">🎨</div>
                        <div class="stat-info">
                            <strong>{{ $portfolios->pluck('template')->filter()->unique()->count() }}</strong>
                            <span>Templates in Use</span>
                        </div>
                    </div>
                    <div class="stat">
                        <div class="stat-icon">🕒</div>
                        <div class="stat-info">
                            <strong>{{ optional($portfolios->first())->updated_at?->diffForHumans() ?? '—' }}</strong>
                            <span>Last Updated</span>
                        </div>
                    </div>
                </div>

                {{-- ========== DESKTOP TABLE ========== --}}
                <div class="table-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th>Portfolio</th>
                                <th>Template</th>
                                <th>Created</th>
                                <th>Status</th>
                                <th style="text-align: right;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($portfolios as $portfolio)
                                <tr>
                                    <td>
                                        <div class="portfolio-name">
                                            <div class="portfolio-avatar">
                                                @if (!empty($portfolio->profile_picture))
                                                    <img src="{{ asset('storage/' . $portfolio->profile_picture) }}" alt="{{ $portfolio->full_name }}">
                                                @else
                                                    {{ strtoupper(substr($portfolio->full_name ?? 'U', 0, 1)) }}
                                                @endif
                                            </div>
                                            <div>
                                                <strong>{{ $portfolio->full_name ?? 'Untitled Portfolio' }}</strong>
                                                <span>{{ $portfolio->email ?? '—' }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        @php $tpl = $portfolio->template ?? 'simple'; @endphp
                                        <span class="template-pill pill-{{ $tpl }}">{{ $tpl }}</span>
                                    </td>
                                    <td>
                                        <span style="color: var(--text-muted);">{{ optional($portfolio->created_at)->format('M d, Y') ?? '—' }}</span>
                                    </td>
                                    <td>
                                        @if (!empty($portfolio->template))
                                            <span class="status-pill"><span class="status-dot"></span> Generated</span>
                                        @else
                                            <span class="status-pill"><span class="status-dot draft"></span> Draft</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="actions-cell">
                                            <a href="{{ route('portfolio.show', $portfolio->id) }}" class="btn-icon view" title="Preview" target="_blank">👁</a>
                                            <a href="{{ route('portfolio.edit', $portfolio->id) }}" class="btn-icon edit" title="Edit">✎</a>

                                            <form action="{{ route('portfolio.destroy', $portfolio->id) }}" method="POST" class="delete-form" data-name="{{ $portfolio->full_name ?? 'this portfolio' }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-icon delete" title="Delete">🗑</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- ========== MOBILE CARDS ========== --}}
                <div class="cards-list">
                    @foreach ($portfolios as $portfolio)
                        <div class="p-card">
                            <div class="p-card-head">
                                <div class="portfolio-avatar">
                                    @if (!empty($portfolio->profile_picture))
                                        <img src="{{ asset('storage/' . $portfolio->profile_picture) }}" alt="{{ $portfolio->full_name }}">
                                    @else
                                        {{ strtoupper(substr($portfolio->full_name ?? 'U', 0, 1)) }}
                                    @endif
                                </div>
                                <div>
                                    <strong style="display: block;">{{ $portfolio->full_name ?? 'Untitled Portfolio' }}</strong>
                                    <span style="color: var(--text-muted); font-size: 0.82rem;">{{ $portfolio->email ?? '—' }}</span>
                                </div>
                            </div>

                            <div class="p-card-meta">
                                @php $tpl = $portfolio->template ?? 'simple'; @endphp
                                <span class="template-pill pill-{{ $tpl }}">{{ $tpl }}</span>
                                <span>·</span>
                                <span>{{ optional($portfolio->created_at)->format('M d, Y') ?? '—' }}</span>
                                <span>·</span>
                                @if (!empty($portfolio->template))
                                    <span class="status-pill"><span class="status-dot"></span> Generated</span>
                                @else
                                    <span class="status-pill"><span class="status-dot draft"></span> Draft</span>
                                @endif
                            </div>

                            <div class="actions-cell">
                                <a href="{{ route('portfolio.show', $portfolio->id) }}" class="btn-icon view" title="Preview" target="_blank">👁</a>
                                <a href="{{ route('portfolio.edit', $portfolio->id) }}" class="btn-icon edit" title="Edit">✎</a>

                                <form action="{{ route('portfolio.destroy', $portfolio->id) }}" method="POST" class="delete-form" data-name="{{ $portfolio->full_name ?? 'this portfolio' }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-icon delete" title="Delete">🗑</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- ========== PAGINATION ========== --}}
                @if (method_exists($portfolios, 'links') && $portfolios->hasPages())
                    <div style="margin-top: 34px; display: flex; justify-content: center;">
                        {{ $portfolios->links() }}
                    </div>
                @endif

            @else

                {{-- ========== EMPTY STATE ========== --}}
                <div class="empty-state">
                    <div class="empty-icon">📭</div>
                    <h2>No Portfolios Yet</h2>
                    <p>You haven't created any portfolios. Start by entering your information and choosing one of our three templates.</p>
                    <a href="{{ route('portfolio.create') }}" class="btn btn-primary">Create My First Portfolio →</a>
                </div>

            @endif

        </div>
    </section>

    {{-- ============ DELETE CONFIRMATION MODAL ============ --}}
    <div class="modal-backdrop" id="deleteModal">
        <div class="modal">
            <div class="modal-icon">🗑</div>
            <h3>Delete Portfolio?</h3>
            <p>
                You are about to permanently delete <strong id="deleteTargetName">this portfolio</strong>.
                This action <strong>cannot be undone</strong>.
            </p>

            <form id="deleteModalForm" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-actions">
                    <button type="button" class="btn btn-ghost" id="cancelDelete">Cancel</button>
                    <button type="submit" class="btn btn-primary" style="background: linear-gradient(135deg, #ef4444, #b91c1c); box-shadow: 0 8px 22px rgba(239,68,68,0.35);">Yes, Delete</button>
                </div>
            </form>
        </div>
    </div>

    {{-- ============ FOOTER ============ --}}
    <footer class="footer">
        <div class="container footer-bottom">
            <span>&copy; {{ date('Y') }} FolioFlow. All rights reserved.</span>
            <span>HCI · IM · WST2 Project</span>
        </div>
    </footer>

    {{-- ============ SCRIPTS ============ --}}
    <script>
        const modal = document.getElementById('deleteModal');
        const modalForm = document.getElementById('deleteModalForm');
        const deleteTargetName = document.getElementById('deleteTargetName');
        const cancelBtn = document.getElementById('cancelDelete');

        /* Intercept every delete form → show modal first */
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function (e) {
                e.preventDefault();
                modalForm.action = this.action;
                deleteTargetName.textContent = this.dataset.name || 'this portfolio';
                modal.classList.add('open');
            });
        });

        /* Cancel */
        cancelBtn.addEventListener('click', () => modal.classList.remove('open'));

        /* Close on backdrop click */
        modal.addEventListener('click', e => { if (e.target === modal) modal.classList.remove('open'); });

        /* Close on Escape */
        document.addEventListener('keydown', e => { if (e.key === 'Escape') modal.classList.remove('open'); });
    </script>

</body>
</html>