@extends('admin.layouts.master', ['page_slug' => 'admin'])

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">{{ __('Admin Create') }}</h4>
                    <div class="buttons">
                        <a href="{{route('admin.index')}}" class="btn btn-sm btn-primary">{{__('Back')}}</a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <label>{{__('Name')}}</label>
                            <input type="text" placeholder="Enter your name" value="{{old('name')}}" name="name" class="form-control">
                            @error('name')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label>{{__('Email')}}</label>
                            <input type="email" placeholder="Enter your email" value="{{old('email')}}" name="email" class="form-control">
                            @error('email')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label>{{__('Password')}}</label>
                            <input type="password" placeholder="Enter your password" name="password" class="form-control">
                            @error('password')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label>{{__('Confirm Password')}}</label>
                            <input type="password" placeholder="Enter your confirm password" name="password_confirmation" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <input type="submit" class="btn btn-sm btn-primary float-end" value="Create">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
