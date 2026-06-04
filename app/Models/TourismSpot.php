<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TourismSpot extends Model
{
    use SoftDeletes;
    // Mass-assignable fields for the Create/Update operations
    protected $fillable = ['name', 'description', 'location', 'category_id', 'image_path', 'price'];

    /**
     * Relationship: Each tourism spot belongs to one category.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Relationship: One tourism spot can have multiple bookings.
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * Relationship: One tourism spot can have multiple user reviews.
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
