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
              <h2 class="panel-title">Manage voucher {{ $voucher->no }}</h2>
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

              <form action="{{ route('admin.voucher.manage', $voucher->id) }}" method="post">
                @csrf
                <div class="row">
                  <div class="col-sm-6 offset-3">
                    <div class="form-group">
                      <label class="control-label">Voucher type <span class="text-danger">*</span></label>
                      <select name="type" id="" class="form-control" required disabled readonly="">
                        @foreach($types as $type)
                          <option value="{{ $type->id }}" @selected($type->id == $voucher->type_id)>{{ $type->name }}</option>
                        @endforeach
                      </select>
                      @error('type')
                      <strong class="text-danger">{{ $errors->first('type') }}</strong>
                      @enderror
                    </div>
                  </div>

                  <div class="col-md-12 single-area">
                    <h5>Info</h5>
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label class="control-label">DR. A/C: <span class="text-danger">*</span></label>
                          <select name="dr_component" id="" class="form-control" required>
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
                          <select name="cr_component" id="" class="form-control" required>
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
                              <input type="text" name="cheque_no" placeholder="Cheque No" autocomplete="off"
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
                              <input type="date" name="date" placeholder="Name" autocomplete="off"
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
                              <input type="number" name="amount" placeholder="0.00" autocomplete="off" required
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
                          <textarea name="narration" id="" cols="3" class="form-control" placeholder="Write something"></textarea>
                          @error('narration')
                          <strong class="text-danger">{{ $errors->first('narration') }}</strong>
                          @enderror
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row text-right">
                  <button class="btn btn-danger btn-sm w-100 text-center" type="submit">Submit</button>
                </div>
              </form>
            </div>
          </section>
        </div>
      </div>

      <div class="card mt-3">
        <div class="card-body">
          <h2>Voucher Details</h2>
          {{--          <div class="table-responsive">--}}
          <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                 cellspacing="0" width="100%" style="font-size: 14px">

            <thead>
            <tr>
              <th class="text-center" width="50">#</th>
              <th class="text-center">Component</th>
              <th class="text-center">Sub-Component</th>
              <th class="text-center">Subsidiary Component</th>
              <th class="text-center">DR Amount</th>
              <th class="text-center">CR Amount</th>
            </tr>
            </thead>
            <tbody>
            <?php $totalCr = 0; $totalDr = 0; ?>
            @foreach($voucher->details as $key => $val)
              <?php $totalDr = ($totalDr + $val->dr_amount); $totalCr = ($totalCr + $val->cr_amount);?>
              <tr class="@if(($key%2) == 0)gradeX @else gradeC @endif">
                <td class="p-1 text-center">{{ $loop->iteration }}</td>
                <td class="p-1">{{ $val->component->name }}</td>
                <td class="p-1">{{ $val->subComponent->name }}</td>
                <td class="p-1">{{ $val->subsidaryComponent->name }}</td>
                <td class="p-1 text-right">{{ \App\Helper\CustomHelper::makePriceFormat($val->dr_amount) }}</td>
                <td class="p-1 text-right">{{ \App\Helper\CustomHelper::makePriceFormat($val->cr_amount) }}</td>
              </tr>
            @endforeach
            <tr>
              <td class="border-0" colspan="4"></td>
              <td class="p-1 text-right"><strong>{{ \App\Helper\CustomHelper::makePriceFormat($totalDr) }}</strong></td>
              <td class="p-1 text-right"><strong>{{ \App\Helper\CustomHelper::makePriceFormat($totalCr) }}</strong></td>
            </tr>
            </tbody>
          </table>
          {{--          </div>--}}

          <div class="row mt-2">
            <div class="col-md-12 text-right">
              In Words: <span>{{ \App\Helper\CustomHelper::numToEnglishWord($totalDr) }}</span> Taka Only
            </div>
            <div class="col-md-12 mt-3">
              <a href="{{ route('admin.voucher.view', ['id'=> $voucher->id, 'print'=>'pdf']) }}" class="btn btn-sm btn-info w-100">Print</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('script')
@endsection
