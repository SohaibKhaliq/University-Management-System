<?php

namespace App\Http\Controllers\Admin\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\FileUploader;
use Illuminate\Support\Str;
use App\Models\Web\News;
use App\Models\Language;
use Toastr;

class NewsController extends Controller
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
        $this->title   = trans_choice('module_news', 1);
        $this->route   = 'admin.news';
        $this->view    = 'admin.web.news';
        $this->path    = 'news';
        $this->access  = 'news';


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

        $data['rows'] = News::where('language_id', Language::version()->id)
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
            'description' => 'required',
            'attach' => 'nullable|image',
        ]);

        //Data Insert
        $news = new News;
        $news->language_id = Language::version()->id;
        $news->title = $request->title;
        $news->slug = Str::slug($request->title, '-');
        $news->date = $request->date;
        $news->description = $request->description;
        $news->attach = $this->uploadImage($request, 'attach', $this->path, 800, 500);
        $news->save();


        Toastr::success(__('msg_created_successfully'), __('msg_success'));

        return redirect()->route($this->route.'.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(News $news)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(News $news)
    {
        //
        $data['title']  = $this->title;
        $data['route']  = $this->route;
        $data['view']   = $this->view;
        $data['access'] = $this->access;

        $data['row'] =  $news;

        return view($this->view.'.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, News $news)
    {
        //Field Validation
        $request->validate([
            'title' => 'required',
            'date' => 'required|date',
            'description' => 'required',
            'attach' => 'nullable|image',
        ]);

        //Data Update
        $news->title = $request->title;
        $news->slug = Str::slug($request->title, '-');
        $news->date = $request->date;
        $news->description = $request->description;
        $news->attach = $this->updateImage($request, 'attach', $this->path, 800, 500, $news, 'attach');
        $news->status = $request->status;
        $news->update();


        Toastr::success(__('msg_updated_successfully'), __('msg_success'));

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news)
    {
        //Delete Attach
        $this->deleteMedia($this->path, $news);

        //Delete Data
        $news->delete();

        Toastr::success(__('msg_deleted_successfully'), __('msg_success'));

        return redirect()->back();
    }
}
