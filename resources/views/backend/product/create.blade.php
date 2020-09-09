@php
    $page_title = $card_header = 'Thêm sản phẩm mới';
    $page_header = 'Quản lý sản phẩm';
@endphp

@extends('backend.layout.master')

@section('notification')
    @if ( $errors->has('null_attributes') )
        <div class="alert alert-danger alert-dismissible" role="alert">
            <strong>{{ $errors->first('null_attributes') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Close</span>
            </button>
        </div>
    @endif

    @if ( $errors->has('null_price_quantity') )
        <div class="alert alert-danger alert-dismissible" role="alert">
            <strong>{{ $errors->first('null_price_quantity') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Close</span>
            </button>
        </div>
    @endif
@endsection

@section('content')
    <form method="post" action="{{ route('be.product.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>Danh mục sản phẩm</label>
            <select name="category_id" id="category_id" class="browser-default custom-select form-control" onchange="getAttributes()">
                @if (count($categories) == 0)
                    <option>-- Vui lòng thêm danh mục sản phẩm trước --</option>
                @else
                    <option>-- Chọn danh mục sản phẩm --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                @endif
            </select>
        </div>

        <div class="form-group">
            <label>Tên sản phẩm</label>
            <div class="input-group mb-3">
                <input class="form-control" type="text" name="name" id="name" placeholder="Tên sản phẩm (*)" value="{{ old('name') }}" onkeyup="getSlug()">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fa fa-info"></span>
                    </div>
                </div>
            </div>
            @if($errors->has('name'))
                <p style="color: red">{{ $errors->first('name') }}</p>
            @endif
        </div>

        <div class="form-group">
            <label>Đường dẫn tĩnh của sản phẩm</label>
            <div class="input-group mb-3">
                <input class="form-control" type="text" name="slug" id="slug" placeholder="Đường dẫn tĩnh của sản phẩm (*)" value="{{ old('slug') }}">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fa fa-info"></span>
                    </div>
                </div>
            </div>
            @if($errors->has('slug'))
                <p style="color: red">{{ $errors->first('slug') }}</p>
            @endif
        </div>

        <div id="attributes_box"></div>

        <label>Mô tả ngắn</label>
        <div class="form-group">
            <textarea class="form-control" name="description_short">{{ old('description_short') }}</textarea>
        </div>
        @if($errors->has('description_short'))
            <p style="color: red">{{ $errors->first('description_short') }}</p>
        @endif

        <label>Mô tả dài</label>
        <div class="form-group">
            <textarea class="form-control" name="description_long">{{ old('description_long') }}</textarea>
        </div>
        @if($errors->has('description_long'))
            <p style="color: red">{{ $errors->first('description_long') }}</p>
        @endif

        <button style="float: right" type="submit" class="btn btn-primary">Thêm sản phẩm</button>
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

        function getAttributes() {
            category_id = $('#category_id').val();

            if (category_id === '-- Chọn danh mục sản phẩm --') {
                $('#attributes_box').empty();
            }
            else {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: 'post',
                    url: 'http://doan.test/backend/index/product/create/get_attributes',
                    data: {category_id : category_id},
                    success: function (data) {
                        $('#attributes_box').html(data);
                    }
                });
            }
        }

        function createVariants() {
            var i = 1;
            var attributes_name = [];
            while($('#attribute_'+i).length) {
                attributes_name.push('#attribute_'+i);
                i = i + 1;
            }

            var attribute_array = [];

            i = 1;

            attributes_name.forEach(function (attribute_name) {
                attribute_array.push($(attribute_name).val());
                i = i + 1;
            });

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: 'post',
                url: 'http://doan.test/backend/index/product/create/create_variants',
                data: {attributes: attribute_array},
                success: function (data) {
                    $('#variants_box').html(data);
                }
            });
        }

        function deleteAttribute(i) {
            if (confirm('Bạn chắc chắn muốn xóa biến thể này?')) {
                $('#variant_' + i).remove();
                alert('Xóa biến thể ' + i + ' thành công');
            }
        }
    </script>
@endsection
