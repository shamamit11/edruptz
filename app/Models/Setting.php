<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $fillable = ['site_name', 'meta_title', 'meta_description', 'google_analytics', 'google_site_verification', 'email', 'phone', 'mobile', 'address', 'years'];
}
