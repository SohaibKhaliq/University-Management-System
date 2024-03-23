<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MarksheetSetting extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'header_left', 'header_center', 'header_right', 'body', 'footer_left', 'footer_center', 'footer_right', 'logo_left', 'logo_right', 'background', 'width', 'height', 'student_photo', 'barcode', 'status',
    ];
}
