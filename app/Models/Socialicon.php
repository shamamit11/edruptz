<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Socialicon extends Model
{
    use HasFactory;
    protected $fillable = ['facebook', 'twitter', 'linkedin', 'instagram', 'youtube', 'whatsapp', 'pinterest'];
}
