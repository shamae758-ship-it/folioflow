<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PortfolioController extends Controller
{
    /* =========================================================
     |  INDEX — List all portfolios
     ========================================================= */
    public function index()
    {
        $portfolios = Portfolio::latest()->paginate(10);

        return view('index', compact('portfolios'));
    }

    /* =========================================================
     |  CREATE — Show the information form
     ========================================================= */
    public function create()
    {
        return view('create');
    }

    /* =========================================================
     |  STORE — Validate, save new portfolio, redirect to
     |          the template selection page
     ========================================================= */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name'      => 'required|string|max:255',
            'email'          => 'required|email|max:255',
            'contact_number' => 'nullable|string|max:50',
            'address'        => 'nullable|string',
            'about_me'       => 'nullable|string',
            'profile_picture'=> 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',

            'education'      => 'nullable|array',
            'skills'         => 'nullable|array',
            'projects'       => 'nullable|array',
            'experience'     => 'nullable|array',
            'links'          => 'nullable|array',
        ]);

        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            $validated['profile_picture'] = $request->file('profile_picture')
                ->store('profile_pictures', 'public');
        }

        // Clean up empty repeater rows (from the create form arrays)
        $validated['education']    = $this->cleanRepeater($request->input('education', []));
        $validated['skills']       = $this->cleanRepeater($request->input('skills', []));
        $validated['projects']     = $this->cleanRepeater($request->input('projects', []));
        $validated['experience']   = $this->cleanRepeater($request->input('experience', []));
        $validated['social_links'] = $this->cleanRepeater($request->input('links', []));

        // Default template
        $validated['template'] = 'simple';

        // Save to database
        $portfolio = Portfolio::create($validated);

        // Redirect to template selection
        return redirect()
            ->route('portfolio.selectTemplate', $portfolio->id)
            ->with('success', 'Portfolio saved! Now choose a template.');
    }

    /* =========================================================
     |  SELECT TEMPLATE — Show the template picker
     ========================================================= */
    public function selectTemplate($id)
    {
        $portfolio = Portfolio::findOrFail($id);

        return view('select-template', compact('portfolio'));
    }

    /* =========================================================
     |  UPDATE TEMPLATE — Save the chosen template
     ========================================================= */
    public function updateTemplate(Request $request, $id)
    {
        $request->validate([
            'template' => 'required|in:simple,modern,creative',
        ]);

        $portfolio = Portfolio::findOrFail($id);
        $portfolio->template = $request->template;
        $portfolio->save();

        return redirect()
            ->route('portfolio.show', $portfolio->id)
            ->with('success', 'Template applied! Here is your portfolio preview.');
    }

    /* =========================================================
     |  SHOW — Preview the generated portfolio
     ========================================================= */
    public function show($id)
    {
        $portfolio = Portfolio::findOrFail($id);

        // Pick the right view based on the chosen template
        $template = in_array($portfolio->template, ['simple', 'modern', 'creative'])
            ? $portfolio->template
            : 'simple';

        return view('templates.' . $template, compact('portfolio'));
    }

    /* =========================================================
     |  EDIT — Show the pre-filled edit form
     ========================================================= */
    public function edit($id)
    {
        $portfolio = Portfolio::findOrFail($id);

        return view('edit', compact('portfolio'));
    }

    /* =========================================================
     |  UPDATE — Save edited portfolio data
     ========================================================= */
    public function update(Request $request, $id)
    {
        $portfolio = Portfolio::findOrFail($id);

        $validated = $request->validate([
            'full_name'      => 'required|string|max:255',
            'email'          => 'required|email|max:255',
            'contact_number' => 'nullable|string|max:50',
            'address'        => 'nullable|string',
            'about_me'       => 'nullable|string',
            'profile_picture'=> 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        // Replace profile picture if a new one is uploaded
        if ($request->hasFile('profile_picture')) {
            // Delete old picture
            if ($portfolio->profile_picture && Storage::disk('public')->exists($portfolio->profile_picture)) {
                Storage::disk('public')->delete($portfolio->profile_picture);
            }

            $validated['profile_picture'] = $request->file('profile_picture')
                ->store('profile_pictures', 'public');
        }

        // Repeater data
        $validated['education']    = $this->cleanRepeater($request->input('education', []));
        $validated['skills']       = $this->cleanRepeater($request->input('skills', []));
        $validated['projects']     = $this->cleanRepeater($request->input('projects', []));
        $validated['experience']   = $this->cleanRepeater($request->input('experience', []));
        $validated['social_links'] = $this->cleanRepeater($request->input('links', []));

        $portfolio->update($validated);

        return redirect()
            ->route('portfolio.index')
            ->with('success', 'Portfolio updated successfully.');
    }

    /* =========================================================
     |  DESTROY — Delete portfolio + its picture
     ========================================================= */
    public function destroy($id)
    {
        $portfolio = Portfolio::findOrFail($id);

        // Delete the profile picture from storage
        if ($portfolio->profile_picture && Storage::disk('public')->exists($portfolio->profile_picture)) {
            Storage::disk('public')->delete($portfolio->profile_picture);
        }

        $portfolio->delete();

        return redirect()
            ->route('portfolio.index')
            ->with('success', 'Portfolio deleted successfully.');
    }

    /* =========================================================
     |  HELPER — Remove empty rows from repeater arrays
     ========================================================= */
    private function cleanRepeater(array $rows): array
    {
        return array_values(array_filter($rows, function ($row) {
            if (is_array($row)) {
                // Keep the row only if at least one value is non-empty
                return collect($row)->filter(fn ($v) => filled($v))->isNotEmpty();
            }
            return filled($row);
        }));
    }
}