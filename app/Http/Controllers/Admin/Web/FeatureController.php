<?php

namespace App\Http\Controllers\Admin\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\FileUploader;
use App\Models\Web\Feature;
use App\Models\Language;
use Toastr;

class FeatureController extends Controller
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
        $this->title   = trans_choice('module_feature', 1);
        $this->route   = 'admin.feature';
        $this->view    = 'admin.web.feature';
        $this->path    = 'feature';
        $this->access  = 'feature';


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

        $data['rows'] = Feature::where('language_id', Language::version()->id)
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
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Field Validation
        $request->validate([
            'title' => 'required|unique:features,title',
            'description' => 'required',
            'attach' => 'nullable|image',
        ]);

        //Data Insert
        $feature = new Feature;
        $feature->language_id = Language::version()->id;
        $feature->title = $request->title;
        $feature->description = $request->description;
        $feature->icon = $request->icon;
        $feature->attach = $this->uploadImage($request, 'attach', $this->path, 500, 280);
        $feature->save();


        Toastr::success(__('msg_created_successfully'), __('msg_success'));

        return redirect()->route($this->route.'.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Feature $feature)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Feature $feature)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Feature $feature)
    {
        //Field Validation
        $request->validate([
            'title' => 'required|unique:features,title,'.$feature->id,
            'description' => 'required',
            'attach' => 'nullable|image',
        ]);

        //Data Update
        $feature->title = $request->title;
        $feature->description = $request->description;
        $feature->icon = $request->icon;
        $feature->attach = $this->updateImage($request, 'attach', $this->path, 500, 280, $feature, 'attach');
        $feature->status = $request->status;
        $feature->update();


        Toastr::success(__('msg_updated_successfully'), __('msg_success'));

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Feature $feature)
    {
        //Delete Attach
        $this->deleteMedia($this->path, $feature);

        //Delete Data
        $feature->delete();

        Toastr::success(__('msg_deleted_successfully'), __('msg_success'));

        return redirect()->back();
    }
}
