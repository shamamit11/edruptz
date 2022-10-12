<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'title', 'sub_title', 'page_section_id', 'short_description', 'description', 'image', 'video', 'slug', 'header_menu', 'footer_menu', 'orders', 'status', 'is_sitemap', 'meta_title', 'meta_description'];

    public function page_section()
    {
        return $this->belongsTo(PageSection::class, 'page_section_id', 'id');
    }
}
