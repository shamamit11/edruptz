<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'slug', 'status'];

    public function tags()
    {
        return $this->hasMany(CategoryTag::class, 'category_id', 'id');
    }

}
