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
              <h2 class="panel-title">Create Component Institute Budget</h2>
            </header>
            <div class="panel-body">
              @if(\App\Helper\CustomHelper::canView('List Of Component Institute Budget', 'Super Admin'))
                <div class="row">
                  <div class="col-lg-12 col-md-12 col-xl-12 text-right mb-3">
                    <a href="{{ route('admin.budget.component.institute.list') }}" class="brn btn-success btn-sm">List of Component Institute Budget</a>
                  </div>
                </div>
              @endif
              @if(session()->has('status'))
                {!! session()->get('status') !!}
              @endif

              <form action="{{ route('admin.budget.component.institute.store') }}" method="post">
                @csrf
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-row p-1">
                      <label class="control-label mr-3">Budget Type<span class="text-danger">*</span></label>
                      <label for="Monthly" class="control-label"> <input type="radio" name="type" @checked(old('type') == 'monthly') class="form-control p-2 ml-2 mr-2" value="monthly" id="Monthly">Monthly</label>
                      <label for="Yearly" class="control-label"> <input type="radio" name="type" @if(old('type')) @checked(old('type') == 'yearly') @else  checked @endif class="form-control p-2 ml-2 mr-2" value="yearly" id="Yearly">Yearly</label>
                      @error('component_id')
                      <strong class="text-danger">{{ $errors->first('component_id') }}</strong>
                      @enderror
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label">Fiscal Year<span class="text-danger">*</span></label>
                      <select name="fiscal_year_id" class="form-control @error('fiscal_year_id') is-invalid @enderror" required>
                        <option value="">Choose a fiscal year</option>
                        @foreach($fsYears as $year)
                          <option value="{{ $year->id }}" @selected($year->id == old('fiscal_year_id'))>{{ $year->code }}</option>
                        @endforeach
                      </select>
                      @error('fiscal_year_id')
                      <strong class="text-danger">{{ $errors->first('fiscal_year_id') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label">Component<span class="text-danger">*</span></label>
                      <select name="component_id" class="form-control @error('component_id') is-invalid @enderror" required>
                        <option value="">-- Select a component --</option>
                        {{--                        @foreach($budgets as $budget)--}}
                        {{--                          <option  @if($budget->disabled) disabled @endif value="{{ $budget->id }}" @selected($budget->id == old('component_id'))>{{ $budget->component->name }} [ {{ $budget->annual_budget }} Tk. ]--}}
                        {{--                          </option>--}}
                        {{--                        @endforeach--}}
                      </select>
                      @error('component_id')
                      <strong class="text-danger">{{ $errors->first('component_id') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label">Institute<span class="text-danger">*</span></label>
                      <select name="institute_id" class="form-control @error('institute_id') is-invalid @enderror" required>
                        <option value="">Choose a Institute</option>
                        @foreach($institutes as $institute)
                          <option value="{{ $institute->id }}" @selected($institute->id == old('institute_id'))>{{ $institute->name }}</option>
                        @endforeach
                      </select>
                      @error('institute_id')
                      <strong class="text-danger">{{ $errors->first('institute_id') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label"> Annual Budget<span class="text-danger">*</span></label>
                      <input type="number" min="0" name="annual_budget" placeholder=" Annual Budget" autocomplete="off" required
                             value="{{ old('annual_budget') }}"
                             class="form-control @error('annual_budget') is-invalid @enderror">
                      @error('annual_budget')
                      <strong class="text-danger">{{ $errors->first('annual_budget') }}</strong>
                      @enderror
                    </div>
                  </div>
                  </div>


                  <div class="row d-none month-area" >
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="control-label">M1<span class="text-danger">*</span></label>
                      <input type="number" min="0" name="m1" placeholder="0.00" step="any" autocomplete="off" required
                             value="{{ old('m1') }}"
                             class="form-control month_input @error('m1') is-invalid @enderror">
                      @error('m1')
                      <strong class="text-danger">{{ $errors->first('m1') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="control-label">M2<span class="text-danger">*</span></label>
                      <input type="number" min="0" name="m2" placeholder=" 0.00" step="any" autocomplete="off" required
                             value="{{ old('m2') }}"
                             class="form-control month_input @error('m2') is-invalid @enderror">
                      @error('m2')
                      <strong class="text-danger">{{ $errors->first('m2') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="control-label">M3<span class="text-danger">*</span></label>
                      <input type="number" min="0" name="m3" placeholder=" 0.00" step="any" autocomplete="off" required
                             value="{{ old('m3') }}"
                             class="form-control month_input @error('m3') is-invalid @enderror">
                      @error('m3')
                      <strong class="text-danger">{{ $errors->first('m3') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="control-label">M4<span class="text-danger">*</span></label>
                      <input type="number" min="0" name="m4" placeholder=" 0.00" step="any" autocomplete="off" required
                             value="{{ old('m4') }}"
                             class="form-control month_input @error('m4') is-invalid @enderror">
                      @error('m4')
                      <strong class="text-danger">{{ $errors->first('m4') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="control-label">M5<span class="text-danger">*</span></label>
                      <input type="number" min="0" name="m5" placeholder=" 0.00" step="any" autocomplete="off" required
                             value="{{ old('m5') }}"
                             class="form-control month_input @error('m5') is-invalid @enderror">
                      @error('m5')
                      <strong class="text-danger">{{ $errors->first('m5') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="control-label">M6<span class="text-danger">*</span></label>
                      <input type="number" min="0" name="m6" placeholder=" 0.00" step="any" autocomplete="off" required
                             value="{{ old('m6') }}"
                             class="form-control month_input @error('m6') is-invalid @enderror">
                      @error('m6')
                      <strong class="text-danger">{{ $errors->first('m6') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="control-label">M7<span class="text-danger">*</span></label>
                      <input type="number" min="0" name="m7" placeholder=" 0.00" step="any" autocomplete="off" required
                             value="{{ old('m7') }}"
                             class="form-control month_input @error('m7') is-invalid @enderror">
                      @error('m7')
                      <strong class="text-danger">{{ $errors->first('m7') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="control-label">M8<span class="text-danger">*</span></label>
                      <input type="number" min="0" name="m8" placeholder=" 0.00" step="any" autocomplete="off" required
                             value="{{ old('m8') }}"
                             class="form-control month_input @error('m8') is-invalid @enderror">
                      @error('m8')
                      <strong class="text-danger">{{ $errors->first('m8') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="control-label">M9<span class="text-danger">*</span></label>
                      <input type="number" min="0" name="m9" placeholder=" 0.00" step="any" autocomplete="off" required
                             value="{{ old('m9') }}"
                             class="form-control month_input @error('m9') is-invalid @enderror">
                      @error('m9')
                      <strong class="text-danger">{{ $errors->first('m9') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="control-label">M10<span class="text-danger">*</span></label>
                      <input type="number" min="0" name="m10" placeholder=" 0.00" step="any" autocomplete="off" required
                             value="{{ old('m10') }}"
                             class="form-control month_input @error('m10') is-invalid @enderror">
                      @error('m10')
                      <strong class="text-danger">{{ $errors->first('m10') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="control-label">M11<span class="text-danger">*</span></label>
                      <input type="number" min="0" name="m11" placeholder=" 0.00" step="any" autocomplete="off" required
                             value="{{ old('m11') }}"
                             class="form-control month_input @error('m11') is-invalid @enderror">
                      @error('m11')
                      <strong class="text-danger">{{ $errors->first('m11') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="control-label">M12<span class="text-danger">*</span></label>
                      <input type="number" min="0" name="m12" placeholder=" 0.00" step="any" autocomplete="off" required
                             value="{{ old('m12') }}"
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
      function setBudgetType() {
        if($('input[name="type"]:checked').val() == 'monthly'){
          $('.month-area').removeClass('d-none')
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
      $('select[name="fiscal_year_id"]').change(function () {
        const $this = $('select[name="component_id"]')
        var idDivision = this.value;
        $this.html('');
        $this.html('<option value="">-- Select a component --</option>');
        $.ajax({
          url: "{{url('api/component-budget')}}/" + idDivision,
          type: "GET",
          dataType: 'json',
          success: function (result) {
            $.each(result.budgets, function (key, value) {
              $this.append('<option value="' + value.id + '" ' + (value.disabled ? "disabled" : "") + '>' + value.component.name + ' [' + value.availableBudget + ' TK]</option>');
            });

          }
        });
      });
    });
  </script>
@endsection
