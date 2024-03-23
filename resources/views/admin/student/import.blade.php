@extends('admin.layouts.master')
@section('title', $title)
@section('content')

<!-- Start Content-->
<div class="main-body">
    <div class="page-wrapper">
        <!-- [ Main Content ] start -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>{{ $title }} {{ __('btn_import') }}</h5>
                    </div>
                    <div class="card-block">
                        <a href="{{ route($route.'.index') }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i> {{ __('btn_back') }}</a>

                        <a href="{{ route($route.'.import') }}" class="btn btn-info"><i class="fas fa-sync-alt"></i> {{ __('btn_refresh') }}</a>
                    </div>

                    <div class="card-block">
                        <p>1. Your Excel data should be in the format of the download file. The first line of your Excel file should be the column headers as in the table example. Also make sure that your file is UTF-8 to avoid unnecessary encoding problems. <a href="{{ asset('dashboard/sample/students.xlsx') }}" class="text-primary" download>Download Sample File</a></p><hr/>
                        <p>2. If the column you are trying to import is date, Make sure that is formatted in format Y-m-d (2022-06-30). Also keep the excel field format as text instead of date.</p><hr/>
                        <p>3. Duplicate "Student ID" (unique in table) rows will not be imported. Student ID must be unique.</p><hr/>
                        <p>4. Duplicate "Email" (unique in table) rows will not be imported. Student email address must be unique and valid email.</p><hr/>
                        <p>5. For "Gender" use ID ( 1=Male, 2=Female, 3=Others ).</p><hr/>
                        <p>6. "DOB" represent the Date of birth. Please follow this date format(2022-06-15) for Date of birth.</p><hr/>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-block">
                        <form class="needs-validation" novalidate action="{{ route($route.'.import.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                            <div class="row gx-2">
                                <div class="form-group col-md-3">
                                    <label for="batch">{{ __('field_batch') }} <span>*</span></label>
                                    <select class="form-control batch" name="batch" id="batch" required>
                                        <option value="">{{ __('select') }}</option>
                                        @foreach( $batches as $batch )
                                        <option value="{{ $batch->id }}" @if(old('batch') == $batch->id) selected @endif>{{ $batch->title }}</option>
                                        @endforeach
                                    </select>

                                    <div class="invalid-feedback">
                                      {{ __('required_field') }} {{ __('field_batch') }}
                                    </div>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="program">{{ __('field_program') }} <span>*</span></label>
                                    <select class="form-control program" name="program" id="program" required>
                                      <option value="">{{ __('select') }}</option>
                                    </select>

                                  <div class="invalid-feedback">
                                    {{ __('required_field') }} {{ __('field_program') }}
                                  </div>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="session">{{ __('field_session') }} <span>*</span></label>
                                    <select class="form-control session" name="session" id="session" required>
                                      <option value="">{{ __('select') }}</option>
                                    </select>

                                    <div class="invalid-feedback">
                                      {{ __('required_field') }} {{ __('field_session') }}
                                    </div>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="semester">{{ __('field_semester') }} <span>*</span></label>
                                    <select class="form-control semester" name="semester" id="semester" required>
                                      <option value="">{{ __('select') }}</option>
                                    </select>

                                    <div class="invalid-feedback">
                                      {{ __('required_field') }} {{ __('field_semester') }}
                                    </div>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="section">{{ __('field_section') }} <span>*</span></label>
                                    <select class="form-control section" name="section" id="section" required>
                                      <option value="">{{ __('select') }}</option>
                                    </select>

                                    <div class="invalid-feedback">
                                      {{ __('required_field') }} {{ __('field_section') }}
                                    </div>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="import">{{ __('File xlsx') }} <span>*</span></label>
                                    <input type="file" class="form-control" name="import" id="import" value="{{ old('import') }}" accept=".xlsx" required>

                                    <div class="invalid-feedback">
                                      {{ __('required_field') }} {{ __('File xlsx') }}
                                    </div>
                                </div>

                                <div class="form-group col-md-3">
                                    <button type="submit" class="btn btn-info btn-filter"><i class="fas fa-upload"></i> {{ __('btn_upload') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ Main Content ] end -->
    </div>
</div>
<!-- End Content-->

@endsection

@section('page_js')
    <!-- validate Js -->
    <script src="{{ asset('dashboard/plugins/jquery-validation/js/jquery.validate.min.js') }}"></script>

    <!-- Filter Search -->
    @include('common.js.batch_filter')
@endsection