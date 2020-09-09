@php
    $page_title = $page_header = 'Đồ nam';
@endphp

@extends('frontend.layout.master')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('styles/categories.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('styles/categories_responsive.css') }}">
@endsection

@section('js')
    <script src="{{ asset('js/categories.js') }}"></script>
@endsection
