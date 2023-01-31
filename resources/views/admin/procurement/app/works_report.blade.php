@extends('layout.admin')

@section('stylesheet')
    <script src="{{ asset('assets/admin/plugins/sweetalert2/sweetalert2.all.js') }}"></script>
    <style>
        .tpp-table-heading{
            min-width: 240px;
        }
        .procurement-type{
            margin-top: 28px !important;
        }
        .table-head-bg{
            background-color: #FFEEBA !important;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <section class="panel">
                        <header class="panel-heading">
                            <h2 class="panel-title">Annual Procurement Plan</h2>
                        </header>
                        <div class="panel-body">
                            @if (session()->has('status'))
                                {!! session()->get('status') !!}
                            @endif
                            {{--              @if (\App\Helper\CustomHelper::canView('Create Training', 'Super Admin')) --}}
                            {{-- <div class="row">
                <div class="col-lg-12 col-md-12 col-xl-12 text-right mb-3">
                  <a href="{{ route('admin.training.create') }}" class="brn btn-success btn-sm">New Training</a>
                </div>
              </div> --}}
                            {{--              @endif --}}
                            <div class="app-report-heading-part row my-5">
                                <div class="col-8">
                                    <h5>Ministry/Division:<span class="text-secondary"> Education Ministry</span></h5>
                                    <h5>Agency:<span class="text-secondary"> Education</span> </h5>
                                    <h5>Procurement Entity Name & Code : <span class="text-secondary"> Education Services #303</span></h5>
                                    <h5>Project / Programme Name & Code : <span class="text-secondary">Technical Accelaration #202</span></h5>
                                </div>
                                <div class="col-4">
                                    <h4 class="text-right ">Type : <span class="bg-success text-light p-2 rounded">WORKS</span></h4>
                                    <h4 class="text-right procurement-type" >Budget : <span class="bg-info text-light p-2 rounded">Development</span></h4>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                                    cellspacing="0" width="100%" style="font-size: 14px">

                                    <thead>
                                        <tr class="table-head-bg">
                                            <th class="tpp-table-heading">Package Number</th>
                                            <th class="tpp-table-heading">Description of
                                                Procurement Item</th>
                                            <th class="tpp-table-heading">Unit</th>
                                            <th class="tpp-table-heading">Quantity</th>
                                            <th class="tpp-table-heading">Procurement Method
                                                & Type</th>
                                            <th class="tpp-table-heading">Contract Approving
                                                Authority</th>
                                            <th class="tpp-table-heading">Source of Funds</th>
                                            <th class="tpp-table-heading">Estd Cost
                                                In Million(Tk.)</th>
                                            <th width="300px">Time Code for
                                                Process</th>
                                            <th class="tpp-table-heading">Not used in Goods</th>
                                            <th class="tpp-table-heading">Invite/Advertise Tender</th>
                                            <th class="tpp-table-heading">Tender Opening</th>
                                            <th class="tpp-table-heading">Tender Evalution</th>
                                            <th class="tpp-table-heading">Approval to Award</th>
                                            <th class="tpp-table-heading">Notification of Award</th>
                                            <th class="tpp-table-heading">Signing of Contact</th>
                                            <th class="tpp-table-heading">Total Time to Contact Signature</th>
                                            <th class="tpp-table-heading">Time for Completion of Contract</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @foreach ($datas as $key => $val) --}}
                                        {{-- <tr class="@if ($key % 2 == 0)gradeX @else gradeC @endif"> --}}
                                        <tr>
                                            @for ($i = 1; $i <= 18; $i++)
                                        <td class="p-1 text-center">{{$i}}</td>
                                        @endfor </tr> 
                                        <tr class="">
                                            <td class="p-1 ">WD1</td>
                                            <td class="p-1">Perchase of ten steel Fabricated water lowers</td>
                                            <td class="p-1">No.</td>
                                            <td class="p-1">23</td>
                                            <td class="p-1">OTM(ICT)</td>
                                            <td class="p-1">Ministry</td>
                                            <td class="p-1">ADB</td>
                                            
                                            <td class="p-1">125</td>
                                            <td class="m-0 p-0">
                                                <table class="">
                                                    <tr>
                                                        <th class="tpp-table-heading">Planned Dates</th>
                                                    </tr>
                                                    <tr><th class="tpp-table-heading">Planned Days</th>
                                                    </tr>
                                                    <tr><th class="tpp-table-heading">Actual Dates</th>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td class="m-0 p-0">
                                                <table class="">
                                                    <tr>
                                                        <td class="tpp-table-heading">10- Jan-2022</td>
                                                    </tr>
                                                    <tr><td class="tpp-table-heading">21</td>
                                                    </tr>
                                                    <tr><td class="tpp-table-heading">23 Jan, 2022</td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td class="m-0 p-0">
                                                <table class="">
                                                    <tr>
                                                        <td class="tpp-table-heading">10- Jan-2022</td>
                                                    </tr>
                                                    <tr><td class="tpp-table-heading">21</td>
                                                    </tr>
                                                    <tr><td class="tpp-table-heading">23 Jan, 2022</td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td class="m-0 p-0">
                                                <table class="">
                                                    <tr>
                                                        <td class="tpp-table-heading">10- Jan-2022</td>
                                                    </tr>
                                                    <tr><td class="tpp-table-heading">21</td>
                                                    </tr>
                                                    <tr><td class="tpp-table-heading">23 Jan, 2022</td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td class="m-0 p-0">
                                                <table class="">
                                                    <tr>
                                                        <td class="tpp-table-heading">10- Jan-2022</td>
                                                    </tr>
                                                    <tr><td class="tpp-table-heading">21</td>
                                                    </tr>
                                                    <tr><td class="tpp-table-heading">23 Jan, 2022</td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td class="m-0 p-0">
                                                <table class="">
                                                    <tr>
                                                        <td class="tpp-table-heading">10- Jan-2022</td>
                                                    </tr>
                                                    <tr><td class="tpp-table-heading">21</td>
                                                    </tr>
                                                    <tr><td class="tpp-table-heading">23 Jan, 2022</td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td class="m-0 p-0">
                                                <table class="">
                                                    <tr>
                                                        <td class="tpp-table-heading">10- Jan-2022</td>
                                                    </tr>
                                                    <tr><td class="tpp-table-heading">21</td>
                                                    </tr>
                                                    <tr><td class="tpp-table-heading">23 Jan, 2022</td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td class="m-0 p-0">
                                                <table class="">
                                                    <tr>
                                                        <td class="tpp-table-heading">10- Jan-2022</td>
                                                    </tr>
                                                    <tr><td class="tpp-table-heading">21</td>
                                                    </tr>
                                                    <tr><td class="tpp-table-heading">23 Jan, 2022</td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td class="m-0 p-0">
                                                <table class="">
                                                    <tr>
                                                        <td class="tpp-table-heading">10- Jan-2022</td>
                                                    </tr>
                                                    <tr><td class="tpp-table-heading">21</td>
                                                    </tr>
                                                    <tr><td class="tpp-table-heading">23 Jan, 2022</td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td class="m-0 p-0">
                                                <table class="">
                                                    <tr>
                                                        <td class="tpp-table-heading">10- Jan-2022</td>
                                                    </tr>
                                                    <tr><td class="tpp-table-heading">21</td>
                                                    </tr>
                                                    <tr><td class="tpp-table-heading">23 Jan, 2022</td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr class="">
                                            <td class="p-1 ">WD2</td>
                                            <td class="p-1">Perchase of ten steel Fabricated water lowers</td>
                                            <td class="p-1">No.</td>
                                            <td class="p-1">23</td>
                                            <td class="p-1">OTM(ICT)</td>
                                            <td class="p-1">Ministry</td>
                                            <td class="p-1">ADB</td>
                                            
                                            <td class="p-1">125</td>
                                            <td class="m-0 p-0">
                                                <table class="">
                                                    <tr>
                                                        <th class="tpp-table-heading">Planned Dates</th>
                                                    </tr>
                                                    <tr><th class="tpp-table-heading">Planned Days</th>
                                                    </tr>
                                                    <tr><th class="tpp-table-heading">Actual Dates</th>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td class="m-0 p-0">
                                                <table class="">
                                                    <tr>
                                                        <td class="tpp-table-heading">10- Jan-2022</td>
                                                    </tr>
                                                    <tr><td class="tpp-table-heading">21</td>
                                                    </tr>
                                                    <tr><td class="tpp-table-heading">23 Jan, 2022</td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td class="m-0 p-0">
                                                <table class="">
                                                    <tr>
                                                        <td class="tpp-table-heading">10- Jan-2022</td>
                                                    </tr>
                                                    <tr><td class="tpp-table-heading">21</td>
                                                    </tr>
                                                    <tr><td class="tpp-table-heading">23 Jan, 2022</td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td class="m-0 p-0">
                                                <table class="">
                                                    <tr>
                                                        <td class="tpp-table-heading">10- Jan-2022</td>
                                                    </tr>
                                                    <tr><td class="tpp-table-heading">21</td>
                                                    </tr>
                                                    <tr><td class="tpp-table-heading">23 Jan, 2022</td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td class="m-0 p-0">
                                                <table class="">
                                                    <tr>
                                                        <td class="tpp-table-heading">10- Jan-2022</td>
                                                    </tr>
                                                    <tr><td class="tpp-table-heading">21</td>
                                                    </tr>
                                                    <tr><td class="tpp-table-heading">23 Jan, 2022</td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td class="m-0 p-0">
                                                <table class="">
                                                    <tr>
                                                        <td class="tpp-table-heading">10- Jan-2022</td>
                                                    </tr>
                                                    <tr><td class="tpp-table-heading">21</td>
                                                    </tr>
                                                    <tr><td class="tpp-table-heading">23 Jan, 2022</td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td class="m-0 p-0">
                                                <table class="">
                                                    <tr>
                                                        <td class="tpp-table-heading">10- Jan-2022</td>
                                                    </tr>
                                                    <tr><td class="tpp-table-heading">21</td>
                                                    </tr>
                                                    <tr><td class="tpp-table-heading">23 Jan, 2022</td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td class="m-0 p-0">
                                                <table class="">
                                                    <tr>
                                                        <td class="tpp-table-heading">10- Jan-2022</td>
                                                    </tr>
                                                    <tr><td class="tpp-table-heading">21</td>
                                                    </tr>
                                                    <tr><td class="tpp-table-heading">23 Jan, 2022</td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td class="m-0 p-0">
                                                <table class="">
                                                    <tr>
                                                        <td class="tpp-table-heading">10- Jan-2022</td>
                                                    </tr>
                                                    <tr><td class="tpp-table-heading">21</td>
                                                    </tr>
                                                    <tr><td class="tpp-table-heading">23 Jan, 2022</td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td class="m-0 p-0">
                                                <table class="">
                                                    <tr>
                                                        <td class="tpp-table-heading">10- Jan-2022</td>
                                                    </tr>
                                                    <tr><td class="tpp-table-heading">21</td>
                                                    </tr>
                                                    <tr><td class="tpp-table-heading">23 Jan, 2022</td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr class="">
                                            <td class="p-1 ">WD3</td>
                                            <td class="p-1">Perchase of ten steel Fabricated water lowers</td>
                                            <td class="p-1">No.</td>
                                            <td class="p-1">23</td>
                                            <td class="p-1">OTM(ICT)</td>
                                            <td class="p-1">Ministry</td>
                                            <td class="p-1">ADB</td>
                                            
                                            <td class="p-1">125</td>
                                            <td class="m-0 p-0">
                                                <table class="">
                                                    <tr>
                                                        <th class="tpp-table-heading">Planned Dates</th>
                                                    </tr>
                                                    <tr><th class="tpp-table-heading">Planned Days</th>
                                                    </tr>
                                                    <tr><th class="tpp-table-heading">Actual Dates</th>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td class="m-0 p-0">
                                                <table class="">
                                                    <tr>
                                                        <td class="tpp-table-heading">10- Jan-2022</td>
                                                    </tr>
                                                    <tr><td class="tpp-table-heading">21</td>
                                                    </tr>
                                                    <tr><td class="tpp-table-heading">23 Jan, 2022</td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td class="m-0 p-0">
                                                <table class="">
                                                    <tr>
                                                        <td class="tpp-table-heading">10- Jan-2022</td>
                                                    </tr>
                                                    <tr><td class="tpp-table-heading">21</td>
                                                    </tr>
                                                    <tr><td class="tpp-table-heading">23 Jan, 2022</td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td class="m-0 p-0">
                                                <table class="">
                                                    <tr>
                                                        <td class="tpp-table-heading">10- Jan-2022</td>
                                                    </tr>
                                                    <tr><td class="tpp-table-heading">21</td>
                                                    </tr>
                                                    <tr><td class="tpp-table-heading">23 Jan, 2022</td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td class="m-0 p-0">
                                                <table class="">
                                                    <tr>
                                                        <td class="tpp-table-heading">10- Jan-2022</td>
                                                    </tr>
                                                    <tr><td class="tpp-table-heading">21</td>
                                                    </tr>
                                                    <tr><td class="tpp-table-heading">23 Jan, 2022</td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td class="m-0 p-0">
                                                <table class="">
                                                    <tr>
                                                        <td class="tpp-table-heading">10- Jan-2022</td>
                                                    </tr>
                                                    <tr><td class="tpp-table-heading">21</td>
                                                    </tr>
                                                    <tr><td class="tpp-table-heading">23 Jan, 2022</td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td class="m-0 p-0">
                                                <table class="">
                                                    <tr>
                                                        <td class="tpp-table-heading">10- Jan-2022</td>
                                                    </tr>
                                                    <tr><td class="tpp-table-heading">21</td>
                                                    </tr>
                                                    <tr><td class="tpp-table-heading">23 Jan, 2022</td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td class="m-0 p-0">
                                                <table class="">
                                                    <tr>
                                                        <td class="tpp-table-heading">10- Jan-2022</td>
                                                    </tr>
                                                    <tr><td class="tpp-table-heading">21</td>
                                                    </tr>
                                                    <tr><td class="tpp-table-heading">23 Jan, 2022</td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td class="m-0 p-0">
                                                <table class="">
                                                    <tr>
                                                        <td class="tpp-table-heading">10- Jan-2022</td>
                                                    </tr>
                                                    <tr><td class="tpp-table-heading">21</td>
                                                    </tr>
                                                    <tr><td class="tpp-table-heading">23 Jan, 2022</td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td class="m-0 p-0">
                                                <table class="">
                                                    <tr>
                                                        <td class="tpp-table-heading">10- Jan-2022</td>
                                                    </tr>
                                                    <tr><td class="tpp-table-heading">21</td>
                                                    </tr>
                                                    <tr><td class="tpp-table-heading">23 Jan, 2022</td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <h5 class="my-4" >Total Value of Works Procurement : <span class="bg-info text-light p-2 rounded">340 Millions (TK.)</span></h5>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>

    {{-- works revenue --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <section class="panel">
                        <header class="panel-heading">
                            <h2 class="panel-title">Annual Procurement Plan</h2>
                        </header>
                        <div class="panel-body">
                            @if (session()->has('status'))
                                {!! session()->get('status') !!}
                            @endif
                            {{--              @if (\App\Helper\CustomHelper::canView('Create Training', 'Super Admin')) --}}
                            {{-- <div class="row">
                <div class="col-lg-12 col-md-12 col-xl-12 text-right mb-3">
                  <a href="{{ route('admin.training.create') }}" class="brn btn-success btn-sm">New Training</a>
                </div>
              </div> --}}
                            {{--              @endif --}}
                            <div class="app-report-heading-part row my-5">
                                <div class="col-8">
                                    <h5>Ministry/Division:<span class="text-secondary"> Education Ministry</span></h5>
                                    <h5>Agency:<span class="text-secondary"> Education</span> </h5>
                                    <h5>Procurement Entity Name & Code : <span class="text-secondary"> Education Services #303</span></h5>
                                    <h5>Project / Programme Name & Code : <span class="text-secondary">Technical Accelaration #202</span></h5>
                                </div>
                                <div class="col-4">
                                    <h4 class="text-right">Type : <span class="bg-success text-light p-2 rounded">WORKS</span></h4>
                                    <h4 class="text-right procurement-type" >Budget : <span class="bg-info text-light p-2 rounded">Revenue</span></h4>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                                    cellspacing="0" width="100%" style="font-size: 14px">

                                    <thead>
                                        <tr class="table-head-bg">
                                            <th class="tpp-table-heading">Package Number</th>
                                            <th class="tpp-table-heading">Description of
                                                Procurement Item</th>
                                            <th class="tpp-table-heading">Unit</th>
                                            <th class="tpp-table-heading">Quantity</th>
                                            <th class="tpp-table-heading">Procurement Method
                                                & Type</th>
                                            <th class="tpp-table-heading">Contract Approving
                                                Authority</th>
                                            <th class="tpp-table-heading">Source of Funds</th>
                                            <th class="tpp-table-heading">Estd Cost
                                                In Million(Tk.)</th>
                                            <th width="300px">Time Code for
                                                Process</th>
                                            <th class="tpp-table-heading">Not used in Goods</th>
                                            <th class="tpp-table-heading">Invite/Advertise Tender</th>
                                            <th class="tpp-table-heading">Tender Opening</th>
                                            <th class="tpp-table-heading">Tender Evalution</th>
                                            <th class="tpp-table-heading">Approval to Award</th>
                                            <th class="tpp-table-heading">Notification of Award</th>
                                            <th class="tpp-table-heading">Signing of Contact</th>
                                            <th class="tpp-table-heading">Total Time to Contact Signature</th>
                                            <th class="tpp-table-heading">Time for Completion of Contract</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @foreach ($datas as $key => $val) --}}
                                        {{-- <tr class="@if ($key % 2 == 0)gradeX @else gradeC @endif"> --}}
                                        <tr>
                                            @for ($i = 1; $i <= 18; $i++)
                                        <td class="p-1 text-center">{{$i}}</td>
                                        @endfor </tr> 
                                        <tr class="">
                                            <td class="p-1 ">WR1</td>
                                            <td class="p-1">Perchase of ten steel Fabricated water lowers</td>
                                            <td class="p-1">No.</td>
                                            <td class="p-1">23</td>
                                            <td class="p-1">OTM(ICT)</td>
                                            <td class="p-1">Ministry</td>
                                            <td class="p-1">ADB</td>
                                            
                                            <td class="p-1">125</td>
                                            <td class="m-0 p-0">
                                                <table class="">
                                                    <tr>
                                                        <th class="tpp-table-heading">Planned Dates</th>
                                                    </tr>
                                                    <tr><th class="tpp-table-heading">Planned Days</th>
                                                    </tr>
                                                    <tr><th class="tpp-table-heading">Actual Dates</th>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td class="m-0 p-0">
                                                <table class="">
                                                    <tr>
                                                        <td class="tpp-table-heading">10- Jan-2022</td>
                                                    </tr>
                                                    <tr><td class="tpp-table-heading">21</td>
                                                    </tr>
                                                    <tr><td class="tpp-table-heading">23 Jan, 2022</td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td class="m-0 p-0">
                                                <table class="">
                                                    <tr>
                                                        <td class="tpp-table-heading">10- Jan-2022</td>
                                                    </tr>
                                                    <tr><td class="tpp-table-heading">21</td>
                                                    </tr>
                                                    <tr><td class="tpp-table-heading">23 Jan, 2022</td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td class="m-0 p-0">
                                                <table class="">
                                                    <tr>
                                                        <td class="tpp-table-heading">10- Jan-2022</td>
                                                    </tr>
                                                    <tr><td class="tpp-table-heading">21</td>
                                                    </tr>
                                                    <tr><td class="tpp-table-heading">23 Jan, 2022</td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td class="m-0 p-0">
                                                <table class="">
                                                    <tr>
                                                        <td class="tpp-table-heading">10- Jan-2022</td>
                                                    </tr>
                                                    <tr><td class="tpp-table-heading">21</td>
                                                    </tr>
                                                    <tr><td class="tpp-table-heading">23 Jan, 2022</td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td class="m-0 p-0">
                                                <table class="">
                                                    <tr>
                                                        <td class="tpp-table-heading">10- Jan-2022</td>
                                                    </tr>
                                                    <tr><td class="tpp-table-heading">21</td>
                                                    </tr>
                                                    <tr><td class="tpp-table-heading">23 Jan, 2022</td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td class="m-0 p-0">
                                                <table class="">
                                                    <tr>
                                                        <td class="tpp-table-heading">10- Jan-2022</td>
                                                    </tr>
                                                    <tr><td class="tpp-table-heading">21</td>
                                                    </tr>
                                                    <tr><td class="tpp-table-heading">23 Jan, 2022</td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td class="m-0 p-0">
                                                <table class="">
                                                    <tr>
                                                        <td class="tpp-table-heading">10- Jan-2022</td>
                                                    </tr>
                                                    <tr><td class="tpp-table-heading">21</td>
                                                    </tr>
                                                    <tr><td class="tpp-table-heading">23 Jan, 2022</td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td class="m-0 p-0">
                                                <table class="">
                                                    <tr>
                                                        <td class="tpp-table-heading">10- Jan-2022</td>
                                                    </tr>
                                                    <tr><td class="tpp-table-heading">21</td>
                                                    </tr>
                                                    <tr><td class="tpp-table-heading">23 Jan, 2022</td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td class="m-0 p-0">
                                                <table class="">
                                                    <tr>
                                                        <td class="tpp-table-heading">10- Jan-2022</td>
                                                    </tr>
                                                    <tr><td class="tpp-table-heading">21</td>
                                                    </tr>
                                                    <tr><td class="tpp-table-heading">23 Jan, 2022</td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr class="">
                                            <td class="p-1 ">WR2</td>
                                            <td class="p-1">Perchase of ten steel Fabricated water lowers</td>
                                            <td class="p-1">No.</td>
                                            <td class="p-1">23</td>
                                            <td class="p-1">OTM(ICT)</td>
                                            <td class="p-1">Ministry</td>
                                            <td class="p-1">ADB</td>
                                            
                                            <td class="p-1">125</td>
                                            <td class="m-0 p-0">
                                                <table class="">
                                                    <tr>
                                                        <th class="tpp-table-heading">Planned Dates</th>
                                                    </tr>
                                                    <tr><th class="tpp-table-heading">Planned Days</th>
                                                    </tr>
                                                    <tr><th class="tpp-table-heading">Actual Dates</th>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td class="m-0 p-0">
                                                <table class="">
                                                    <tr>
                                                        <td class="tpp-table-heading">10- Jan-2022</td>
                                                    </tr>
                                                    <tr><td class="tpp-table-heading">21</td>
                                                    </tr>
                                                    <tr><td class="tpp-table-heading">23 Jan, 2022</td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td class="m-0 p-0">
                                                <table class="">
                                                    <tr>
                                                        <td class="tpp-table-heading">10- Jan-2022</td>
                                                    </tr>
                                                    <tr><td class="tpp-table-heading">21</td>
                                                    </tr>
                                                    <tr><td class="tpp-table-heading">23 Jan, 2022</td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td class="m-0 p-0">
                                                <table class="">
                                                    <tr>
                                                        <td class="tpp-table-heading">10- Jan-2022</td>
                                                    </tr>
                                                    <tr><td class="tpp-table-heading">21</td>
                                                    </tr>
                                                    <tr><td class="tpp-table-heading">23 Jan, 2022</td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td class="m-0 p-0">
                                                <table class="">
                                                    <tr>
                                                        <td class="tpp-table-heading">10- Jan-2022</td>
                                                    </tr>
                                                    <tr><td class="tpp-table-heading">21</td>
                                                    </tr>
                                                    <tr><td class="tpp-table-heading">23 Jan, 2022</td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td class="m-0 p-0">
                                                <table class="">
                                                    <tr>
                                                        <td class="tpp-table-heading">10- Jan-2022</td>
                                                    </tr>
                                                    <tr><td class="tpp-table-heading">21</td>
                                                    </tr>
                                                    <tr><td class="tpp-table-heading">23 Jan, 2022</td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td class="m-0 p-0">
                                                <table class="">
                                                    <tr>
                                                        <td class="tpp-table-heading">10- Jan-2022</td>
                                                    </tr>
                                                    <tr><td class="tpp-table-heading">21</td>
                                                    </tr>
                                                    <tr><td class="tpp-table-heading">23 Jan, 2022</td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td class="m-0 p-0">
                                                <table class="">
                                                    <tr>
                                                        <td class="tpp-table-heading">10- Jan-2022</td>
                                                    </tr>
                                                    <tr><td class="tpp-table-heading">21</td>
                                                    </tr>
                                                    <tr><td class="tpp-table-heading">23 Jan, 2022</td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td class="m-0 p-0">
                                                <table class="">
                                                    <tr>
                                                        <td class="tpp-table-heading">10- Jan-2022</td>
                                                    </tr>
                                                    <tr><td class="tpp-table-heading">21</td>
                                                    </tr>
                                                    <tr><td class="tpp-table-heading">23 Jan, 2022</td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td class="m-0 p-0">
                                                <table class="">
                                                    <tr>
                                                        <td class="tpp-table-heading">10- Jan-2022</td>
                                                    </tr>
                                                    <tr><td class="tpp-table-heading">21</td>
                                                    </tr>
                                                    <tr><td class="tpp-table-heading">23 Jan, 2022</td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr class="">
                                            <td class="p-1 ">WR3</td>
                                            <td class="p-1">Perchase of ten steel Fabricated water lowers</td>
                                            <td class="p-1">No.</td>
                                            <td class="p-1">23</td>
                                            <td class="p-1">OTM(ICT)</td>
                                            <td class="p-1">Ministry</td>
                                            <td class="p-1">ADB</td>
                                            
                                            <td class="p-1">125</td>
                                            <td class="m-0 p-0">
                                                <table class="">
                                                    <tr>
                                                        <th class="tpp-table-heading">Planned Dates</th>
                                                    </tr>
                                                    <tr><th class="tpp-table-heading">Planned Days</th>
                                                    </tr>
                                                    <tr><th class="tpp-table-heading">Actual Dates</th>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td class="m-0 p-0">
                                                <table class="">
                                                    <tr>
                                                        <td class="tpp-table-heading">10- Jan-2022</td>
                                                    </tr>
                                                    <tr><td class="tpp-table-heading">21</td>
                                                    </tr>
                                                    <tr><td class="tpp-table-heading">23 Jan, 2022</td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td class="m-0 p-0">
                                                <table class="">
                                                    <tr>
                                                        <td class="tpp-table-heading">10- Jan-2022</td>
                                                    </tr>
                                                    <tr><td class="tpp-table-heading">21</td>
                                                    </tr>
                                                    <tr><td class="tpp-table-heading">23 Jan, 2022</td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td class="m-0 p-0">
                                                <table class="">
                                                    <tr>
                                                        <td class="tpp-table-heading">10- Jan-2022</td>
                                                    </tr>
                                                    <tr><td class="tpp-table-heading">21</td>
                                                    </tr>
                                                    <tr><td class="tpp-table-heading">23 Jan, 2022</td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td class="m-0 p-0">
                                                <table class="">
                                                    <tr>
                                                        <td class="tpp-table-heading">10- Jan-2022</td>
                                                    </tr>
                                                    <tr><td class="tpp-table-heading">21</td>
                                                    </tr>
                                                    <tr><td class="tpp-table-heading">23 Jan, 2022</td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td class="m-0 p-0">
                                                <table class="">
                                                    <tr>
                                                        <td class="tpp-table-heading">10- Jan-2022</td>
                                                    </tr>
                                                    <tr><td class="tpp-table-heading">21</td>
                                                    </tr>
                                                    <tr><td class="tpp-table-heading">23 Jan, 2022</td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td class="m-0 p-0">
                                                <table class="">
                                                    <tr>
                                                        <td class="tpp-table-heading">10- Jan-2022</td>
                                                    </tr>
                                                    <tr><td class="tpp-table-heading">21</td>
                                                    </tr>
                                                    <tr><td class="tpp-table-heading">23 Jan, 2022</td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td class="m-0 p-0">
                                                <table class="">
                                                    <tr>
                                                        <td class="tpp-table-heading">10- Jan-2022</td>
                                                    </tr>
                                                    <tr><td class="tpp-table-heading">21</td>
                                                    </tr>
                                                    <tr><td class="tpp-table-heading">23 Jan, 2022</td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td class="m-0 p-0">
                                                <table class="">
                                                    <tr>
                                                        <td class="tpp-table-heading">10- Jan-2022</td>
                                                    </tr>
                                                    <tr><td class="tpp-table-heading">21</td>
                                                    </tr>
                                                    <tr><td class="tpp-table-heading">23 Jan, 2022</td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td class="m-0 p-0">
                                                <table class="">
                                                    <tr>
                                                        <td class="tpp-table-heading">10- Jan-2022</td>
                                                    </tr>
                                                    <tr><td class="tpp-table-heading">21</td>
                                                    </tr>
                                                    <tr><td class="tpp-table-heading">23 Jan, 2022</td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <h5 class="my-4" >Total Value of Works Procurement : <span class="bg-info text-light p-2 rounded">340 Millions (TK.)</span></h5>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
