<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Website;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public function index()
    {
        $websites = Website::all();
        return view('links.index', compact('websites'));
    }

    public function create()
    {
        return view('links.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'url' => 'required|url',
        ]);

        Website::create($request->all());
        return redirect()->route('links.index');
    }

    public function show(Website $website)
    {
        return view('links.show', compact('link'));
    }

    public function edit(Website $website)
    {
        return view('links.edit', compact('link'));
    }

    public function update(Request $request, Website $website)
    {
        $request->validate([
            'url' => 'required|url',
        ]);

        $website->update($request->all());
        return redirect()->route('links.index');
    }

    public function destroy(Website $website)
    {
        $website->delete();
        return redirect()->route('links.index');
    }

}
