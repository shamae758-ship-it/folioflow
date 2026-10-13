{{-- resources/views/edit.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Portfolio — FolioFlow</title>
    <style>
        /* ============ RESET & BASE ============ */
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root { --bg: #0b0f19; --bg-soft: #111827; --surface: #161e2e; --surface-2: #1c2740; --border: #243049; --text: #e7ecf5; --text-muted: #9aa7bd; --primary: #6366f1; --primary-hover: #4f52e0; --accent: #22d3ee; --accent-2: #a855f7; --danger: #ef4444; --radius: 14px; --radius-sm: 10px; --shadow: 0 10px 30px rgba(0,0,0,0.35); --transition: 0.25s ease; }

        html { scroll-behavior: smooth; }
        body { font-family: "Inter", "Segoe UI", system-ui, -apple-system, sans-serif; background: var(--bg); color: var(--text); line-height: 1.6; -webkit-font-smoothing: antialiased; }
        a { text-decoration: none; color: inherit; }
        img { max-width: 100%; display: block; }

        /* ============ LAYOUT ============ */
        .container { width: 100%; max-width: 1180px; margin: 0 auto; padding: 0 24px; }
        .container-narrow { width: 100%; max-width: 900px; margin: 0 auto; padding: 0 24px; }

        /* ============ NAVBAR ============ */
        .navbar { position: sticky; top: 0; z-index: 100; background: rgba(11,15,25,0.85); backdrop-filter: blur(12px); border-bottom: 1px solid var(--border); }
        .navbar-inner { display: flex; align-items: center; justify-content: space-between; height: 72px; }
        .logo { display: flex; align-items: center; gap: 10px; font-weight: 800; font-size: 1.35rem; letter-spacing: -0.02em; }
        .logo-mark { width: 34px; height: 34px; border-radius: 9px; background: linear-gradient(135deg, var(--primary), var(--accent)); display: grid; place-items: center; font-size: 1rem; color: #fff; box-shadow: 0 6px 16px rgba(99,102,241,0.45); }
        .logo span { background: linear-gradient(135deg, #fff, #b8c2ff); -webkit-background-clip: text; background-clip: text; -webkit-text-fill-color: transparent; }
        .back-link { display: inline-flex; align-items: center; gap: 8px; color: var(--text-muted); font-size: 0.92rem; font-weight: 500; transition: color var(--transition); }
        .back-link:hover { color: var(--accent); }

        /* ============ BUTTONS ============ */
        .btn { display: inline-flex; align-items: center; justify-content: center; gap: 8px; border: none; cursor: pointer; font-family: inherit; font-weight: 600; font-size: 0.95rem; padding: 13px 24px; border-radius: var(--radius-sm); transition: transform var(--transition), background var(--transition), box-shadow var(--transition), border-color var(--transition); white-space: nowrap; }
        .btn-primary { background: linear-gradient(135deg, var(--primary), var(--accent-2)); color: #fff; box-shadow: 0 8px 22px rgba(99,102,241,0.4); }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 12px 28px rgba(99,102,241,0.55); }
        .btn-ghost { background: transparent; color: var(--text); border: 1px solid var(--border); }
        .btn-ghost:hover { background: var(--surface); border-color: var(--primary); transform: translateY(-2px); }
        .btn-preview { background: rgba(34,211,238,0.1); color: #a5f3fc; border: 1px solid rgba(34,211,238,0.4); }
        .btn-preview:hover { background: rgba(34,211,238,0.18); border-color: var(--accent); transform: translateY(-2px); }

        /* ============ PAGE HEADER ============ */
        .page-head { padding: 56px 0 34px; position: relative; overflow: hidden; }
        .page-head::before { content: ""; position: absolute; top: -260px; left: 50%; transform: translateX(-50%); width: 700px; height: 700px; background: radial-gradient(circle, rgba(99,102,241,0.18), transparent 62%); pointer-events: none; }
        .page-head-inner { position: relative; }
        .page-head .eyebrow { color: var(--accent); font-size: 0.8rem; font-weight: 700; letter-spacing: 0.14em; text-transform: uppercase; margin-bottom: 12px; }
        .page-head h1 { font-size: clamp(1.9rem, 3.4vw, 2.6rem); font-weight: 800; letter-spacing: -0.03em; margin-bottom: 12px; }
        .page-head p { color: var(--text-muted); font-size: 1.02rem; max-width: 620px; }
        .page-head p strong { color: var(--accent); font-weight: 700; }

        /* ============ FORM WRAPPER ============ */
        .form-wrap { padding: 8px 0 90px; }

        /* ============ FORM CARD ============ */
        .form-card { background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius); padding: 34px 32px; margin-bottom: 26px; box-shadow: var(--shadow); transition: border-color var(--transition); }
        .form-card:hover { border-color: rgba(99,102,241,0.35); }
        .form-card-head { display: flex; align-items: center; gap: 14px; margin-bottom: 26px; padding-bottom: 20px; border-bottom: 1px solid var(--border); }
        .form-card-icon { width: 44px; height: 44px; border-radius: 12px; display: grid; place-items: center; font-size: 1.25rem; background: rgba(99,102,241,0.14); border: 1px solid rgba(99,102,241,0.3); flex-shrink: 0; }
        .form-card-head h2 { font-size: 1.18rem; font-weight: 700; letter-spacing: -0.01em; }
        .form-card-head p { color: var(--text-muted); font-size: 0.88rem; margin-top: 3px; }

        /* ============ GRIDS ============ */
        .grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        .col-span-2 { grid-column: span 2; }

        /* ============ FLOATING LABEL FIELDS ============ */
        .field { position: relative; }
        .field input, .field textarea, .field select { width: 100%; font-family: inherit; font-size: 0.95rem; color: var(--text); background: var(--bg-soft); border: 1px solid var(--border); border-radius: var(--radius-sm); padding: 16px; outline: none; transition: border-color var(--transition), box-shadow var(--transition), background var(--transition); }
        .field textarea { resize: vertical; min-height: 120px; padding-top: 24px; }
        .field input:focus, .field textarea:focus, .field select:focus { border-color: var(--primary); background: var(--surface-2); box-shadow: 0 0 0 4px rgba(99,102,241,0.14); }

        .field label { position: absolute; top: 16px; left: 16px; color: var(--text-muted); font-size: 0.95rem; pointer-events: none; transition: top var(--transition), font-size var(--transition), color var(--transition), background var(--transition); padding: 0 6px; }
        .field input:focus + label, .field input:not(:placeholder-shown) + label, .field textarea:focus + label, .field textarea:not(:placeholder-shown) + label { top: -9px; left: 12px; font-size: 0.75rem; font-weight: 600; color: var(--accent); background: var(--surface); }

        /* ============ UPLOAD ZONE ============ */
        .upload-zone { display: flex; align-items: center; gap: 20px; background: var(--bg-soft); border: 1.5px dashed var(--border); border-radius: var(--radius-sm); padding: 22px; transition: border-color var(--transition), background var(--transition); }
        .upload-zone:hover { border-color: var(--primary); background: var(--surface-2); }
        .upload-preview { width: 76px; height: 76px; border-radius: 50%; background: linear-gradient(135deg, var(--primary), var(--accent)); display: grid; place-items: center; font-size: 1.6rem; color: #fff; flex-shrink: 0; overflow: hidden; }
        .upload-preview img { width: 100%; height: 100%; object-fit: cover; }
        .upload-info { flex: 1; }
        .upload-info strong { display: block; font-size: 0.95rem; margin-bottom: 4px; }
        .upload-info span { color: var(--text-muted); font-size: 0.83rem; }
        .upload-info input[type="file"] { margin-top: 12px; font-size: 0.83rem; color: var(--text-muted); width: 100%; }
        .upload-info input[type="file"]::file-selector-button { font-family: inherit; font-weight: 600; font-size: 0.83rem; padding: 9px 16px; margin-right: 12px; border: 1px solid var(--border); border-radius: 8px; background: var(--surface); color: var(--text); cursor: pointer; transition: background var(--transition), border-color var(--transition); }
        .upload-info input[type="file"]::file-selector-button:hover { background: var(--surface-2); border-color: var(--primary); }

        /* ============ REPEATER ============ */
        .repeater { display: flex; flex-direction: column; gap: 14px; margin-bottom: 16px; }
        .repeater-row { display: grid; grid-template-columns: 1fr 1fr auto; gap: 14px; align-items: start; background: var(--bg-soft); border: 1px solid var(--border); border-radius: var(--radius-sm); padding: 16px; }
        .repeater-row.single { grid-template-columns: 1fr auto; }
        .repeater-row .field input, .repeater-row .field textarea { background: var(--surface); }
        .remove-row { width: 42px; height: 42px; border-radius: 9px; display: grid; place-items: center; background: transparent; border: 1px solid rgba(239,68,68,0.35); color: #ffb4b4; cursor: pointer; font-size: 1.1rem; transition: background var(--transition), border-color var(--transition); align-self: center; }
        .remove-row:hover { background: rgba(239,68,68,0.12); border-color: var(--danger); }
        .add-row { display: inline-flex; align-items: center; gap: 8px; font-family: inherit; font-size: 0.88rem; font-weight: 600; color: var(--accent); background: rgba(34,211,238,0.08); border: 1px dashed rgba(34,211,238,0.4); border-radius: 9px; padding: 11px 18px; cursor: pointer; transition: background var(--transition), border-color var(--transition); }
        .add-row:hover { background: rgba(34,211,238,0.14); border-color: var(--accent); }

        /* ============ ACTIONS ============ */
        .form-actions { display: flex; align-items: center; justify-content: flex-end; gap: 14px; padding-top: 10px; flex-wrap: wrap; }

        /* ============ ALERTS ============ */
        .alert { border-radius: var(--radius-sm); padding: 14px 18px; font-size: 0.9rem; margin-bottom: 24px; }
        .alert-error { background: rgba(239,68,68,0.1); border: 1px solid rgba(239,68,68,0.4); color: #ffb4b4; }
        .alert-error ul { margin-left: 18px; }

        /* ============ FOOTER ============ */
        .footer { border-top: 1px solid var(--border); background: var(--bg-soft); padding: 30px 0; }
        .footer-bottom { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px; color: var(--text-muted); font-size: 0.85rem; }

        /* ============ RESPONSIVE ============ */
        @media (max-width: 860px) {
            .grid { grid-template-columns: 1fr; }
            .col-span-2 { grid-column: span 1; }
            .repeater-row, .repeater-row.single { grid-template-columns: 1fr; }
            .remove-row { justify-self: end; }
        }

        @media (max-width: 640px) {
            .navbar-inner { height: 64px; }
            .form-card { padding: 26px 20px; }
            .upload-zone { flex-direction: column; text-align: center; }
            .form-actions { flex-direction: column-reverse; align-items: stretch; }
            .form-actions .btn { width: 100%; }
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
            <a href="{{ route('portfolio.index') }}" class="back-link">← Back to My Portfolios</a>
        </div>
    </header>

    {{-- ============ PAGE HEADER ============ --}}
    <section class="page-head">
        <div class="container page-head-inner">
            <p class="eyebrow">Editing Portfolio</p>
            <h1>Edit <strong>{{ $portfolio->full_name }}</strong></h1>
            <p>Update any information below. Your changes will be saved to the online database.</p>
        </div>
    </section>

    {{-- ============ FORM ============ --}}
    <section class="form-wrap">
        <div class="container-narrow">

            @if ($errors->any())
                <div class="alert alert-error">
                    <strong>Please fix the following:</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('portfolio.update', $portfolio->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- ========== PERSONAL INFORMATION ========== --}}
                <div class="form-card">
                    <div class="form-card-head">
                        <div class="form-card-icon">👤</div>
                        <div>
                            <h2>Personal Information</h2>
                            <p>Your basic details and introduction.</p>
                        </div>
                    </div>

                    <div class="grid">
                        <div class="field">
                            <input type="text" name="full_name" placeholder=" " value="{{ old('full_name', $portfolio->full_name) }}" required>
                            <label>Full Name</label>
                        </div>

                        <div class="field">
                            <input type="email" name="email" placeholder=" " value="{{ old('email', $portfolio->email) }}" required>
                            <label>Email Address</label>
                        </div>

                        <div class="field">
                            <input type="text" name="contact_number" placeholder=" " value="{{ old('contact_number', $portfolio->contact_number) }}">
                            <label>Contact Number</label>
                        </div>

                        <div class="field">
                            <input type="text" name="address" placeholder=" " value="{{ old('address', $portfolio->address) }}">
                            <label>Address</label>
                        </div>

                        <div class="field col-span-2">
                            <textarea name="about_me" placeholder=" " rows="4">{{ old('about_me', $portfolio->about_me) }}</textarea>
                            <label>About Me</label>
                        </div>
                    </div>

                    <div style="margin-top: 22px;">
                        <div class="upload-zone">
                            <div class="upload-preview" id="avatarPreview">
                                @if ($portfolio->profile_picture)
                                    <img src="{{ asset('storage/' . $portfolio->profile_picture) }}" alt="Current picture">
                                @else
                                    📷
                                @endif
                            </div>
                            <div class="upload-info">
                                <strong>Profile Picture</strong>
                                <span>Leave blank to keep the current picture. JPG, PNG or GIF — max 2 MB.</span>
                                <input type="file" name="profile_picture" accept="image/*" onchange="previewAvatar(event)">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ========== EDUCATION ========== --}}
                <div class="form-card">
                    <div class="form-card-head">
                        <div class="form-card-icon">🎓</div>
                        <div>
                            <h2>Educational Background</h2>
                            <p>Your schools, degrees, and graduation years.</p>
                        </div>
                    </div>

                    <div class="repeater" id="educationRepeater">
                        @php $education = old('education', $portfolio->education ?? [['school' => '', 'degree' => '']]); @endphp
                        @foreach ($education as $i => $edu)
                            <div class="repeater-row">
                                <div class="field">
                                    <input type="text" name="education[{{ $i }}][school]" placeholder=" " value="{{ $edu['school'] ?? '' }}">
                                    <label>School / University</label>
                                </div>
                                <div class="field">
                                    <input type="text" name="education[{{ $i }}][degree]" placeholder=" " value="{{ $edu['degree'] ?? '' }}">
                                    <label>Degree / Program</label>
                                </div>
                                <button type="button" class="remove-row" onclick="removeRow(this)" title="Remove">✕</button>
                            </div>
                        @endforeach
                    </div>
                    <button type="button" class="add-row" onclick="addRow('educationRepeater', educationTemplate)">＋ Add Education</button>
                </div>

                {{-- ========== SKILLS ========== --}}
                <div class="form-card">
                    <div class="form-card-head">
                        <div class="form-card-icon">💡</div>
                        <div>
                            <h2>Skills</h2>
                            <p>Your technical and soft skills.</p>
                        </div>
                    </div>

                    <div class="repeater" id="skillsRepeater">
                        @php $skills = old('skills', $portfolio->skills ?? [['name' => '']]); @endphp
                        @foreach ($skills as $i => $skill)
                            <div class="repeater-row single">
                                <div class="field">
                                    <input type="text" name="skills[{{ $i }}][name]" placeholder=" " value="{{ $skill['name'] ?? '' }}">
                                    <label>Skill</label>
                                </div>
                                <button type="button" class="remove-row" onclick="removeRow(this)" title="Remove">✕</button>
                            </div>
                        @endforeach
                    </div>
                    <button type="button" class="add-row" onclick="addRow('skillsRepeater', skillsTemplate)">＋ Add Skill</button>
                </div>

                {{-- ========== PROJECTS ========== --}}
                <div class="form-card">
                    <div class="form-card-head">
                        <div class="form-card-icon">🚀</div>
                        <div>
                            <h2>Projects</h2>
                            <p>Showcase the work you're proud of.</p>
                        </div>
                    </div>

                    <div class="repeater" id="projectsRepeater">
                        @php $projects = old('projects', $portfolio->projects ?? [['title' => '', 'description' => '']]); @endphp
                        @foreach ($projects as $i => $project)
                            <div class="repeater-row">
                                <div class="field">
                                    <input type="text" name="projects[{{ $i }}][title]" placeholder=" " value="{{ $project['title'] ?? '' }}">
                                    <label>Project Title</label>
                                </div>
                                <div class="field">
                                    <input type="text" name="projects[{{ $i }}][description]" placeholder=" " value="{{ $project['description'] ?? '' }}">
                                    <label>Short Description</label>
                                </div>
                                <button type="button" class="remove-row" onclick="removeRow(this)" title="Remove">✕</button>
                            </div>
                        @endforeach
                    </div>
                    <button type="button" class="add-row" onclick="addRow('projectsRepeater', projectsTemplate)">＋ Add Project</button>
                </div>

                {{-- ========== EXPERIENCE ========== --}}
                <div class="form-card">
                    <div class="form-card-head">
                        <div class="form-card-icon">💼</div>
                        <div>
                            <h2>Work Experience</h2>
                            <p>Your roles, companies, and duration.</p>
                        </div>
                    </div>

                    <div class="repeater" id="experienceRepeater">
                        @php $experience = old('experience', $portfolio->experience ?? [['position' => '', 'company' => '']]); @endphp
                        @foreach ($experience as $i => $exp)
                            <div class="repeater-row">
                                <div class="field">
                                    <input type="text" name="experience[{{ $i }}][position]" placeholder=" " value="{{ $exp['position'] ?? '' }}">
                                    <label>Position / Role</label>
                                </div>
                                <div class="field">
                                    <input type="text" name="experience[{{ $i }}][company]" placeholder=" " value="{{ $exp['company'] ?? '' }}">
                                    <label>Company / Organization</label>
                                </div>
                                <button type="button" class="remove-row" onclick="removeRow(this)" title="Remove">✕</button>
                            </div>
                        @endforeach
                    </div>
                    <button type="button" class="add-row" onclick="addRow('experienceRepeater', experienceTemplate)">＋ Add Experience</button>
                </div>

                {{-- ========== LINKS ========== --}}
                <div class="form-card">
                    <div class="form-card-head">
                        <div class="form-card-icon">🔗</div>
                        <div>
                            <h2>Social Media / Website Links</h2>
                            <p>Where can people find you online?</p>
                        </div>
                    </div>

                    <div class="repeater" id="linksRepeater">
                        @php $links = old('links', $portfolio->social_links ?? [['label' => '', 'url' => '']]); @endphp
                        @foreach ($links as $i => $link)
                            <div class="repeater-row">
                                <div class="field">
                                    <input type="text" name="links[{{ $i }}][label]" placeholder=" " value="{{ $link['label'] ?? '' }}">
                                    <label>Label (e.g., GitHub, LinkedIn)</label>
                                </div>
                                <div class="field">
                                    <input type="url" name="links[{{ $i }}][url]" placeholder=" " value="{{ $link['url'] ?? '' }}">
                                    <label>URL (https://...)</label>
                                </div>
                                <button type="button" class="remove-row" onclick="removeRow(this)" title="Remove">✕</button>
                            </div>
                        @endforeach
                    </div>
                    <button type="button" class="add-row" onclick="addRow('linksRepeater', linksTemplate)">＋ Add Link</button>
                </div>

                {{-- ========== ACTIONS ========== --}}
                <div class="form-actions">
                    <a href="{{ route('portfolio.index') }}" class="btn btn-ghost">Cancel</a>
                    <a href="{{ route('portfolio.show', $portfolio->id) }}" class="btn btn-preview" target="_blank">👁 Preview</a>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
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
        /* ---- Avatar preview ---- */
        function previewAvatar(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('avatarPreview');
            if (file) {
                const reader = new FileReader();
                reader.onload = e => { preview.innerHTML = `<img src="${e.target.result}" alt="Preview">`; };
                reader.readAsDataURL(file);
            }
        }

        /* ---- Remove repeater row ---- */
        function removeRow(btn) {
            const row = btn.closest('.repeater-row');
            const repeater = row.parentElement;
            if (repeater.querySelectorAll('.repeater-row').length > 1) {
                row.remove();
                reindexRepeater(repeater.id);
            }
        }

        /* ---- Add repeater row ---- */
        let counters = {
            educationRepeater: {{ count(old('education', $portfolio->education ?? [0])) }},
            skillsRepeater: {{ count(old('skills', $portfolio->skills ?? [0])) }},
            projectsRepeater: {{ count(old('projects', $portfolio->projects ?? [0])) }},
            experienceRepeater: {{ count(old('experience', $portfolio->experience ?? [0])) }},
            linksRepeater: {{ count(old('links', $portfolio->social_links ?? [0])) }},
        };

        function addRow(repeaterId, templateFn) {
            const repeater = document.getElementById(repeaterId);
            const index = counters[repeaterId]++;
            repeater.insertAdjacentHTML('beforeend', templateFn(index));
        }

        /* ---- Re-index after removal ---- */
        function reindexRepeater(repeaterId) {
            const repeater = document.getElementById(repeaterId);
            const rows = repeater.querySelectorAll('.repeater-row');
            rows.forEach((row, i) => {
                row.querySelectorAll('input, textarea, select').forEach(input => {
                    input.name = input.name.replace(/\[\d+\]/, `[${i}]`);
                });
            });
            counters[repeaterId] = rows.length;
        }

        /* ---- Row templates ---- */
        const educationTemplate = i => `
            <div class="repeater-row">
                <div class="field"><input type="text" name="education[${i}][school]" placeholder=" "><label>School / University</label></div>
                <div class="field"><input type="text" name="education[${i}][degree]" placeholder=" "><label>Degree / Program</label></div>
                <button type="button" class="remove-row" onclick="removeRow(this)" title="Remove">✕</button>
            </div>`;

        const skillsTemplate = i => `
            <div class="repeater-row single">
                <div class="field"><input type="text" name="skills[${i}][name]" placeholder=" "><label>Skill</label></div>
                <button type="button" class="remove-row" onclick="removeRow(this)" title="Remove">✕</button>
            </div>`;

        const projectsTemplate = i => `
            <div class="repeater-row">
                <div class="field"><input type="text" name="projects[${i}][title]" placeholder=" "><label>Project Title</label></div>
                <div class="field"><input type="text" name="projects[${i}][description]" placeholder=" "><label>Short Description</label></div>
                <button type="button" class="remove-row" onclick="removeRow(this)" title="Remove">✕</button>
            </div>`;

        const experienceTemplate = i => `
            <div class="repeater-row">
                <div class="field"><input type="text" name="experience[${i}][position]" placeholder=" "><label>Position / Role</label></div>
                <div class="field"><input type="text" name="experience[${i}][company]" placeholder=" "><label>Company / Organization</label></div>
                <button type="button" class="remove-row" onclick="removeRow(this)" title="Remove">✕</button>
            </div>`;

        const linksTemplate = i => `
            <div class="repeater-row">
                <div class="field"><input type="text" name="links[${i}][label]" placeholder=" "><label>Label</label></div>
                <div class="field"><input type="url" name="links[${i}][url]" placeholder=" "><label>URL (https://...)</label></div>
                <button type="button" class="remove-row" onclick="removeRow(this)" title="Remove">✕</button>
            </div>`;
    </script>

</body>
</html>