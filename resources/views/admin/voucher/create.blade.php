@extends('layout.admin')

@section('stylesheet')
@endsection

@section('content')
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <section class="panel">
            <header class="panel-heading">
              <h2 class="panel-title">Create voucher</h2>
            </header>
            <div class="panel-body">
              @if(\App\Helper\CustomHelper::canView('List Of Voucher', 'Super Admin'))
                <div class="row">
                  <div class="col-lg-12 col-md-12 col-xl-12 text-right mb-3">
                    <a href="{{ route('admin.voucher.list') }}" class="brn btn-success btn-sm">List of Voucher</a>
                  </div>
                </div>
              @endif
              @if(session()->has('status'))
                {!! session()->get('status') !!}
              @endif

              <form action="{{ route('admin.voucher.store') }}" method="post">
                @csrf
                <div class="row">
                  <div class="col-sm-6 offset-3">
                    <div class="form-group">
                      <label class="control-label">Voucher type <span class="text-danger">*</span></label>
                      <select name="type" id="" class="form-control" required>
                        @foreach($types as $type)
                          <option value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach
                      </select>
                      @error('type')
                      <strong class="text-danger">{{ $errors->first('type') }}</strong>
                      @enderror
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="row parent-area">
                      <div class="col-md-12 single-area">
                        <h5>Info</h5>
                        <i class="fa fa-plus add-btn action-btn" title="add"></i>
                        <div class="row">
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label class="control-label">DR. A/C: <span class="text-danger">*</span></label>
                              <select name="dr_component[]" id="" class="form-control" required>
                                <option value="">Choose dr a/c</option>
                                @foreach($subcomponents as $subcomponent)
                                  <optgroup label="{{ $subcomponent->component->name.' ----  '.$subcomponent->name  }}">
                                    @foreach($subcomponent->subsidiaries as $subsidiarie)
                                      <option value="{{ $subsidiarie->id }}">{{ $subsidiarie->name }}</option>
                                    @endforeach
                                  </optgroup>
                                @endforeach
                              </select>
                              @error('dr_component')
                              <strong class="text-danger">{{ $errors->first('dr_component') }}</strong>
                              @enderror
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label class="control-label">CR. A/C: <span class="text-danger">*</span></label>
                              <select name="cr_component[]" id="" class="form-control" required>
                                <option value="">Choose cr a/c</option>
                                @foreach($subcomponents as $subcomponent)
                                  <optgroup label="{{ $subcomponent->name.' ----  '. $subcomponent->component->name }}">
                                    @foreach($subcomponent->subsidiaries as $subsidiarie)
                                      <option value="{{ $subsidiarie->id }}">{{ $subsidiarie->name }}</option>
                                    @endforeach
                                  </optgroup>
                                @endforeach
                              </select>
                              @error('cr_component')
                              <strong class="text-danger">{{ $errors->first('cr_component') }}</strong>
                              @enderror
                            </div>
                          </div>
                          <div class="col-md-12">
                            <div class="row">
                              <div class="col-sm-4">
                                <div class="form-group">
                                  <label class="control-label">Cheque No</label>
                                  <input type="text" name="cheque_no[]" placeholder="Cheque No" autocomplete="off"
                                         value="{{ old('cheque_no') }}"
                                         class="form-control @error('cheque_no') is-invalid @enderror">
                                  @error('cheque_no')
                                  <strong class="text-danger">{{ $errors->first('cheque_no') }}</strong>
                                  @enderror
                                </div>
                              </div>
                              <div class="col-sm-4">
                                <div class="form-group">
                                  <label class="control-label">Date</label>
                                  <input type="date" name="date[]" placeholder="Name" autocomplete="off"
                                         value="{{ old('date') }}"
                                         class="form-control @error('date') is-invalid @enderror">
                                  @error('date')
                                  <strong class="text-danger">{{ $errors->first('date') }}</strong>
                                  @enderror
                                </div>
                              </div>
                              <div class="col-sm-4">
                                <div class="form-group">
                                  <label class="control-label">Amount<span class="text-danger">*</span></label>
                                  <input type="number" name="amount[]" placeholder="0.00" autocomplete="off" required
                                         value="{{ old('amount') }}"
                                         class="form-control @error('amount') is-invalid @enderror">
                                  @error('amount')
                                  <strong class="text-danger">{{ $errors->first('amount') }}</strong>
                                  @enderror
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-12">
                            <div class="form-group">
                              <label class="control-label">Narration<span class="text-danger">*</span></label>
                              <textarea name="narration[]" id="" cols="3" class="form-control" placeholder="Write something"></textarea>
                              @error('narration')
                              <strong class="text-danger">{{ $errors->first('narration') }}</strong>
                              @enderror
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12 text-right">
                    <button class="btn btn-danger btn-sm w-100 text-center" type="submit">Submit</button>
                  </div>
                </div>
              </form>
            </div>
          </section>
        </div>
      </div>
    </div>

    <div class="div d-none" id="test01">
      <div class="col-md-12 single-area">
        <h5>Info</h5>
        <i class="fa fa-minus minus-btn action-btn" title="Remove"></i>
        <i class="fa fa-plus add-btn action-btn" title="Add"></i>
        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
              <label class="control-label">DR. A/C: </label>
              <select name="dr_component[]" id="" class="form-control" required>
                <option value="">Choose dr a/c</option>
                @foreach($subcomponents as $subcomponent)
                  <optgroup label="{{ $subcomponent->component->name.' ----  '.$subcomponent->name  }}">
                    @foreach($subcomponent->subsidiaries as $subsidiarie)
                      <option value="{{ $subsidiarie->id }}">{{ $subsidiarie->name }}</option>
                    @endforeach
                  </optgroup>
                @endforeach
              </select>
              @error('dr_component')
              <strong class="text-danger">{{ $errors->first('dr_component') }}</strong>
              @enderror
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label class="control-label">CR. A/C: </label>
              <select name="cr_component[]" id="" class="form-control" required>
                <option value="">Choose cr a/c</option>
                @foreach($subcomponents as $subcomponent)
                  <optgroup label="{{ $subcomponent->name.' ----  '. $subcomponent->component->name }}">
                    @foreach($subcomponent->subsidiaries as $subsidiarie)
                      <option value="{{ $subsidiarie->id }}">{{ $subsidiarie->name }}</option>
                    @endforeach
                  </optgroup>
                @endforeach
              </select>
              @error('cr_component')
              <strong class="text-danger">{{ $errors->first('cr_component') }}</strong>
              @enderror
            </div>
          </div>
          <div class="col-md-12">
            <div class="row">
              <div class="col-sm-4">
                <div class="form-group">
                  <label class="control-label">Cheque No<span class="text-danger">*</span></label>
                  <input type="text" name="cheque_no[]" placeholder="Cheque No" autocomplete="off"
                         value="{{ old('cheque_no') }}"
                         class="form-control @error('cheque_no') is-invalid @enderror">
                  @error('cheque_no')
                  <strong class="text-danger">{{ $errors->first('cheque_no') }}</strong>
                  @enderror
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label class="control-label">Date<span class="text-danger">*</span></label>
                  <input type="date" name="date[]" placeholder="Name" autocomplete="off"
                         value="{{ old('date') }}"
                         class="form-control @error('date') is-invalid @enderror">
                  @error('date')
                  <strong class="text-danger">{{ $errors->first('date') }}</strong>
                  @enderror
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label class="control-label">Amount<span class="text-danger">*</span></label>
                  <input type="number" name="amount[]" placeholder="0.00" autocomplete="off" required
                         value="{{ old('amount') }}"
                         class="form-control @error('amount') is-invalid @enderror">
                  @error('amount')
                  <strong class="text-danger">{{ $errors->first('amount') }}</strong>
                  @enderror
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label class="control-label">Narration<span class="text-danger">*</span></label>
              <textarea name="narration[]" id="" cols="3" class="form-control" placeholder="Write something"></textarea>
              @error('narration')
              <strong class="text-danger">{{ $errors->first('narration') }}</strong>
              @enderror
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
@endsection
@section('script')

  <script>
    $(document).ready(function () {
      $(document).on('click', '.add-btn', function () {
        const content = $('#test01').html()
        $('.parent-area').append(content)
      })
      $(document).on('click', '.minus-btn', function () {
        $(this).closest('.single-area').remove()
      })
    })
  </script>
@endsection
