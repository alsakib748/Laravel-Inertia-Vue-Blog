<?php

namespace App\Http\Controllers\Backend;

use App\Models\News;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::latest()->paginate(10);
        // dd($tags->toArray());
        // $news->create = route('news.create');
        return Inertia::render('backend/pages/news/Index', compact('news'));
    }

    public function create()
    {
        return Inertia::render('backend/pages/news/Create');
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'headline' => 'required|string|min:30|unique:news,headline',
        ]);

        $news = new News();
        $news->headline = $request->headline;
        $news->save();

        return redirect()->route('news.index')->with('success', 'News created successfully!');
    }


    public function show(string $id)
    {
        //
    }


    public function edit($id)
    {

        // dd($id);

        $news = News::find($id);

        return Inertia::render('backend/pages/news/Edit', compact('news'));
    }


    public function update(Request $request, News $news)
    {

        // dd($request->all());

        $request->validate([
            'headline' => 'required|string|min:30|unique:news,headline,' . $news->id,
        ]);

        $news = News::find($request->id);
        $news->headline = $request->headline;
        $news->save();

        return redirect()->route('news.index')->with('success', 'News updated successfully!');
    }


    public function destroy(string $id)
    {
        $news = News::findOrFail($id);
        $news->delete();

        return back()->with('success', 'News deleted successfully!');
    }
}
