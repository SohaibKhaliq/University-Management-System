<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'slug', 'status',
    ];

    // Get Record
    public static function field($slug)
    {
        $field = Field::where('slug', $slug)->first();

        return $field;
    }
}
