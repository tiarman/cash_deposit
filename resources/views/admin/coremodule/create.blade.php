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
                            <h2 class="panel-title">Create new Core Module</h2>
                        </header>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-xl-12 text-right mb-3">
                                    <a href="/" class="brn btn-success btn-sm">List of Core Module</a>
                                </div>
                            </div>

                            @if(session()->has('status'))
                                {!! session()->get('status') !!}
                            @endif
                            <form action="{{route('admin.coremodule.store')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label">Name</label>
                                            <input type="text" name="name" placeholder="Core module name" value="{{ old('name') }}"
                                                   class="form-control @error('name') is-invalid @enderror">
                                            @error('name')
                                            <strong class="text-danger">{{ $errors->first('name') }}</strong>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label">link</label>
                                            <input type="text" name="link" placeholder="Core module link" value="{{ old('link') }}"
                                                   class="form-control @error('link') is-invalid @enderror">
                                            @error('link')
                                            <strong class="text-danger">{{ $errors->first('link') }}</strong>
                                            @enderror
                                        </div>
                                    </div>
                                </div>


                                    <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label">Image <label class="text-danger">*</label></label>
                                            <input type="file" name="image" required placeholder="Slider image" value="{{ old('image') }}"
                                                   class="form-control @error('image') is-invalid @enderror">
                                            @error('image')
                                            <strong class="text-danger">{{ $errors->first('image') }}</strong>
                                            @enderror
                                        </div>
                                    </div>


                                        <div class="col-sm-6 mt-2">
                                            <div class="form-group">
                                                <label class="control-label">Status<span class="text-danger">*</span></label>
                                                <select name="status" required class="form-control @error('status') is-invalid @enderror">
                                                    <option value="">Choose a status</option>
                                                    @foreach(\App\Models\CoreModule::$statusArrays as $status)
                                                        <option value="{{ $status }}"
                                                                @if(old('status') == $status) selected @endif>{{ ucfirst($status) }}</option>
                                                    @endforeach
                                                </select>
                                                @error('status')
                                                <strong class="text-danger">{{ $errors->first('status') }}</strong>
                                                @enderror

                                            </div>
                                        </div>


{{--                                    <div class="col-sm-6">--}}
{{--                                        <div class="form-group">--}}
{{--                                            <label class="control-label">Status<span class="text-danger">*</span></label>--}}
{{--                                            <select name="status" required class="form-control @error('status') is-invalid @enderror">--}}
{{--                                                <option value="">Choose a status</option>--}}
{{--                                                @foreach(\App\Models\Slider::$statusArray as $statys)--}}
{{--                                                    <option value="{{ $statys }}"--}}
{{--                                                            @if(old('status') == $statys) selected @endif>{{ ucfirst($statys) }}</option>--}}
{{--                                                @endforeach--}}
{{--                                            </select>--}}
{{--                                            @error('status')--}}
{{--                                            <strong class="text-danger">{{ $errors->first('status') }}</strong>--}}
{{--                                            @enderror--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
                                </div>
                                <div class="row mt-4">
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

@endsection
