<?php

namespace App\Http\Controllers\Admin\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\FileUploader;
use App\Models\Web\WebEvent;
use Illuminate\Support\Str;
use App\Models\Language;
use Toastr;

class WebEventController extends Controller
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
        $this->title   = trans_choice('module_event', 1);
        $this->route   = 'admin.web-event';
        $this->view    = 'admin.web.web-event';
        $this->path    = 'web-event';
        $this->access  = 'web-event';


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

        $data['rows'] = WebEvent::where('language_id', Language::version()->id)
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
            'title' => 'required',
            'date' => 'required|date|after_or_equal:today',
            'attach' => 'nullable|image',
        ]);

        //Data Insert
        $webEvent = new WebEvent;
        $webEvent->language_id = Language::version()->id;
        $webEvent->title = $request->title;
        $webEvent->slug = Str::slug($request->title, '-');
        $webEvent->date = $request->date;
        $webEvent->time = $request->time;
        $webEvent->address = $request->address;
        $webEvent->description = $request->description;
        $webEvent->attach = $this->uploadImage($request, 'attach', $this->path, 1200, 600);
        $webEvent->save();


        Toastr::success(__('msg_created_successfully'), __('msg_success'));

        return redirect()->route($this->route.'.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(WebEvent $webEvent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WebEvent $webEvent)
    {
        //
        $data['title']  = $this->title;
        $data['route']  = $this->route;
        $data['view']   = $this->view;
        $data['access'] = $this->access;

        $data['row'] =  $webEvent;

        return view($this->view.'.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, WebEvent $webEvent)
    {
        //Field Validation
        $request->validate([
            'title' => 'required',
            'date' => 'required|date',
            'attach' => 'nullable|image',
        ]);

        //Data Update
        $webEvent->title = $request->title;
        $webEvent->slug = Str::slug($request->title, '-');
        $webEvent->date = $request->date;
        $webEvent->time = $request->time;
        $webEvent->address = $request->address;
        $webEvent->description = $request->description;
        $webEvent->attach = $this->updateImage($request, 'attach', $this->path, 1200, 600, $webEvent, 'attach');
        $webEvent->status = $request->status;
        $webEvent->update();


        Toastr::success(__('msg_updated_successfully'), __('msg_success'));

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WebEvent $webEvent)
    {
        //Delete Attach
        $this->deleteMedia($this->path, $webEvent);

        //Delete Data
        $webEvent->delete();

        Toastr::success(__('msg_deleted_successfully'), __('msg_success'));

        return redirect()->back();
    }
}
