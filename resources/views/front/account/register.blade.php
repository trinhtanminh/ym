@extends('front.layouts.app')

@section('content')
    <section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="{{route("front.home")}}">Trang chủ</a></li>
                    <li class="breadcrumb-item">Đăng ký</li>
                </ol>
            </div>
        </div>
    </section>

    <section class=" section-10">
        <div class="container rounded">
            <div class="login-form rounded">
                <form action="" method="post" name="registrationForm" id="registrationForm">
                    <h4 class="modal-title">Đăng Ký Tài Khoản Ngay!</h4>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Tên" id="name" name="name">
                        <p></p>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Email" id="email" name="email">
                        <p></p>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Số điện thoại" id="phone" name="phone">
                        <p></p>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Mật khẩu" id="password" name="password">
                        <p></p>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Xác nhận lại mật khẩu" id="cpassword"
                            name="password_confirmation">
                        <p></p>
                    </div>
                    <div class="form-group small">
                        <a href="#" class="forgot-link">Bạn quên mật khẩu?</a>
                    </div>
                    <button type="submit" class="btn btn-dark btn-block btn-lg rounded" value="Register">Đăng Ký</button>
                </form>
                <div class="text-center small">Bạn đã có tài khoản? <a href="{{route('account.login')}}">Đăng Nhập</a></div>
            </div>
        </div>
    </section>
@endsection

@section('customJS')
    <script type="text/javascript">
        $(document).ready(function() {
            $("#registrationForm").submit(function(event) {
                event.preventDefault();

                $("button[type='submit']").prop('disabled', true);

                $.ajax({
                    url: '{{ route('account.processRegister') }}',
                    type: 'post',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(response) {

                        $("button[type='submit']").prop('disabled', false);

                        var errors = response.errors;

                        if (response.status == false) {
                            // Name
                            if (errors.name) {
                                $("#name").siblings("p").addClass('invalid-feedback').html(
                                    errors.name);
                                $("#name").addClass('is-invalid');
                            } else {
                                $("#name").siblings("p").removeClass('invalid-feedback').html(
                                    '');
                                $("#name").removeClass('is-invalid');
                            }
                            // Email
                            if (errors.email) {
                                $("#email").siblings("p").addClass('invalid-feedback').html(
                                    errors.email);
                                $("#email").addClass('is-invalid');
                            } else {
                                $("#email").siblings("p").removeClass('invalid-feedback').html(
                                    '');
                                $("#email").removeClass('is-invalid');
                            }
                            // Password
                            if (errors.password) {
                                $("#password").siblings("p").addClass('invalid-feedback').html(
                                    errors.password);
                                $("#password").addClass('is-invalid');
                            } else {
                                $("#password").siblings("p").removeClass('invalid-feedback')
                                    .html('');
                                $("#password").removeClass('is-invalid');
                            }
                        } else {
                            $("#name").siblings("p").removeClass('invalid-feedback').html(
                                '');
                            $("#name").removeClass('is-invalid');

                            $("#email").siblings("p").removeClass('invalid-feedback').html(
                                '');
                            $("#email").removeClass('is-invalid');

                            $("#password").siblings("p").removeClass('invalid-feedback')
                                .html('');
                            $("#password").removeClass('is-invalid');

                            window.location.href = '{{ route('account.login') }}';
                        }
                    },
                    error: function(jqXHR, exception) {
                        console.log("Something went wrong", jqXHR.responseText);
                    }
                });
            });
        });
    </script>
@endsection
