<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;
use App\Models\Web\SocialSetting;

class SocialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('social_settings')->delete();

        $social = SocialSetting::create([

            'facebook'=>'https://www.facebook.com/HiTechParks/',
            'twitter'=>'https://twitter.com/hitechparks',
            'linkedin'=>'https://www.linkedin.com/company/hi-techparks/',
            'pinterest'=>'https://www.pinterest.com/hitechparks/',
            'youtube'=>'https://www.youtube.com/@hitechparks',
            'skype'=>'hitechparks',
            'whatsapp'=>'+8801740473189',
        ]);
    }
}
