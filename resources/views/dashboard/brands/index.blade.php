@extends('layouts.dashboard.app')
@section('title')
    {{ __('dashboard.brands') }}
@endsection
@section('content')

@endsection
@push('css')
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/dashboard') }}/vendors/css/tables/datatable/datatables.min.css">
@endpush
@push('js')
    <script src="{{ asset('assets/dashboard') }}/vendors/js/tables/datatable/datatables.min.js" type="text/javascript">
    </script>
@endpush
