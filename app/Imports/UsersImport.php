<?php

namespace App\Imports;

use Auth;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToCollection, WithHeadingRow
{
    protected $data;

    /**
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        Validator::make($rows->toArray(), [
            '*.staff_id' => 'required|unique:users,staff_id',
            '*.first_name' => 'required',
            '*.last_name' => 'required',
            '*.email' => 'required|email|unique:users,email',
            '*.gender' => 'required|integer',
            '*.dob' => 'required|date',
            '*.phone' => 'required',
            '*.basic_salary' => 'required|numeric',
            '*.contract_type' => 'required|integer',
            '*.salary_type' => 'required|integer',
        ])->validate();


        foreach ($rows as $row) {
            User::updateOrCreate(
                [
                'staff_id'     => $row['staff_id'],
                ],[
                'staff_id'     => $row['staff_id'],
                'department_id'     => $this->data['department'],
                'designation_id'     => $this->data['designation'],
                'first_name'    => $row['first_name'],
                'last_name'    => $row['last_name'],
                'father_name'    => $row['father_name'],
                'mother_name'    => $row['mother_name'],
                'email'    => $row['email'],
                'password'      => Hash::make($row['staff_id']),
                'password_text'     => Crypt::encryptString($row['staff_id']),
                'gender'    => $row['gender'],
                'dob'    => $row['dob'],
                'phone'    => $row['phone'],
                'basic_salary'    => $row['basic_salary'],
                'contract_type'    => $row['contract_type'],
                'salary_type'    => $row['salary_type'],
                'created_by'     => Auth::guard('web')->user()->id,
            ]);
        }
    }
}
