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
                        <p>1. Your Excel data should be in the format of the download file. The first line of your Excel file should be the column headers as in the table example. Also make sure that your file is UTF-8 to avoid unnecessary encoding problems. <a href="{{ asset('dashboard/sample/books.xlsx') }}" class="text-primary" download>Download Sample File</a></p><hr/>
                        <p>2. Duplicate "ISBN" (unique in table) rows will not be imported. Book ISBN no must be unique.</p><hr/>
                        <p>3. "Price" must contain a numeric value (price of book).</p><hr/>
                        <p>4. "Quantity" must contain a numeric value (number of book).</p><hr/>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-block">
                        <form class="needs-validation" novalidate action="{{ route($route.'.import.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                            <div class="row gx-2">
                                <div class="form-group col-md-4">
                                    <label for="category">{{ __('field_category') }} <span>*</span></label>
                                    <select class="form-control" name="category" id="category" required>
                                        <option value="">{{ __('select') }}</option>
                                        @foreach( $categories as $category )
                                        <option value="{{ $category->id }}" @if(old('category') == $category->id) selected @endif>{{ $category->title }}</option>
                                        @endforeach
                                    </select>

                                    <div class="invalid-feedback">
                                      {{ __('required_field') }} {{ __('field_category') }}
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