<?php

namespace App\Http\Controllers\Frontend;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FrontendController extends Controller
{

    public function home()
    {
        return Inertia::render('frontend/Index');
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