<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StudentsExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Student::get(['student_id', 'admission_date', 'first_name', 'last_name', 'father_name', 'mother_name', 'email', 'gender', 'dob', 'phone']);
    }


    public function headings(): array
    {
        return ['student_id', 'admission_date', 'first_name', 'last_name', 'father_name', 'mother_name', 'email', 'gender', 'dob', 'phone'];
    }
}
