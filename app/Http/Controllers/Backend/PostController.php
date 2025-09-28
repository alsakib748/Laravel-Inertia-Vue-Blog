<?php

namespace App\Http\Controllers\Backend;

use App\Models\Tag;
use App\Models\Post;
use Inertia\Inertia;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PHPUnit\Event\Test\PostConditionCalled;

class PostController extends Controller
{


    public function index()
    {
        $posts = Post::with(['category', 'author', 'tags'])->latest()->paginate(10);
        // $categories->create = route('posts.create');

        return Inertia::render('backend/pages/posts/Index', compact('posts'));
    }

    public function create()
    {
        return Inertia::render('backend/pages/posts/Create', [
            'categories' => Category::all(),
            'tags' => Tag::all()
        ]);
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'description' => 'nullable|string|max:5000', // Increased for rich text content
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $category = new Post();
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->description = $request->description;

        // Handle image upload
        if ($request->hasFile('image')) {
            $baseUrl = request()->getSchemeAndHttpHost();
            $image = $request->file('image');
            $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
            $path = public_path('/backend/images/category/');
            $image->move($path, $imageName);
            $fullImageName = $baseUrl . '/backend/images/category/' . $imageName;
            $category->image = $fullImageName;
        }

        $category->save();

        return redirect()->route('posts.index')->with('success', 'Post created successfully!');
    }


    public function show(string $id)
    {
        //
    }


    public function edit($id)
    {

        // dd($id);

        $post = Post::find($id);

        return Inertia::render('backend/pages/posts/Edit', compact('post'));
    }


    public function update(Request $request, Post $category)
    {

        // dd($request->all());

        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'description' => 'nullable|string', // Increased for rich text content
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $category = Post::find($request->id);
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->description = $request->description;

        // Handle image upload
        if ($request->hasFile('image')) {
            // Safely delete old image if it's a local file
            if (!empty($category->image)) {
                $oldPathFromUrl = parse_url($category->image, PHP_URL_PATH);
                if ($oldPathFromUrl) {
                    $oldFullPath = public_path($oldPathFromUrl);
                    if (file_exists($oldFullPath)) {
                        @unlink($oldFullPath);
                    }
                }
            }
            $baseUrl = request()->getSchemeAndHttpHost();
            $image = $request->file('image');
            $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
            $path = public_path('/backend/images/category/');
            $image->move($path, $imageName);
            $fullImageName = $baseUrl . '/backend/images/category/' . $imageName;
            $category->image = $fullImageName;
        }

        $category->save();

        return redirect()->route('posts.index')->with('success', 'Post updated successfully!');
    }


    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);

        // Safely delete old image if stored
        if (!empty($post->image)) {
            $oldPathFromUrl = parse_url($post->image, PHP_URL_PATH);
            if ($oldPathFromUrl) {
                $oldFullPath = public_path($oldPathFromUrl);
                if (file_exists($oldFullPath)) {
                    @unlink($oldFullPath);
                }
            }
        }

        $post->delete();

        return back()->with('success', 'Post deleted successfully!');
    }

}
