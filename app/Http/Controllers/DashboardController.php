<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use App\Models\Contact;
use App\Models\Partnership;
use App\Models\PrayerRequest;
use App\Models\RecentSermon;
use App\Models\User;
use App\Models\Donation;
use App\Models\Hero;
use App\Models\Testimonial;
use App\Models\UpcomingSermon;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistics
        $stats = [
            'donations' => Donation::count(),
            'partnerships' => Partnership::count(),
            'prayer_requests' => PrayerRequest::count(),
            'testimonials' => Testimonial::count(),
            'contacts' => Contact::count(),
        ];

        // Data for Charts
        $monthlyDonations = Donation::selectRaw('MONTH(created_at) as month, payment_method,status, donor_name,currency, SUM(amount) as total')
            ->groupBy('month', 'payment_method', 'currency', 'status', 'donor_name', )
            ->orderBy('month')
            ->get();

        $partnershipStats = Partnership::selectRaw('state_country, COUNT(*) as total')
            ->groupBy('state_country')
            ->orderByDesc('total')
            ->take(5)
            ->get();

        return view('backend.pages.dashboard', compact('stats', 'monthlyDonations', 'partnershipStats'));

        // return view('backend.pages.dashboard');
    }

    public function manageUsers()
    {
        $users = User::all();
        return view('backend.pages.users', compact('users'));
    }

    public function donation()
    {
        $donation = Donation::all();
        return view('backend.pages.donation', compact('users'));

    }

    public function others()
    {
        $users = User::all();
        return view('backend.pages.users', compact('users'));
    }

    public function settings()
    {
        $users = User::all();
        return view('backend.pages.users', compact('users'));
    }

    public function listHero()
    {
        // Get the first 6 records
        $heroes = Hero::limit(6)->get();
        return view('backend.pages.hero', compact('heroes'));
    }

    public function updateHero(Request $request, $id)
    {
        $hero = Hero::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string',
            'button_text' => 'required|string|max:255',
            'button_link' => 'required|url',
            'youtube' => 'nullable|url',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Process images
        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $imageName = str_replace(' ', '-', strtolower($request->input('title'))) . '-image1.' . $imageFile->getClientOriginalExtension();
            $imagePath = $imageFile->storeAs('heroes', $imageName, 'public');
            $validated['image'] = 'storage/images/' . $imagePath;
        }

        if ($request->hasFile('image2')) {
            $image2File = $request->file('image2');
            $image2Name = str_replace(' ', '-', strtolower($request->input('title'))) . '-image2.' . $image2File->getClientOriginalExtension();
            $image2Path = $image2File->storeAs('heroes', $image2Name, 'public');
            $validated['image2'] = 'storage/images/' . $image2Path;
        }

        // Update the hero record
        $hero->update($validated);

        return redirect()->back()->with('success', 'Hero updated successfully.');
    }



    public function listRecentSermon()
    {
        $sermons = RecentSermon::paginate(10);
        return view('backend.pages.recent-sermon', compact('sermons'));
    }

    // Store a new sermon
    public function storeRecentSermon(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'pastor' => 'required|string|max:255',
            'date' => 'required|date',
            'description' => 'required|string',
            'link' => 'required|url',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('sermons', 'public');
            $validated['image'] = 'storage/' . $validated['image'];
        }

        RecentSermon::create($validated);

        return redirect()->route('admin.setting.recent.list')->with('success', 'Sermon added successfully.');
    }

    // Update an existing sermon
    public function updateRecentSermon(Request $request, $id)
    {
        $sermon = RecentSermon::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'pastor' => 'required|string|max:255',
            'date' => 'required|date',
            'description' => 'required|string',
            'link' => 'required|url',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('sermons', 'public');
            $validated['image'] = 'storage/' . $validated['image'];
        }

        $sermon->update($validated);

        return redirect()->route('admin.setting.recent.list')->with('success', 'Sermon updated successfully.');
    }

    // Delete a sermon
    public function destroyRecentSermon($id)
    {
        $sermon = RecentSermon::findOrFail($id);
        $sermon->delete();

        return redirect()->route('admin.setting.recent.list')->with('success', 'Sermon deleted successfully.');
    }


    public function listUpcomingSermon()
    {
        $sermon = UpcomingSermon::first();
        $sermon->date = Carbon::parse($sermon->date)->format('Y-m-d');
        // dd($sermon->date );
        return view('backend.pages.upcoming-sermon', compact('sermon'));
    }


    public function updateUpcomingSermon(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'pastor' => 'required|string|max:255',
            'date' => 'required|date',
            'button_text' => 'required|string|max:255',
            'button_link' => 'required|url',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Update or create the record
        $sermon = UpcomingSermon::first(); // There is only one record to update
        $sermon->update($validated);

        return redirect()->route('admin.setting.upcoming.list')->with('success', 'Sermon updated successfully.');
    }


    public function listAboutUs()
    {
        $about = \App\Models\AboutUs::first();
        return view('backend.pages.about-us', compact('about'));
    }


    public function updateAboutUs(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'button_text' => 'required|string|max:255',
            'button_link' => 'required|url',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $about = AboutUs::first();

        // Decode existing images or initialize as an empty array
        $existingImages = json_decode($about->images, true) ?? [];

        // Handle new images only if provided
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('about-us', 'public'); // Save the image
                $existingImages[] = 'storage/' . $path; // Append the path to the array
            }
        }

        // Prepare the data to be updated
        $updateData = [
            'title' => $request->title,
            'description' => $request->description,
            'button_text' => $request->button_text,
            'button_link' => $request->button_link,
        ];

        // Update the images field only if there are changes
        if ($request->hasFile('images')) {
            $updateData['images'] = json_encode($existingImages);
        }

        // Update the About Us record
        $about->update($updateData);

        return redirect()->back()->with('success', 'About Us section updated successfully.');
    }



    public function listTestimony()
    {
        $testimonials = Testimonial::paginate(10);
        return view('backend.pages.testimony', compact('testimonials'));
    }

    /**
     * Store a newly created testimonial in storage.
     */
    public function storeTestimony(Request $request)
    {
        $request->validate([
            'author' => 'required|string|max:255',
            'quote' => 'required|string',
            'role' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('testimonials', 'public');
        }

        Testimonial::create([
            'author' => $request->author,
            'quote' => $request->quote,
            'role' => $request->role,
            'title' => $request->title,
            'image' => $imagePath ? 'storage/' . $imagePath : null,
        ]);

        return redirect()->back()->with('success', 'Testimonial added successfully.');
    }

    /**
     * Update the specified testimonial in storage.
     */
    public function updateTestimony(Request $request, Testimonial $testimonial)
    {
        $request->validate([
            'author' => 'required|string|max:255',
            'quote' => 'required|string',
            'role' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = $testimonial->image;

        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($imagePath && file_exists(public_path($imagePath))) {
                unlink(public_path($imagePath));
            }

            $imagePath = $request->file('image')->store('testimonials', 'public');
            $imagePath = 'storage/' . $imagePath;
        }

        $testimonial->update([
            'author' => $request->author,
            'quote' => $request->quote,
            'role' => $request->role,
            'title' => $request->title,
            'image' => $imagePath,
        ]);

        return redirect()->back()->with('success', 'Testimonial updated successfully.');
    }

    /**
     * Remove the specified testimonial from storage.
     */
    public function destroyTestimony(Testimonial $testimonial)
    {
        if ($testimonial->image && file_exists(public_path($testimonial->image))) {
            unlink(public_path($testimonial->image));
        }

        $testimonial->delete();

        return redirect()->back()->with('success', 'Testimonial deleted successfully.');
    }

}
