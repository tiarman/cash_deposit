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
              <h2 class="panel-title">Manage Component Budget</h2>
            </header>
            <div class="panel-body">
              @if(\App\Helper\CustomHelper::canView('List Of Component Budget', 'Super Admin'))
                <div class="row">
                  <div class="col-lg-12 col-md-12 col-xl-12 text-right mb-3">
                    <a href="{{ route('admin.budget.component.list') }}" class="brn btn-success btn-sm">List of Component Budgets</a>
                  </div>
                </div>
              @endif
              @if(session()->has('status'))
                {!! session()->get('status') !!}
              @endif

              <form action="{{ route('admin.budget.component.store') }}" method="post">
                @csrf
                <input type="hidden" class="dt form-control" name="id" value="{{ $fcBudget->id }}">
                <div class="row">

                  <div class="col-md-12">
                    <div class="form-row p-1">
                      <label class="control-label mr-3">Budget Type<span class="text-danger">*</span></label>
                      <label for="Monthly" class="control-label"> <input type="radio" name="type" @checked(old('type', $fcBudget->type) == 'monthly') class="form-control p-2 ml-2 mr-2" value="monthly" id="Monthly">Monthly</label>
                      <label for="Yearly" class="control-label"> <input type="radio" name="type" @checked(old('type', $fcBudget->type) == 'yearly') class="form-control p-2 ml-2 mr-2" value="yearly" id="Yearly">Yearly</label>
                      @error('component_id')
                      <strong class="text-danger">{{ $errors->first('component_id') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="control-label">Components<span class="text-danger">*</span></label>
                      <select name="component_id" class="form-control @error('component_id') is-invalid @enderror" required>
                        <option value="">Choose a Components</option>
                        @foreach($components as $component)
                          <option value="{{ $component->id }}" @selected($component->id == old('component_id',$fcBudget->component_id))>{{ $component->name }}</option>
                        @endforeach
                      </select>
                      @error('component_id')
                      <strong class="text-danger">{{ $errors->first('component_id') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="control-label">Fiscal Year<span class="text-danger">*</span></label>
                      <select name="fiscal_year_id" class="form-control @error('fiscal_year_id') is-invalid @enderror" required>
                        <option value="">Choose a Fiscal Year</option>
                        @foreach($fiscalyears as $fiscalyear)
                          <option value="{{ $fiscalyear->id }}" @selected($fiscalyear->id == old('fiscal_year_id',$fcBudget->fiscal_year_id))>{{ $fiscalyear->code }}</option>
                        @endforeach
                      </select>
                      @error('fiscal_year_id')
                      <strong class="text-danger">{{ $errors->first('fiscal_year_id') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="control-label"> Annual Budget<span class="text-danger">*</span></label>
                      <input type="number" min="0" name="annual_budget" placeholder=" Annual Budget" autocomplete="off" required
                             value="{{ old('annual_budget',$fcBudget->annual_budget) }}"
                             class="form-control @error('annual_budget') is-invalid @enderror">
                      @error('annual_budget')
                      <strong class="text-danger">{{ $errors->first('annual_budget') }}</strong>
                      @enderror
                    </div>
                  </div>
                  {{--                      <div class="col-md-6">--}}
                  {{--                          <div class="form-group">--}}
                  {{--                              <label class="control-label">Cost<span class="text-danger">*</span></label>--}}
                  {{--                              <input type="number" min="0" name="cost" placeholder="0.00" autocomplete="off" required--}}
                  {{--                                     value="{{ old('cost',$fcBudget->cost) }}"--}}
                  {{--                                     class="form-control @error('cost') is-invalid @enderror">--}}
                  {{--                              @error('cost')--}}
                  {{--                              <strong class="text-danger">{{ $errors->first('cost') }}</strong>--}}
                  {{--                              @enderror--}}
                  {{--                          </div>--}}
                  {{--                      </div>--}}
                </div>

                <div class="row month-area d-none">
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="control-label">M1<span class="text-danger">*</span></label>
                      <input type="number" min="0" step="any" name="m1" placeholder="0.00" autocomplete="off" required
                             value="{{ old('m1',$fcBudget->m1) }}"
                             class="form-control month_input @error('m1') is-invalid @enderror">
                      @error('m1')
                      <strong class="text-danger">{{ $errors->first('m1') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="control-label">M2<span class="text-danger">*</span></label>
                      <input type="number" min="0" step="any" name="m2" placeholder="0.00" autocomplete="off" required
                             value="{{ old('m2',$fcBudget->m2) }}"
                             class="form-control month_input @error('m2') is-invalid @enderror">
                      @error('m2')
                      <strong class="text-danger">{{ $errors->first('m2') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="control-label">M3<span class="text-danger">*</span></label>
                      <input type="number" min="0" step="any" name="m3" placeholder="0.00" autocomplete="off" required
                             value="{{ old('m3',$fcBudget->m3) }}"
                             class="form-control month_input @error('m3') is-invalid @enderror">
                      @error('m3')
                      <strong class="text-danger">{{ $errors->first('m3') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="control-label">M4<span class="text-danger">*</span></label>
                      <input type="number" min="0" step="any" name="m4" placeholder="0.00" autocomplete="off" required
                             value="{{ old('m4',$fcBudget->m4) }}"
                             class="form-control month_input @error('m4') is-invalid @enderror">
                      @error('m4')
                      <strong class="text-danger">{{ $errors->first('m4') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="control-label">M5<span class="text-danger">*</span></label>
                      <input type="number" min="0" step="any" name="m5" placeholder="0.00" autocomplete="off" required
                             value="{{ old('m5',$fcBudget->m5) }}"
                             class="form-control month_input @error('m5') is-invalid @enderror">
                      @error('m5')
                      <strong class="text-danger">{{ $errors->first('m5') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="control-label">M6<span class="text-danger">*</span></label>
                      <input type="number" min="0" step="any" name="m6" placeholder="0.00" autocomplete="off" required
                             value="{{ old('m6',$fcBudget->m6) }}"
                             class="form-control month_input @error('m6') is-invalid @enderror">
                      @error('m6')
                      <strong class="text-danger">{{ $errors->first('m6') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="control-label">M7<span class="text-danger">*</span></label>
                      <input type="number" min="0" step="any" name="m7" placeholder="0.00" autocomplete="off" required
                             value="{{ old('m7',$fcBudget->m7) }}"
                             class="form-control month_input @error('m7') is-invalid @enderror">
                      @error('m7')
                      <strong class="text-danger">{{ $errors->first('m7') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="control-label">M8<span class="text-danger">*</span></label>
                      <input type="number" min="0" step="any" name="m8" placeholder="0.00" autocomplete="off" required
                             value="{{ old('m8',$fcBudget->m8) }}"
                             class="form-control month_input @error('m8') is-invalid @enderror">
                      @error('m8')
                      <strong class="text-danger">{{ $errors->first('m8') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="control-label">M9<span class="text-danger">*</span></label>
                      <input type="number" min="0" step="any" name="m9" placeholder="0.00" autocomplete="off" required
                             value="{{ old('m9',$fcBudget->m9) }}"
                             class="form-control month_input @error('m9') is-invalid @enderror">
                      @error('m9')
                      <strong class="text-danger">{{ $errors->first('m9') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="control-label">M10<span class="text-danger">*</span></label>
                      <input type="number" min="0" step="any" name="m10" placeholder="0.00" autocomplete="off" required
                             value="{{ old('m10',$fcBudget->m10) }}"
                             class="form-control month_input @error('m10') is-invalid @enderror">
                      @error('m10')
                      <strong class="text-danger">{{ $errors->first('m10') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="control-label">M11<span class="text-danger">*</span></label>
                      <input type="number" min="0" step="any" name="m11" placeholder="0.00" autocomplete="off" required
                             value="{{ old('m11',$fcBudget->m11) }}"
                             class="form-control month_input @error('m11') is-invalid @enderror">
                      @error('m11')
                      <strong class="text-danger">{{ $errors->first('m11') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="control-label">M12<span class="text-danger">*</span></label>
                      <input type="number" min="0" step="any" name="m12" placeholder="0.00" autocomplete="off" required
                             value="{{ old('m12',$fcBudget->m12) }}"
                             class="form-control month_input @error('m12') is-invalid @enderror">
                      @error('m12')
                      <strong class="text-danger">{{ $errors->first('m12') }}</strong>
                      @enderror
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12 text-right">
                    <button class="btn btn-danger btn-sm" type="submit">Submit</button>
                  </div>
                </div>
              </form>
            </div>
          </section>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('script')
  <script>
    $(document).ready(function () {
      $('input[name="type"]').change(function () {
        setBudgetType()
      })
      setBudgetType()
      function setBudgetType() {
        if($('input[name="type"]:checked').val() == 'monthly'){
          $('.month-area').removeClass('d-none')
          $('.month_input').val((Number($('input[name="annual_budget"]').val()) / 12).toFixed(2));
        }else{
          $('.month-area').addClass('d-none')
        }
      }


      $('input[name="annual_budget"]').change(function () {
        $('.month_input').val((Number($(this).val()) / 12).toFixed(2));
      });
      $('.month_input').change(function () {
        var sum = 0;
        $('.month_input').each(function () {
          sum += parseFloat($(this).val());
        });
        $('input[name="annual_budget"]').val(sum);

      });
    });
  </script>
@endsection
