<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class PortfolioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $portfolios = Portfolio::where('user_id', auth()->id())->latest()->paginate(10);
        return view('index', compact('portfolios'));
    }

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name'      => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s\.\-]+$/'],
            'email'          => 'required|email|max:255',
            'contact_number' => 'nullable|string|max:50',
            'address'        => 'nullable|string',
            'about_me'       => 'nullable|string',
            'profile_picture'=> 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ], [
            'full_name.regex' => 'The name must only contain letters, spaces, or hyphens. Numbers are not allowed.',
        ]);

        if ($request->hasFile('profile_picture')) {
            $validated['profile_picture'] = $request->file('profile_picture')->store('profile_pictures', 'public');
        }

        $validated['education']    = $this->cleanRepeater($request->input('education', []));
        $validated['skills']       = $this->cleanRepeater($request->input('skills', []));
        $validated['projects']     = $this->cleanRepeater($request->input('projects', []));
        $validated['experience']   = $this->cleanRepeater($request->input('experience', []));
        $validated['social_links'] = $this->cleanRepeater($request->input('links', []));
        
        $validated['template'] = 'simple';
        $validated['user_id'] = auth()->id();

        $portfolio = Portfolio::create($validated);

        return redirect()->route('portfolio.selectTemplate', $portfolio->id)->with('success', 'Portfolio saved! Now choose a template.');
    }

    public function selectTemplate($id)
    {
        $portfolio = Portfolio::findOrFail($id);
        return view('select-template', compact('portfolio'));
    }

    public function updateTemplate(Request $request, $id)
    {
        $request->validate(['template' => 'required|in:simple,modern,creative']);
        $portfolio = Portfolio::findOrFail($id);
        $portfolio->template = $request->template;
        $portfolio->save();

        return redirect()->route('portfolio.show', $portfolio->id);
    }

    public function show($id)
    {
        $portfolio = Portfolio::findOrFail($id);
        $template = in_array($portfolio->template, ['simple', 'modern', 'creative']) ? $portfolio->template : 'simple';
        
        // EMERGENCY FIX: This forces the template to load properly
        return response()->view('templates.' . $template, compact('portfolio'));
    }

    public function edit($id)
    {
        $portfolio = Portfolio::findOrFail($id);
        return view('edit', compact('portfolio'));
    }

    public function update(Request $request, $id)
    {
        $portfolio = Portfolio::findOrFail($id);

        $validated = $request->validate([
            'full_name'      => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s\.\-]+$/'],
            'email'          => 'required|email|max:255',
            'contact_number' => 'nullable|string|max:50',
            'address'        => 'nullable|string',
            'about_me'       => 'nullable|string',
            'profile_picture'=> 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ], [
            'full_name.regex' => 'The name must only contain letters, spaces, or hyphens. Numbers are not allowed.',
        ]);

        if ($request->hasFile('profile_picture')) {
            if ($portfolio->profile_picture && Storage::disk('public')->exists($portfolio->profile_picture)) {
                Storage::disk('public')->delete($portfolio->profile_picture);
            }
            $validated['profile_picture'] = $request->file('profile_picture')->store('profile_pictures', 'public');
        }

        $validated['education']    = $this->cleanRepeater($request->input('education', []));
        $validated['skills']       = $this->cleanRepeater($request->input('skills', []));
        $validated['projects']     = $this->cleanRepeater($request->input('projects', []));
        $validated['experience']   = $this->cleanRepeater($request->input('experience', []));
        $validated['social_links'] = $this->cleanRepeater($request->input('links', []));

        $portfolio->update($validated);

        return redirect()->route('portfolio.index')->with('success', 'Portfolio updated successfully.');
    }

    public function destroy($id)
    {
        $portfolio = Portfolio::findOrFail($id);
        if ($portfolio->profile_picture && Storage::disk('public')->exists($portfolio->profile_picture)) {
            Storage::disk('public')->delete($portfolio->profile_picture);
        }
        $portfolio->delete();
        return redirect()->route('portfolio.index')->with('success', 'Portfolio deleted successfully.');
    }

    private function cleanRepeater(array $rows): array
    {
        return array_values(array_filter($rows, function ($row) {
            if (is_array($row)) { return collect($row)->filter(fn ($v) => filled($v))->isNotEmpty(); }
            return filled($row);
        }));
    }
}