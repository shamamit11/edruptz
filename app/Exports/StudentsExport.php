<?php

namespace App\Exports;

use App\Models\Student;

use Maatwebsite\Excel\Concerns\FromCollection;

class StudentsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Student::get()->makeHidden(['password', 'remember_token', 'image', 'verified_code', 'email_verified','status', 'updated_at']);
    }
}
