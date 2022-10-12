<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class General extends Model
{
    use HasFactory;

    public static function getSlug($table_name, $field_name, $title, $id = 0, $id_name = 'id')
    {
        $slug_name = Str::slug($title);
        $slug_name = ($slug_name) ? $slug_name : time();
        $ras = DB::table($table_name)->whereRaw("$id_name != '$id' and $field_name = '$slug_name'")->doesntExist();
        $slug = ($ras) ? $slug_name : $slug_name . "-" . time();
        return $slug;
    }

    public static function getMax($table_name, $field_name)
    {
        return DB::table($table_name)->max($field_name) + 1;
    }

    public static function youtube($url)
    {
        $pattern = '#^(?:https?://)?(?:www\.)?(?:youtu\.be/|youtube\.com(?:/embed/|/v/|/watch\?v=|/watch\?.+&v=))([\w-]{11})(?:.+)?$#x';
        preg_match($pattern, $url, $matches);
        return (isset($matches[1])) ? $matches[1] : '';
    }
}
