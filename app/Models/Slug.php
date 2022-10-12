<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slug extends Model
{
    use HasFactory;

    protected $fillable = ['controller_name', 'function_name', 'slug', 'is_sitemap'];

    public static function insertSlug($controller_name, $function_name, $slug_name, $old_slug_name, $is_sitemap = 1)
    {
        if ($slug_name == $old_slug_name) {
            return $slug_name;
        }
        $no_exits = Slug::where('slug', $slug_name)->doesntExist();
        $slug_name = ($no_exits) ? $slug_name : $slug_name . "-" . time();
        $slug = new Slug;
        $slug->controller_name = $controller_name;
        $slug->function_name = $function_name;
        $slug->slug = $slug_name;
        $slug->is_sitemap = $is_sitemap;
        $slug->save();
        return $slug_name;
    }
}
