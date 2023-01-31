<div class="text-center">

    <a class="btn btn-outline-primary m-2 tabClick @if(request()->routeIs('institute.registration')) btn-primary text-white @endif" href="{{route('institute.registration')}}">Institute</a>

    <a class="btn btn-outline-primary m-2 tabClick @if(request()->routeIs('teacher.registration')) btn-primary text-white @endif" href="{{route('teacher.registration')}}">Teacher</a>
    <a class="btn btn-outline-primary m-2 tabClick @if(request()->routeIs('register')) btn-primary text-white @endif" href="{{ route('register') }}">Graduate</a>
    <a class="btn btn-outline-primary m-2 tabClick @if(request()->routeIs('industry.registration')) btn-primary text-white @endif" href="{{route('industry.registration')}}">Industry</a>
</div>

