@extends('layout.site')

@section('stylesheet')
    <style>
      .contact-info{
        background-color: #54359D;
        color: #ffff;
      }
      .contact-form{
        background-color: #fff;
        color: #54359D;
      }
      .contact-submit{
        background-color: #54359D;
        color: #ffff;
      }
      .contact-title{
        font-weight: bold;
        color: #54359D;
        border-bottom: 2px solid #54359D;
      }
      .input-label{
        font-weight: bold;
        color: #54359D;
      }
    </style>
@endsection

@section('content')
<section>
    <div class="row container p-3 mx-auto rounded">
        <div class="col-sm-12 col-lg-6 contact-info">
            <div class="mt-5 p-3">
                <img width="100%" src="{{asset('/assets/frontend/img/ims-contact/contact-5.png')}}" alt="">
            </div>
            <div class="mt-3 p-3">
                <h3>Office Address</h3>
                <p>
                    Registered Office: H-202, 3rd Floor, Road- 3/A, Block-B, Shagufta Housing Society,Pallabi
                    Mirpur - 12, Dhaka 1230<br>
                    <br>
                    <strong>Phone:</strong> +8801844177603<br>
                    <strong>Phone:</strong> +8801913651485<br>
                    <strong>Email:</strong> info@touchandsolve.com<br>
                </p>
            </div>
        </div>
        <div class="col-sm-12 col-lg-6 contact-form p-4">
            <h3 class="text-center contact-title">Contact Us</h3>
            <form class="form-horizontal" action="{{ route('login')}}" method="post">
                @csrf
                <div class="form-group mt-3">
                  <label class="form-label input-label input-label" for="name">Name</label>
                    <input type="text" name="name" id="name" placeholder="Enter Your name"
                           class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                  <span class="spin"></span>
                  @error('name')
                  <strong class="text-danger">{{ $errors->first('name') }}</strong>
                  @enderror
                </div>
                <div class="form-group mt-3">
                  <label class="form-label input-label" for="email">Email</label>
                    <input type="email" name="email" id="email" placeholder="Enter Your email"
                           class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                  <span class="spin"></span>
                  @error('email')
                  <strong class="text-danger">{{ $errors->first('email') }}</strong>
                  @enderror
                </div>
                <div class="form-group mt-3">
                  <label class="form-label input-label" for="phone">Phone</label>
                    <input type="number" name="phone" id="phone" placeholder="Enter Your phone"
                           class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}" required>
                  <span class="spin"></span>
                  @error('phone')
                  <strong class="text-danger">{{ $errors->first('phone') }}</strong>
                  @enderror
                </div>
                <div class="form-group mt-3">
                  <label class="form-label input-label" for="phone">How can we help you?</label>
                  <textarea name="description" id="description"  class="form-control @error('description') is-invalid @enderror" value="{{ old('description') }}" required cols="30" rows="10"></textarea>
                  <span class="spin"></span>
                  @error('description')
                  <strong class="text-danger">{{ $errors->first('description') }}</strong>
                  @enderror
                </div>
      
                <div class="form-group mt-3 row m-t-20">
                  <div class="col-sm-12 text-right">
                    <button class="btn fw-bold w-100 contact-submit w-md waves-effect waves-light" type="submit">Submit</button>
                  </div>
                </div>
              </form>
        </div>
    </div>
</section>
@endsection

@section('script')
    
@endsection