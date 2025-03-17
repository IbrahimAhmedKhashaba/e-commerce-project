@extends('layouts.dashboard.app')
@section('title')
    Create admin
@endsection
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block"><a href="{{ route('dashboard.welcome') }}">{{ __('dashboard.dashboard') }}</a></h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                
                                <li class="breadcrumb-item"><a href="{{ route('dashboard.admins.index') }}">{{ __('dashboard.admins') }}</a>
                                </li>
                                <li class="breadcrumb-item active"><a href="{{ route('dashboard.admins.create') }}">{{ __('dashboard.add') }}</a>
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
                        <h4 class="card-title" id="basic-layout-colored-form-control">{{ __('dashboard.admins') }} </h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                <li><a data-action="close"><i class="ft-x"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            @include('dashboard.includes.validations-errors')
                            <form class="form" action="{{ route('dashboard.admins.store') }}" method="POST">
                                @csrf
                                <div class="form-body">
                                    <h4 class="form-section"><i class="la la-new"></i>{{ __('dashboard.create_admin') }}</h4>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="userinput1">{{  __('dashboard.name') }}</label>
                                                <input type="text" id="userinput1" class="form-control border-primary"
                                                    name="name">
                                            </div>

                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="userinput1">{{__('dashboard.email') }}</label>
                                                <input type="email" id="userinput1" class="form-control border-primary"
                                                     name="email">
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="userinput1">{{__('dashboard.password') }}</label>
                                                <input type="password" id="userinput1" class="form-control border-primary"
                                                     name="password">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="userinput1"> {{ __('dashboard.password_confirmation') }}</label>
                                                <input type="password" id="userinput1" class="form-control border-primary"
                                                     name="password_confirmation">
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{ __('dashboard.role') }}</label>
                                                <select class="form-control" name="role_id">
                                                    <optgroup label="{{ __('dashboard.select_role') }}">
                                                        @foreach ($roles as $role)
                                                            <option value="{{ $role->id }}">{{ $role->role }}
                                                            </option>
                                                        @endforeach
                                                    </optgroup>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{ __('dashboard.status') }}</label>
                                                <select class="form-control" name="status">
                                                    <optgroup label="{{ __('dashboard.select_status') }}">
                                                        <option value="1" selected>{{ __('dashboard.active') }}</option>
                                                        <option value="0">{{ __('dashboard.inactive') }}</option>
                                                    </optgroup>
                                                </select>
                                              </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions right">
                                    <button type="reset" class="btn btn-warning mr-1">
                                        <i class="ft-x"></i> {{ __('dashboard.cancel') }}
                                    </button>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="la la-check-square-o"></i> {{ __('dashboard.save') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


