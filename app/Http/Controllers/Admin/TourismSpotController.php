<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TourismSpot;
use App\Models\Category;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class TourismSpotController extends Controller
{
    /**
     * Display a paginated list of tourism spots for the admin.
     */
    public function index()
    {
        // Load spots with their categories, including archived (soft-deleted) ones
        $spots = TourismSpot::withTrashed()->with('category')->paginate(10);
        return view('admin.spots.index', compact('spots'));
    }

    /**
     * Show the form for creating a new tourism spot.
     */
    public function create()
    {
        // Fetch categories to populate the dropdown in the form
        $categories = Category::all();
        return view('admin.spots.create', compact('categories'));
    }

    /**
     * Store a newly created tourism spot in the database.
     */
    public function store(Request $request)
    {
        // Validate the incoming form data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('spots'), $filename);
            $validated['image_path'] = 'spots/' . $filename;
        }

        // Create the record in the database
        $spot = TourismSpot::create($validated);

        ActivityLog::log('Created Spot', "Created tourism spot: {$spot->name}");

        // Redirect back with a success message
        return redirect()->route('admin.spots.index')->with('success', 'Tourism spot created successfully.');
    }

    /**
     * Show the form for editing an existing tourism spot.
     */
    public function edit(TourismSpot $spot)
    {
        $categories = Category::all();
        return view('admin.spots.edit', compact('spot', 'categories'));
    }

    /**
     * Update the specified tourism spot in the database.
     */
    public function update(Request $request, TourismSpot $spot)
    {
        // Validate the update request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if it exists and is not a default/placeholder
            if ($spot->image_path && file_exists(public_path($spot->image_path))) {
                // Optionally check if it's in the spots folder to avoid deleting other things
                if (str_starts_with($spot->image_path, 'spots/')) {
                    unlink(public_path($spot->image_path));
                }
            }

            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('spots'), $filename);
            $validated['image_path'] = 'spots/' . $filename;
        }

        // Update the database record
        $spot->update($validated);

        ActivityLog::log('Updated Spot', "Updated tourism spot: {$spot->name}");

        return redirect()->route('admin.spots.index')->with('success', 'Tourism spot updated successfully.');
    }

    /**
     * Restore the specified archived tourism spot.
     */
    public function restore($id)
    {
        $spot = TourismSpot::withTrashed()->findOrFail($id);
        $spot->restore();

        ActivityLog::log('Restored Spot', "Restored tourism spot: {$spot->name}");

        return redirect()->route('admin.spots.index')->with('success', 'Tourism spot restored successfully.');
    }

    /**
     * Remove the specified tourism spot from the database.
     */
    public function destroy(TourismSpot $spot)
    {
        $spotName = $spot->name;
        // Soft delete the record (Archive)
        $spot->delete();
        
        ActivityLog::log('Archived Spot', "Archived tourism spot: {$spotName}");

        return redirect()->route('admin.spots.index')->with('success', 'Tourism spot archived successfully.');
    }
}
