<?php

namespace App\Http\Controllers\Backend;

use Inertia\Inertia;
use App\Models\About;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class AboutController extends Controller
{

    public function index()
    {
        $about = About::first();

        return Inertia::render('backend/pages/about/Edit', [
            'about' => $about,
            'categories' => Category::orderBy('priority', 'asc')->get(),
        ]);
    }

    public function update(Request $request, About $about)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:png,jpg,jpeg,webp,gif|max:2048',
        ]);

        $baseUrl = request()->getSchemeAndHttpHost();
        $imagePath = public_path('/backend/images/about/');

        $imageName = uniqid() . '.jpg';
        $thumbnailName = 'thumb_' . $imageName;

        // Handle image upload
        if ($request->hasFile('image')) {

            // Safely delete existing image if stored as URL
            if (!empty($about->image)) {
                $oldPathFromUrl = parse_url($about->image, PHP_URL_PATH);
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

            $fullImageUrl = $baseUrl . '/backend/images/about/' . $imageName;
        } else {
            $fullImageUrl = $about->image;
        }

        $about->update([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $fullImageUrl,
        ]);

        return back()->with('success', 'About updated successfully!');
    }
}