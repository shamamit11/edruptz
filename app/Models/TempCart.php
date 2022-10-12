<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempCart extends Model
{
    use HasFactory;
    protected $fillable = ['session_id', 'course_id', 'amount' ];


    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }
}
