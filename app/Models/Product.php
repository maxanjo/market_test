<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'category_id', 'price'];
    protected $casts = [
        'price' => 'decimal:2',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    
    /**
     * @param Builder $query
     * @param array $filters
     * @return Builder
     */
    public function scopeFilter(Builder $query, array $filters): Builder
    {
        $query->when($filters['q'] ?? null, function ($query, $search) {
            $query->where('name', 'like', '%' . $search . '%');
        });

        $query->when($filters['price_from'] ?? null, function ($query, $price) {
            $query->where('price', '>=', $price);
        });

        $query->when($filters['price_to'] ?? null, function ($query, $price) {
            $query->where('price', '<=', $price);
        });

        $query->when($filters['category_id'] ?? null, function ($query, $categoryId) {
            $query->where('category_id', $categoryId);
        });

        $query->when($filters['rating_from'] ?? null, function ($query, $rating) {
            $query->where('rating', '>=', $rating);
        });

        if (isset($filters['in_stock'])) {
            $query->where('in_stock', $filters['in_stock']);
        }

        $sort = $filters['sort'] ?? 'newest';

        match ($sort) {
            'price_asc'   => $query->orderBy('price', 'asc'),
            'price_desc'  => $query->orderBy('price', 'desc'),
            'rating_desc' => $query->orderBy('rating', 'desc'),
            'newest'      => $query->latest(),
            default       => $query->latest(),
        };

        return $query;
    }
}
