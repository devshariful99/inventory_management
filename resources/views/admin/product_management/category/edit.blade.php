@extends('admin.layouts.master', ['page_slug' => 'category'])

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">{{ __('Category Create') }}</h4>
                    <div class="buttons">
                        <a href="{{route('category.index')}}" class="btn btn-sm btn-primary">{{__('Back')}}</a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{route('category.update', encrypt($cat->id))}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-3">
                            <label>{{__('Name')}}</label>
                            <input type="text" placeholder="Enter your name" value="{{ $cat->name }}" name="name" class="form-control">
                            @error('name')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label>{{__('Slug')}}</label>
                            <input type="slug" placeholder="Enter your slug" value="{{ $cat->slug }}" name="slug" class="form-control">
                            @error('slug')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label>{{__('Description')}}</label>
                            <textarea name="description" class="form-control" placeholder="Enter your description">{{ $cat->description }}</textarea>
                            @error('slug')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        
                        <div class="form-group mb-3">
                            <input type="submit" class="btn btn-sm btn-primary float-end" value="Update">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
