<?php

namespace App\Imports;

use App\Models\Subject;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SubjectsImport implements ToCollection, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        Validator::make($rows->toArray(), [
            '*.title' => 'required|max:191|unique:subjects,title',
            '*.code' => 'required|max:191|unique:subjects,code',
            '*.credit_hour' => 'required|numeric',
            '*.subject_type' => 'nullable|integer',
            '*.class_type' => 'required|integer',
        ])->validate();


        foreach ($rows as $row) {
            Subject::updateOrCreate(
                [
                'code'    => $row['code'],
                ],[
                'title'    => $row['title'],
                'code'    => $row['code'],
                'credit_hour'    => $row['credit_hour'],
                'subject_type'    => $row['subject_type'] ?? 0,
                'class_type'    => $row['class_type'],
            ]);
        }
    }
}
