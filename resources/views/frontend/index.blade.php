@php
    $page_title = 'Trang chủ'
@endphp

@extends('frontend.layout.master')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('styles/main_styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('styles/responsive.css') }}">
@endsection

@section('ajax')
    <script>
        function showproduct(category) {
            $('#products_box').find('*').not('#loading-ajax').remove();
            $.ajaxSetup({
                beforeSend: function() {
                    $('#loading-ajax').css('display', 'block');
                },
                complete: function(){
                    $('#loading-ajax').css('display', 'none');
                },
            });
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: 'GET',
                url: 'http://doan.test/index/show_products/'+category,
                success: function (data) {
                    $('#products_box').append(data);
                    $.getScript("js/custom.js");
                }
            });
        }
    </script>
@endsection
@section('js')
    <script src="{{ asset('js/custom.js') }}"></script>
    <script type="text/javascript" src="https://ahachat.com/customer-chats/customer_chat_I3KUhaeZa05f4f9357531a5.js"></script>
@endsection
