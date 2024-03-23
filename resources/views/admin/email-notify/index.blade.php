@extends('admin.layouts.master')
@section('title', $title)
@section('content')

<!-- Start Content-->
<div class="main-body">
    <div class="page-wrapper">
        <!-- [ Main Content ] start -->
        <div class="row">
            <!-- [ Card ] start -->
            @can($access.'-create')
            <div class="col-sm-12">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active text-uppercase" id="group-tab" data-bs-toggle="tab" href="#group" role="tab" aria-controls="group" aria-selected="true">{{ $title }} > {{ __('tab_group') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-uppercase" id="individual-tab" data-bs-toggle="tab" href="#individual" role="tab" aria-controls="individual" aria-selected="false">{{ $title }} > {{ __('tab_individual') }}</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="group" role="tabpanel" aria-labelledby="group-tab">
                        <div class="card">
                            
                            <form class="needs-validation" novalidate action="{{ route($route.'.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-block">
                              <div class="row gx-2">
                                <!-- Form Start -->
                                @include('common.inc.notify_search_filter')

                                <div class="form-group col-md-12">
                                    <label for="subject" class="form-label">{{ __('field_mail_subject') }} <span>*</span></label>
                                    <input type="text" class="form-control" name="subject" id="subject" value="{{ old('subject') }}" required>

                                    <div class="invalid-feedback">
                                      {{ __('required_field') }} {{ __('field_mail_subject') }}
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="message" class="form-label">{{ __('field_message') }} <span>*</span></label>
                                    <textarea class="form-control" name="message" id="message" rows="4" required>{{ old('message') }}</textarea>
                                    <div class="alert alert-secondary" role="alert">
                                        {{ __('field_shortcode') }}: 
                                        [first_name] [last_name] [student_id] [batch] [faculty] [program] [session] [semester] [section] [father_name] [mother_name] [email] [phone]
                                    </div>

                                    <div class="invalid-feedback">
                                      {{ __('required_field') }} {{ __('field_message') }}
                                    </div>
                                </div>
                                <!-- Form End -->
                              </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-success"><i class="fas fa-paper-plane"></i> {{ __('btn_send') }}</button>
                            </div>
                            </form>
                            
                        </div>
                    </div>
                    <div class="tab-pane fade" id="individual" role="tabpanel" aria-labelledby="individual-tab">
                        <div class="card">
                            
                            <form class="needs-validation" novalidate action="{{ route($route.'.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-block">
                              <div class="row gx-2">
                                <!-- Form Start -->
                                <div class="form-group col-md-12">
                                    <label for="student">{{ __('field_student') }} <span>*</span></label>
                                    <select class="form-control select2" name="students[]" id="student" multiple required>
                                        <option value="">{{ __('select') }}</option>
                                        @foreach($students as $student)
                                        <option value="{{ $student->id }}" @if(old('students') == $student->id) selected @endif>{{ $student->student_id }} - {{ $student->first_name }} {{ $student->last_name }}</option>
                                        @endforeach
                                    </select>

                                    <div class="invalid-feedback">
                                      {{ __('required_field') }} {{ __('field_student') }}
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="subject" class="form-label">{{ __('field_mail_subject') }} <span>*</span></label>
                                    <input type="text" class="form-control" name="subject" id="subject" value="{{ old('subject') }}" required>

                                    <div class="invalid-feedback">
                                      {{ __('required_field') }} {{ __('field_mail_subject') }}
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="message" class="form-label">{{ __('field_message') }} <span>*</span></label>
                                    <textarea class="form-control" name="message" id="message" rows="4" required>{{ old('message') }}</textarea>
                                    <div class="alert alert-secondary" role="alert">
                                        {{ __('field_shortcode') }}: 
                                        [first_name] [last_name] [student_id] [batch] [faculty] [program] [session] [semester] [section] [father_name] [mother_name] [email] [phone]
                                    </div>

                                    <div class="invalid-feedback">
                                      {{ __('required_field') }} {{ __('field_message') }}
                                    </div>
                                </div>
                                <!-- Form End -->
                              </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-success"><i class="fas fa-paper-plane"></i> {{ __('btn_send') }}</button>
                            </div>
                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
            @endcan
            <!-- [ Card ] end -->
        </div>

        <div class="row">
            <!-- [ Card ] start -->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-block">
                        <!-- [ Data table ] start -->
                        <div class="table-responsive">
                            <table id="basic-table" class="display table nowrap table-striped table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('field_mail_subject') }}</th>
                                        <th>{{ __('field_message') }}</th>
                                        <th>{{ __('field_student') }}</th>
                                        <th>{{ __('field_date') }}</th>
                                        <th>{{ __('field_action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach( $rows as $key => $row )
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{!! str_limit($row->subject, 30, ' ...') !!}</td>
                                        <td>{!! str_limit(strip_tags($row->message), 50, ' ...') !!}</td>
                                        <td>{{ $row->receive_count }}</td>
                                        <td>
                                            @if(isset($setting->date_format))
                                            {{ date($setting->date_format, strtotime($row->created_at)) }}
                                            @else
                                            {{ date("Y-m-d", strtotime($row->created_at)) }}
                                            @endif

                                            | 

                                            @if(isset($setting->time_format))
                                            {{ date($setting->time_format, strtotime($row->created_at)) }}
                                            @else
                                            {{ date("h:i A", strtotime($row->created_at)) }}
                                            @endif
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-icon btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#showModal-{{ $row->id }}">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <!-- Include Show modal -->
                                            @include($view.'.show')

                                            @can($access.'-delete')
                                            <button type="button" class="btn btn-icon btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $row->id }}">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                            <!-- Include Delete modal -->
                                            @include('admin.layouts.inc.delete')
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- [ Data table ] end -->
                    </div>
                </div>
            </div>
        </div>
        <!-- [ Main Content ] end -->
    </div>
</div>
<!-- End Content-->

@endsection