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
use Intervention\Image\Laravel\Facades\Image;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

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
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'content' => 'required|string',
            'status' => 'required|in:draft,pending,published,archived,deleted',
            'published_at' => 'nullable|date',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $baseUrl = request()->getSchemeAndHttpHost();
        $imagePath = public_path('/backend/images/posts/');
        $thumbnailPath = public_path('/backend/images/posts/thumbnails/');

        if (!file_exists($imagePath)) {
            mkdir($imagePath, 0755, true);
        }

        if (!file_exists($thumbnailPath)) {
            mkdir($thumbnailPath, 0755, true);
        }

        $imageName = uniqid() . '.jpg';
        $thumbnailName = 'thumb_' . $imageName;

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $manager = new ImageManager(new Driver());

            $originalImage = $manager->read($image);
            $originalImage->scaleDown(1200)
                ->toJpeg(90)
                ->save($imagePath . $imageName);

            // $image->move($imagePath, $imageName);
            $fullImageUrl = $baseUrl . '/backend/images/posts/' . $imageName;
        }

        // Process thumbnail
        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail');
            $manager = new ImageManager(new Driver());

            // Create thumbnail (300x200, fit and crop)
            $thumbnailImage = $manager->read($thumbnail);
            $thumbnailImage->cover(300, 200)
                ->toJpeg(85)
                ->save($thumbnailPath . $thumbnailName);

            $fullThumbnailUrl = $baseUrl . '/backend/images/posts/thumbnails/' . $thumbnailName;
        }

        $post = Post::create([
            'user_id' => auth()->id(),
            'category_id' => $request->category_id,
            'title' => $request->title,
            'slug' => Str::slug($request->title) . '-' . uniqid(),
            'excerpt' => $request->excerpt,
            'content' => $request->content,
            'status' => $request->status,
            'published_at' => $request->published_at ? \Carbon\Carbon::parse($request->published_at) : ($request->status === 'published' ? now() : null),
            'thumbnail' => $fullThumbnailUrl ?? null,
            'image' => $fullImageUrl ?? null,
            'is_featured' => $request->boolean('is_featured'),
            'is_trending' => $request->boolean('is_trending'),
            'is_slider' => $request->boolean('is_slider'),
            'meta' => $request->meta ? json_decode($request->meta, true) : null,
            'active' => $request->boolean('active', true),
        ]);

        $post->tags()->sync($request->tags ?? []);

        return redirect()->route('posts.index')->with('success', 'Post created successfully!');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(Post $post)
    {
        // dd($id);
        // $post = Post::find($id);
        return Inertia::render('backend/pages/posts/Edit', [
            'post' => $post->load('tags'),
            'categories' => Category::all(),
            'tags' => Tag::all(),
        ]);
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|max:255',
            'category_id' => 'required|exists:categories,id',
            'content' => 'required',
            'status' => 'required|in:draft,pending,published,archived,deleted',
            'published_at' => 'nullable|date',
        ]);

        $baseUrl = request()->getSchemeAndHttpHost();
        $imagePath = public_path('/backend/images/posts/');
        $thumbnailPath = public_path('/backend/images/posts/thumbnails/');

        $imageName = uniqid() . '.jpg';
        $thumbnailName = 'thumb_' . $imageName;

        // Handle image upload
        if ($request->hasFile('image')) {

            // Safely delete existing image if stored as URL
            if (!empty($post->image)) {
                $oldPathFromUrl = parse_url($post->image, PHP_URL_PATH);
                if ($oldPathFromUrl) {
                    $oldFullPath = public_path($oldPathFromUrl);
                    if (file_exists($oldFullPath)) {
                        @unlink($oldFullPath);
                    }
                }
            }

            $image = $request->file('image');
            $manager = new ImageManager(new Driver());

            $originalImage = $manager->read($image);
            $originalImage->scaleDown(1200)
                ->toJpeg(90)
                ->save($imagePath . $imageName);

            $fullImageUrl = $baseUrl . '/backend/images/posts/' . $imageName;
        } else {
            $fullImageUrl = $post->image;
        }

        // Process thumbnail
        if ($request->hasFile('thumbnail')) {

            // Safely delete existing thumbnail if stored as URL
            if (!empty($post->thumbnail)) {
                $oldThumbPathFromUrl = parse_url($post->thumbnail, PHP_URL_PATH);
                if ($oldThumbPathFromUrl) {
                    $oldThumbFullPath = public_path($oldThumbPathFromUrl);
                    if (file_exists($oldThumbFullPath)) {
                        @unlink($oldThumbFullPath);
                    }
                }
            }

            $thumbnail = $request->file('thumbnail');
            $manager = new ImageManager(new Driver());

            // Create thumbnail (300x200, fit and crop)
            $thumbnailImage = $manager->read($thumbnail);
            $thumbnailImage->cover(300, 200)
                ->toJpeg(85)
                ->save($thumbnailPath . $thumbnailName);

            $fullThumbnailUrl = $baseUrl . '/backend/images/posts/thumbnails/' . $thumbnailName;
        } else {
            $fullThumbnailUrl = $post->thumbnail;
        }

        $post->update([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'slug' => Str::slug($request->title) . '-' . $post->id,
            'excerpt' => $request->excerpt,
            'content' => $request->content,
            'status' => $request->status,
            'published_at' => $request->published_at ? \Carbon\Carbon::parse($request->published_at) : ($request->status === 'published' ? now() : null),
            'thumbnail' => $fullThumbnailUrl,
            'image' => $fullImageUrl,
            'is_featured' => $request->boolean('is_featured'),
            'is_trending' => $request->boolean('is_trending'),
            'is_slider' => $request->boolean('is_slider'),
            'meta' => $request->meta ? json_decode($request->meta, true) : null,
            'active' => $request->boolean('active', true),
        ]);

        $post->tags()->sync($request->tags ?? []);

        return redirect()->route('posts.index')->with('success', 'Post updated successfully!');
    }


    public function destroy(Post $post)
    {
        // $post = Post::findOrFail($id);

        // Safely delete existing thumbnail if stored as URL
        if (!empty($post->thumbnail)) {
            $oldThumbPathFromUrl = parse_url($post->thumbnail, PHP_URL_PATH);
            if ($oldThumbPathFromUrl) {
                $oldThumbFullPath = public_path($oldThumbPathFromUrl);
                if (file_exists($oldThumbFullPath)) {
                    @unlink($oldThumbFullPath);
                }
            }
        }

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