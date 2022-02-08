<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;
    protected $table = 'orders';
    public $timestamps = true;

     protected $fillable = [
        'customer_id',
        'name',
        'description',
        'price',
        'qty',
        'image_url',
        'created_at',
        'updated_at'
    ];
}
