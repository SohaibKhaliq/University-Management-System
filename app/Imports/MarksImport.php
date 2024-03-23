<?php

namespace App\Imports;

use Auth;
use App\Models\Exam;
use App\Models\ExamType;
use App\Models\StudentEnroll;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MarksImport implements ToCollection, WithHeadingRow
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
            '*.student_id' => 'required',
            '*.attendance' => 'required',
            '*.achieve_marks' => 'nullable|numeric',
        ])->validate();


        foreach ($rows as $row) {

            if($row['attendance'] == 'P'){$attendance = 1;}
            elseif($row['attendance'] == 'A'){$attendance = 2;}
            else{$attendance = 2;}

            $student_id = $row['student_id'];
            $subject = $this->data['subject'];


            // Enrolls
            $enroll = StudentEnroll::where('session_id', $this->data['session']);
            $enroll->with('student')->whereHas('student', function ($query) use ($student_id){
                $query->where('student_id', $student_id);
            });
            $enroll->with('subjects')->whereHas('subjects', function ($query) use ($subject){
                $query->where('subject_id', $subject);
            });
            $student = $enroll->first();


            // Exam Type
            $examType = ExamType::where('id', $this->data['type'])->first();


            if(isset($student) && isset($examType)){
            // Attendance Update
            Exam::updateOrCreate(
                [
                'student_enroll_id'    => $student->id,
                'subject_id'    => $this->data['subject'],
                'exam_type_id'    => $this->data['type'],
                ],[
                'student_enroll_id'    => $student->id,
                'subject_id'    => $this->data['subject'],
                'exam_type_id'    => $this->data['type'],
                'date'    => $this->data['date'],
                'marks'    => $examType->marks,
                'contribution'    => $examType->contribution,
                'attendance'    => $attendance,
                'achieve_marks'    => $row['achieve_marks'] ?? null,
                'note'    => $row['note'],
                'created_by'     => Auth::guard('web')->user()->id,
            ]);
            }
        }
    }
}
