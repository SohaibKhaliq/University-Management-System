<?php

namespace App\Http\Controllers\Admin\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\FileUploader;
use App\Models\Web\AboutUs;
use App\Models\Language;
use Toastr;

class AboutUsController extends Controller
{
    use FileUploader;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Module Data
        $this->title    = trans_choice('module_about_us', 1);
        $this->route    = 'admin.about-us';
        $this->view     = 'admin.web.about-us';
        $this->path     = 'about-us';
        $this->access   = 'about-us';


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
        $data['path']   = $this->path;
        $data['access'] = $this->access;

        $data['row'] = AboutUs::where('language_id', Language::version()->id)->first();

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
            'label' => 'required',
            'title' => 'required',
            'description' => 'required',
            'attach' => 'nullable|image',
            'vision_image' => 'nullable|image',
            'mission_image' => 'nullable|image',
        ]);

        $id = $request->id;


        // -1 means no data row found
        if($id == -1){
            // Insert Data
            $aboutUs = new AboutUs;
            $aboutUs->language_id = Language::version()->id;
            $aboutUs->label = $request->label;
            $aboutUs->title = $request->title;
            $aboutUs->short_desc = $request->short_desc;
            $aboutUs->description = $request->description;
            $aboutUs->button_text = $request->button_text;
            $aboutUs->video_id = $request->video_id;
            $aboutUs->features = json_encode($request->features, JSON_UNESCAPED_UNICODE);
            $aboutUs->attach = $this->uploadImage($request, 'attach', $this->path, null, 800);
            $aboutUs->vision_title = $request->vision_title;
            $aboutUs->vision_desc = $request->vision_desc;
            $aboutUs->vision_icon = $request->vision_icon;
            $aboutUs->vision_image = $this->uploadImage($request, 'vision_image', $this->path, 500, 280);
            $aboutUs->mission_title = $request->mission_title;
            $aboutUs->mission_desc = $request->mission_desc;
            $aboutUs->mission_icon = $request->mission_icon;
            $aboutUs->mission_image = $this->uploadImage($request, 'mission_image', $this->path, 500, 280);
            $aboutUs->save();
        }
        else{
            // Update Data
            $aboutUs = AboutUs::find($id);
            $aboutUs->label = $request->label;
            $aboutUs->title = $request->title;
            $aboutUs->short_desc = $request->short_desc;
            $aboutUs->description = $request->description;
            $aboutUs->button_text = $request->button_text;
            $aboutUs->video_id = $request->video_id;
            $aboutUs->features = json_encode($request->features, JSON_UNESCAPED_UNICODE);
            $aboutUs->attach = $this->updateImage($request, 'attach', $this->path, null, 800, $aboutUs, 'attach');
            $aboutUs->vision_title = $request->vision_title;
            $aboutUs->vision_desc = $request->vision_desc;
            $aboutUs->vision_icon = $request->vision_icon;
            $aboutUs->vision_image = $this->updateImage($request, 'vision_image', $this->path, 500, 280, $aboutUs, 'vision_image');
            $aboutUs->mission_title = $request->mission_title;
            $aboutUs->mission_desc = $request->mission_desc;
            $aboutUs->mission_icon = $request->mission_icon;
            $aboutUs->mission_image = $this->updateImage($request, 'mission_image', $this->path, 500, 280, $aboutUs, 'mission_image');
            $aboutUs->save();
        }


        Toastr::success(__('msg_updated_successfully'), __('msg_success'));

        return redirect()->back();
    }
}
