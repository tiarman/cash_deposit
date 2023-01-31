@extends('layout.admin')

@section('stylesheet')
  <link rel="stylesheet" href="{{ asset('assets/admin/plugins/select2/css/select2.min.css') }}">
  {{--  <style>--}}
  {{--      .select2-selection__rendered {--}}
  {{--          line-height: 31px !important;--}}
  {{--      }--}}
  {{--      .select2-container .select2-selection--single {--}}
  {{--          height: 35px !important;--}}
  {{--      }--}}
  {{--      .select2-selection__arrow {--}}
  {{--          height: 100px !important;--}}
  {{--      }--}}
  {{--      .select2-container .select2-selection--multiple {--}}
  {{--          box-sizing: border-box;--}}
  {{--          cursor: pointer;--}}
  {{--          display: block;--}}
  {{--          min-height: 122px;--}}
  {{--          user-select: none;--}}
  {{--          -webkit-user-select: none;--}}
  {{--      }--}}
  {{--  </style>--}}
@endsection

@section('content')
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <section class="panel">
            <header class="panel-heading">
              <h2 class="panel-title">Create Stall</h2>
            </header>
            <div class="panel-body">
              @if(\App\Helper\CustomHelper::canView('List Of Division', 'Super Admin'))
                <div class="row">
                  <div class="col-lg-12 col-md-12 col-xl-12 text-right mb-3">
                    {{--                    <a href="{{ route('admin.division.list') }}" class="brn btn-success btn-sm">List of divisions</a>--}}
                  </div>
                </div>
              @endif
              @if(session()->has('status'))
                {!! session()->get('status') !!}
              @endif

              <form action="" method="post">
                @csrf
                <div class="row">
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
  <script src="{{ asset('assets/admin/plugins/select2/js/select2.min.js') }}"></script>
  <script>
    $(document).ready(function () {
      $('.select2').select2()
    });
  </script>
@endsection
