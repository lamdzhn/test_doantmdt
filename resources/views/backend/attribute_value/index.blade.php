@php
    $page_title = $card_header = 'Danh sách giá trị thuộc tính';
    $page_header = 'Quản lý giá trị thuộc tính';
@endphp

@extends('backend.layout.master')

@section('content')
    <table class="table table-bordered table-hover dataTable text-center">
        <thead>
        <tr>
            <th>ID</th>
            <th>Danh mục</th>
            <th>Thuộc tính</th>
            <th>Giá trị</th>
            <th>Thời gian tạo</th>
            <th>Thời gian cập nhật cuối</th>
            <th>Chức năng</th>
        </tr>
        </thead>
        <tbody>
        @if (count($attribute_values) == 0)
            <tr>
                <td colspan="6">Không có dữ liệu</td>
            </tr>
        @else
            @foreach($attribute_values as $attribute_value)
                <tr>
                    <td>{{ $attribute_value->id }}</td>
                    <td>{{ \App\Models\Category::getCategoryById($attribute_value->category_id)->name }}</td>
                    <td>{{ \App\Models\Attribute::getAttributeById($attribute_value->attribute_id)->name }}</td>
                    <td><a href="#">{{ $attribute_value->value }}</a></td>
                    <td>{{ date('d-m-Y H:i:s', strtotime($attribute_value->created_at)) }}</td>
                    <td>{{ date('d-m-Y H:i:s', strtotime($attribute_value->updated_at)) }}</td>
                    <td><button class="btn btn-danger" onclick="deleteAttributeValue({{ $attribute_value->id }})">Xóa</button></td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
@endsection

@section('pagination')
    @if(count($attribute_values) == 0)
    @else
        <div class="viewing" style="display: inline-block">
            {{ 'Đang xem giá trị thuộc tính '.$attribute_values->firstitem().'-'.$attribute_values->lastitem().' trên tổng số '.$attribute_values->total() }}
        </div>
        <div class="pagination" style="float: right">
            {{ $attribute_values->links() }}
        </div>
    @endif
@endsection
