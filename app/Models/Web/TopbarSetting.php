<?php

namespace App\Models\Web;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TopbarSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'address_title', 'address', 'email', 'phone', 'working_hour', 'about_title', 'about_summery', 'social_title', 'social_status', 'status',
    ];
}
