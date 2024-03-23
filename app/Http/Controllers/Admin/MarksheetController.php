<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MarksheetSetting;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Program;
use App\Models\Session;
use App\Models\Batch;
use App\Models\Grade;

class MarksheetController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Module Data
        $this->title = trans_choice('module_marksheet_total', 1);
        $this->route = 'admin.marksheet';
        $this->view = 'admin.marksheet';
        $this->path = 'marksheet-setting';
        $this->access = 'marksheet';


        $this->middleware('permission:'.$this->access.'-view|'.$this->access.'-print|'.$this->access.'-download', ['only' => ['index','show','semester']]);
        $this->middleware('permission:'.$this->access.'-print', ['only' => ['print','semesterPrint']]);
        $this->middleware('permission:'.$this->access.'-download', ['only' => ['download','semesterDownload']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $data['title']     = $this->title;
        $data['route']     = $this->route;
        $data['path']      = $this->path;
        $data['access']    = $this->access;


        if(!empty($request->batch) || $request->batch != null){
            $data['selected_batch'] = $batch = $request->batch;
        }
        else{
            $data['selected_batch'] = '0';
        }

        if(!empty($request->program) || $request->program != null){
            $data['selected_program'] = $program = $request->program;
        }
        else{
            $data['selected_program'] = '0';
        }

        if(!empty($request->student_id) || $request->student_id != null){
            $data['selected_student_id'] = $student_id = $request->student_id;
        }
        else{
            $data['selected_student_id'] = null;
        }


        $data['batchs'] = Batch::where('status', '1')
                        ->orderBy('id', 'desc')->get();
        $data['programs'] = Program::where('status', '1')
                        ->orderBy('title', 'asc')->get();
        $data['print'] = MarksheetSetting::where('status', '1')->first();
        
        
        // Student List
        if(isset($request->batch) || isset($request->program) || !empty($request->student_id)){
        
            $students = Student::where('id', '!=', '0');

            if(!empty($request->batch) && $request->batch != '0'){
                $students->where('batch_id', $batch);
            }
            if(!empty($request->program) && $request->program != '0'){
                $students->where('program_id', $program);
            }
            if(!empty($request->student_id)){
                $students->where('student_id', 'LIKE', '%'.$student_id.'%');
            }
            $data['rows'] = $students->orderBy('student_id', 'asc')->get();
        }

        return view($this->view.'.index', $data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $data['title']     = $this->title;
        $data['route']     = $this->route;
        $data['path']      = $this->path;
        $data['access']    = $this->access;
        
        $data['row'] = Student::findOrFail($id);
        $data['grades'] = Grade::where('status', '1')->orderBy('min_mark', 'desc')->get();

        return view($this->view.'.show', $data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function print($id)
    {
        //
        $data['title'] = $this->title;
        $data['route'] = $this->route;
        $data['view'] = $this->view;
        $data['path'] = $this->path;

        // View
        $data['grades'] = Grade::where('status', '1')->orderBy('min_mark', 'desc')->get();
        $data['marksheet'] = MarksheetSetting::where('status', '1')->firstOrFail();
        $data['row'] = Student::findOrFail($id);

        return view($this->view.'.print', $data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function download($id)
    {
        //
        $data['title'] = $this->title;
        $data['route'] = $this->route;
        $data['view'] = $this->view;
        $data['path'] = $this->path;

        // View
        $data['grades'] = Grade::where('status', '1')->orderBy('min_mark', 'desc')->get();
        $data['marksheet'] = MarksheetSetting::where('status', '1')->firstOrFail();
        $data['row'] = Student::findOrFail($id);

        return view($this->view.'.download', $data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function semester(Request $request)
    {
        //
        $data['title']     = trans_choice('module_marksheet_semester', 1);
        $data['route']     = $this->route;
        $data['path']      = $this->path;
        $data['access']    = $this->access;


        if(!empty($request->program) || $request->program != null){
            $data['selected_program'] = $program = $request->program;
        }
        else{
            $data['selected_program'] = '0';
        }

        if(!empty($request->session) || $request->session != null){
            $data['selected_session'] = $session = $request->session;
        }
        else{
            $data['selected_session'] = '0';
        }

        if(!empty($request->student_id) || $request->student_id != null){
            $data['selected_student_id'] = $student_id = $request->student_id;
        }
        else{
            $data['selected_student_id'] = null;
        }


        // Search Filter
        $data['programs'] = Program::where('status', '1')
                        ->orderBy('title', 'asc')->get();
        $data['print'] = MarksheetSetting::where('status', '1')->first();


        if(!empty($request->program) && $request->program != '0'){
        $sessions = Session::where('status', 1);
        $sessions->with('programs')->whereHas('programs', function ($query) use ($program){
            $query->where('program_id', $program);
        });
        $data['sessions'] = $sessions->orderBy('id', 'desc')->get();}
        
        
        // Student List
        if(isset($request->program) || isset($request->session) || !empty($request->student_id)){
        
            $students = Student::where('id', '!=', '0');
            
            if(!empty($request->program) && $request->program != '0'){
                $students->with('studentEnrolls')->whereHas('studentEnrolls', function ($query) use ($program){
                    $query->where('program_id', $program);
                });
            }
            if(!empty($request->session) && $request->session != '0'){
                $students->with('studentEnrolls')->whereHas('studentEnrolls', function ($query) use ($session){
                    $query->where('session_id', $session);
                });
            }
            if(!empty($request->student_id)){
                $students->where('student_id', 'LIKE', '%'.$student_id.'%');
            }
            $data['rows'] = $students->orderBy('student_id', 'asc')->get();
        }

        return view($this->view.'.semester', $data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function semesterPrint($id, $session)
    {
        //
        $data['title'] = $this->title;
        $data['route'] = $this->route;
        $data['view'] = $this->view;
        $data['path'] = $this->path;

        // View
        $data['grades'] = Grade::where('status', '1')->orderBy('min_mark', 'desc')->get();
        $data['marksheet'] = MarksheetSetting::where('status', '1')->firstOrFail();
        $data['row'] = Student::findOrFail($id);
        $data['session'] = $session;

        return view($this->view.'.session-print', $data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function semesterDownload($id, $session)
    {
        //
        $data['title'] = $this->title;
        $data['route'] = $this->route;
        $data['view'] = $this->view;
        $data['path'] = $this->path;

        // View
        $data['grades'] = Grade::where('status', '1')->orderBy('min_mark', 'desc')->get();
        $data['marksheet'] = MarksheetSetting::where('status', '1')->firstOrFail();
        $data['row'] = Student::findOrFail($id);
        $data['session'] = $session;

        return view($this->view.'.session-download', $data);
    }
}
