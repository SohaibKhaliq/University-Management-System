<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Config;
use Illuminate\Pagination\Paginator;
use App\Models\Web\TopbarSetting;
use App\Models\Web\SocialSetting;
use App\Models\ScheduleSetting;
use App\Models\Web\Page;
use App\Models\Language;
use App\Models\Setting;
use View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Schema::defaultStringLength(191);
        Paginator::useBootstrap();


        // Share view for Common Data
        $user_languages = Language::where('status', '1')->get();
        $setting = Setting::where('status', '1')->first();
        $topbarSetting = TopbarSetting::where('status', '1')->first();
        $socialSetting = SocialSetting::where('status', '1')->first();
        $schedule_setting = ScheduleSetting::where('slug', 'fees-schedule')->first();
        $footer_pages = Page::where('language_id', Language::version()->id)
                            ->where('status', '1')
                            ->orderBy('id', 'asc')
                            ->get();

        // Set Time Zone
        Config::set('app.timezone', $setting->time_zone);

        View::share(['setting' => $setting, 'user_languages' => $user_languages, 'schedule_setting' => $schedule_setting, 'topbarSetting' => $topbarSetting, 'socialSetting' => $socialSetting, 'footer_pages' => $footer_pages]);

    }
}
