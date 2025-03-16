@extends('layouts.dashboard.app')
@section('title')
    Edit Role
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
                                
                                <li class="breadcrumb-item"><a href="{{ route('dashboard.roles.index') }}">{{ __('dashboard.roles') }}</a>
                                </li>
                                <li class="breadcrumb-item active"><a href="{{ route('dashboard.roles.create') }}">{{ __('dashboard.edit_role') }}</a>
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
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" id="basic-layout-colored-form-control">{{ __('dashboard.edit_role') }}</h4>
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
                            <form class="form" action="{{ route('dashboard.roles.update' , $role->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-body">

                                    <input  name="id"  hidden value="{{$role->id}}">
                                    <h4 class="form-section"><i class="la la-new"></i>{{ __('dashboard.edit_role') }}</h4>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="userinput1">{{ __('dashboard.role_en') }}</label>
                                                <input type="text" id="userinput1" class="form-control border-primary"
                                                value="{{$role->getTranslation('role' , 'en')}}"    placeholder="Name" name="role[en]">
                                            </div>

                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="userinput1">{{ __('dashboard.role_ar') }}</label>
                                                <input type="text" id="userinput1" class="form-control border-primary"
                                                   value="{{$role->getTranslation('role' , 'ar')}}"  placeholder="Name" name="role[ar]">
                                            </div>

                                        </div>

                                    </div>
                                    <div class="row">
                                        @if (Config::get('app.locale') == 'ar')
                                            @foreach (config('permissions_ar') as $key => $value)
                                                <div class="col-md-2">
                                                    <input id="{{$value}}" value="{{ $key }}" type="checkbox" name="permissions[]"
                                                        class="checkbox"  @checked(in_array($key, json_decode($role->permissions)))>
                                                    <label for="{{$value}}">{{ $value }}</label>
                                                </div>
                                            @endforeach
                                        @else
                                            @foreach (config('permissions_en') as $key => $value)
                                                <div class="col-md-2">
                                                    <input id="{{$value}}" value="{{ $key }}" type="checkbox" name="permissions[]"
                                                        class="checkbox"  @checked(in_array($key, $role->permissions))>
                                                    <label {{$value}}>{{ $value }}</label>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                                <div class="form-actions right">
                                    <a href="{{ route('dashboard.roles.index') }}" class="btn btn-warning mr-1">
                                        <i class="ft-x"></i> {{ __('dashboard.cancel') }}
                                    </a>
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
