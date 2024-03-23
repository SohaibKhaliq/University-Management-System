<?php

namespace App\Http\Controllers\Admin\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\FileUploader;
use App\Models\Web\Gallery;
use App\Models\Language;
use Toastr;

class GalleryController extends Controller
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
        $this->title   = trans_choice('module_gallery', 1);
        $this->route   = 'admin.gallery';
        $this->view    = 'admin.web.gallery';
        $this->path    = 'gallery';
        $this->access  = 'gallery';


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

        $data['rows'] = Gallery::where('language_id', Language::version()->id)
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
            'attach' => 'required|image',
        ]);

        //Data Insert
        $gallery = new Gallery;
        $gallery->language_id = Language::version()->id;
        $gallery->title = $request->title;
        $gallery->description = $request->description;
        $gallery->attach = $this->uploadImage($request, 'attach', $this->path, 800, null);
        $gallery->save();


        Toastr::success(__('msg_created_successfully'), __('msg_success'));

        return redirect()->route($this->route.'.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Gallery $gallery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gallery $gallery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gallery $gallery)
    {
        //Field Validation
        $request->validate([
            'attach' => 'nullable|image',
        ]);

        //Data Update
        $gallery->title = $request->title;
        $gallery->description = $request->description;
        $gallery->attach = $this->updateImage($request, 'attach', $this->path, 800, null, $gallery, 'attach');
        $gallery->status = $request->status;
        $gallery->update();


        Toastr::success(__('msg_updated_successfully'), __('msg_success'));

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gallery $gallery)
    {
        //Delete Attach
        $this->deleteMedia($this->path, $gallery);

        //Delete Data
        $gallery->delete();

        Toastr::success(__('msg_deleted_successfully'), __('msg_success'));

        return redirect()->back();
    }
}
