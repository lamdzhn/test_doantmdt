@php
    $page_title = $card_header = 'Thêm giá trị thuộc tính';
    $page_header = 'Quản lý giá trị thuộc tính'
@endphp

@extends('backend.layout.master')

@section('notification')
    @if ( $errors->has('null_attribute_value') )
        <div class="alert alert-danger alert-dismissible" role="alert">
            <strong>{{ $errors->first('null_attribute_value') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Close</span>
            </button>
        </div>
    @endif
@endsection

@section('content')

    <form method="post" action="{{ route('be.attribute_value.store') }}" onkeypress="return event.keyCode !== 13;">
        @csrf
        <div class="form-group">
            <label>Danh mục</label>
            <select class="browser-default custom-select form-control" name="category_id" id="category_id" onchange="getAttributes()">
                <option value="0">-- Chọn danh mục --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div id="attributes_box"></div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary" style="float: right">Thêm giá trị thuộc tính</button>
            <button type="reset" class="btn btn-primary" style="float: right; margin-right: 10px">Nhập lại</button>
        </div>
    </form>

    <script>
        function getAttributes() {
            if ($('#category_id').val() === '0') {
                $('#attributes_box').empty();
            }
            else {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: 'get',
                    url: 'http://doan.test/backend/index/attribute-value/get_attributes',
                    data: {},
                    success: function (data) {
                        $('#attributes_box').html(data);
                    }
                });
            }
        }
    </script>
@endsection
