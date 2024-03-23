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
                                            <th>{{ __('Field Title') }}</th>
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
                                            $field = field('application_father_name');
                                        @endphp
                                        <tr>
                                            <td>{{ __('field_father_name') }}</td>
                                            <td>
                                                <input name="ids[]" type="hidden" value="{{ $field->id }}">

                                                <div class="switch d-inline" style="float:left; margin-top: -15px;">
                                                    <input type="checkbox" id="status-{{ $field->id }}" name="statuses[{{ $field->id }}]" value="1" @if($field->status == 1) checked @endif>
                                                    <label for="status-{{ $field->id }}" class="cr"></label>
                                                </div>
                                            </td>
                                        </tr>

                                        @php
                                            $field = field('application_mother_name');
                                        @endphp
                                        <tr>
                                            <td>{{ __('field_mother_name') }}</td>
                                            <td>
                                                <input name="ids[]" type="hidden" value="{{ $field->id }}">

                                                <div class="switch d-inline" style="float:left; margin-top: -15px;">
                                                    <input type="checkbox" id="status-{{ $field->id }}" name="statuses[{{ $field->id }}]" value="1" @if($field->status == 1) checked @endif>
                                                    <label for="status-{{ $field->id }}" class="cr"></label>
                                                </div>
                                            </td>
                                        </tr>

                                        @php
                                            $field = field('application_father_occupation');
                                        @endphp
                                        <tr>
                                            <td>{{ __('field_father_occupation') }}</td>
                                            <td>
                                                <input name="ids[]" type="hidden" value="{{ $field->id }}">

                                                <div class="switch d-inline" style="float:left; margin-top: -15px;">
                                                    <input type="checkbox" id="status-{{ $field->id }}" name="statuses[{{ $field->id }}]" value="1" @if($field->status == 1) checked @endif>
                                                    <label for="status-{{ $field->id }}" class="cr"></label>
                                                </div>
                                            </td>
                                        </tr>

                                        @php
                                            $field = field('application_mother_occupation');
                                        @endphp
                                        <tr>
                                            <td>{{ __('field_mother_occupation') }}</td>
                                            <td>
                                                <input name="ids[]" type="hidden" value="{{ $field->id }}">

                                                <div class="switch d-inline" style="float:left; margin-top: -15px;">
                                                    <input type="checkbox" id="status-{{ $field->id }}" name="statuses[{{ $field->id }}]" value="1" @if($field->status == 1) checked @endif>
                                                    <label for="status-{{ $field->id }}" class="cr"></label>
                                                </div>
                                            </td>
                                        </tr>

                                        @php
                                            $field = field('application_emergency_phone');
                                        @endphp
                                        <tr>
                                            <td>{{ __('field_emergency_phone') }}</td>
                                            <td>
                                                <input name="ids[]" type="hidden" value="{{ $field->id }}">

                                                <div class="switch d-inline" style="float:left; margin-top: -15px;">
                                                    <input type="checkbox" id="status-{{ $field->id }}" name="statuses[{{ $field->id }}]" value="1" @if($field->status == 1) checked @endif>
                                                    <label for="status-{{ $field->id }}" class="cr"></label>
                                                </div>
                                            </td>
                                        </tr>

                                        @php
                                            $field = field('application_religion');
                                        @endphp
                                        <tr>
                                            <td>{{ __('field_religion') }}</td>
                                            <td>
                                                <input name="ids[]" type="hidden" value="{{ $field->id }}">

                                                <div class="switch d-inline" style="float:left; margin-top: -15px;">
                                                    <input type="checkbox" id="status-{{ $field->id }}" name="statuses[{{ $field->id }}]" value="1" @if($field->status == 1) checked @endif>
                                                    <label for="status-{{ $field->id }}" class="cr"></label>
                                                </div>
                                            </td>
                                        </tr>

                                        @php
                                            $field = field('application_caste');
                                        @endphp
                                        <tr>
                                            <td>{{ __('field_caste') }}</td>
                                            <td>
                                                <input name="ids[]" type="hidden" value="{{ $field->id }}">

                                                <div class="switch d-inline" style="float:left; margin-top: -15px;">
                                                    <input type="checkbox" id="status-{{ $field->id }}" name="statuses[{{ $field->id }}]" value="1" @if($field->status == 1) checked @endif>
                                                    <label for="status-{{ $field->id }}" class="cr"></label>
                                                </div>
                                            </td>
                                        </tr>

                                        @php
                                            $field = field('application_mother_tongue');
                                        @endphp
                                        <tr>
                                            <td>{{ __('field_mother_tongue') }}</td>
                                            <td>
                                                <input name="ids[]" type="hidden" value="{{ $field->id }}">

                                                <div class="switch d-inline" style="float:left; margin-top: -15px;">
                                                    <input type="checkbox" id="status-{{ $field->id }}" name="statuses[{{ $field->id }}]" value="1" @if($field->status == 1) checked @endif>
                                                    <label for="status-{{ $field->id }}" class="cr"></label>
                                                </div>
                                            </td>
                                        </tr>

                                        @php
                                            $field = field('application_nationality');
                                        @endphp
                                        <tr>
                                            <td>{{ __('field_nationality') }}</td>
                                            <td>
                                                <input name="ids[]" type="hidden" value="{{ $field->id }}">

                                                <div class="switch d-inline" style="float:left; margin-top: -15px;">
                                                    <input type="checkbox" id="status-{{ $field->id }}" name="statuses[{{ $field->id }}]" value="1" @if($field->status == 1) checked @endif>
                                                    <label for="status-{{ $field->id }}" class="cr"></label>
                                                </div>
                                            </td>
                                        </tr>

                                        @php
                                            $field = field('application_marital_status');
                                        @endphp
                                        <tr>
                                            <td>{{ __('field_marital_status') }}</td>
                                            <td>
                                                <input name="ids[]" type="hidden" value="{{ $field->id }}">

                                                <div class="switch d-inline" style="float:left; margin-top: -15px;">
                                                    <input type="checkbox" id="status-{{ $field->id }}" name="statuses[{{ $field->id }}]" value="1" @if($field->status == 1) checked @endif>
                                                    <label for="status-{{ $field->id }}" class="cr"></label>
                                                </div>
                                            </td>
                                        </tr>

                                        @php
                                            $field = field('application_blood_group');
                                        @endphp
                                        <tr>
                                            <td>{{ __('field_blood_group') }}</td>
                                            <td>
                                                <input name="ids[]" type="hidden" value="{{ $field->id }}">

                                                <div class="switch d-inline" style="float:left; margin-top: -15px;">
                                                    <input type="checkbox" id="status-{{ $field->id }}" name="statuses[{{ $field->id }}]" value="1" @if($field->status == 1) checked @endif>
                                                    <label for="status-{{ $field->id }}" class="cr"></label>
                                                </div>
                                            </td>
                                        </tr>

                                        @php
                                            $field = field('application_national_id');
                                        @endphp
                                        <tr>
                                            <td>{{ __('field_national_id') }}</td>
                                            <td>
                                                <input name="ids[]" type="hidden" value="{{ $field->id }}">

                                                <div class="switch d-inline" style="float:left; margin-top: -15px;">
                                                    <input type="checkbox" id="status-{{ $field->id }}" name="statuses[{{ $field->id }}]" value="1" @if($field->status == 1) checked @endif>
                                                    <label for="status-{{ $field->id }}" class="cr"></label>
                                                </div>
                                            </td>
                                        </tr>

                                        @php
                                            $field = field('application_passport_no');
                                        @endphp
                                        <tr>
                                            <td>{{ __('field_passport_no') }}</td>
                                            <td>
                                                <input name="ids[]" type="hidden" value="{{ $field->id }}">

                                                <div class="switch d-inline" style="float:left; margin-top: -15px;">
                                                    <input type="checkbox" id="status-{{ $field->id }}" name="statuses[{{ $field->id }}]" value="1" @if($field->status == 1) checked @endif>
                                                    <label for="status-{{ $field->id }}" class="cr"></label>
                                                </div>
                                            </td>
                                        </tr>

                                        @php
                                            $field = field('application_address');
                                        @endphp
                                        <tr>
                                            <td>{{ __('Address Details') }}</td>
                                            <td>
                                                <input name="ids[]" type="hidden" value="{{ $field->id }}">

                                                <div class="switch d-inline" style="float:left; margin-top: -15px;">
                                                    <input type="checkbox" id="status-{{ $field->id }}" name="statuses[{{ $field->id }}]" value="1" @if($field->status == 1) checked @endif>
                                                    <label for="status-{{ $field->id }}" class="cr"></label>
                                                </div>
                                            </td>
                                        </tr>

                                        @php
                                            $field = field('application_school_info');
                                        @endphp
                                        <tr>
                                            <td>{{ __('School Info') }}</td>
                                            <td>
                                                <input name="ids[]" type="hidden" value="{{ $field->id }}">

                                                <div class="switch d-inline" style="float:left; margin-top: -15px;">
                                                    <input type="checkbox" id="status-{{ $field->id }}" name="statuses[{{ $field->id }}]" value="1" @if($field->status == 1) checked @endif>
                                                    <label for="status-{{ $field->id }}" class="cr"></label>
                                                </div>
                                            </td>
                                        </tr>

                                        @php
                                            $field = field('application_collage_info');
                                        @endphp
                                        <tr>
                                            <td>{{ __('Collage Info') }}</td>
                                            <td>
                                                <input name="ids[]" type="hidden" value="{{ $field->id }}">

                                                <div class="switch d-inline" style="float:left; margin-top: -15px;">
                                                    <input type="checkbox" id="status-{{ $field->id }}" name="statuses[{{ $field->id }}]" value="1" @if($field->status == 1) checked @endif>
                                                    <label for="status-{{ $field->id }}" class="cr"></label>
                                                </div>
                                            </td>
                                        </tr>

                                        @php
                                            $field = field('application_photo');
                                        @endphp
                                        <tr>
                                            <td>{{ __('field_photo') }}</td>
                                            <td>
                                                <input name="ids[]" type="hidden" value="{{ $field->id }}">

                                                <div class="switch d-inline" style="float:left; margin-top: -15px;">
                                                    <input type="checkbox" id="status-{{ $field->id }}" name="statuses[{{ $field->id }}]" value="1" @if($field->status == 1) checked @endif>
                                                    <label for="status-{{ $field->id }}" class="cr"></label>
                                                </div>
                                            </td>
                                        </tr>

                                        @php
                                            $field = field('application_signature');
                                        @endphp
                                        <tr>
                                            <td>{{ __('field_signature') }}</td>
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