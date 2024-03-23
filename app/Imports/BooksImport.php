<?php

namespace App\Imports;

use Auth;
use App\Models\Book;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BooksImport implements ToCollection, WithHeadingRow
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
            '*.title' => 'required|max:191',
            '*.isbn' => 'required|max:30|unique:books,isbn',
            '*.price' => 'nullable|numeric',
            '*.quantity' => 'required|numeric',
        ])->validate();


        foreach ($rows as $row) {
            Book::updateOrCreate(
                [
                'isbn'    => $row['isbn'],
                ],[
                'category_id'     => $this->data['category'],
                'title'    => $row['title'],
                'isbn'    => $row['isbn'],
                'author'    => $row['author'],
                'publisher'    => $row['publisher'],
                'edition'    => $row['edition'],
                'publish_year'    => $row['publish_year'],
                'language'    => $row['language'],
                'price'    => $row['price'],
                'quantity'    => $row['quantity'],
                'created_by'     => Auth::guard('web')->user()->id,
            ]);
        }
    }
}
