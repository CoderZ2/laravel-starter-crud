<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Images;

class Store extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'total', 'description', 'category_id'];

    public function images()
    {
        return $this->morphMany(Images::class, 'imageable');
    }
}
