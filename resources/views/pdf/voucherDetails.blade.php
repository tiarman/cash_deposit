<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Voucher Details</title>
  <style>
    .badge-success {
      background-color: #0e9f6e;
    }
    .badge-danger {
      background-color: #a41515;
    }
    .badge-info {
      background-color: #3bc3e9;
    }
    .badge-warning {
      background-color: #ffbb44;
    }

    .badge {
      font-weight: 600;
      padding: 2px 4px;
      border-radius: 4px;
      color: #ffffff;
    }
    .bg-light {
      background-color: #f8f9fa !important
    }

    .bg-gray-200 {
      --tw-bg-opacity: 1;
      background-color: rgb(229 231 235 / var(--tw-bg-opacity));
    }

    .container {
      width: 100%;
      margin-right: auto;
      margin-left: auto
    }

    .container-fluid {
      width: 100%;
      margin-right: auto;
      margin-left: auto
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
      margin-top: 4px;
      margin-bottom: 4px;
    }

    .font-10 {
      font-size: 10px;
    }

    .font-12 {
      font-size: 12px;
    }

    .font-14 {
      font-size: 14px;
    }

    .font-16 {
      font-size: 16px;
    }

    .font-18 {
      font-size: 18px;
    }

    .font-20 {
      font-size: 20px;
    }

    .font-22 {
      font-size: 22px;
    }

    .font-24 {
      font-size: 24px;
    }

    .font-26 {
      font-size: 26px;
    }

    .font-28 {
      font-size: 28px;
    }

    .font-30 {
      font-size: 30px;
    }

    .w-25 {
      width: 25% !important
    }

    .w-50 {
      width: 50% !important
    }

    .w-75 {
      width: 75% !important
    }

    .w-100 {
      width: 100% !important
    }

    .h-25 {
      height: 25% !important
    }

    .h-50 {
      height: 50% !important
    }

    .h-75 {
      height: 75% !important
    }

    .h-100 {
      height: 100% !important
    }

    .mw-100 {
      max-width: 100% !important
    }

    .mh-100 {
      max-height: 100% !important
    }

    .m-0 {
      margin: 0 !important
    }

    .mt-0,
    .my-0 {
      margin-top: 0 !important
    }

    .mr-0,
    .mx-0 {
      margin-right: 0 !important
    }

    .mb-0,
    .my-0 {
      margin-bottom: 0 !important
    }

    .ml-0,
    .mx-0 {
      margin-left: 0 !important
    }

    .m-1 {
      margin: .25rem !important
    }

    .mt-1,
    .my-1 {
      margin-top: .25rem !important
    }

    .mr-1,
    .mx-1 {
      margin-right: .25rem !important
    }

    .mb-1,
    .my-1 {
      margin-bottom: .25rem !important
    }

    .ml-1,
    .mx-1 {
      margin-left: .25rem !important
    }

    .m-2 {
      margin: .5rem !important
    }

    .mt-2,
    .my-2 {
      margin-top: .5rem !important
    }

    .mr-2,
    .mx-2 {
      margin-right: .5rem !important
    }

    .mb-2,
    .my-2 {
      margin-bottom: .5rem !important
    }

    .ml-2,
    .mx-2 {
      margin-left: .5rem !important
    }

    .m-3 {
      margin: 1rem !important
    }

    .mt-3,
    .my-3 {
      margin-top: 1rem !important
    }

    .mr-3,
    .mx-3 {
      margin-right: 1rem !important
    }

    .mb-3,
    .my-3 {
      margin-bottom: 1rem !important
    }

    .ml-3,
    .mx-3 {
      margin-left: 1rem !important
    }

    .m-4 {
      margin: 1.5rem !important
    }

    .mt-4,
    .my-4 {
      margin-top: 1.5rem !important
    }

    .mr-4,
    .mx-4 {
      margin-right: 1.5rem !important
    }

    .mb-4,
    .my-4 {
      margin-bottom: 1.5rem !important
    }

    .ml-4,
    .mx-4 {
      margin-left: 1.5rem !important
    }

    .m-5 {
      margin: 3rem !important
    }

    .mt-5,
    .my-5 {
      margin-top: 3rem !important
    }

    .mr-5,
    .mx-5 {
      margin-right: 3rem !important
    }

    .mb-5,
    .my-5 {
      margin-bottom: 3rem !important
    }

    .ml-5,
    .mx-5 {
      margin-left: 3rem !important
    }

    .p-0 {
      padding: 0 !important
    }

    .pt-0,
    .py-0 {
      padding-top: 0 !important
    }

    .pr-0,
    .px-0 {
      padding-right: 0 !important
    }

    .pb-0,
    .py-0 {
      padding-bottom: 0 !important
    }

    .pl-0,
    .px-0 {
      padding-left: 0 !important
    }

    .p-1 {
      padding: .25rem !important
    }

    .pt-1,
    .py-1 {
      padding-top: .25rem !important
    }

    .pr-1,
    .px-1 {
      padding-right: .25rem !important
    }

    .pb-1,
    .py-1 {
      padding-bottom: .25rem !important
    }

    .pl-1,
    .px-1 {
      padding-left: .25rem !important
    }

    .p-2 {
      padding: .5rem !important
    }

    .pt-2,
    .py-2 {
      padding-top: .5rem !important
    }

    .pr-2,
    .px-2 {
      padding-right: .5rem !important
    }

    .pb-2,
    .py-2 {
      padding-bottom: .5rem !important
    }

    .pl-2,
    .px-2 {
      padding-left: .5rem !important
    }

    .p-3 {
      padding: 1rem !important
    }

    .pt-3,
    .py-3 {
      padding-top: 1rem !important
    }

    .pr-3,
    .px-3 {
      padding-right: 1rem !important
    }

    .pb-3,
    .py-3 {
      padding-bottom: 1rem !important
    }

    .pl-3,
    .px-3 {
      padding-left: 1rem !important
    }

    .p-4 {
      padding: 1.5rem !important
    }

    .pt-4,
    .py-4 {
      padding-top: 1.5rem !important
    }

    .pr-4,
    .px-4 {
      padding-right: 1.5rem !important
    }

    .pb-4,
    .py-4 {
      padding-bottom: 1.5rem !important
    }

    .pl-4,
    .px-4 {
      padding-left: 1.5rem !important
    }

    .p-5 {
      padding: 3rem !important
    }

    .pt-5,
    .py-5 {
      padding-top: 3rem !important
    }

    .pr-5,
    .px-5 {
      padding-right: 3rem !important
    }

    .pb-5,
    .py-5 {
      padding-bottom: 3rem !important
    }

    .pl-5,
    .px-5 {
      padding-left: 3rem !important
    }

    .m-auto {
      margin: auto !important
    }

    .mt-auto,
    .my-auto {
      margin-top: auto !important
    }

    .mr-auto,
    .mx-auto {
      margin-right: auto !important
    }

    .mb-auto,
    .my-auto {
      margin-bottom: auto !important
    }

    .ml-auto,
    .mx-auto {
      margin-left: auto !important
    }

    .border {
      border: 1px solid #dee2e6 !important
    }

    .border-b {
      border: 1px solid black !important
    }

    .border-bl {
      border-left: 1px solid black !important
    }

    .border-br {
      border-right: 1px solid black !important
    }

    .border-bt {
      border-top: 1px solid black !important
    }

    .border-bb {
      border-bottom: 1px solid black !important
    }

    .border-top {
      border-top: 1px solid #dee2e6 !important
    }

    .border-right {
      border-right: 1px solid #dee2e6 !important
    }

    .border-bottom {
      border-bottom: 1px solid #dee2e6 !important
    }

    .border-left {
      border-left: 1px solid #dee2e6 !important
    }

    .border-0 {
      border: 0 !important
    }

    .border-top-0 {
      border-top: 0 !important
    }

    .border-right-0 {
      border-right: 0 !important
    }

    .border-bottom-0 {
      border-bottom: 0 !important
    }

    .border-left-0 {
      border-left: 0 !important
    }

    .round-1 {
      border-radius: 4px !important
    }

    .round-2 {
      border-radius: 8px !important
    }

    .round-3 {
      border-radius: 12px !important
    }

    .round-4 {
      border-radius: 16px !important
    }

    .round-5 {
      border-radius: 20px !important
    }

    .rounded {
      border-radius: .25rem !important
    }

    .rounded-top {
      border-top-left-radius: .25rem !important;
      border-top-right-radius: .25rem !important
    }

    .rounded-right {
      border-top-right-radius: .25rem !important;
      border-bottom-right-radius: .25rem !important
    }

    .rounded-bottom {
      border-bottom-right-radius: .25rem !important;
      border-bottom-left-radius: .25rem !important
    }

    .rounded-left {
      border-top-left-radius: .25rem !important;
      border-bottom-left-radius: .25rem !important
    }

    .rounded-circle {
      border-radius: 50% !important
    }

    table {
      width: 100%;
      padding: 4px 6px;
    }

    td.col-1 {
      width: 8.333333%
    }

    td.col-2 {
      width: 16.666666%
    }

    td.col-3 {
      width: 24.999999%
    }

    td.col-4 {
      width: 33.333333%
    }

    td.col-5 {
      width: 41.666666%
    }

    td.col-6 {
      width: 49.999999%
    }

    td.col-7 {
      width: 58.333333%
    }

    td.col-8 {
      width: 66.666666%
    }

    td.col-9 {
      width: 74.999999%
    }

    td.col-10 {
      width: 83.333333%
    }

    td.col-11 {
      width: 91.666666%
    }

    td.col-12 {
      width: 99.999999%
    }

    .text-justify {
      text-align: justify !important
    }

    .text-nowrap {
      white-space: nowrap !important
    }

    .text-truncate {
      overflow: hidden;
      text-overflow: ellipsis;
      white-space: nowrap
    }

    .text-left {
      text-align: left !important
    }

    .text-right {
      text-align: right !important
    }

    .text-center {
      text-align: center !important
    }

    .text-lowercase {
      text-transform: lowercase !important
    }

    .text-uppercase {
      text-transform: uppercase !important
    }

    .text-capitalize {
      text-transform: capitalize !important
    }

    .font-weight-light {
      font-weight: 300 !important
    }

    .font-weight-normal {
      font-weight: 400 !important
    }

    .font-weight-bold {
      font-weight: 700 !important
    }

    .font-italic {
      font-style: italic !important
    }

    .text-white {
      color: #fff !important
    }

    .text-primary {
      color: #007bff !important
    }

    .text-dark {
      color: #343a40 !important
    }

    .text-light {
      color: #f8f9fa !important
    }

    .text-danger {
      color: #dc3545 !important
    }

    .text-warning {
      color: #ffc107 !important
    }

    .text-info {
      color: #17a2b8 !important
    }

    .text-success {
      color: #28a745 !important
    }

    .text-secondary {
      color: #6c757d !important
    }

    .text-primary {
      color: #007bff !important
    }

    .text-muted {
      color: #6c757d !important
    }

    .text-hide {
      color: transparent;
      text-shadow: none;
      background-color: transparent;
      border: 0
    }

    .visible {
      visibility: visible !important
    }

    .invisible {
      visibility: hidden !important
    }

    .bg-light {
      background-color: #f8f9fa !important
    }

    .bg-primary {
      background-color: #007bff !important
    }

    .bg-secondary {
      background-color: #6c757d !important
    }

    .bg-success {
      background-color: #28a745 !important
    }

    .bg-info {
      background-color: #17a2b8 !important
    }

    .bg-warning {
      background-color: #ffc107 !important
    }

    .bg-danger {
      background-color: #dc3545 !important
    }

    .bg-dark {
      background-color: #343a40 !important
    }

    .bg-white {
      background-color: #fff !important
    }

    .bg-transparent {
      background-color: transparent !important
    }

    table {
      width: 100%;
      max-width: 100%;
      margin-bottom: 1rem;
      background-color: transparent !important;
      border-spacing: 0 !important;
    }

    th, td {
      border: 1px solid;

    }
    td{
      padding: 4px;
    }


    h5.title {
      background: lightgrey;
      color: black;
      padding: 6px 2px;
      margin: 0;
      border-bottom: 1px solid black;
    }

    h5.child {
      padding: 0 2px;
    }

    .dot-underline {
      border-bottom: dotted !important;
    }


  </style>

  @vite('resources/js/app.js')
