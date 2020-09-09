@php
    $page_title = $card_header = 'Danh sách danh mục';
    $page_header = 'Quản lý danh mục';
@endphp

@extends('backend.layout.master')

@section('content')
    <table class="table table-bordered table-hover dataTable text-center">
        <thead>
            <tr>
                <th>ID danh mục</th>
                <th>Danh mục cha</th>
                <th>Tên danh mục</th>
                <th>Đường dẫn tĩnh của danh mục</th>
                <th>Thời gian tạo</th>
                <th>Thời gian cập nhật</th>
                <th>Chức năng</th>
            </tr>
        </thead>
        <tbody id="categories_box">
            @if (count($categories) == 0)
                <tr>
                    <td colspan="8">Không có dữ liệu</td>
                </tr>
            @else
                @foreach($categories as $category)
                    <tr id="category_{{ $category->id }}">
                        <td>{{ $category->id }}</td>
                        @if ($category->parent_id == 0)
                            <td>Không có</td>
                        @else
                            <td>{{ \App\Models\Category::getCategoryById($category->parent_id)->name }}</td>
                        @endif
                        <td><a href="#edit_category_{{ $category->id }}" data-toggle="modal">{{ $category->name }}</a></td>
                        <td>{{ $category->slug }}</td>
                        <td>{{ date('d-m-Y H:i:s', strtotime($category->created_at)) }}</td>
                        <td>{{ date('d-m-Y H:i:s', strtotime($category->updated_at)) }}</td>
                        <td><button onclick="deleteCategory({{ $category->id }})" href="#" class="btn btn-danger">Xóa</button></td>
                    </tr>

                    <div class="modal fade" id="edit_category_{{ $category->id }}" role="dialog">
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content" style="margin-top:50%">
                                <div class="modal-header">
                                    <h4 class="modal-title">Sửa danh mục: {{ $category->name }}</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <label>Danh mục cha</label>
                                    <div class="form-group">
                                        <select id="parent_id_{{ $category->id }}" class="browser-default custom-select form-control">
                                            <option value="0">Không có</option>
                                            @foreach($categories as $value)
                                                @if ($category->parent_id == $value->id)
                                                    <option value="{{ $value->id }}" selected>{{ $value->name }}</option>
                                                @elseif ($value->id == $category->id)

                                                @else
                                                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>

                                    <label>Tên danh mục</label>
                                    <div class="input-group mb-3">
                                        <input onkeyup="getSlug({{ $category->id }})" class="form-control" type="text" id="name_{{ $category->id }}" value="{{ (old('name')) != null ? old('name') : $category->name }}">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fa fa-info"></i></span>
                                        </div>
                                    </div>

                                    <label>Đường dẫn tĩnh của danh mục</label>
                                    <div class="input-group mb-3">
                                        <input class="form-control" type="text" id="slug_{{ $category->id }}" value="{{ (old('slug')) != null ? old('slug') : $category->slug }}">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fa fa-info"></i></span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button id="editCategory_{{ $category->id }}" style="float: right" type="button" class="btn btn-primary" data-dismiss="modal" onclick="editCategory({{ $category->id }})">Sửa</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </tbody>
    </table>

    <script>
        function getSlug(id) {
            var name = $('#name_'+id).val();
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
            $('#slug_'+id).val(slug);
        }

        function editCategory(id) {
            if ($('#name_' + id).val() === '' || $('#slug_' + id).val() === '') {
                alert('Tên danh mục và đường dẫn tĩnh của danh mục không được phép để trống');
                $('#editCategory_' + id).attr('data-dismiss', '');
                console.log($('#categories_box'));
            }
            else {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: 'post',
                    url: 'http://doan.test/backend/index/category/edit/'+id,
                    data: {name: $('#name_'+id).val(), slug: $('#slug_'+id).val(), parent_id: $('#parent_id_'+id).val()},
                    success: function (data) {
                        alert('Sửa danh mục thành công');
                        window.location.href = "http://doan.test/backend/index/category";
                    }
                });
            }
        }

        function deleteCategory(id) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: 'delete',
                url: 'http://doan.test/backend/index/category/delete/'+id,
                data: {},
                success: function (data) {
                    $('#category_'+id).remove();
                    $('#edit_category_'+id).remove();
                    if (!$.trim( $('#attributes_box').html()).length) {
                        $('#categories_box').append('<tr><td colspan="7">Không có dữ liệu</td></tr>');
                    }
                    console.log($('#categories_box'));
                    alert('Xóa danh mục thành công');
                }
            })
        }
    </script>
@endsection

@section('pagination')
    @if(count($categories) == 0)
    @else
            <div class="viewing" style="display: inline-block">
                {{ 'Đang xem danh mục '.$categories->firstitem().'-'.$categories->lastitem().' trên tổng số '.$categories->total() }}
            </div>
            <div class="pagination" style="float: right">
                {{ $categories->links() }}
            </div>
    @endif
@endsection
