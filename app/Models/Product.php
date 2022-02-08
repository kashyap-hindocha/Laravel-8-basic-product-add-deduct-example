<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    public $timestamps = true;

    protected $fillable = [
        'name',
        'description',
        'price',
        'qty',
        'image_url',
        'created_at',
        'updated_at'
    ];
}

