<?php

namespace App\Http\Controllers;

use App\Models\TourismSpot;
use App\Models\Category;
use Illuminate\Http\Request;

class TourismController extends Controller
{
    /**
     * Display the homepage with tourism spots.
     * Includes logic for searching and filtering by category.
     */
    public function index(Request $request)
    {
        // Start building the query with the category relationship loaded
        $query = TourismSpot::with('category');

        // Check if there is a search term in the request
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
        }

        // Check if a specific category is selected for filtering
        if ($request->has('category') && $request->category != '') {
            $query->where('category_id', $request->category);
        }

        // Execute the query and get the results
        $spots = $query->get();
        
        // Fetch all categories for the filter dropdown
        $categories = Category::all();
        
        // Return the welcome view with the data
        return view('welcome', compact('spots', 'categories'));
    }

    /**
     * Display the details of a specific tourism spot.
     */
    public function show(TourismSpot $spot)
    {
        return view('spots.show', compact('spot'));
    }
}
