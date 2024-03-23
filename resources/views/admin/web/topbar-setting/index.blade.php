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

                            <div class="form-group col-md-6">
                                <label for="email" class="form-label">{{ __('field_email') }} <span>*</span></label>
                                <input type="email" class="form-control" name="email" id="email" value="{{ isset($row->email)?$row->email:'' }}" required>

                                <div class="invalid-feedback">
                                  {{ __('required_field') }} {{ __('field_email') }}
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="phone" class="form-label">{{ __('field_phone') }} <span>*</span></label>
                                <input type="text" class="form-control" name="phone" id="phone" value="{{ isset($row->phone)?$row->phone:'' }}" required>

                                <div class="invalid-feedback">
                                  {{ __('required_field') }} {{ __('field_phone') }}
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="address" class="form-label">{{ __('field_address') }} <span>*</span></label>
                                <input type="text" class="form-control" name="address" id="address" value="{{ isset($row->address)?$row->address:'' }}" required>

                                <div class="invalid-feedback">
                                  {{ __('required_field') }} {{ __('field_address') }}
                                </div>
                            </div>

                            {{-- <div class="form-group col-md-6">
                                <label for="social_title" class="form-label">{{ __('field_social_title') }}</label>
                                <input type="text" class="form-control" name="social_title" id="social_title" value="{{ isset($row->social_title)?$row->social_title:'' }}">

                                <div class="invalid-feedback">
                                  {{ __('required_field') }} {{ __('field_social_title') }}
                                </div>
                            </div> --}}

                            <div class="form-group col-md-6">
                                <label for="social_status">{{ __('field_social_status') }} <span>*</span></label>
                                <br/>

                                <div class="radio radio-success d-inline">
                                    <input type="radio" name="social_status" value="1" id="show" @if( isset($row->social_status) && $row->social_status == 1 ) checked @endif required>
                                    <label for="show" class="cr">{{ __('status_show') }}</label>
                                </div>

                                <div class="radio radio-danger d-inline">
                                    <input type="radio" name="social_status" value="0" id="hide" @if( isset($row->social_status) && $row->social_status == 0 ) checked @endif required>
                                    <label for="hide" class="cr">{{ __('status_hide') }}</label>
                                </div>

                                <div class="invalid-feedback">
                                  {{ __('required_field') }} {{ __('field_social_status') }}
                                </div>
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
