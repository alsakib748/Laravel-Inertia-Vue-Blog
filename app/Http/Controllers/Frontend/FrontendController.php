<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Post;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class FrontendController extends Controller
{

    public function home()
    {
        return Inertia::render('frontend/Index', [
            'sliderPosts' => Cache::remember('slider_posts', 60, function () {
                return Post::select('id', 'title', 'slug', 'excerpt', 'thumbnail', 'image', 'category_id', 'user_id', 'published_at','updated_at')->with(['category', 'author'])->where('is_slider', 1)->where('status', 'published')->active()->latest()->take(5)->get();
            }),
        ]);
    }

    public function about()
    {
        return Inertia::render('frontend/About');
    }

    public function blog()
    {
        return Inertia::render('frontend/Blog');
    }

    public function blogDetails(string $slug)
    {
        return Inertia::render('frontend/BlogDetails', [
            'slug' => $slug,
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