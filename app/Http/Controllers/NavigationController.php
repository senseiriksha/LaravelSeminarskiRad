<?php

namespace App\Http\Controllers;

use App\Models\Navigation;
use App\Models\Page;
use Illuminate\Http\Request;

class NavigationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('navigations.index', [
            'navigations' => Navigation::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('navigations.create', [
            'pages' => Page::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nav_title' => 'required|string|max:255',
            'page' => 'required|exists:pages,id'
        ]);

        $navigation = new Navigation();
        $navigation->nav_title = $request->nav_title;
        $navigation->save();
        $navigation->pages()->attach($request->page);
        $navigation->save();

        return redirect()->route('navigations.index')->with('success', 'Navigation created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('navigations.edit', [
            'navigation' => Navigation::findOrFail($id),
            'pages' => Page::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nav_title' => 'required|string|max:255',
            'page' => 'required|exists:pages,id'
        ]);

        $navigation = Navigation::findOrFail($id);
        $navigation->nav_title = $request->nav_title;
        $navigation->save();
        $navigation->pages()->sync($request->page);
        $navigation->save();

        return redirect()->route('navigations.index')->with('success', 'Navigation updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $navigation = Navigation::findOrFail($id);
        $navigation->delete();

        return redirect()->route('navigations.index')->with('success', 'Navigation deleted successfully');
    }
}
