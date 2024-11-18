<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Add the fillable fields
    protected $fillable = ['name', 'description', 'price', 'quantity', 'image'];
    public function creator()
{
    return $this->belongsTo(User::class, 'createdBy');
}

}
