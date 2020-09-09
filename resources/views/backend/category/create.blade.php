@php
    $page_title = $card_header = 'Thêm danh mục mới';
    $page_header = 'Quản lý danh mục';
@endphp

@extends('backend.layout.master')

@section('notification')

@endsection

@section('content')
    <form method="POST" action="{{ route('be.category.store') }}">
        @csrf
        <div class="form-group">
            <label>Danh mục cha</label>
            <select name="parent_id" class="browser-default custom-select form-control" aria-hidden="true">
                @if (count($categories) == 0)
                    <option value="0">Trống</option>
                @else
                    <option value="0">Trống</option>
                    @foreach($categories as $category)
                        @if ($category->parent_id == 0)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endif
                    @endforeach
                @endif
            </select>
        </div>

        <label>Tên danh mục</label>
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="name" id="name" placeholder="Tên danh mục (*)" value="{{ old('name') }}" onkeyup="getSlug()">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fa fa-info"></span>
                </div>
            </div>
        </div>
        @if($errors->has('name'))
            <p style="color: red">{{ $errors->first('name') }}</p>
        @endif

        <label>Đường dẫn tĩnh</label>
        <div class="input-group mb-3">
            <input type="text" class="form-control" id="slug" name="slug" placeholder="Đường dẫn tĩnh của danh mục (*)" value="{{ old('slug') }}">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fa fa-info"></span>
                </div>
            </div>
        </div>
        @if($errors->has('slug'))
            <p style="color: red">{{ $errors->first('slug') }}</p>
        @endif

        <button style="float: right" type="submit" class="btn btn-primary">Thêm danh mục</button>
        <button style="float: right; margin-right: 10px" type="reset" class="btn btn-primary">Nhập lại</button>
    </form>

    <script>
        function getSlug() {
            var name = $('#name').val();
            //Đổi chữ hoa thành chữ thường
            slug = name.toLowerCase();

            //Đổi ký tự có dấu thành không dấu
            slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
            slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
            slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
            slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
            slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
            slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
            slug = slug.replace(/đ/gi, 'd');
            //Xóa các ký tự đặt biệt
            slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
            //Đổi khoảng trắng thành ký tự gạch ngang
            slug = slug.replace(/ /gi, "-");
            //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
            //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
            slug = slug.replace(/\-\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-\-/gi, '-');
            slug = slug.replace(/\-\-/gi, '-');
            //Xóa các ký tự gạch ngang ở đầu và cuối
            slug = '@' + slug + '@';
            slug = slug.replace(/\@\-|\-\@|\@/gi, '');
            //In slug ra textbox có id “slug”
            $('#slug').val(slug);
        }
    </script>
@endsection
