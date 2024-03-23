<?php

namespace App\Http\Controllers\Admin\Web;

use App\Http\Controllers\Controller;
use App\Models\Web\SocialSetting;
use Illuminate\Http\Request;
use Toastr;

class SocialSettingController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Module Data
        $this->title    = trans_choice('module_social_setting', 1);
        $this->route    = 'admin.social-setting';
        $this->view     = 'admin.web.social-setting';
        $this->access   = 'social-setting';


        $this->middleware('permission:'.$this->access.'-view');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['title']  = $this->title;
        $data['route']  = $this->route;
        $data['view']   = $this->view;
        $data['access'] = $this->access;

        $data['row'] = SocialSetting::first();

        return view($this->view.'.index', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Field Validation
        $request->validate([
            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
            'instagram' => 'nullable|url',
            'pinterest' => 'nullable|url',
            'linkedin' => 'nullable|url',
            'youtube' => 'nullable|url',
        ]);

        $id = $request->id;


        // -1 means no data row found
        if($id == -1){
            // Insert Data
            $social = new SocialSetting;
            $social->facebook = $request->facebook;
            $social->twitter = $request->twitter;
            $social->instagram = $request->instagram;
            $social->pinterest = $request->pinterest;
            $social->linkedin = $request->linkedin;
            $social->youtube = $request->youtube;
            $social->tiktok = $request->tiktok;
            $social->skype = $request->skype;
            $social->telegram = $request->telegram;
            $social->whatsapp = $request->whatsapp;
            $social->save();
        }
        else{
            // Update Data
            $social = SocialSetting::find($id);
            $social->facebook = $request->facebook;
            $social->twitter = $request->twitter;
            $social->instagram = $request->instagram;
            $social->pinterest = $request->pinterest;
            $social->linkedin = $request->linkedin;
            $social->youtube = $request->youtube;
            $social->tiktok = $request->tiktok;
            $social->skype = $request->skype;
            $social->telegram = $request->telegram;
            $social->whatsapp = $request->whatsapp;
            $social->save();
        }


        Toastr::success(__('msg_updated_successfully'), __('msg_success'));

        return redirect()->back();
    }
}
