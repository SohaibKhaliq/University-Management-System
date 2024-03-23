<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Field;
use Toastr;

class FieldController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Module Data
        $this->title = trans_choice('module_field_setting', 1);
        $this->route = 'admin.field';
        $this->view = 'admin.field';
        $this->access = 'field';

        
        $this->middleware('permission:'.$this->access.'-staff', ['only' => ['user','store']]);
        $this->middleware('permission:'.$this->access.'-student', ['only' => ['student','store']]);
        $this->middleware('permission:'.$this->access.'-application', ['only' => ['application','store']]);
        $this->middleware('permission:student-panel-view', ['only' => ['panel','store']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function user()
    {
        //
        $data['title'] = trans_choice('module_staff', 1).' '.trans_choice('module_field_setting', 1);
        $data['route'] = $this->route;
        $data['view'] = $this->view;
        $data['access'] = $this->access;

        return view($this->view.'.user', $data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function student()
    {
        //
        $data['title'] = trans_choice('module_student', 1).' '.trans_choice('module_field_setting', 1);
        $data['route'] = $this->route;
        $data['view'] = $this->view;
        $data['access'] = $this->access;

        return view($this->view.'.student', $data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function application()
    {
        //
        $data['title'] = trans_choice('module_application', 1).' '.trans_choice('module_field_setting', 1);
        $data['route'] = $this->route;
        $data['view'] = $this->view;
        $data['access'] = $this->access;

        return view($this->view.'.application', $data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function panel()
    {
        //
        $data['title'] = trans_choice('module_student_panel', 1).' '.trans_choice('module_setting', 1);
        $data['route'] = $this->route;
        $data['view'] = $this->view;
        $data['access'] = $this->access;

        return view($this->view.'.panel', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        foreach($request->ids as $id){
            // Update Data
            $field = Field::find($id);
            $field->status = $request->statuses[$id] ?? 0;
            $field->save();
        }


        Toastr::success(__('msg_updated_successfully'), __('msg_success'));

        return redirect()->back();
    }
}
