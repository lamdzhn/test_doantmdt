@php
    $page_title = $card_header = 'Danh sách thuộc tính';
    $page_header = 'Quản lý thuộc tính';
@endphp

@extends('backend.layout.master')

@section('content')
    <table class="table table-bordered table-hover dataTable text-center">
        <thead>
            <tr>
                <th>ID</th>
                <th>Thuộc tính</th>
                <th>Thời gian tạo</th>
            </tr>
        </thead>
        <tbody>
            @if (count($attributes) == 0)
                <tr>
                    <td colspan="3">Không có dữ liệu</td>
                </tr>
            @else
                @foreach($attributes as $attribute)
                    <tr>
                        <td>{{ $attribute->id }}</td>
                        <td>{{ $attribute->name }}</td>
                        <td>{{ date('d-m-Y H:i:s', strtotime($attribute->created_at)) }}</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
@endsection
