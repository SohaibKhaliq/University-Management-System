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
                        <h5>{{ __('btn_update') }} {{ $title }}</h5>
                    </div>
                    <div class="card-block">
                      <div class="row">
                        <!-- Form Start -->
                        <input name="id" type="hidden" value="{{ (isset($row->id))?$row->id:-1 }}">

                        <div class="form-group col-md-12">
                            <label for="title">{{ __('field_title') }} <span>*</span></label>
                            <input type="text" class="form-control" name="title" id="title" value="{{ isset($row->title)?$row->title:'' }}" required>

                            <div class="invalid-feedback">
                              {{ __('required_field') }} {{ __('field_title') }}
                            </div>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="sub_title">{{ __('field_sub_title') }} <span>*</span></label>
                            <textarea class="form-control" name="sub_title" id="sub_title" rows="4" required>{{ isset($row->sub_title)?$row->sub_title:'' }}</textarea>

                            <div class="invalid-feedback">
                              {{ __('required_field') }} {{ __('field_sub_title') }}
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="button_text">{{ __('field_button_text') }}</label>
                            <input type="text" class="form-control" name="button_text" id="button_text" value="{{ isset($row->button_text)?$row->button_text:'' }}">

                            <div class="invalid-feedback">
                              {{ __('required_field') }} {{ __('field_button_text') }}
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="button_link">{{ __('field_button_link') }}</label>
                            <input type="url" class="form-control" name="button_link" id="button_link" value="{{ isset($row->button_link)?$row->button_link:'' }}">

                            <div class="invalid-feedback">
                              {{ __('required_field') }} {{ __('field_button_link') }}
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="status" class="form-label">{{ __('select_status') }}</label>
                            <select class="form-control" name="status" id="status">
                                <option value="1" @if( isset($row->status) && $row->status == 1 ) selected @endif>{{ __('status_active') }}</option>
                                <option value="0" @if( isset($row->status) && $row->status == 0 ) selected @endif>{{ __('status_inactive') }}</option>
                            </select>
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
