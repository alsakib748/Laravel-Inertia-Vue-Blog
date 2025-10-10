<?php

namespace App\Http\Controllers\Frontend;

use App\Models\News;
use App\Models\Post;
use Inertia\Inertia;
use App\Models\About;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class FrontendController extends Controller
{

    public function home()
    {
        return Inertia::render('frontend/Index', [
            'sliderPosts' => Cache::remember('slider_posts', 60, function () {
                return Post::select('id', 'title', 'slug', 'excerpt', 'thumbnail', 'image', 'category_id', 'user_id', 'published_at', 'updated_at')->with(['category', 'author'])
                    ->where('is_slider', 1)
                    ->where('status', 'published')
                    ->active()
                    ->latest('published_at')
                    ->take(5)
                    ->get();
            }),
            'featuredPosts' => Cache::remember('featured_posts', 60, function () {
                return Post::select('id', 'title', 'slug', 'excerpt', 'thumbnail', 'image', 'category_id', 'user_id', 'published_at', 'updated_at')
                    ->with(['category', 'author'])
                    ->where('is_featured', 1)
                    ->where('status', 'published')
                    ->active()
                    ->latest('published_at')
                    ->take(4)
                    ->get();
            }),
            'firstPriorityCategory' => Category::where('priority', 1)->where('status', 1)->first(),
            'firstPriorityCategoryPosts' => Post::select('id', 'title', 'slug', 'excerpt', 'thumbnail', 'image', 'category_id', 'user_id', 'published_at', 'updated_at')
                ->with(['category:id,name,priority,slug', 'author:id,name'])
                ->whereHas('category', function ($q) {
                    $q->where('priority', 1);
                })
                ->where('status', 'published')
                ->active()
                ->latest('published_at')
                ->take(4)
                ->get(),
            'secondPriorityCategory' => Category::where('priority', 2)->where('status', 1)->first(),
            'secondPriorityCategoryPosts' => Post::select('id', 'title', 'slug', 'excerpt', 'thumbnail', 'image', 'category_id', 'user_id', 'published_at', 'updated_at')
                ->with(['category:id,name,priority,slug', 'author:id,name'])
                ->whereHas('category', function ($q) {
                    $q->where('priority', 2);
                })
                ->where('status', 'published')
                ->active()
                ->latest('published_at')
                ->take(4)
                ->get(),
            'thirdPriorityCategory' => Category::where('priority', 3)->where('status', 1)->first(),
            'thirdPriorityCategoryPosts' => Post::select('id', 'title', 'slug', 'excerpt', 'thumbnail', 'image', 'category_id', 'user_id', 'published_at', 'updated_at')
                ->with(['category:id,name,priority,slug', 'author:id,name'])
                ->whereHas('category', function ($q) {
                    $q->where('priority', 3);
                })
                ->where('status', 'published')
                ->active()
                ->latest('published_at')
                ->take(4)
                ->get(),
            'trendingPosts' => Cache::remember('trending_posts', 60, function () {
                return Post::select('id', 'title', 'slug', 'excerpt', 'thumbnail', 'image', 'category_id', 'user_id', 'published_at', 'updated_at')
                    ->with(['category', 'author'])
                    ->where('is_trending', 1)
                    ->where('status', 'published')
                    ->active()
                    ->latest('published_at')
                    ->take(4)
                    ->get();
            }),
            'news' => Cache::remember('news', 60, function () {
                return News::latest()->take(7)->get();
            })

        ]);
    }

    public function about()
    {

        $about = About::first();

        $categories = Category::where('status', 1)->orderBy('priority', 'asc')->get();

        return Inertia::render('frontend/About', compact('about', 'categories'));

    }

    public function blog()
    {
        $categories = Category::orderBy('priority', 'asc')
            ->withCount([
                'posts as posts_count' => function ($q) {
                    $q->where('status', 'published')->active();
                }
            ])
            ->get();

        $posts = Post::select('id', 'title', 'slug', 'excerpt', 'thumbnail', 'image', 'category_id', 'user_id', 'published_at', 'updated_at')
            ->with(['category:id,name,priority,slug', 'author:id,name'])
            ->where('status', 'published')
            ->active()
            ->latest('published_at')
            ->get();

        $trendingPosts = Post::select('id', 'title', 'slug', 'excerpt', 'thumbnail', 'image', 'category_id', 'user_id', 'published_at', 'updated_at')
            ->with(['category', 'author'])
            ->where('is_trending', 1)
            ->where('status', 'published')
            ->active()
            ->latest('published_at')
            ->take(3)
            ->get();

        $firstPriorityCategory = Category::where('priority', 1)->where('status', 1)->first();
        $firstPriorityCategoryPosts = Post::select('id', 'title', 'slug', 'excerpt', 'thumbnail', 'image', 'category_id', 'user_id', 'published_at', 'updated_at')
            ->with(['category:id,name,priority,slug', 'author:id,name'])
            ->whereHas('category', function ($q) {
                $q->where('priority', 1);
            })
            ->where('status', 'published')
            ->active()
            ->latest('published_at')
            ->take(3)
            ->get();

        $secondPriorityCategory = Category::where('priority', 2)->where('status', 1)->first();
        $secondPriorityCategoryPosts = Post::select('id', 'title', 'slug', 'excerpt', 'thumbnail', 'image', 'category_id', 'user_id', 'published_at', 'updated_at')
            ->with(['category:id,name,priority,slug', 'author:id,name'])
            ->whereHas('category', function ($q) {
                $q->where('priority', 2);
            })
            ->where('status', 'published')
            ->active()
            ->latest('published_at')
            ->take(3)
            ->get();

        return Inertia::render('frontend/Blog', compact('categories', 'posts', 'trendingPosts', 'firstPriorityCategory', 'firstPriorityCategoryPosts', 'secondPriorityCategory', 'secondPriorityCategoryPosts'));
    }

    public function blogDetails(string $slug)
    {

        $post = Post::with(['category', 'author'])->where('slug', $slug)->first();

        $categories = Category::where('status', 1)
            ->orderBy('priority', 'asc')
            ->withCount([
                'posts as posts_count' => function ($q) {
                    $q->where('status', 'published')->active();
                }
            ])->get();

        $trendingPosts = Post::select('id', 'title', 'slug', 'excerpt', 'thumbnail', 'image', 'category_id', 'user_id', 'published_at', 'updated_at')
            ->with(['category', 'author'])
            ->where('is_trending', 1)
            ->where('status', 'published')
            ->active()
            ->latest('published_at')
            ->take(3)
            ->get();

        $firstPriorityCategory = Category::where('priority', 1)->where('status', 1)->first();
        $firstPriorityCategoryPosts = Post::select('id', 'title', 'slug', 'excerpt', 'thumbnail', 'image', 'category_id', 'user_id', 'published_at', 'updated_at')
            ->with(['category:id,name,priority,slug', 'author:id,name'])
            ->whereHas('category', function ($q) {
                $q->where('priority', 1);
            })
            ->where('status', 'published')
            ->active()
            ->latest('published_at')
            ->take(3)
            ->get();

        $secondPriorityCategory = Category::where('priority', 2)->where('status', 1)->first();
        $secondPriorityCategoryPosts = Post::select('id', 'title', 'slug', 'excerpt', 'thumbnail', 'image', 'category_id', 'user_id', 'published_at', 'updated_at')
            ->with(['category:id,name,priority,slug', 'author:id,name'])
            ->whereHas('category', function ($q) {
                $q->where('priority', 2);
            })
            ->where('status', 'published')
            ->active()
            ->latest('published_at')
            ->take(3)
            ->get();

        return Inertia::render('frontend/BlogDetails', [
            'post' => $post,
            'categories' => $categories,
            'trendingPosts' => $trendingPosts,
            'firstPriorityCategory' => $firstPriorityCategory,
            'firstPriorityCategoryPosts' => $firstPriorityCategoryPosts,
            'secondPriorityCategory' => $secondPriorityCategory,
            'secondPriorityCategoryPosts' => $secondPriorityCategoryPosts
        ]);

    }

    public function contact()
    {
        return Inertia::render('frontend/Contact');
    }

    public function login()
    {
        return Inertia::render('Pages/Login'); // or 'frontend/Login' if you create it there
    }

}
