    <!-- Add modal content -->
    <div id="addModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <form class="needs-validation" novalidate action="{{ route($route.'.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">{{ __('btn_issue') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <!-- Form Start -->
                    <div class="form-group col-md-6">
                        <label for="book">{{ __('field_book') }} <span>*</span></label>
                        <select class="form-control select2" name="book" id="book" required>
                            <option value="">{{ __('select') }}</option>
                            @foreach( $books as $book )
                            <option value="{{ $book->id }}" @if(old('book') == $book->id) selected @endif>{{ $book->isbn }} | {{ $book->title }}</option>
                            @endforeach
                        </select>

                        <div class="invalid-feedback">
                          {{ __('required_field') }} {{ __('field_book') }}
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="member">{{ __('field_member') }} <span>*</span></label>
                        <select class="form-control select2" name="member" id="member" required>
                            <option value="">{{ __('select') }}</option>
                            @foreach( $members as $member )
                            <option value="{{ $member->id }}" @if(old('member') == $member->id) selected @endif>{{ $member->library_id }} | {{ $member->memberable->first_name ?? '' }} {{ $member->memberable->last_name ?? '' }}</option>
                            @endforeach
                        </select>

                        <div class="invalid-feedback">
                          {{ __('required_field') }} {{ __('field_member') }}
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="issue_date">{{ __('field_issue_date') }} <span>*</span></label>
                        <input type="date" class="form-control date" name="issue_date" id="issue_date" value="{{ date('Y-m-d') }}" required>

                        <div class="invalid-feedback">
                          {{ __('required_field') }} {{ __('field_issue_date') }}
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="due_date">{{ __('field_due_return_date') }} <span>*</span></label>
                        <input type="date" class="form-control date" name="due_date" id="due_date" value="{{ date('Y-m-d') }}" required>

                        <div class="invalid-feedback">
                          {{ __('required_field') }} {{ __('field_due_return_date') }}
                        </div>
                    </div>
                    <!-- Form End -->
                  </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-times"></i> {{ __('btn_close') }}</button>
                    <button type="submit" class="btn btn-success"><i class="fas fa-plus"></i> {{ __('btn_issue') }}</button>
                </div>

              </form>
            </div>
        </div>
    </div>