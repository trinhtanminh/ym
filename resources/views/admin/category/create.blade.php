@extends('admin.layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tạo Danh Mục</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('categories.index') }}" class="btn btn-primary">Trở lại</a>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <form action="{{ route('category.store') }}" method="post" id="categoryForm" name="categoryForm">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name">Tên</label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        placeholder="Name" autocomplete="name">
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="slug">Slug - SEO</label>
                                    <input type="text" readonly name="slug" id="slug" class="form-control"
                                        placeholder="Slug">
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <input type="hidden" id="image_id" name="image_id" value="">
                                    <label for="image">Hình ảnh</label>
                                    <div id="image" class="dropzone dz-clickable">
                                        <div class="dz-message needsclick">
                                            <br>Kéo và thả tệp vào đây hoặc nhấn để tải lên.<br><br>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="status">Trạng thái</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="1">Hoạt động</option>
                                        <option value="0">Chặn</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="status">Hiển thị trên Trang chủ</label>
                                    <select name="showHome" id="showHome" class="form-control">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pb-5 pt-3">
                    <button type="submit" class="btn btn-primary">Tạo</button>
                    <a href="{{ route('categories.index') }}" class="btn btn-outline-dark ml-3">Hủy bỏ</a>
                </div>
            </form>
        </div>
    </section>
@endsection

@section('customJs')
    <script>
        // Gắn một hàm xử lý sự kiện cho sự kiện submit của form với id là "categoryForm"
        $("#categoryForm").submit(function(event) {

            // Ngăn chặn hành động mặc định của sự kiện submit, ngăn chặn trang web từ việc làm mới lại (refresh).
            event.preventDefault();

            // Lấy đối tượng jQuery của form với id "categoryForm" và gán cho biến element.
            var element = $(this);

            // Disable nút submit trong form để tránh việc gửi nhiều yêu cầu cùng một lúc.
            $("button[type=submit]").prop('disabled', true);

            // Sử dụng jQuery Ajax để gửi yêu cầu đến máy chủ.
            $.ajax({
                // Địa chỉ URL mà yêu cầu sẽ được gửi đến. Thường là một route trong Laravel được đặt tên là 'category.store'.
                url: '{{ route('category.store') }}',

                // Phương thức HTTP sẽ được sử dụng (POST trong trường hợp này).
                type: "post",

                // Dữ liệu sẽ được gửi lên máy chủ, được chuyển đổi từ form thành một mảng các cặp tên và giá trị.
                data: element.serializeArray(),

                // Loại dữ liệu mà máy chủ trả về sẽ được xử lý là JSON.
                dataType: 'json',

                // Hàm được gọi khi yêu cầu Ajax thành công. Biến response chứa dữ liệu trả về từ máy chủ.
                success: function(response) {

                    // Enable nút submit sau khi yêu cầu Ajax thành công.
                    $("button[type=submit]").prop('disabled', false);

                    // Kiểm tra trạng thái trả về từ máy chủ.
                    if (response["status"] == true) {

                        // Nếu trạng thái là true, chuyển hướng trình duyệt đến một đường dẫn mới, thường là danh sách các danh mục (index).
                        window.location.href = "{{ route('categories.index') }}";

                        // Loại bỏ các lớp và nội dung thông báo lỗi cho trường 'name'.
                        $('#name').removeClass('is-invalid').siblings('p').removeClass(
                            'invalid-feedback').html("");

                        // Loại bỏ các lớp và nội dung thông báo lỗi cho trường 'slug'.
                        $('#slug').removeClass('is-invalid').siblings('p').removeClass(
                            'invalid-feedback').html("");
                    } else {

                        // Nếu trạng thái là false, lấy danh sách lỗi từ response và kiểm tra lỗi của trường 'name'.
                        var errors = response['errors'];
                        if (errors['name']) {

                            // Nếu có lỗi cho trường 'name', thêm các lớp và hiển thị thông báo lỗi.
                            $('#name').addClass('is-invalid').siblings('p').addClass('invalid-feedback')
                                .html(errors['name']);
                        } else {

                            // Nếu không có lỗi cho trường 'name', loại bỏ các lớp và nội dung thông báo lỗi.
                            $('#name').removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html("");
                        }

                        // Kiểm tra lỗi của trường 'slug'.
                        if (errors['slug']) {

                            // Nếu có lỗi cho trường 'slug', thêm các lớp và hiển thị thông báo lỗi.
                            $('#slug').addClass('is-invalid').siblings('p').addClass('invalid-feedback')
                                .html(errors['slug']);
                        } else {

                            // Nếu không có lỗi cho trường 'slug', loại bỏ các lớp và nội dung thông báo lỗi.
                            $('#slug').removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html("");
                        }
                    }
                },

                // Hàm được gọi khi có lỗi trong quá trình gửi yêu cầu Ajax. In ra console thông báo "Something went wrong".
                error: function(jqXHR, exception) {
                    console.log("Something went wrong");
                }
            });
        });


        $("#name").change(function() {
            var element = $(this); // Thêm từ khóa var để khai báo biến element
            $("button[type=submit]").prop('disabled', true);

            $.ajax({
                url: '{{ route('getSlug') }}',
                type: 'get',
                data: {
                    title: element.val()
                },
                dataType: 'json',
                success: function(response) {
                    $("button[type=submit]").prop('disabled', false);
                    if (response.status === true) { // Sửa lỗi cú pháp ở đây
                        $("#slug").val(response.slug); // Sửa lại cú pháp ở đây
                    }
                }
            });
        });

        Dropzone.autoDiscover = false;
        const dropzone = $("#image").dropzone({
            init: function() {
                this.on('addedfile', function(file) {
                    if (this.files.length > 1) {
                        this.removeFile(this.files[0]);
                    }
                });
            },
            url: "{{ route('temp-images.create') }}",
            maxFiles: 1,
            paramName: 'image',
            addRemoveLinks: true,
            acceptedFiles: "image/jpeg,image/png,image/gif",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(file, response) {
                $("#image_id").val(response.image_id);
                //console.log(response)
            }
        });
    </script>
@endsection
