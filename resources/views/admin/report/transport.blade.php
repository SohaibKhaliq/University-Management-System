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
                        <h5>{{ $title }}</h5>
                    </div>
                    <div class="card-block">
                        <form class="needs-validation" novalidate method="get" action="{{ route($route.'.transport') }}">
                            <div class="row gx-2">
                                <div class="form-group col-md-3">
                                    <label for="route">{{ __('field_route') }}</label>
                                    <select class="form-control" name="route" id="route">
                                        <option value="">{{ __('all') }}</option>
                                        @foreach( $transportRoutes as $transportRoute )
                                        <option value="{{ $transportRoute->id }}" @if($selected_route == $transportRoute->id) selected @endif>{{ $transportRoute->title }}</option>
                                        @endforeach
                                    </select>

                                    <div class="invalid-feedback">
                                      {{ __('required_field') }} {{ __('field_route') }}
                                    </div>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="vehicle">{{ __('field_vehicle') }}</label>
                                    <select class="form-control" name="vehicle" id="vehicle">
                                        <option value="">{{ __('all') }}</option>
                                        @foreach( $transportVehicles as $transportVehicle )
                                        <option value="{{ $transportVehicle->id }}" @if($selected_vehicle == $transportVehicle->id) selected @endif>{{ $transportVehicle->number }}</option>
                                        @endforeach
                                    </select>

                                    <div class="invalid-feedback">
                                      {{ __('required_field') }} {{ __('field_vehicle') }}
                                    </div>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="member">{{ __('field_member') }}</label>
                                    <select class="form-control" name="member" id="member">
                                        <option value="">{{ __('all') }}</option>
                                        <option value="1" @if($selected_member == 1) selected @endif>{{ __('field_student') }}</option>
                                        <option value="2" @if($selected_member == 2) selected @endif>{{ __('field_staff') }}</option>
                                    </select>

                                    <div class="invalid-feedback">
                                      {{ __('required_field') }} {{ __('field_member') }}
                                    </div>
                                </div>
                                <div class="form-group col-md-3">
                                    <button type="submit" class="btn btn-info btn-filter"><i class="fas fa-search"></i> {{ __('btn_search') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-sm-12">
                <div class="card">
                    @if(isset($rows))                
                    <div class="card-block">
                        <!-- [ Data table ] start -->
                        <div class="table-responsive">
                            <table id="report-table" class="display table nowrap table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('field_route') }}</th>
                                        <th>{{ __('field_vehicle') }}</th>
                                        <th>{{ __('field_fee') }}</th>
                                        <th>{{ __('field_member') }}</th>
                                        <th>{{ __('field_name') }}</th>
                                        <th>{{ __('field_gender') }}</th>
                                        <th>{{ __('field_phone') }}</th>
                                        <th>{{ __('field_status') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @php
                                    $total_fee = 0;
                                  @endphp
                                  @foreach( $rows as $key => $row )
                                    <tr>
                                        @php
                                            $total_fee = $total_fee + round($row->transportRoute->fee ?? 0, $setting->decimal_place ?? 2);
                                        @endphp
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $row->transportRoute->title ?? '' }}</td>
                                        <td>{{ $row->transportVehicle->number ?? '' }}</td>
                                        <td>{{ number_format((float)$row->transportRoute->fee ?? 0, $setting->decimal_place ?? 2) }} {!! $setting->currency_symbol !!}</td>
                                        <td>
                                            @isset($row->transportable->student_id)
                                            {{ __('field_student_id') }} : 
                                            #{{ $row->transportable->student_id ?? '' }}
                                            @endisset
                                            @isset($row->transportable->staff_id)
                                            {{ __('field_staff_id') }} : 
                                            #{{ $row->transportable->staff_id ?? '' }}
                                            @endisset
                                        </td>
                                        <td>{{ $row->transportable->first_name ?? '' }} {{ $row->transportable->last_name ?? '' }}</td>
                                        <td>
                                            @if( $row->transportable->gender == 1 )
                                            {{ __('gender_male') }}
                                            @elseif( $row->transportable->gender == 2 )
                                            {{ __('gender_female') }}
                                            @elseif( $row->transportable->gender == 3 )
                                            {{ __('gender_other') }}
                                            @endif
                                        </td>
                                        <td>{{ $row->transportable->phone ?? '' }}</td>
                                        <td>
                                            @if( $row->status == 1 )
                                            <span class="badge badge-pill badge-success">{{ __('status_active') }}</span>
                                            @else
                                            <span class="badge badge-pill badge-danger">{{ __('status_canceled') }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                  @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th>{{ __('field_grand_total') }}</th>
                                        <th>{{ number_format((float)$total_fee, $setting->decimal_place ?? 2) }} {!! $setting->currency_symbol !!}</th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- [ Data table ] end -->
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <!-- [ Main Content ] end -->
    </div>
</div>
<!-- End Content-->

@endsection

@section('page_js')
    @include('admin.report.script')
@endsection