</head>
<body>
<div class="container">
  <h1 class="text-center p-0 m-0 font-28">Voucher Details</h1>
  <p class="p-0 m-0 font-16 w-100 mb-3 mt-2 text-center"><strong>{{ $voucher->no }}</strong></p>
  {{--  <table>--}}
  {{--    <td class="col-4">--}}
  {{--      <img src="{{ public_path().$quote->company->logo }}" alt="" style="height: 170px;">--}}
  {{--    </td>--}}
  {{--    <td class="col-4"></td>--}}
  {{--  </table>--}}

  <table style="font-size: 12px">
    <tr>
      <td style="width: 33.33%" class="border-0">
        <h3 class="font-18 border-bottom mb-1 bg-gray-200 pl-1 rounded">Institute Info</h3>
        <h5>{{ $voucher->institute->name }}</h5>
        <h5 class="font-10">Phone: {{ $voucher->institute->phone }}</h5>
        <h5 class="font-10">Email: {{ $voucher->institute->email }}</h5>
      </td>
      <td style="width: 33.33%"  class="border-0">
        <h3 class="font-18 border-bottom mb-1 bg-gray-200 pl-1 rounded">Voucher Info</h3>
        <h5><strong>{{ $voucher->no }}</strong></h5>
        <h5 class="font-10">Year: {{ date('Y', strtotime($voucher->year->start_date)) }}</h5>
        <h5 class="font-10">Type: {{ $voucher->type->name }}</h5>
      </td>
      <td style="width: 33.33%"  class="border-0">
        <h3 class="font-18 border-bottom mb-1 bg-gray-200 pl-1 rounded">Creator Info</h3>
        <h5>{{ $voucher->creator->name_en  }}</h5>
        <h5 class="font-10">Phone: {{ $voucher->creator->phone }}</h5>
        <h5 class="font-10">Email: {{ $voucher->creator->email }}</h5>
      </td>
    </tr>
  </table>

  <table class="table" style="font-size: 12px">
    <tr>
      <th width="10">#</th>
      <th>Component</th>
      <th>Sub-Component</th>
      <th>Subsidiary Component</th>
      <th>DR Amount</th>
      <th>CR Amount</th>
    </tr>
    <?php $totalCr = 0; $totalDr = 0; ?>
    @foreach($voucher->details as $key => $val)
      <?php $totalDr = ($totalDr + $val->dr_amount); $totalCr = ($totalCr + $val->cr_amount);?>
      <tr class="">
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
  </table>

  <div class="text-right mt-3">
    In Words: <span>{{ \App\Helper\CustomHelper::numToEnglishWord($voucher->amount) }}</span> Taka Only
  </div>
</div>
</body>
</html>