@extends('admin.layouts.master', ['page_slug' => 'category'])

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">{{ __('Category List') }}</h4>
                    <div class="buttons">
                        <a href="{{route('category.create')}}" class="btn btn-sm btn-primary">{{__('Add Category')}}</a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-responsive">
                        <thead>
                            <tr>
                                <th>{{ __('SL') }}</th>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Created At') }}</th>
                                <th>{{ __('Created By') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cats as $cat)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $cat->name }}</td>
                                    <td><span class="{{$cat->getStatusClass()}}">{{$cat->getStatus()}}</span></td>
                                    <td>{{ date('d M, Y', strtotime($cat->created_at)) }}</td>
                                    <td>{{$cat->creater ? $cat->creater->name : 'System'}}</td>
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
                                                    <a href="javascript:void(0)" data-id="{{ encrypt($cat->id) }}" class="dropdown-item show">{{__('Show')}}</a>
                                                    <a href="{{route('category.edit', encrypt($cat->id))}}" class="dropdown-item">{{__('Edit')}}</a>
                                                    <a href="{{route('category.status', encrypt($cat->id))}}" class="dropdown-item">{{$cat->getStatusTitle()}}</a>
                                                    <a class="dropdown-item" href="javascript:void(0)"
                                                        onclick='confirmDelete(()=>document.getElementById("delete-form{{ $loop->iteration }}").submit())'>
                                                        {{ __('Delete') }}
                                                    </a>

                                                    <form id="delete-form{{ $loop->iteration }}"
                                                        action="{{ route('category.destroy', encrypt($cat->id)) }}" method="POST"
                                                        class="d-none">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
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
    @include('admin.includes.details_modal', ['modal_title' => 'Category Details'])
@endsection

@push('js')
     <script>
        $(document).ready(()=> {
            $('.show').on('click',function() {
                let id = $(this).data('id');
                let url = ("{{ route('category.show', ['id']) }}");
                let _url = url.replace('id', id);
                $.ajax({
                    url: _url,
                    method: 'GET',
                    dataType: 'json',
                    success: (data)=> {
                        var result = `
                                <table class="table table-striped">
                                    <tr>
                                        <th class="text-nowrap">Name</th>
                                        <th>:</th>
                                        <td>${data.name}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-nowrap">Slug</th>
                                        <th>:</th>
                                        <td>${data.slug}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-nowrap">Status</th>
                                        <th>:</th>
                                        <td><span class="${data.getStatusClass}">${data.getStatus}</span></td>
                                    </tr>
                                     <tr>
                                        <th class="text-nowrap">Description</th>
                                        <th>:</th>
                                        <td>${data.description}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-nowrap">Created Date</th>
                                        <th>:</th>
                                        <td>${data.created_time}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-nowrap">Created By</th>
                                        <th>:</th>
                                        <td>${data.creater ? data.creater.name : 'System'}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-nowrap">Updated Date</th>
                                        <th>:</th>
                                        <td>${data.updated_time}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-nowrap">Updated By</th>
                                        <th>:</th>
                                        <td>${data.updater ? data.updater.name : 'NULL'}</td>
                                    </tr>
                                </table>
                                `;
                        $('#modal_data').html(result);
                        showModal('myModal');
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching admin data:', error);
                    }
                });
            });
        });
    </script>
@endpush
