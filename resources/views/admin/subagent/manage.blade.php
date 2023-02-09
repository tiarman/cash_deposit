@extends('layouts.admin')

@section('stylesheet')
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <section class="panel">
                        <header class="panel-heading">
                            <h2 class="panel-title">Sub Agent Manage</h2>
                        </header>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-xl-12 text-right mb-3">
                                    <a href="{{ route('admin.subagent.list') }}" class="brn btn-success btn-sm">বিভাগের
                                        তালিকা</a>
                                </div>
                            </div>
                            @if(session()->has('status'))
                                {!! session()->get('status') !!}
                            @endif

                            <form action="{{ route('admin.subagent.store') }}" method="post"
                                  enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $subagent->id }}">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="name_subagent" class="control-label">বিভাগিয় অফিস এর নাম</label>
                                            <input type="text" name="name_subagent" placeholder="বিভাগের নাম"
                                                   value="{{ old('name_subagent', $subagent->name) }}"
                                                   class="form-control @error('name_subagent') is-invalid @enderror">
                                            @error('name_subagent')
                                            <strong class="text-danger">{{ $errors->first('name_subagent') }}</strong>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label">ঠিকানা</label>
                                            <input type="text" name="address" placeholder="Division address"
                                                   value="{{ old('address', $subagent->address) }}"
                                                   class="form-control @error('address') is-invalid @enderror">
                                            @error('address')
                                            <strong class="text-danger">{{ $errors->first('address') }}</strong>
                                            @enderror
                                        </div>
                                    </div>
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
