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
              <h2 class="panel-title">Manage Sub Component Institute Budgets</h2>
            </header>
            <div class="panel-body">
              @if(\App\Helper\CustomHelper::canView('List Of Sub Component Institute Budget', 'Super Admin'))
                <div class="row">
                  <div class="col-lg-12 col-md-12 col-xl-12 text-right mb-3">
                    <a href="{{ route('admin.budget.sub.component.institute.list') }}" class="brn btn-success btn-sm">List of Sub Component Institute Budgets</a>
                  </div>
                </div>
              @endif
              @if(session()->has('status'))
                {!! session()->get('status') !!}
              @endif

              <form action="{{ route('admin.budget.sub.component.institute.store') }}" method="post">
                @csrf
                <input type="hidden" class="dt form-control" name="id" value="{{ $scib->id }}">

                <div class="row">

                  <div class="col-md-12">
                    <div class="form-row p-1">
                      <label class="control-label mr-3">Budget Type<span class="text-danger">*</span></label>
                      <label for="Monthly" class="control-label"> <input type="radio" name="type" @checked(old('type', $scib->type) == 'monthly') class="form-control p-2 ml-2 mr-2" value="monthly" id="Monthly">Monthly</label>
                      <label for="Yearly" class="control-label"> <input type="radio" name="type" @checked(old('type', $scib->type) == 'yearly') class="form-control p-2 ml-2 mr-2" value="yearly" id="Yearly">Yearly</label>
                      @error('component_id')
                      <strong class="text-danger">{{ $errors->first('component_id') }}</strong>
                      @enderror
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="control-label">Fiscal Year<span class="text-danger">*</span></label>
                      <select name="fiscal_year_id" class="form-control @error('fiscal_year_id') is-invalid @enderror" required>
                        <option value="">Choose a fiscal year</option>
                        @foreach($fsYears as $year)
                          <option value="{{ $year->id }}" @selected($year->id == old('fiscal_year_id',$scib->fiscal_year_id))>{{ $year->code }}</option>
                        @endforeach
                      </select>
                      @error('fiscal_year_id')
                      <strong class="text-danger">{{ $errors->first('fiscal_year_id') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="control-label">Institute<span class="text-danger">*</span></label>
                      <select name="institute_id" class="form-control @error('institute_id') is-invalid @enderror" required>
                        <option value="">Choose a Institute</option>
                        @foreach($institutes as $institute)
                          <option value="{{ $institute->id }}" @selected($institute->id == old('institute_id',$scib->institute_id))>{{ $institute->name }}</option>
                        @endforeach
                      </select>
                      @error('institute_id')
                      <strong class="text-danger">{{ $errors->first('institute_id') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="control-label">Component<span class="text-danger">*</span></label>
                      <select name="component_id" class="form-control @error('component_id') is-invalid @enderror" required>
                        <option value="">-- Select a component</option>
                        @foreach($budgets as $budget)
                          <option value="{{ $budget->id }}" @selected($budget->id == old('component_id',$scib->component_id))>{{ $budget->component->name }}
                            [ {{ $budget->annual_budget }} Tk. ]
                          </option>
                        @endforeach
                      </select>
                      @error('component_id')
                      <strong class="text-danger">{{ $errors->first('component_id') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label">Sub Component<span class="text-danger">*</span></label>
                      <select name="sub_component_id" class="form-control @error('sub_component_id') is-invalid @enderror" required>
                        <option value="">Choose a Sub Component</option>
                        @foreach($subcomponents as $subcomp)
                          <option value="{{ $subcomp->id }}" @selected($subcomp->id == old('sub_component_id',$scib->sub_component_id))>{{ $subcomp->name }}</option>
                        @endforeach
                      </select>
                      @error('sub_component_id')
                      <strong class="text-danger">{{ $errors->first('sub_component_id') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label"> Annual Budget<span class="text-danger">*</span></label>
                      <input type="number" min="0" name="annual_budget" placeholder=" Annual Budget" autocomplete="off" required
                             value="{{ old('annual_budget',$scib->annual_budget) }}"
                             class="form-control @error('annual_budget') is-invalid @enderror">
                      @error('annual_budget')
                      <strong class="text-danger">{{ $errors->first('annual_budget') }}</strong>
                      @enderror
                    </div>
                  </div>

                  {{--                  <div class="col-md-6">--}}
                  {{--                    <div class="form-group">--}}
                  {{--                      <label class="control-label"> org_proposed<span class="text-danger">*</span></label>--}}
                  {{--                      <input type="text" name="org_proposed" placeholder=" Anual Budget" autocomplete="off" required--}}
                  {{--                             value="{{ old('org_proposed',$scib->org_proposed) }}"--}}
                  {{--                             class="form-control @error('org_proposed') is-invalid @enderror">--}}
                  {{--                      @error('org_proposed')--}}
                  {{--                      <strong class="text-danger">{{ $errors->first('org_proposed') }}</strong>--}}
                  {{--                      @enderror--}}
                  {{--                    </div>--}}
                  {{--                  </div>--}}
                  {{--                  <div class="col-md-6">--}}
                  {{--                    <div class="form-group">--}}
                  {{--                      <label class="control-label"> revised<span class="text-danger">*</span></label>--}}
                  {{--                      <input type="text" name="revised" placeholder=" Anual Budget" autocomplete="off" required--}}
                  {{--                             value="{{ old('revised',$scib->revised) }}"--}}
                  {{--                             class="form-control @error('revised') is-invalid @enderror">--}}
                  {{--                      @error('revised')--}}
                  {{--                      <strong class="text-danger">{{ $errors->first('revised') }}</strong>--}}
                  {{--                      @enderror--}}
                  {{--                    </div>--}}
                  {{--                  </div>--}}

                  </div>

                <div class="row d-none month-area">
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="control-label">M1<span class="text-danger">*</span></label>
                      <input type="number" min="0" name="m1" step="any" placeholder="0.00" autocomplete="off" required
                             value="{{ old('m1',$scib->m1) }}"
                             class="form-control month_input @error('m1') is-invalid @enderror">
                      @error('m1')
                      <strong class="text-danger">{{ $errors->first('m1') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="control-label">M2<span class="text-danger">*</span></label>
                      <input type="number" min="0" name="m2" step="any" placeholder="0.00 " autocomplete="off" required
                             value="{{ old('m2',$scib->m2) }}"
                             class="form-control month_input @error('m2') is-invalid @enderror">
                      @error('m2')
                      <strong class="text-danger">{{ $errors->first('m2') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="control-label">M3<span class="text-danger">*</span></label>
                      <input type="number" min="0" name="m3" step="any" placeholder="0.00 " autocomplete="off" required
                             value="{{ old('m3',$scib->m3) }}"
                             class="form-control month_input @error('m3') is-invalid @enderror">
                      @error('m3')
                      <strong class="text-danger">{{ $errors->first('m3') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="control-label">M4<span class="text-danger">*</span></label>
                      <input type="number" min="0" name="m4" step="any" placeholder="0.00 " autocomplete="off" required
                             value="{{ old('m4',$scib->m4) }}"
                             class="form-control month_input @error('m4') is-invalid @enderror">
                      @error('m4')
                      <strong class="text-danger">{{ $errors->first('m4') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="control-label">M5<span class="text-danger">*</span></label>
                      <input type="number" min="0" name="m5" step="any" placeholder="0.00 " autocomplete="off" required
                             value="{{ old('m5',$scib->m5) }}"
                             class="form-control month_input @error('m5') is-invalid @enderror">
                      @error('m5')
                      <strong class="text-danger">{{ $errors->first('m5') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="control-label">M6<span class="text-danger">*</span></label>
                      <input type="number" min="0" name="m6" step="any" placeholder="0.00 " autocomplete="off" required
                             value="{{ old('m6',$scib->m6) }}"
                             class="form-control month_input @error('m6') is-invalid @enderror">
                      @error('m6')
                      <strong class="text-danger">{{ $errors->first('m6') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="control-label">M7<span class="text-danger">*</span></label>
                      <input type="number" min="0" name="m7" step="any" placeholder="0.00 " autocomplete="off" required
                             value="{{ old('m7',$scib->m7) }}"
                             class="form-control month_input @error('m7') is-invalid @enderror">
                      @error('m7')
                      <strong class="text-danger">{{ $errors->first('m7') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="control-label">M8<span class="text-danger">*</span></label>
                      <input type="number" min="0" name="m8" step="any" placeholder="0.00 " autocomplete="off" required
                             value="{{ old('m8',$scib->m8) }}"
                             class="form-control month_input @error('m8') is-invalid @enderror">
                      @error('m8')
                      <strong class="text-danger">{{ $errors->first('m8') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="control-label">M9<span class="text-danger">*</span></label>
                      <input type="number" min="0" name="m9" step="any" placeholder="0.00 " autocomplete="off" required
                             value="{{ old('m9',$scib->m9) }}"
                             class="form-control month_input @error('m9') is-invalid @enderror">
                      @error('m9')
                      <strong class="text-danger">{{ $errors->first('m9') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="control-label">M10<span class="text-danger">*</span></label>
                      <input type="number" min="0" name="m10" step="any" placeholder="0.00 " autocomplete="off" required
                             value="{{ old('m10',$scib->m10) }}"
                             class="form-control month_input @error('m10') is-invalid @enderror">
                      @error('m10')
                      <strong class="text-danger">{{ $errors->first('m10') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="control-label">M11<span class="text-danger">*</span></label>
                      <input type="number" min="0" name="m11" step="any" placeholder="0.00 " autocomplete="off" required
                             value="{{ old('m11',$scib->m11) }}"
                             class="form-control month_input @error('m11') is-invalid @enderror">
                      @error('m11')
                      <strong class="text-danger">{{ $errors->first('m11') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="control-label">M12<span class="text-danger">*</span></label>
                      <input type="number" min="0" name="m12" step="any" placeholder="0.00 " autocomplete="off" required
                             value="{{ old('m12',$scib->m12) }}"
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
      $('select[name="institute_id"]').change(function () {
        populateComponentBudget()
      });
      $('select[name="fiscal_year_id"]').change(function () {
        populateComponentBudget()
      });

      populateComponentBudget()
      function populateComponentBudget() {
        const $this = $('select[name="component_id"]')
        const year = $('select[name="fiscal_year_id"]').val()
        const institute = $('select[name="institute_id"]').val()
        $this.html('');
        $this.html('<option value="">-- Select a component --</option>');
        if (year === '' || year === null || institute === '' || institute === null) {
          return o;
        }

        const oldCompId = '{{ old('component_id', $scib->component_institute_budget_id) }}'

        $.ajax({
          url: "{{url('api/component-institute-budget')}}/" + year + '/' + institute,
          type: "GET",
          dataType: 'json',
          success: function (result) {
            $.each(result.budgets, function (key, value) {
              $this.append('<option value="' + value.id + '" '+ ((Number(oldCompId) === Number(value.id)) ? "selected" : "") +' data-component-id="' + value.component.id + '" ' + (value.disabled ? "disabled" : "") + '>' + value.component.name + ' [' + value.availableBudget + ' TK]</option>');
            });

          }
        });
      }

      $('select[name="component_id"]').change(function () {
        const $this = $('select[name="sub_component_id"]')
        var idDivision = $(this).find(':selected').data('component-id')
        $this.html('');
        $this.html('<option value="">-- Select a sub component --</option>');
        $.ajax({
          url: "{{url('api/sub-component')}}/" + idDivision,
          type: "GET",
          dataType: 'json',
          success: function (result) {
            $.each(result.subcomponent, function (key, value) {
              $this.append('<option value="' + value.id + '">' + value.name + '</option>');
            });

          }
        });
      });
    });
  </script>
@endsection
