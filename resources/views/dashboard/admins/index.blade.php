@extends('layouts.dashboard.app')
@section('title')
    Admins
@endsection
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block"><a
                            href="{{ route('dashboard.welcome') }}">{{ __('dashboard.dashboard') }}</a></h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">

                                <li class="breadcrumb-item"><a
                                        href="{{ route('dashboard.admins.index') }}">{{ __('dashboard.admins') }}</a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="content-header-right col-md-6 col-12">
                    <div class="dropdown float-md-right">
                        <button class="btn btn-danger dropdown-toggle round btn-glow px-2" id="dropdownBreadcrumbButton"
                            type="button" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">Actions</button>
                        <div class="dropdown-menu" aria-labelledby="dropdownBreadcrumbButton"><a class="dropdown-item"
                                href="#"><i class="la la-calendar-check-o"></i> Calender</a>
                            <a class="dropdown-item" href="#"><i class="la la-cart-plus"></i> Cart</a>
                            <a class="dropdown-item" href="#"><i class="la la-life-ring"></i> Support</a>
                            <div class="dropdown-divider"></div><a class="dropdown-item" href="#"><i
                                    class="la la-cog"></i> Settings</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex">
                            <h4 class="card-title" id="basic-layout-colored-form-control">{{ __('dashboard.admins') }} </h4>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        </div>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                <li><a data-action="close"><i class="ft-x"></i></a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="card-content">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div class="row">
                                    <div class="col-md-2">
                                        <a href="{{ route('dashboard.admins.create') }}"
                                            class="btn btn-danger">{{ __('dashboard.add') }}</a><br><br>
                                    </div>
                                </div>
                                <div class="col-md-10">
                                    <input id="search" type="text" class="form-control"
                                        placeholder="{{ __('dashboard.search') }}">
                                </div>
                            </div>
                            <table class="table table-responsive-sm">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">{{ __('dashboard.name') }}</th>
                                        <th scope="col">{{ __('dashboard.email') }} </th>
                                        <th scope="col">{{ __('dashboard.role') }} </th>
                                        <th scope="col">{{ __('dashboard.status') }} </th>
                                        <th scope="col">{{ __('dashboard.created_at') }} </th>
                                        <th scope="col">{{ __('dashboard.operations') }} </th>
                                    </tr>
                                </thead>
                                <tbody id="admins">

                                    @forelse ($admins as $admin)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $admin->name }} </td>
                                            <td>{{ $admin->email }}</td>
                                            <td>{{ $admin->role->role }}</td>
                                            <td>
                                                <span
                                                    class="badge @if ($admin->status == 'Active') bg-success @else bg-danger @endif">{{ $admin->status == 'Active' ? __('dashboard.active') : __('dashboard.inactive') }}</span>
                                            </td>
                                            <td>{{ $admin->created_at->format('Y-m-d') }}</td>
                                            <td>
                                                <div class="dropdown float-md-left">
                                                    <button class="btn btn-danger dropdown-toggle round btn-glow px-2"
                                                        id="dropdownBreadcrumbButton" type="button" data-toggle="dropdown"
                                                        aria-haspopup="true"
                                                        aria-expanded="false">{{ __('dashboard.operations') }}</button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownBreadcrumbButton">
                                                        <a class="dropdown-item"
                                                            href="{{ route('dashboard.admins.edit', $admin->id) }}"><i
                                                                class="la la-edit"></i>{{ __('dashboard.edit') }}</a>
                                                        <a class="dropdown-item"
                                                            href="{{ route('dashboard.admins.status', $admin->id) }}"><i
                                                                class="la @if ($admin->status == 'Active') la-toggle-on @else la-toggle-off @endif"></i>
                                                            @if ($admin->status == 'Active')
                                                                {{ __('dashboard.inactive') }}
                                                            @else
                                                                {{ __('dashboard.active') }}
                                                            @endif
                                                        </a>

                                                        <div class="dropdown-divider"></div><a class="dropdown-item"
                                                            href="javascript:void(0)"
                                                            onclick="if(confirm('Are you sure you want to delete this admin?')){document.getElementById('delete-form-{{ $admin->id }}').submit();} return false"><i
                                                                class="la la-trash"></i> Delete</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>


                                        {{-- delete form  --}}
                                        <form id="delete-form-{{ $admin->id }}"
                                            action="{{ route('dashboard.admins.destroy', $admin->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                        </form>


                                    @empty
                                        <td colspan="4">{{ __('dashboard.no_data') }}</td>
                                    @endforelse
                                </tbody>
                            </table>
                            {{ $admins->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $(document).on('input', '#search', function() {
                const search = $(this).val();
                $.ajax({
                    url: "{{ route('dashboard.admins.search', ':search') }}".replace(':search',
                        search),
                    method: 'GET',
                    success: function(data) {
                        $('#admins').empty();

                        data.forEach((admin, index) => {
                            console.log(admin);
                            const statusClass = admin.status === 'Active' ?
                                'bg-success' : 'bg-danger';
                            const statusText = admin.status === 'Active' ?
                                "{{ __('dashboard.active') }}" :
                                "{{ __('dashboard.inactive') }}";
                            const toggleIcon = admin.status === 'Active' ?
                                'la-toggle-on' : 'la-toggle-off';
                            const toggleText = admin.status === 'Active' ?
                                "{{ __('dashboard.inactive') }}" :
                                "{{ __('dashboard.active') }}";
                            
                            var locale = "{{ $admin->role->role }}";
                            console.log(locale);
                            const row = `
                            <tr>
                                <th scope="row">${index + 1}</th>
                                <td>${admin.name}</td>
                                <td>${admin.email}</td>
                                <td>${locale}</td>
                                <td>
                                    <span class="badge ${statusClass}">${statusText}</span>
                                </td>
                                <td>${admin.created_at}</td>
                                <td>
                                    <div class="dropdown float-md-left">
                                        <button class="btn btn-danger dropdown-toggle round btn-glow px-2"
                                            type="button" data-toggle="dropdown"
                                            aria-haspopup="true"
                                            aria-expanded="false">{{ __('dashboard.operations') }}</button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item"
                                                href="/dashboard/admins/${admin.id}/edit">
                                                <i class="la la-edit"></i>{{ __('dashboard.edit') }}
                                            </a>
                                            <a class="dropdown-item"
                                                href="/dashboard/admins/${admin.id}/status">
                                                <i class="la ${toggleIcon}"></i>${toggleText}
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="javascript:void(0)"
                                                onclick="if(confirm('{{ __('Are you sure?') }}')){document.getElementById('delete-form-${admin.id}').submit();}">
                                                <i class="la la-trash"></i> {{ __('Delete') }}
                                            </a>
                                        </div>
                                    </div>
                                    <form id="delete-form-${admin.id}" 
                                          action="/dashboard/admins/${admin.id}" 
                                          method="POST" class="d-none">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                        `;
                            console.log(row)
                            $('#admins').append(row);
                        });
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>
@endpush
