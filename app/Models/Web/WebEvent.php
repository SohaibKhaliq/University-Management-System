<?php

namespace App\Models\Web;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebEvent extends Model
{
    use HasFactory;

    protected $fillable = [
        'language_id', 'title', 'slug', 'date', 'time', 'address', 'description', 'attach', 'status',
    ];

    public function language()
    {
        return $this->belongsTo(Language::class, 'language_id');
    }
}
