@extends('layout.auth')
@section('content')
    <div class="card ">
        <div class="card-body">
            <div class="row">
                <div class="col-12 text-center"><a href="{{ route('home') }}" class="logo logo-admin">
                        <img src="{{ asset('assets/text-logo.png') }}" height="80" alt="logo">
                    </a></div>
            </div>
            <div class="pl-3 pr-3 pb-3">
                <div class="row">
                    <div class="col-12 text-center">
                        <h6 class="m-2">Please verify your email with bellow link:</h6>
                        <hr>
                        @if(session()->has('status'))
                            {!! session()->get('status') !!}
                        @endif
                    </div>
                </div>


                <form class="form-horizontal" action="{{ route('password.request') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label class="form-label" for="email">Email</label>
                        <div class="d-flex">
                            <input type="email" name="email" id="email" placeholder="Enter Your email"
                                   class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                            <span class="mt-1 "><i class="fa fa-duotone fa-envelope icon login-icon"></i></span>
                        </div>

                        <span class="spin"></span>
                        @error('email')
                        <strong class="text-danger">{{ $errors->first('email') }}</strong>
                        @enderror
                    </div>
                    <div class="form-group row m-t-20">
                        <div class="col-sm-12 text-right">
                            <button class="btn btn-success w-md waves-effect waves-light" type="submit" name="verify" >Send Email</button>

                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection
