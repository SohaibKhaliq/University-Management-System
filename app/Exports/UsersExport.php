<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::get(['staff_id', 'first_name', 'last_name', 'father_name', 'mother_name', 'email', 'gender', 'dob', 'phone', 'basic_salary', 'contract_type', 'salary_type']);
    }


    public function headings(): array
    {
        return ['staff_id', 'first_name', 'last_name', 'father_name', 'mother_name', 'email', 'gender', 'dob', 'phone', 'basic_salary', 'contract_type', 'salary_type'];
    }
}
