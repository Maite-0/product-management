<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    protected $fillable = [
        'title',          // Product title
        'description',    // Product description
        'price',          // Product price
        'stock',          // Product stock quantity
        'image_url',      // URL of the product image
        'category',       // Product category
        'sku',            // Stock Keeping Unit, a unique identifier for products
        'status',         // Product status (e.g., active, inactive)
        'created_by',     // The user who created the product
        'updated_by',     // The user who last updated the product
        'owner_email',
        'owner_mobilenumber'
    ];
}
