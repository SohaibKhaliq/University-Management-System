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
                        <form class="needs-validation" novalidate method="get" action="{{ route($route.'.semester') }}">
                            <div class="row gx-2">
                                <div class="form-group col-md-3">
                                    <label for="program">{{ __('field_program') }} <span>*</span></label>
                                    <select class="form-control program" name="program" id="program" required>
                                        <option value="">{{ __('select') }}</option>
                                        @foreach( $programs as $program )
                                        <option value="{{ $program->id }}" @if( $selected_program == $program->id) selected @endif>{{ $program->title }}</option>
                                        @endforeach
                                    </select>

                                    <div class="invalid-feedback">
                                      {{ __('required_field') }} {{ __('field_program') }}
                                    </div>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="session">{{ __('field_session') }} <span>*</span></label>
                                    <select class="form-control session" name="session" id="session" required>
                                        <option value="">{{ __('select') }}</option>
                                        @if(isset($sessions))
                                        @foreach( $sessions->sortByDesc('id') as $session )
                                        <option value="{{ $session->id }}" @if( $selected_session == $session->id) selected @endif>{{ $session->title }}</option>
                                        @endforeach
                                        @endif
                                    </select>

                                    <div class="invalid-feedback">
                                        {{ __('required_field') }} {{ __('field_session') }}
                                    </div>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="student_id">{{ __('field_student_id') }}</label>
                                    <input type="text" class="form-control" name="student_id" id="student_id" value="{{ $selected_student_id }}">

                                    <div class="invalid-feedback">
                                      {{ __('required_field') }} {{ __('field_student_id') }}
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
                            <table id="basic-table" class="display table nowrap table-striped table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>{{ __('field_student_id') }}</th>
                                        <th>{{ __('field_name') }}</th>
                                        <th>{{ __('field_batch') }}</th>
                                        <th>{{ __('field_program') }}</th>
                                        <th>{{ __('field_action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @foreach( $rows as $key => $row )
                                    <tr>
                                        <td>
                                            @isset($row->student_id)
                                            <a href="{{ route('admin.student.show', $row->id) }}">
                                            #{{ $row->student_id }}
                                            </a>
                                            @endisset
                                        </td>
                                        <td>{{ $row->first_name }} {{ $row->last_name }}</td>
                                        <td>{{ $row->batch->title ?? '' }}</td>
                                        <td>{{ $row->program->shortcode ?? '' }}</td>
                                        <td>
                                            @can($access.'-print')
                                            @if(isset($print))
                                            <a href="#" class="btn btn-icon btn-dark btn-sm" onclick="PopupWin('{{ route($route.'.semester.print', ['id' => $row->id, 'session' => $selected_session]) }}', '{{ $title }}', 1000, 600);">
                                                <i class="fas fa-print"></i>
                                            </a>
                                            @endif
                                            @endcan
                                            
                                            @can($access.'-download')
                                            @if(isset($print))
                                            <a href="{{ route($route.'.semester.download', ['id' => $row->id, 'session' => $selected_session]) }}" target="_blank" class="btn btn-icon btn-dark btn-sm">
                                                <i class="fas fa-download"></i>
                                            </a>
                                            @endif
                                            @endcan
                                        </td>
                                    </tr>
                                  @endforeach
                                </tbody>
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
<script type="text/javascript">
    "use strict";
    $(".program").on('change',function(e){
      e.preventDefault(e);
      var session=$(".session");
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        type:'POST',
        url: "{{ route('filter-session') }}",
        data:{
          _token:$('input[name=_token]').val(),
          program:$(this).val()
        },
        success:function(response){
            // var jsonData=JSON.parse(response);
            $('option', session).remove();
            $('.session').append('<option value="">{{ __("select") }}</option>');
            $.each(response, function(){
              $('<option/>', {
                'value': this.id,
                'text': this.title
              }).appendTo('.session');
            });
          }

      });
    });
</script>
@endsection