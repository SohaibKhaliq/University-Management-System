<?php

namespace App\Http\Controllers\Admin\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\FileUploader;
use App\Models\Web\Slider;
use App\Models\Language;
use Toastr;

class SliderController extends Controller
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
        $this->title   = trans_choice('module_slider', 1);
        $this->route   = 'admin.slider';
        $this->view    = 'admin.web.slider';
        $this->path    = 'slider';
        $this->access  = 'slider';


        $this->middleware('permission:'.$this->access.'-view|'.$this->access.'-create|'.$this->access.'-edit|'.$this->access.'-delete', ['only' => ['index','show']]);
        $this->middleware('permission:'.$this->access.'-create', ['only' => ['create','store']]);
        $this->middleware('permission:'.$this->access.'-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:'.$this->access.'-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data['title']  = $this->title;
        $data['route']  = $this->route;
        $data['view']   = $this->view;
        $data['path']   = $this->path;
        $data['access'] = $this->access;

        $data['rows'] = Slider::where('language_id', Language::version()->id)
                        ->orderby('id', 'asc')
                        ->get();

        return view($this->view.'.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $data['title']  = $this->title;
        $data['route']  = $this->route;
        $data['view']   = $this->view;
        $data['access'] = $this->access;


        return view($this->view.'.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Field Validation
        $request->validate([
            'title' => 'required|unique:sliders,title',
            'button_link' => 'nullable|url',
            'attach' => 'required|image',
        ]);

        //Data Insert
        $slider = new Slider;
        $slider->language_id = Language::version()->id;
        $slider->title = $request->title;
        $slider->sub_title = $request->sub_title;
        $slider->button_text = $request->button_text;
        $slider->button_link = $request->button_link;
        $slider->attach = $this->uploadImage($request, 'attach', $this->path, 1920, 850);
        $slider->save();


        Toastr::success(__('msg_created_successfully'), __('msg_success'));

        return redirect()->route($this->route.'.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Slider $slider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Slider $slider)
    {
        //
        $data['title']  = $this->title;
        $data['route']  = $this->route;
        $data['view']   = $this->view;
        $data['access'] = $this->access;

        $data['row'] =  $slider;

        return view($this->view.'.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Slider $slider)
    {
        //Field Validation
        $request->validate([
            'title' => 'required|unique:sliders,title,'.$slider->id,
            'button_link' => 'nullable|url',
            'attach' => 'nullable|image',
        ]);

        //Data Update
        $slider->title = $request->title;
        $slider->sub_title = $request->sub_title;
        $slider->button_text = $request->button_text;
        $slider->button_link = $request->button_link;
        $slider->attach = $this->updateImage($request, 'attach', $this->path, 1920, 850, $slider, 'attach');
        $slider->status = $request->status;
        $slider->update();


        Toastr::success(__('msg_updated_successfully'), __('msg_success'));

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Slider $slider)
    {
        //Delete Attach
        $this->deleteMedia($this->path, $slider);

        //Delete Data
        $slider->delete();

        Toastr::success(__('msg_deleted_successfully'), __('msg_success'));

        return redirect()->back();
    }
}
