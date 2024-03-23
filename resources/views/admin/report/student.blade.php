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
                        <form class="needs-validation" novalidate method="get" action="{{ route($route.'.student') }}">
                            <div class="row gx-2">
                                @include('common.inc.student_search_filter')

                                <div class="form-group col-md-3">
                                    <label for="status">{{ __('field_status') }}</label>
                                    <select class="form-control" name="status" id="status" required>
                                        <option value="0">{{ __('all') }}</option>
                                        @foreach( $statuses as $status )
                                        <option value="{{ $status->id }}" @if( $selected_status == $status->id) selected @endif>{{ $status->title }}</option>
                                        @endforeach
                                    </select>

                                    <div class="invalid-feedback">
                                      {{ __('required_field') }} {{ __('field_status') }}
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
                    <div class="card-block">
                        <!-- [ Data table ] start -->
                        <div class="table-responsive">
                            <table id="report-table" class="display table nowrap table-striped table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('field_student_id') }}</th>
                                        <th>{{ __('field_name') }}</th>
                                        <th>{{ __('field_program') }}</th>
                                        <th>{{ __('field_session') }}</th>
                                        <th>{{ __('field_semester') }}</th>
                                        <th>{{ __('field_section') }}</th>
                                        <th>{{ __('field_total_credit_hour') }}</th>
                                        <th>{{ __('field_cumulative_gpa') }}</th>
                                        <th>{{ __('field_batch') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @foreach( $rows as $key => $row )
                                    @php
                                        $enroll = \App\Models\Student::enroll($row->id);
                                        $total_credits = 0;
                                        $total_cgpa = 0;
                                    @endphp
                                    @foreach( $row->studentEnrolls as $key => $item )

                                        @if(isset($item->subjectMarks))
                                        @foreach($item->subjectMarks as $mark)

                                            @php
                                            $marks_per = round($mark->total_marks);
                                            @endphp

                                            @foreach($grades as $grade)
                                            @if($marks_per >= $grade->min_mark && $marks_per <= $grade->max_mark)
                                            @php
                                            if($grade->point > 0){
                                            $total_cgpa = $total_cgpa + ($grade->point * $mark->subject->credit_hour);
                                            $total_credits = $total_credits + $mark->subject->credit_hour;
                                            }
                                            @endphp
                                            @break
                                            @endif
                                            @endforeach

                                        @endforeach
                                        @endif

                                    @endforeach
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>
                                            <a href="{{ route('admin.student.show', $row->id) }}">
                                            #{{ $row->student_id }}
                                            </a>
                                        </td>
                                        <td>{{ $row->first_name }} {{ $row->last_name }}</td>
                                        <td>{{ $row->program->shortcode ?? '' }}</td>
                                        <td>{{ $enroll->session->title ?? '' }}</td>
                                        <td>{{ $enroll->semester->title ?? '' }}</td>
                                        <td>{{ $enroll->section->title ?? '' }}</td>
                                        <td>{{ round($total_credits, 2) }}</td>
                                        <td>
                                            @php
                                            if($total_credits <= 0){
                                                $total_credits = 1;
                                            }
                                            $com_gpa = $total_cgpa / $total_credits;
                                            echo number_format((float)$com_gpa, 2, '.', '');
                                            @endphp
                                        </td>
                                        <td>{{ $row->batch->title ?? '' }}</td>
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

@section('page_js')
    @include('admin.report.script')
@endsection