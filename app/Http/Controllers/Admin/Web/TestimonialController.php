<?php

namespace App\Http\Controllers\Admin\Web;

use App\Http\Controllers\Controller;
use App\Models\Web\Testimonial;
use Illuminate\Http\Request;
use App\Traits\FileUploader;
use App\Models\Language;
use Toastr;

class TestimonialController extends Controller
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
        $this->title   = trans_choice('module_testimonial', 1);
        $this->route   = 'admin.testimonial';
        $this->view    = 'admin.web.testimonial';
        $this->path    = 'testimonial';
        $this->access  = 'testimonial';


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

        $data['rows'] = Testimonial::where('language_id', Language::version()->id)
                        ->orderby('id', 'desc')
                        ->get();

        return view($this->view.'.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Field Validation
        $request->validate([
            'name' => 'required|unique:testimonials,name',
            'description' => 'required',
            'attach' => 'required|image',
        ]);

        //Data Insert
        $testimonial = new Testimonial;
        $testimonial->language_id = Language::version()->id;
        $testimonial->name = $request->name;
        $testimonial->designation = $request->designation;
        $testimonial->description = $request->description;
        $testimonial->rating = $request->rating ?? 5;
        $testimonial->attach = $this->uploadImage($request, 'attach', $this->path, 300, 300);
        $testimonial->save();


        Toastr::success(__('msg_created_successfully'), __('msg_success'));

        return redirect()->route($this->route.'.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Testimonial $testimonial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Testimonial $testimonial)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Testimonial $testimonial)
    {
        //Field Validation
        $request->validate([
            'name' => 'required|unique:testimonials,name,'.$testimonial->id,
            'description' => 'required',
            'attach' => 'nullable|image',
        ]);

        //Data Update
        $testimonial->name = $request->name;
        $testimonial->designation = $request->designation;
        $testimonial->description = $request->description;
        $testimonial->rating = $request->rating ?? 5;
        $testimonial->attach = $this->updateImage($request, 'attach', $this->path, 300, 300, $testimonial, 'attach');
        $testimonial->status = $request->status;
        $testimonial->update();


        Toastr::success(__('msg_updated_successfully'), __('msg_success'));

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Testimonial $testimonial)
    {
        //Delete Attach
        $this->deleteMedia($this->path, $testimonial);

        //Delete Data
        $testimonial->delete();

        Toastr::success(__('msg_deleted_successfully'), __('msg_success'));

        return redirect()->back();
    }
}
