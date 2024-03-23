@extends('admin.layouts.master')
@section('title', $title)
@section('content')

<!-- Start Content-->
<div class="main-body">
    <div class="page-wrapper">
        <!-- [ Main Content ] start -->
        <div class="row">
            <div class="col-md-12 col-lg-8">
                <form class="needs-validation" novalidate action="{{ route($route.'.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                    <div class="card">
                        <div class="card-header">
                            <h5>{{ $title }}</h5>
                        </div>
                        <div class="card-block">
                          <div class="row">
                            <!-- Form Start -->
                            <div class="table-responsive">
                                <table class="table nowrap table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>{{ __('Sidebar Navs') }}</th>
                                            <th>{{ __('field_status') }}</th>
                                        </tr>
                                    </thead>
                                    @php
                                        function field($slug){
                                            return \App\Models\Field::field($slug);
                                        }
                                    @endphp
                                    <tbody>
                                        @php
                                            $field = field('panel_class_routine');
                                        @endphp
                                        <tr>
                                            <td>{{ trans_choice('module_class_routine', 2) }}</td>
                                            <td>
                                                <input name="ids[]" type="hidden" value="{{ $field->id }}">

                                                <div class="switch d-inline" style="float:left; margin-top: -15px;">
                                                    <input type="checkbox" id="status-{{ $field->id }}" name="statuses[{{ $field->id }}]" value="1" @if($field->status == 1) checked @endif>
                                                    <label for="status-{{ $field->id }}" class="cr"></label>
                                                </div>
                                            </td>
                                        </tr>

                                        @php
                                            $field = field('panel_exam_routine');
                                        @endphp
                                        <tr>
                                            <td>{{ trans_choice('module_exam_routine', 2) }}</td>
                                            <td>
                                                <input name="ids[]" type="hidden" value="{{ $field->id }}">

                                                <div class="switch d-inline" style="float:left; margin-top: -15px;">
                                                    <input type="checkbox" id="status-{{ $field->id }}" name="statuses[{{ $field->id }}]" value="1" @if($field->status == 1) checked @endif>
                                                    <label for="status-{{ $field->id }}" class="cr"></label>
                                                </div>
                                            </td>
                                        </tr>

                                        @php
                                            $field = field('panel_attendance');
                                        @endphp
                                        <tr>
                                            <td>{{ trans_choice('module_attendance', 2) }}</td>
                                            <td>
                                                <input name="ids[]" type="hidden" value="{{ $field->id }}">

                                                <div class="switch d-inline" style="float:left; margin-top: -15px;">
                                                    <input type="checkbox" id="status-{{ $field->id }}" name="statuses[{{ $field->id }}]" value="1" @if($field->status == 1) checked @endif>
                                                    <label for="status-{{ $field->id }}" class="cr"></label>
                                                </div>
                                            </td>
                                        </tr>

                                        @php
                                            $field = field('panel_leave');
                                        @endphp
                                        <tr>
                                            <td>{{ trans_choice('module_apply_leave', 2) }}</td>
                                            <td>
                                                <input name="ids[]" type="hidden" value="{{ $field->id }}">

                                                <div class="switch d-inline" style="float:left; margin-top: -15px;">
                                                    <input type="checkbox" id="status-{{ $field->id }}" name="statuses[{{ $field->id }}]" value="1" @if($field->status == 1) checked @endif>
                                                    <label for="status-{{ $field->id }}" class="cr"></label>
                                                </div>
                                            </td>
                                        </tr>

                                        @php
                                            $field = field('panel_fees_report');
                                        @endphp
                                        <tr>
                                            <td>{{ trans_choice('module_fees_report', 2) }}</td>
                                            <td>
                                                <input name="ids[]" type="hidden" value="{{ $field->id }}">

                                                <div class="switch d-inline" style="float:left; margin-top: -15px;">
                                                    <input type="checkbox" id="status-{{ $field->id }}" name="statuses[{{ $field->id }}]" value="1" @if($field->status == 1) checked @endif>
                                                    <label for="status-{{ $field->id }}" class="cr"></label>
                                                </div>
                                            </td>
                                        </tr>

                                        @php
                                            $field = field('panel_library');
                                        @endphp
                                        <tr>
                                            <td>{{ trans_choice('module_library', 2) }}</td>
                                            <td>
                                                <input name="ids[]" type="hidden" value="{{ $field->id }}">

                                                <div class="switch d-inline" style="float:left; margin-top: -15px;">
                                                    <input type="checkbox" id="status-{{ $field->id }}" name="statuses[{{ $field->id }}]" value="1" @if($field->status == 1) checked @endif>
                                                    <label for="status-{{ $field->id }}" class="cr"></label>
                                                </div>
                                            </td>
                                        </tr>

                                        @php
                                            $field = field('panel_notice');
                                        @endphp
                                        <tr>
                                            <td>{{ trans_choice('module_notice', 2) }}</td>
                                            <td>
                                                <input name="ids[]" type="hidden" value="{{ $field->id }}">

                                                <div class="switch d-inline" style="float:left; margin-top: -15px;">
                                                    <input type="checkbox" id="status-{{ $field->id }}" name="statuses[{{ $field->id }}]" value="1" @if($field->status == 1) checked @endif>
                                                    <label for="status-{{ $field->id }}" class="cr"></label>
                                                </div>
                                            </td>
                                        </tr>

                                        @php
                                            $field = field('panel_assignment');
                                        @endphp
                                        <tr>
                                            <td>{{ trans_choice('module_assignment', 2) }}</td>
                                            <td>
                                                <input name="ids[]" type="hidden" value="{{ $field->id }}">

                                                <div class="switch d-inline" style="float:left; margin-top: -15px;">
                                                    <input type="checkbox" id="status-{{ $field->id }}" name="statuses[{{ $field->id }}]" value="1" @if($field->status == 1) checked @endif>
                                                    <label for="status-{{ $field->id }}" class="cr"></label>
                                                </div>
                                            </td>
                                        </tr>

                                        @php
                                            $field = field('panel_download');
                                        @endphp
                                        <tr>
                                            <td>{{ trans_choice('module_download', 2) }}</td>
                                            <td>
                                                <input name="ids[]" type="hidden" value="{{ $field->id }}">

                                                <div class="switch d-inline" style="float:left; margin-top: -15px;">
                                                    <input type="checkbox" id="status-{{ $field->id }}" name="statuses[{{ $field->id }}]" value="1" @if($field->status == 1) checked @endif>
                                                    <label for="status-{{ $field->id }}" class="cr"></label>
                                                </div>
                                            </td>
                                        </tr>

                                        @php
                                            $field = field('panel_transcript');
                                        @endphp
                                        <tr>
                                            <td>{{ trans_choice('module_transcript', 1) }}</td>
                                            <td>
                                                <input name="ids[]" type="hidden" value="{{ $field->id }}">

                                                <div class="switch d-inline" style="float:left; margin-top: -15px;">
                                                    <input type="checkbox" id="status-{{ $field->id }}" name="statuses[{{ $field->id }}]" value="1" @if($field->status == 1) checked @endif>
                                                    <label for="status-{{ $field->id }}" class="cr"></label>
                                                </div>
                                            </td>
                                        </tr>

                                        @php
                                            $field = field('panel_profile');
                                        @endphp
                                        <tr>
                                            <td>{{ trans_choice('module_profile', 2) }}</td>
                                            <td>
                                                <input name="ids[]" type="hidden" value="{{ $field->id }}">

                                                <div class="switch d-inline" style="float:left; margin-top: -15px;">
                                                    <input type="checkbox" id="status-{{ $field->id }}" name="statuses[{{ $field->id }}]" value="1" @if($field->status == 1) checked @endif>
                                                    <label for="status-{{ $field->id }}" class="cr"></label>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- Form End -->
                          </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success"><i class="fas fa-check"></i> {{ __('btn_update') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- [ Main Content ] end -->
    </div>
</div>
<!-- End Content-->

@endsection