@extends('layout.admin')


@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/summernote/summernote-bs4.css') }}">
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <section class="panel">
                        <header class="panel-heading">
                            <h2 class="panel-title">TTP FORM</h2>
                        </header>
                        <div class="panel-body">
                            {{--                            @if (\App\Helper\CustomHelper::canView('List Of Event', 'Super Admin')) --}}
                            {{--                                <div class="row"> --}}
                            {{--                                    <div class="col-lg-12 col-md-12 col-xl-12 text-right mb-3"> --}}
                            {{--                                        <a href="" class="brn btn-success btn-sm">List of Events</a> --}}
                            {{--                                    </div> --}}
                            {{--                                </div> --}}
                            {{--                            @endif --}}
                            @if (session()->has('status'))
                                {!! session()->get('status') !!}
                            @endif

                            <form action="" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label">Procurement Type<span
                                                    class="text-danger">*</span></label>
                                            <select name="app" id="app"
                                                class="form-control @error('app') is-invalid @enderror">
                                                <option value="">Choose an period</option>
                                                <option value="0">Goods</option>
                                                <option value="1">Works</option>
                                                <option value="2">Services</option>
                                            </select>
                                            @error('app')
                                                <strong class="text-danger">{{ $errors->first('app') }}</strong>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label">Budget<span class="text-danger">*</span></label>
                                            <select name="budget" id="budget"
                                                class="form-control @error('budget') is-invalid @enderror">
                                                <option value="">Choose an period</option>
                                                <option value="0">Development</option>
                                                <option value="1">Revenue</option>
                                            </select>
                                            @error('budget')
                                                <strong class="text-danger">{{ $errors->first('budget') }}</strong>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="description" class="control-label">Description (Optional)</label>
                                            <textarea name="description" placeholder="Description" autocomplete="off" id="summernote"
                                                class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                                            @error('description')
                                                <strong class="text-danger">{{ $errors->first('description') }}</strong>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="control-label">Unit</label>
                                            <input type="number" name="unit" placeholder="Enter unit" autocomplete="off"
                                                value="{{ old('unit') }}"
                                                class="form-control @error('unit') is-invalid @enderror">
                                            @error('unit')
                                                <strong class="text-danger">{{ $errors->first('unit') }}</strong>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="control-label">Quantity</label>
                                            <input type="number" name="quantity" placeholder="Enter quantity"
                                                autocomplete="off" value="{{ old('quantity') }}"
                                                class="form-control @error('quantity') is-invalid @enderror">
                                            @error('quantity')
                                                <strong class="text-danger">{{ $errors->first('quantity') }}</strong>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="control-label">Procurement Method and type<span
                                                    class="text-danger">*</span></label>
                                            <select name="budget" id="procurement_method"
                                                class="form-control @error('procurement_method') is-invalid @enderror">
                                                <option value="">Choose an period</option>
                                                <option value="0">OTM (ICT)</option>
                                                <option value="1">LTM National</option>
                                            </select>
                                            @error('procurement_method')
                                                <strong class="text-danger">{{ $errors->first('procurement_method') }}</strong>
                                            @enderror
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="control-label">Contact Approving Authority<span
                                                    class="text-danger">*</span></label>
                                            <select name="contact_pproving" id="contact_pproving"
                                                class="form-control @error('contact_pproving') is-invalid @enderror">
                                                <option value="">Choose an period</option>
                                                <option value="0">Ministry</option>
                                                <option value="1">Hope</option>
                                            </select>
                                            @error('contact_pproving')
                                                <strong class="text-danger">{{ $errors->first('contact_pproving') }}</strong>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="control-label">Source of Founds <span
                                                    class="text-danger">*</span></label>
                                            <select name="source_founds" id="source_founds"
                                                class="form-control @error('source_founds') is-invalid @enderror">
                                                <option value="">Choose an period</option>
                                                <option value="0">ADB</option>
                                                <option value="1">GOB</option>
                                            </select>
                                            @error('source_founds')
                                                <strong class="text-danger">{{ $errors->first('source_founds') }}</strong>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="control-label">Estimated cost. Cost in BDT. (Lakh)</label>
                                            <input type="number" name="estimated_cost"
                                                placeholder="Enter estimated cost" autocomplete="off"
                                                value="{{ old('estimated_cost') }}"
                                                class="form-control @error('estimated_cost') is-invalid @enderror">
                                            @error('estimated_cost')
                                                <strong class="text-danger">{{ $errors->first('estimated_cost') }}</strong>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <header class="panel-heading mt-5">
                                    <h2 class="panel-title">Time Code for Process</h2>
                                </header>

                                <div class="row mt-4">
                                    <div class="col-lg-12 col-md-12 col-xl-12 text-left mb-3">
                                        <a href="" class="brn btn-success btn-sm">Invite Advertise Tender</a>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-sm-12 col-md-12 col-lg-4">
                                        <div class="form-group">
                                            <label for="tcp_planned_dates">Planned Dates<span
                                                    class="text-danger">*</span></label>
                                            <input type="date" name="tcp_planned_dates" id="tcp_planned_dates"
                                                value="{{ old('tcp_planned_dates') }}" placeholder=""
                                                class="form-control @error('tcp_planned_dates') is-invalid @enderror">
                                            @error('tcp_planned_dates')
                                                <strong class="text-danger">{{ $errors->first('tcp_planned_dates') }}</strong>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-4">
                                        <div class="form-group">
                                            <label for="">Planned Days<span class="text-danger">*</span></label>
                                            <input type="number" name="tcp_planned_days" id="tcp_planned_days"
                                                value="{{ old('tcp_planned_days') }}" placeholder=""
                                                class="form-control @error('tcp_planned_days') is-invalid @enderror">
                                            @error('tcp_planned_days')
                                                <strong class="text-danger">{{ $errors->first('tcp_planned_days') }}</strong>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-12 col-lg-4">
                                        <div class="form-group">
                                            <label for="tcp_actual_dates">Actual Dates<span
                                                    class="text-danger">*</span></label>
                                            <input type="date" name="tcp_actual_dates" id="tcp_actual_dates"
                                                value="{{ old('tcp_actual_dates') }}" placeholder=""
                                                class="form-control @error('tcp_actual_dates') is-invalid @enderror">
                                            @error('tcp_actual_dates')
                                                <strong class="text-danger">{{ $errors->first('tcp_actual_dates') }}</strong>
                                            @enderror
                                        </div>
                                    </div>

                                </div>



                                <div class="row mt-4">
                                    <div class="col-lg-12 col-md-12 col-xl-12 text-left mb-3">
                                        <a href="" class="brn btn-success btn-sm">Tender Opening</a>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-sm-12 col-md-12 col-lg-4">
                                        <div class="form-group">
                                            <label for="to_planned_dates">Planned Dates<span
                                                    class="text-danger">*</span></label>
                                            <input type="date" name="to_planned_dates" id="to_planned_dates"
                                                value="{{ old('to_planned_dates') }}" placeholder=""
                                                class="form-control @error('to_planned_dates') is-invalid @enderror">
                                            @error('to_planned_dates')
                                                <strong class="text-danger">{{ $errors->first('to_planned_dates') }}</strong>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-4">
                                        <div class="form-group">
                                            <label for=to_planned_days">Planned Days<span
                                                    class="text-danger">*</span></label>
                                            <input type="number" name="to_planned_days" id="to_planned_days"
                                                value="{{ old('to_planned_days') }}" placeholder=""
                                                class="form-control @error('to_planned_days') is-invalid @enderror">
                                            @error('to_planned_days')
                                                <strong class="text-danger">{{ $errors->first('to_planned_days') }}</strong>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-12 col-lg-4">
                                        <div class="form-group">
                                            <label for="to_actual_dates">Actual Dates<span
                                                    class="text-danger">*</span></label>
                                            <input type="date" name="to_actual_dates" id="to_actual_dates"
                                                value="{{ old('to_actual_dates') }}" placeholder=""
                                                class="form-control @error('to_actual_dates') is-invalid @enderror">
                                            @error('to_actual_dates')
                                                <strong class="text-danger">{{ $errors->first('to_actual_dates') }}</strong>
                                            @enderror
                                        </div>
                                    </div>

                                </div>

                                <div class="row mt-4">
                                    <div class="col-lg-12 col-md-12 col-xl-12 text-left mb-3">
                                        <a href="" class="brn btn-success btn-sm">Tender Evaluation</a>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-sm-12 col-md-12 col-lg-4">
                                        <div class="form-group">
                                            <label for="te_to_planned_dates">Planned Dates<span
                                                    class="text-danger">*</span></label>
                                            <input type="date" name="te_to_planned_dates" id="te_to_planned_dates"
                                                value="{{ old('te_to_planned_dates') }}" placeholder=""
                                                class="form-control @error('te_to_planned_dates') is-invalid @enderror">
                                            @error('te_to_planned_dates')
                                                <strong
                                                    class="text-danger">{{ $errors->first('te_to_planned_dates') }}</strong>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-4">
                                        <div class="form-group">
                                            <label for=te_to_planned_days">Planned Days<span
                                                    class="text-danger">*</span></label>
                                            <input type="number" name="te_to_planned_days" id="te_to_planned_days"
                                                value="{{ old('te_to_planned_days') }}" placeholder=""
                                                class="form-control @error('te_to_planned_days') is-invalid @enderror">
                                            @error('te_to_planned_days')
                                                <strong
                                                    class="text-danger">{{ $errors->first('te_to_planned_days') }}</strong>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-12 col-lg-4">
                                        <div class="form-group">
                                            <label for="te_to_actual_dates">Actual Dates<span
                                                    class="text-danger">*</span></label>
                                            <input type="date" name="te_to_actual_dates" id="te_to_actual_dates"
                                                value="{{ old('te_to_actual_dates') }}" placeholder=""
                                                class="form-control @error('te_to_actual_dates') is-invalid @enderror">
                                            @error('te_to_actual_dates')
                                                <strong
                                                    class="text-danger">{{ $errors->first('te_to_actual_dates') }}</strong>
                                            @enderror
                                        </div>
                                    </div>

                                </div>



                                <div class="row mt-4">
                                    <div class="col-lg-12 col-md-12 col-xl-12 text-left mb-3">
                                        <a href="" class="brn btn-success btn-sm">Approval to Award</a>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-sm-12 col-md-12 col-lg-4">
                                        <div class="form-group">
                                            <label for="ata_planned_dates">Planned Dates<span
                                                    class="text-danger">*</span></label>
                                            <input type="date" name="ata_planned_dates" id="ata_planned_dates"
                                                value="{{ old('ata_planned_dates') }}" placeholder=""
                                                class="form-control @error('ata_planned_dates') is-invalid @enderror">
                                            @error('ata_planned_dates')
                                                <strong class="text-danger">{{ $errors->first('ata_planned_dates') }}</strong>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-4">
                                        <div class="form-group">
                                            <label for=ata_planned_days">Planned Days<span
                                                    class="text-danger">*</span></label>
                                            <input type="number" name="ata_planned_days" id="ata_planned_days"
                                                value="{{ old('ata_planned_days') }}" placeholder=""
                                                class="form-control @error('ata_planned_days') is-invalid @enderror">
                                            @error('ata_planned_days')
                                                <strong class="text-danger">{{ $errors->first('ata_planned_days') }}</strong>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-12 col-lg-4">
                                        <div class="form-group">
                                            <label for="ata_actual_dates">Actual Dates<span
                                                    class="text-danger">*</span></label>
                                            <input type="date" name="ata_actual_dates" id="ata_actual_dates"
                                                value="{{ old('ata_actual_dates') }}" placeholder=""
                                                class="form-control @error('ata_actual_dates') is-invalid @enderror">
                                            @error('ata_actual_dates')
                                                <strong class="text-danger">{{ $errors->first('ata_actual_dates') }}</strong>
                                            @enderror
                                        </div>
                                    </div>

                                </div>



                                <div class="row mt-4">
                                    <div class="col-lg-12 col-md-12 col-xl-12 text-left mb-3">
                                        <a href="" class="brn btn-success btn-sm">Notification of Award</a>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-sm-12 col-md-12 col-lg-4">
                                        <div class="form-group">
                                            <label for="noa_planned_dates">Planned Dates<span
                                                    class="text-danger">*</span></label>
                                            <input type="date" name="noa_planned_dates" id="noa_planned_dates"
                                                value="{{ old('noa_planned_dates') }}" placeholder=""
                                                class="form-control @error('noa_planned_dates') is-invalid @enderror">
                                            @error('noa_planned_dates')
                                                <strong class="text-danger">{{ $errors->first('noa_planned_dates') }}</strong>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-4">
                                        <div class="form-group">
                                            <label for=noa_planned_days">Planned Days<span
                                                    class="text-danger">*</span></label>
                                            <input type="number" name="noa_planned_days" id="noa_planned_days"
                                                value="{{ old('noa_planned_days') }}" placeholder=""
                                                class="form-control @error('noa_planned_days') is-invalid @enderror">
                                            @error('noa_planned_days')
                                                <strong class="text-danger">{{ $errors->first('noa_planned_days') }}</strong>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-12 col-lg-4">
                                        <div class="form-group">
                                            <label for="noa_actual_dates">Actual Dates<span
                                                    class="text-danger">*</span></label>
                                            <input type="date" name="noa_actual_dates" id="noa_actual_dates"
                                                value="{{ old('noa_actual_dates') }}" placeholder=""
                                                class="form-control @error('noa_actual_dates') is-invalid @enderror">
                                            @error('noa_actual_dates')
                                                <strong class="text-danger">{{ $errors->first('noa_actual_dates') }}</strong>
                                            @enderror
                                        </div>
                                    </div>

                                </div>


                                <div class="row mt-4">
                                    <div class="col-lg-12 col-md-12 col-xl-12 text-left mb-3">
                                        <a href="" class="brn btn-success btn-sm">Signing of Contact</a>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-sm-12 col-md-12 col-lg-4">
                                        <div class="form-group">
                                            <label for="soc_planned_dates">Planned Dates<span
                                                    class="text-danger">*</span></label>
                                            <input type="date" name="soc_planned_dates" id="soc_planned_dates"
                                                value="{{ old('soc_planned_dates') }}" placeholder=""
                                                class="form-control @error('soc_planned_dates') is-invalid @enderror">
                                            @error('soc_planned_dates')
                                                <strong class="text-danger">{{ $errors->first('soc_planned_dates') }}</strong>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-4">
                                        <div class="form-group">
                                            <label for=soc_planned_days">Planned Days<span
                                                    class="text-danger">*</span></label>
                                            <input type="number" name="soc_planned_days" id="soc_planned_days"
                                                value="{{ old('soc_planned_days') }}" placeholder=""
                                                class="form-control @error('soc_planned_days') is-invalid @enderror">
                                            @error('soc_planned_days')
                                                <strong class="text-danger">{{ $errors->first('soc_planned_days') }}</strong>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-12 col-lg-4">
                                        <div class="form-group">
                                            <label for="soc_actual_dates">Actual Dates<span
                                                    class="text-danger">*</span></label>
                                            <input type="date" name="soc_actual_dates" id="soc_actual_dates"
                                                value="{{ old('soc_actual_dates') }}" placeholder=""
                                                class="form-control @error('soc_actual_dates') is-invalid @enderror">
                                            @error('soc_actual_dates')
                                                <strong class="text-danger">{{ $errors->first('soc_actual_dates') }}</strong>
                                            @enderror
                                        </div>
                                    </div>

                                </div>

                                <div class="row mt-4">
                                    <div class="col-lg-12 col-md-12 col-xl-12 text-left mb-3">
                                        <a href="" class="brn btn-success btn-sm">Total time to Contact
                                            Signature</a>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-sm-12 col-md-12 col-lg-4">
                                        <div class="form-group">
                                            <label for="tcs_planned_dates">Planned Dates<span
                                                    class="text-danger">*</span></label>
                                            <input type="date" name="tcs_planned_dates" id="tcs_planned_dates"
                                                value="{{ old('tcs_planned_dates') }}" placeholder=""
                                                class="form-control @error('tcs_planned_dates') is-invalid @enderror">
                                            @error('tcs_planned_dates')
                                                <strong class="text-danger">{{ $errors->first('tcs_planned_dates') }}</strong>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-4">
                                        <div class="form-group">
                                            <label for=tcs_planned_days">Planned Days<span
                                                    class="text-danger">*</span></label>
                                            <input type="number" name="tcs_planned_days" id="tcs_planned_days"
                                                value="{{ old('tcs_planned_days') }}" placeholder=""
                                                class="form-control @error('tcs_planned_days') is-invalid @enderror">
                                            @error('tcs_planned_days')
                                                <strong class="text-danger">{{ $errors->first('tcs_planned_days') }}</strong>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-12 col-lg-4">
                                        <div class="form-group">
                                            <label for="tcs_actual_dates">Actual Dates<span
                                                    class="text-danger">*</span></label>
                                            <input type="date" name="tcs_actual_dates" id="tcs_actual_dates"
                                                value="{{ old('tcs_actual_dates') }}" placeholder=""
                                                class="form-control @error('tcs_actual_dates') is-invalid @enderror">
                                            @error('tcs_actual_dates')
                                                <strong class="text-danger">{{ $errors->first('tcs_actual_dates') }}</strong>
                                            @enderror
                                        </div>
                                    </div>

                                </div>


                                <div class="row mt-4">
                                    <div class="col-lg-12 col-md-12 col-xl-12 text-left mb-3">
                                        <a href="" class="brn btn-success btn-sm">Time for Completion</a>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-sm-12 col-md-12 col-lg-4">
                                        <div class="form-group">
                                            <label for="tfc_planned_dates">Planned Dates<span
                                                    class="text-danger">*</span></label>
                                            <input type="date" name="tfc_planned_dates" id="tfc_planned_dates"
                                                value="{{ old('tfc_planned_dates') }}" placeholder=""
                                                class="form-control @error('tfc_planned_dates') is-invalid @enderror">
                                            @error('tfc_planned_dates')
                                                <strong class="text-danger">{{ $errors->first('tfc_planned_dates') }}</strong>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-4">
                                        <div class="form-group">
                                            <label for=tfc_planned_days">Planned Days<span
                                                    class="text-danger">*</span></label>
                                            <input type="number" name="tfc_planned_days" id="tfc_planned_days"
                                                value="{{ old('tfc_planned_days') }}" placeholder=""
                                                class="form-control @error('tfc_planned_days') is-invalid @enderror">
                                            @error('tfc_planned_days')
                                                <strong class="text-danger">{{ $errors->first('tfc_planned_days') }}</strong>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-12 col-lg-4">
                                        <div class="form-group">
                                            <label for="tfc_actual_dates">Actual Dates<span
                                                    class="text-danger">*</span></label>
                                            <input type="date" name="tfc_actual_dates" id="tfc_actual_dates"
                                                value="{{ old('tfc_actual_dates') }}" placeholder=""
                                                class="form-control @error('tfc_actual_dates') is-invalid @enderror">
                                            @error('tfc_actual_dates')
                                                <strong class="text-danger">{{ $errors->first('tfc_actual_dates') }}</strong>
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
    <script src="{{ asset('assets/admin/plugins/summernote/summernote-bs4.js') }}"></script>
    <script>
        $(".yearPicker").datepicker({
            format: "yyyy",
            viewMode: "years",
            minViewMode: "years",
            startDate: '-50y',
            endDate: '+30y',
            autoclose: true
        });
        // summernote
        $(document).ready(function() {
            $('#summernote').summernote({
                placeholder: 'Write here ...',
                tabSize: 2,
                height: 100
            });
        })
    </script>
@endsection
