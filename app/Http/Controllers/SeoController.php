<?php

namespace App\Http\Controllers;

use App\Models\SeoSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SeoController extends Controller
{
    public function index()
    {
        $seoSettings = SeoSetting::all();
        return view('backend.pages.seo-index', compact('seoSettings'));
    }

    public function create()
    {
        $pages = [
            'home' => 'Home',
            'about' => 'About Us',
            'sermons' => 'Sermons',
            'contact' => 'Contact',
            'donation' => 'Donation',
            'ministry' => 'Ministry',
            'prayer.form' => 'Prayer Form',
            'partnership' => 'Partnership',
        ];
        return view('backend.pages.seo-create', compact('pages'));
    }

    public function store(Request $request)
    {
        $pages = [
            'home' => 'Home',
            'about' => 'About Us',
            'sermons' => 'Sermons',
            'contact' => 'Contact',
            'donation' => 'Donation',
            'ministry' => 'Ministry',
            'prayer.form' => 'Prayer Form',
            'partnership' => 'Partnership',
        ];
        $validated = $request->validate([
            'page' => ['required', 'in:' . implode(',', array_keys($pages))], // Convert array keys to string
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'keywords' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Handle Image Upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('seo_images', 'public');
            $validated['image'] = $imagePath;
        }

        SeoSetting::updateOrCreate(
            ['page' => $validated['page']],  // Unique per page
            $validated
        );

        Cache::flush(); // Clears all cached data

        return redirect()->route('seo.create')->with('success', 'SEO settings updated successfully.');
    }


    public function edit(SeoSetting $seo)
    {
        return view('backend.pages.seo-edit', compact('seo'));
    }

    public function update(Request $request, SeoSetting $seo)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'keywords' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('seo_images', 'public');
        }

        $seo->update($validated);
        Cache::flush(); // Clears all cached data
        return redirect()->route('seo.index')->with('success', 'SEO settings updated!');
    }

    public function destroy(SeoSetting $seo)
    {
        $seo->delete();
        return redirect()->route('seo.index')->with('success', 'SEO settings deleted!');
    }
}
