<?php

namespace App\Http\Controllers\Admin\Web;

use App\Http\Controllers\Controller;
use App\Models\Web\CallToAction;
use Illuminate\Http\Request;
use App\Traits\FileUploader;
use App\Models\Language;
use Toastr;

class CallToActionController extends Controller
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
        $this->title    = trans_choice('module_call_to_action', 1);
        $this->route    = 'admin.call-to-action';
        $this->view     = 'admin.web.call-to-action';
        $this->path     = 'call-to-action';
        $this->access   = 'call-to-action';


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

        $data['row'] = CallToAction::where('language_id', Language::version()->id)->first();

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
            'title' => 'required',
            'sub_title' => 'required',
            'button_link' => 'nullable|url',
            'image' => 'nullable|image',
            'bg_image' => 'nullable|image',
        ]);

        $id = $request->id;


        // -1 means no data row found
        if($id == -1){
            // Insert Data
            $callToAction = new CallToAction;
            $callToAction->language_id = Language::version()->id;
            $callToAction->title = $request->title;
            $callToAction->sub_title = $request->sub_title;
            $callToAction->button_text = $request->button_text;
            $callToAction->button_link = $request->button_link;
            $callToAction->video_id = $request->video_id;
            $callToAction->image = $this->uploadImage($request, 'image', $this->path, 500, 280);
            $callToAction->bg_image = $this->uploadImage($request, 'bg_image', $this->path, 500, 280);
            $callToAction->status = $request->status;
            $callToAction->save();
        }
        else{
            // Update Data
            $callToAction = CallToAction::find($id);
            $callToAction->title = $request->title;
            $callToAction->sub_title = $request->sub_title;
            $callToAction->button_text = $request->button_text;
            $callToAction->button_link = $request->button_link;
            $callToAction->video_id = $request->video_id;
            $callToAction->image = $this->updateImage($request, 'image', $this->path, 500, 280, $callToAction, 'image');
            $callToAction->bg_image = $this->updateImage($request, 'bg_image', $this->path, 500, 280, $callToAction, 'bg_image');
            $callToAction->status = $request->status;
            $callToAction->save();
        }


        Toastr::success(__('msg_updated_successfully'), __('msg_success'));

        return redirect()->back();
    }
}
