@extends('admin.layouts.master')
@section('title', $title)
@section('content')

<!-- Start Content-->
<div class="main-body">
    <div class="page-wrapper">
        <!-- [ Main Content ] start -->
        <div class="row">
            <div class="col-sm-12">
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
                            <label for="label">{{ __('field_label') }} <span>*</span></label>
                            <input type="text" class="form-control" name="label" id="label" value="{{ isset($row->label)?$row->label:'' }}" required>

                            <div class="invalid-feedback">
                              {{ __('required_field') }} {{ __('field_label') }}
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="title">{{ __('field_title') }} <span>*</span></label>
                            <input type="text" class="form-control" name="title" id="title" value="{{ isset($row->title)?$row->title:'' }}" required>

                            <div class="invalid-feedback">
                              {{ __('required_field') }} {{ __('field_title') }}
                            </div>
                        </div>

                        {{-- <div class="form-group col-md-6">
                            <label for="short_desc">{{ __('field_short_desc') }}</label>
                            <textarea name="short_desc" id="short_desc" class="form-control texteditor">{{ isset($row->short_desc)?$row->short_desc:'' }}</textarea>

                            <div class="invalid-feedback">
                              {{ __('required_field') }} {{ __('field_short_desc') }}
                            </div>
                        </div> --}}

                        <div class="form-group col-md-12">
                            <label for="description">{{ __('field_description') }} <span>*</span></label>
                            <textarea name="description" id="description" class="form-control texteditor" required>{{ isset($row->description)?$row->description:'' }}</textarea>

                            <div class="invalid-feedback">
                              {{ __('required_field') }} {{ __('field_description') }}
                            </div>
                        </div>

                        {{-- <div class="form-group col-md-6">
                            <label for="button_text">{{ __('field_button_text') }}</label>
                            <input type="text" class="form-control" name="button_text" id="button_text" value="{{ isset($row->button_text)?$row->button_text:'' }}">

                            <div class="invalid-feedback">
                              {{ __('required_field') }} {{ __('field_button_text') }}
                            </div>
                        </div> --}}

                        {{-- <div class="form-group col-md-6">
                            <label for="video_id">{{ __('field_video_id') }}</label>
                            <input type="text" class="form-control" name="video_id" id="video_id" value="{{ isset($row->video_id)?$row->video_id:'' }}">

                            <div class="invalid-feedback">
                              {{ __('required_field') }} {{ __('field_video_id') }}
                            </div>
                        </div> --}}

                        <div class="form-group col-md-12">
                            @if(isset($row->attach))
                            @if(is_file('uploads/'.$path.'/'.$row->attach))
                            <img src="{{ asset('uploads/'.$path.'/'.$row->attach) }}" class="img-fluid" style="max-height: 300px; max-width: 100%;" alt="{{ __('field_attach') }}">
                            <div class="clearfix"></div>
                            @endif
                            @endif

                            <label for="attach">{{ __('field_attach') }}: <span>{{ __('image_size', ['height' => 800, 'width' => 'Any']) }}</span></label>
                            <input type="file" class="form-control" name="attach" id="attach">

                            <div class="invalid-feedback">
                              {{ __('required_field') }} {{ __('field_attach') }}
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="mission_title">{{ __('field_mission_title') }}</label>
                            <input type="text" class="form-control" name="mission_title" id="mission_title" value="{{ isset($row->mission_title)?$row->mission_title:'' }}">

                            <div class="invalid-feedback">
                              {{ __('required_field') }} {{ __('field_mission_title') }}
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="vision_title">{{ __('field_vision_title') }}</label>
                            <input type="text" class="form-control" name="vision_title" id="title" value="{{ isset($row->vision_title)?$row->vision_title:'' }}">

                            <div class="invalid-feedback">
                              {{ __('required_field') }} {{ __('field_vision_title') }}
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="mission_desc">{{ __('field_mission_desc') }}</label>
                            <textarea name="mission_desc" id="mission_desc" class="form-control texteditor">{{ isset($row->mission_desc)?$row->mission_desc:'' }}</textarea>

                            <div class="invalid-feedback">
                              {{ __('required_field') }} {{ __('field_mission_desc') }}
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="vision_desc">{{ __('field_vision_desc') }}</label>
                            <textarea name="vision_desc" id="vision_desc" class="form-control texteditor">{{ isset($row->vision_desc)?$row->vision_desc:'' }}</textarea>

                            <div class="invalid-feedback">
                              {{ __('required_field') }} {{ __('field_vision_desc') }}
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