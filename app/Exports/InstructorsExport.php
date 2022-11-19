<?php

namespace App\Exports;

use App\Models\Instructor;

use Maatwebsite\Excel\Concerns\FromCollection;

class InstructorsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Instructor::get()->makeHidden(['password', 'remember_token', 'about_me', 'status', 'image', 'slug', 'verified_code', 'email_verified', 'admin_set', 'stripe_id', 'updated_at']);;
    }
}
