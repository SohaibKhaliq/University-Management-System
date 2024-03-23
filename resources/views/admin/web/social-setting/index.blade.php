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
                                <label for="facebook">{{ __('field_facebook_url') }}</label>
                                <input type="url" class="form-control" name="facebook" id="facebook" value="{{ isset($row->facebook)?$row->facebook:'' }}">

                                <div class="invalid-feedback">
                                  {{ __('required_field') }} {{ __('field_facebook_url') }}
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="twitter">{{ __('field_twitter_url') }}</label>
                                <input type="url" class="form-control" name="twitter" id="twitter" value="{{ isset($row->twitter)?$row->twitter:'' }}">

                                <div class="invalid-feedback">
                                  {{ __('required_field') }} {{ __('field_twitter_url') }}
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="instagram">{{ __('field_instagram_url') }}</label>
                                <input type="url" class="form-control" name="instagram" id="instagram" value="{{ isset($row->instagram)?$row->instagram:'' }}">

                                <div class="invalid-feedback">
                                  {{ __('required_field') }} {{ __('field_instagram_url') }}
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="linkedin">{{ __('field_linkedin_url') }}</label>
                                <input type="url" class="form-control" name="linkedin" id="linkedin" value="{{ isset($row->linkedin)?$row->linkedin:'' }}">

                                <div class="invalid-feedback">
                                  {{ __('required_field') }} {{ __('field_linkedin_url') }}
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="pinterest">{{ __('field_pinterest_url') }}</label>
                                <input type="url" class="form-control" name="pinterest" id="pinterest" value="{{ isset($row->pinterest)?$row->pinterest:'' }}">

                                <div class="invalid-feedback">
                                  {{ __('required_field') }} {{ __('field_pinterest_url') }}
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="youtube">{{ __('field_youtube_url') }}</label>
                                <input type="url" class="form-control" name="youtube" id="youtube" value="{{ isset($row->youtube)?$row->youtube:'' }}">

                                <div class="invalid-feedback">
                                  {{ __('required_field') }} {{ __('field_youtube_url') }}
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
