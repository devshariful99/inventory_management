@extends('admin.layouts.master', ['page_slug' => 'admin'])

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">{{ __('Admin List') }}</h4>
                    <div class="buttons">
                        <a href="{{route('admin.create')}}" class="btn btn-sm btn-primary">{{__('Add Admin')}}</a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-responsive">
                        <thead>
                            <tr>
                                <th>{{ __('SL') }}</th>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Email') }}</th>
                                <th>{{ __('Created At') }}</th>
                                <th>{{ __('Updated At') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($admins as $admin)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $admin->name }}</td>
                                    <td>{{ $admin->email }}</td>
                                    <td>{{ date('d M, Y', strtotime($admin->created_at)) }}</td>
                                    <td>{{ $admin->created_at != $admin->updated_at ? date('d M, Y', strtotime($admin->updated_at)) : 'NULL' }}
                                    </td>
                                    <td>
                                        <div class="btn-group d-flex align-items-center gap-3 flex-wrap">
                                            <a href="javascript:void(0)"
                                                class="btn btn-primary btn-rounded d-flex align-items-center justify-content-center"
                                                style="max-width: 30px; max-height: 30px" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                <i class="icon-options-vertical"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a href="#"class="dropdown-item">Edit</a>
                                                    <a href="#"class="dropdown-item">Status Update</a>
                                                    <a href="#"class="dropdown-item">Delete</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>


                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
