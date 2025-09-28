<?php

namespace App\Http\Controllers\Backend;

use App\Models\Tag;
use Inertia\Inertia;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagController extends Controller
{

    public function index()
    {
        $tags = Tag::latest()->paginate(10);
        // dd($tags->toArray());
        $tags->create = route('tags.create');
        return Inertia::render('backend/pages/tags/Index', compact('tags'));
    }

    public function create()
    {
        return Inertia::render('backend/pages/tags/Create');
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'name' => 'required|string|max:255|unique:tags,name',
        ]);

        $tag = new Tag();
        $tag->name = $request->name;
        $tag->slug = Str::slug($request->name);
        $tag->save();

        return redirect()->route('tags.index')->with('success', 'Tag created successfully!');
    }


    public function show(string $id)
    {
        //
    }


    public function edit($id)
    {

        // dd($id);

        $tag = Tag::find($id);

        return Inertia::render('backend/pages/tags/Edit', compact('tag'));
    }


    public function update(Request $request, Tag $tag)
    {

        // dd($request->all());

        $request->validate([
            'name' => 'required|string|max:255|unique:tags,name,' . $tag->id,
        ]);

        $tag = Tag::find($request->id);
        $tag->name = $request->name;
        $tag->slug = Str::slug($request->name);
        $tag->save();

        return redirect()->route('tags.index')->with('success', 'Tag updated successfully!');
    }


    public function destroy(string $id)
    {
        $tag = Tag::findOrFail($id);
        $tag->delete();

        return back()->with('success', 'Tag deleted successfully!');
    }

}
