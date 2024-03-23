<?php

namespace App\Models\Web;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'facebook', 'twitter', 'linkedin', 'instagram', 'pinterest',
        'youtube', 'tiktok', 'skype', 'telegram', 'whatsapp', 'status',
    ];
}
