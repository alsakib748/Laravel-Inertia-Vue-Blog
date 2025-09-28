<?php

namespace App\Http\Controllers\Backend;

use Inertia\Inertia;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::latest()->paginate(10);
        $categories->create = route('categories.create');

        // $routes = [
        //     'create' => route('categories.create'),
        //     'edit' => route('categories.edit', ':id'),
        //     'destroy' => route('categories.destory', ':id')
        // ];

        return Inertia::render('backend/pages/categories/Index', compact('categories'));
    }

    public function create()
    {
        return Inertia::render('backend/pages/categories/Create');
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'description' => 'nullable|string|max:5000', // Increased for rich text content
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $category = new Category();
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

        return redirect()->route('categories.index')->with('success', 'Category created successfully!');
    }


    public function show(string $id)
    {
        //
    }


    public function edit($id)
    {

        // dd($id);

        $category = Category::find($id);

        return Inertia::render('backend/pages/categories/Edit', compact('category'));
    }


    public function update(Request $request, Category $category)
    {

        // dd($request->all());

        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'description' => 'nullable|string', // Increased for rich text content
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $category = Category::find($request->id);
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

        return redirect()->route('categories.index')->with('success', 'Category updated successfully!');
    }


    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);

        // Safely delete old image if stored
        if (!empty($category->image)) {
            $oldPathFromUrl = parse_url($category->image, PHP_URL_PATH);
            if ($oldPathFromUrl) {
                $oldFullPath = public_path($oldPathFromUrl);
                if (file_exists($oldFullPath)) {
                    @unlink($oldFullPath);
                }
            }
        }

        $category->delete();

        return back()->with('success', 'Category deleted successfully!');
    }
}