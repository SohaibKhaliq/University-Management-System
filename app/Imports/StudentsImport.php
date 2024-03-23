<?php

namespace App\Imports;

use Auth;
use Carbon\Carbon;
use App\Models\Student;
use App\Models\StudentEnroll;
use App\Models\EnrollSubject;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentsImport implements ToCollection, WithHeadingRow
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
            '*.student_id' => 'required|unique:students,student_id',
            '*.admission_date' => 'required|date',
            '*.first_name' => 'required',
            '*.last_name' => 'required',
            '*.email' => 'required|email|unique:students,email',
            '*.gender' => 'required|integer',
            '*.dob' => 'required|date',
            '*.phone' => 'required',
        ])->validate();
  

        foreach ($rows as $row) {
            $student = Student::updateOrCreate(
                [
                'student_id'     => $row['student_id'],
                ],[
                'student_id'     => $row['student_id'],
                'batch_id'     => $this->data['batch'],
                'program_id'     => $this->data['program'],
                'admission_date'     => $row['admission_date'],
                'first_name'     => $row['first_name'],
                'last_name'     => $row['last_name'],
                'father_name'     => $row['father_name'],
                'mother_name'     => $row['mother_name'],
                'email'     => $row['email'],
                'password'      => Hash::make($row['student_id']),
                'password_text'     => Crypt::encryptString($row['student_id']),
                'gender'     => $row['gender'],
                'dob'     => $row['dob'],
                'phone'     => $row['phone'],
                'created_by'     => Auth::guard('web')->user()->id,
            ]);


            // Student Enroll
            $enroll = new StudentEnroll();
            $enroll->student_id = $student->id;
            $enroll->session_id = $this->data['session'];
            $enroll->semester_id = $this->data['semester'];
            $enroll->program_id = $this->data['program'];
            $enroll->section_id = $this->data['section'];
            $enroll->created_by = Auth::guard('web')->user()->id;
            $enroll->save();


            // Assign Subjects
            $enrollSubject = EnrollSubject::where('program_id', $this->data['program'])->where('semester_id', $this->data['semester'])->where('section_id', $this->data['section'])->first();
            
            if(isset($enrollSubject)){
                foreach($enrollSubject->subjects as $subject){
                    // Attach Subject
                    $enroll->subjects()->attach($subject->id);
                }
            }
        }
    }
}
