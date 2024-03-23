<?php

namespace App\Models\Web;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
    use HasFactory;

    protected $fillable = [
        'language_id', 'label', 'title', 'short_desc', 'description', 'features', 'attach', 'video_id', 'button_text', 'mission_title', 'mission_desc', 'mission_icon', 'mission_image', 'vision_title', 'vision_desc', 'vision_icon', 'vision_image', 'status',
    ];

    public function language()
    {
        return $this->belongsTo(Language::class, 'language_id');
    }
}
