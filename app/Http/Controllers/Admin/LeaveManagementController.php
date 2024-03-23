<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\FileUploader;
use App\Models\LeaveType;
use App\Models\Leave;
use Carbon\Carbon;
use App\User;
use Toastr;
use Auth;

class LeaveManagementController extends Controller
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
        $this->title = trans_choice('module_leave_manage', 1);
        $this->route = 'admin.leave-manage';
        $this->view = 'admin.leave-manage';
        $this->path = 'staff-leave';
        $this->access = 'staff-leave-manage';


        $this->middleware('permission:'.$this->access.'-view|'.$this->access.'-edit|'.$this->access.'-delete', ['only' => ['index','show']]);
        $this->middleware('permission:'.$this->access.'-edit', ['only' => ['update', 'status']]);
        $this->middleware('permission:'.$this->access.'-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $data['title'] = $this->title;
        $data['route'] = $this->route;
        $data['view'] = $this->view;
        $data['path'] = $this->path;
        $data['access'] = $this->access;
        
        
        if(!empty($request->user) || $request->user != null){
            $data['selected_user'] = $user = $request->user;
        }
        else{
            $data['selected_user'] = $user = '0';
        }

        if(!empty($request->pay_type) || $request->pay_type != null){
            $data['selected_pay_type'] = $pay_type = $request->pay_type;
        }
        else{
            $data['selected_pay_type'] = $pay_type = '0';
        }

        if(!empty($request->type) || $request->type != null){
            $data['selected_type'] = $type = $request->type;
        }
        else{
            $data['selected_type'] = $type = '0';
        }

        if(!empty($request->start_date) || $request->start_date != null){
            $data['selected_start_date'] = $start_date = $request->start_date;
        }
        else{
            $data['selected_start_date'] = $start_date = date('Y-m-d', strtotime(Carbon::now()->subYear()));
        }

        if(!empty($request->end_date) || $request->end_date != null){
            $data['selected_end_date'] = $end_date = $request->end_date;
        }
        else{
            $data['selected_end_date'] = $end_date = date('Y-m-d', strtotime(Carbon::today()));
        }


        // Search Filter
        $data['users'] = User::where('status', '1')
                            ->orderBy('staff_id', 'asc')->get();
        $data['types'] = LeaveType::where('status', '1')
                            ->orderBy('title', 'asc')->get();

        $rows = Leave::whereDate('apply_date', '>=', $start_date)
                    ->whereDate('apply_date', '<=', $end_date);
                    if(!empty($request->user) || $request->user != null){
                        $rows->where('user_id', $user);
                    }
                    if(!empty($request->pay_type) || $request->pay_type != null){
                        $rows->where('pay_type', $pay_type);
                    }
                    if(!empty($request->type) || $request->type != null){
                        $rows->where('type_id', $type);
                    }
        $data['rows'] = $rows->orderBy('id', 'desc')->get();

        return view($this->view.'.index', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Field Validation
        $request->validate([
            'from_date' => 'required|date',
            'to_date' => 'required|date|after_or_equal:from_date',
            'pay_type' => 'required',
            'status' => 'required',
        ]);


        // Update Data
        $leave = Leave::findOrFail($id);
        $leave->review_by = Auth::guard('web')->user()->id;
        $leave->from_date = $request->from_date;
        $leave->to_date = $request->to_date;
        $leave->note = $request->note;
        $leave->pay_type = $request->pay_type;
        $leave->status = $request->status;
        $leave->save();


        Toastr::success(__('msg_updated_successfully'), __('msg_success'));

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //
        $leave = Leave::findOrFail($id);
        // Delete Attach
        $this->deleteMedia($this->path, $leave);

        // Delete data
        $leave->delete();

        Toastr::success(__('msg_deleted_successfully'), __('msg_success'));

        return redirect()->back();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function status(Request $request, $id)
    {
        // Field Validation
        $request->validate([
            'status' => 'required',
        ]);

        // Status Update
        $leave = Leave::findOrFail($id);
        $leave->review_by = Auth::guard('web')->user()->id;
        $leave->status = $request->status;
        $leave->save();


        if($request->status == 1)
        {
            Toastr::success(__('msg_approve_successfully'), __('msg_success'));
        }
        else{
            Toastr::success(__('msg_reject_successfully'), __('msg_success'));
        }

        return redirect()->back();
    }
}
