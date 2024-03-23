@extends('admin.layouts.master')
@section('title', $title)
@section('content')

<!-- Start Content-->
<div class="main-body">
    <div class="page-wrapper">
        <!-- [ Main Content ] start -->
        <div class="row">
            @can($access.'-create')
            <div class="col-md-4">
                <form class="needs-validation" novalidate action="{{ route($route.'.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                    <div class="card">
                        <div class="card-header">
                            <h5>{{ __('btn_create') }} {{ $title }}</h5>
                        </div>
                        <div class="card-block">
                            <!-- Form Start -->
                            <div class="form-group">
                                <label for="name" class="form-label">{{ __('field_name') }} <span>*</span></label>
                                <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}" required>

                                <div class="invalid-feedback">
                                  {{ __('required_field') }} {{ __('field_name') }}
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="designation" class="form-label">{{ __('field_designation') }} </label>
                                <input type="text" class="form-control" name="designation" id="designation" value="{{ old('designation') }}">

                                <div class="invalid-feedback">
                                  {{ __('required_field') }} {{ __('field_designation') }}
                                </div>
                            </div>

                            <div class="form-group ">
                                <label for="attach">{{ __('field_photo') }} <span>{{ __('image_size', ['height' => 300, 'width' => 300]) }}</span> <span>*</span></label>
                                <input type="file" class="form-control" name="attach" id="attach" value="{{ old('attach') }}" required>

                                <div class="invalid-feedback">
                                  {{ __('required_field') }} {{ __('field_photo') }}
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="description" class="form-label">{{ __('field_description') }} <span>*</span></label>
                                <textarea name="description" id="description" class="form-control" required>{{ old('description') }}</textarea>

                                <div class="invalid-feedback">
                                    {{ __('required_field') }} {{ __('field_description') }}
                                </div>
                            </div>
                            <!-- Form End -->
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success"><i class="fas fa-check"></i> {{ __('btn_save') }}</button>
                        </div>
                    </div>
                </form>
            </div>
            @endcan
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5>{{ $title }} {{ __('list') }}</h5>
                    </div>
                    <div class="card-block">
                        <!-- [ Data table ] start -->
                        <div class="table-responsive">
                            <table id="basic-table" class="display table nowrap table-striped table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('field_name') }}</th>
                                        <th>{{ __('field_photo') }}</th>
                                        <th>{{ __('field_status') }}</th>
                                        <th>{{ __('field_action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @foreach( $rows as $key => $row )
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $row->name }}</td>
                                        <td>
                                            @if(is_file('uploads/'.$path.'/'.$row->attach))
                                            <img style="width:50px; height:auto;" src="{{asset('uploads/'.$path.'/'.$row->attach)}}" alt="" srcset="">
                                            @endif
                                        </td>
                                        <td>
                                            @if( $row->status == 1 )
                                            <span class="badge badge-pill badge-success">{{ __('status_active') }}</span>
                                            @else
                                            <span class="badge badge-pill badge-danger">{{ __('status_inactive') }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-icon btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#showModal-{{ $row->id }}">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <!-- Include Show modal -->
                                            @include($view.'.show')

                                            @can($access.'-edit')
                                            <button type="button" class="btn btn-icon btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editModal-{{ $row->id }}">
                                                <i class="far fa-edit"></i>
                                            </button>
                                            <!-- Include Edit modal -->
                                            @include($view.'.edit')
                                            @endcan

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
