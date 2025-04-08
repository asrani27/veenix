@extends('mobile.app')

@push('css')
<style>
    .card a:hover {
        box-shadow: 2px -1px 5px 11px rgba(0, 0, 0, 0.26);
        -webkit-box-shadow: 2px -1px 5px 11px rgba(0, 0, 0, 0.26);
        -moz-box-shadow: 2px -1px 5px 11px rgba(0, 0, 0, 0.26);
        background-color: gray;
    }
</style>
@endpush
@section('content')

@endsection