<?php

namespace App\Http\Controllers;

use App\Models\Navigation;
use App\Models\Page;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.index', [
            'pages' => Page::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'page_title' => 'required|string|max:255',
            'page_content' => 'required|string',
            'featured_image' => 'nullable|image|max:1024'
        ]);

        $page = new Page();
        $page->page_title = $request->page_title;
        $page->page_content = $request->page_content;
        $page->slug = \Str::slug($request->page_title);
        $page->featured_image = $request->file('featured_image')->store('pages/featured_images', 'public');
        $page->save();

        return redirect()->route('pages.index')->with('success', 'Page created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $page = Page::where('slug', $slug)->firstOrFail();
        $navigations = Navigation::with('pages')->get();
        
        $isVisible = $navigations->contains(function ($navigation) use ($page) {
            return $navigation->pages->contains('id', $page->id);
        });
        
        if ($isVisible) {
            return view('pages.show', [
                'navigations' => $navigations,
                'page' => $page
            ]);
        } else {
            return redirect()->route('welcome');
        }

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('pages.edit', [
            'page' => Page::findOrFail($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'page_title' => 'required|string|max:255',
            'page_content' => 'required|string',
            'featured_image' => 'nullable|image|max:1024'
        ]);

        $page = Page::findOrFail($id);
        $page->page_title = $request->page_title;
        $page->page_content = $request->page_content;
        $page->slug = \Str::slug($request->page_title);

        if ($request->hasFile('featured_image')) {
            $page->featured_image = $request->file('featured_image')->store('pages/featured_images', 'public');
        }

        $page->save();

        return redirect()->route('pages.index')->with('success', 'Page updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $page = Page::findOrFail($id);
        Storage::disk('public')->delete($page->featured_image);
        $page->delete();

        return redirect()->route('pages.index')->with('success', 'Page deleted successfully.');
    }
}
