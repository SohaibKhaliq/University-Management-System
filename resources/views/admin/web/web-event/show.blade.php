<!-- Show modal content -->
<div id="showModal-{{ $row->id }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">{{ __('modal_view') }} {{ $title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <!-- Details View Start -->
                <h4><mark class="text-primary">{{ __('field_title') }}:</mark> {{ $row->title }}</h4>
                <hr/>
                <div class="">
                    <div class="row">
                        <div class="col-md-12">
                            <p><mark class="text-primary">{{ __('field_date') }}:</mark> 
                                @if(isset($setting->date_format))
                                {{ date($setting->date_format, strtotime($row->date)) }}
                                @else
                                {{ date("Y-m-d", strtotime($row->date)) }}
                                @endif
                            </p><hr/>

                            <p><mark class="text-primary">{{ __('field_time') }}:</mark> 
                                @if(isset($setting->time_format))
                                {{ date($setting->time_format, strtotime($row->time)) }}
                                @else
                                {{ date("h:i A", strtotime($row->time)) }}
                                @endif
                            </p><hr/>

                            <p><mark class="text-primary">{{ __('field_address') }}:</mark> {{ $row->address }}</p><hr/>

                            <p><mark class="text-primary">{{ __('field_description') }}:</mark> {!! $row->description !!}</p><hr/>

                            <p><mark class="text-primary">{{ __('field_status') }}:</mark>
                                @if( $row->status == 1 )
                                <span class="badge badge-pill badge-success">{{ __('status_active') }}</span>
                                @else
                                <span class="badge badge-pill badge-danger">{{ __('status_inactive') }}</span>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
                <!-- Details View End -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-times"></i> {{ __('btn_close') }}</button>
            </div>
        </div>
    </div>
</div>
