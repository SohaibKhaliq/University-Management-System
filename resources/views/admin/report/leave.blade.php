@extends('admin.layouts.master')
@section('title', $title)
@section('content')

<!-- Start Content-->
<div class="main-body">
    <div class="page-wrapper">
        <!-- [ Main Content ] start -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>{{ $title }}</h5>
                    </div>
                    <div class="card-block">
                        <form class="needs-validation" novalidate method="get" action="{{ route($route.'.leave') }}">
                            <div class="row gx-2">
                                <div class="form-group col-md-2">
                                    <label for="user">{{ __('field_staff') }}</label>
                                    <select class="form-control select2" name="user" id="user">
                                        <option value="">{{ __('all') }}</option>
                                        @foreach( $users as $user )
                                        <option value="{{ $user->id }}" @if($selected_user == $user->id) selected @endif>{{ $user->staff_id }} - {{ $user->first_name }} {{ $user->last_name }}</option>
                                        @endforeach
                                    </select>

                                    <div class="invalid-feedback">
                                      {{ __('required_field') }} {{ __('field_staff') }}
                                    </div>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="pay_type">{{ __('field_pay_type') }}</label>
                                    <select class="form-control" name="pay_type" id="pay_type">
                                        <option value="">{{ __('all') }}</option>
                                        <option value="1" @if($selected_pay_type == 1) selected @endif>{{ __('field_paid_leave') }}</option>
                                        <option value="2" @if($selected_pay_type == 2) selected @endif>{{ __('field_unpaid_leave') }}</option>
                                    </select>

                                    <div class="invalid-feedback">
                                      {{ __('required_field') }} {{ __('field_pay_type') }}
                                    </div>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="type">{{ __('field_leave_type') }}</label>
                                    <select class="form-control" name="type" id="type">
                                        <option value="">{{ __('all') }}</option>
                                        @foreach( $types as $type )
                                        <option value="{{ $type->id }}" @if($selected_type == $type->id) selected @endif>{{ $type->title }}</option>
                                        @endforeach
                                    </select>

                                    <div class="invalid-feedback">
                                      {{ __('required_field') }} {{ __('field_leave_type') }}
                                    </div>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="start_date">{{ __('field_from_date') }}</label>
                                    <input type="date" class="form-control date" name="start_date" id="start_date" value="{{ $selected_start_date }}" required>

                                    <div class="invalid-feedback">
                                      {{ __('required_field') }} {{ __('field_from_date') }}
                                    </div>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="end_date">{{ __('field_to_date') }}</label>
                                    <input type="date" class="form-control date" name="end_date" id="end_date" value="{{ $selected_end_date }}" required>

                                    <div class="invalid-feedback">
                                      {{ __('required_field') }} {{ __('field_to_date') }}
                                    </div>
                                </div>
                                <div class="form-group col-md-2">
                                    <button type="submit" class="btn btn-info btn-filter"><i class="fas fa-search"></i> {{ __('btn_filter') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="card-block">
                        <!-- [ Data table ] start -->
                        <div class="table-responsive">
                            <table id="report-table" class="display table nowrap table-striped table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('field_staff_id') }}</th>
                                        <th>{{ __('field_name') }}</th>
                                        <th>{{ __('field_leave_type') }}</th>
                                        <th>{{ __('field_pay_type') }}</th>
                                        <th>{{ __('field_leave_date') }}</th>
                                        <th>{{ __('field_days') }}</th>
                                        <th>{{ __('field_apply_date') }}</th>
                                        <th>{{ __('field_status') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @php $total_days = 0; @endphp
                                  @foreach( $rows as $key => $row )
                                    <tr>
                                        @php
                                            $total_days = $total_days + (int)((strtotime($row->to_date) - strtotime($row->from_date))/86400) + 1;
                                        @endphp
                                        <td>{{ $key + 1 }}</td>
                                        <td>
                                            <a href="{{ route('admin.user.show', $row->user->id) }}">
                                                #{{ $row->user->staff_id ?? '' }}
                                            </a>
                                        </td>
                                        <td>{{ $row->user->first_name ?? '' }} {{ $row->user->last_name ?? '' }}</td>
                                        <td>{{ $row->leaveType->title ?? '' }}</td>
                                        <td>
                                            @if($row->pay_type == 1)
                                            <span class="badge badge-pill badge-success">{{ __('field_paid_leave') }}</span>
                                            @elseif($row->pay_type == 2)
                                            <span class="badge badge-pill badge-danger">{{ __('field_unpaid_leave') }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if(isset($setting->date_format))
                                                {{ date($setting->date_format, strtotime($row->from_date)) }}
                                            @else
                                                {{ date("Y-m-d", strtotime($row->from_date)) }}
                                            @endif
                                            -
                                            @if(isset($setting->date_format))
                                                {{ date($setting->date_format, strtotime($row->to_date)) }}
                                            @else
                                                {{ date("Y-m-d", strtotime($row->to_date)) }}
                                            @endif
                                        </td>
                                        <td>{{ (int)((strtotime($row->to_date) - strtotime($row->from_date))/86400) + 1 }}</td>
                                        <td>
                                            @if(isset($setting->date_format))
                                                {{ date($setting->date_format, strtotime($row->apply_date)) }}
                                            @else
                                                {{ date("Y-m-d", strtotime($row->apply_date)) }}
                                            @endif
                                        </td>
                                        <td>
                                            @if( $row->status == 1 )
                                            <span class="badge badge-pill badge-success">{{ __('status_approved') }}</span>
                                            @elseif( $row->status == 2 )
                                            <span class="badge badge-pill badge-danger">{{ __('status_rejected') }}</span>
                                            @else
                                            <span class="badge badge-pill badge-primary">{{ __('status_pending') }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                  @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th>{{ __('field_grand_total') }}</th>
                                        <th>{{ $total_days }}</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </tfoot>
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

@section('page_js')
    @include('admin.report.script')
@endsection