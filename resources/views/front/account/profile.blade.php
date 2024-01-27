@extends('front.layouts.app')

@section('content')
    <section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="#">Tài khoản của tôi</a></li>
                    <li class="breadcrumb-item">Cài đặt</li>
                </ol>
            </div>
        </div>
    </section>

    <section class=" section-11 ">
        <div class="container  mt-5">
            <div class="row">
                <div class="col-md-3">
                    @include('front.account.common.sidebar')

                </div>
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="h5 mb-0 pt-2 pb-2">Thông tin cá nhân</h2>
                        </div>
                        <div class="card-body p-4">
                            <div class="row">
                                <div class="mb-3">
                                    <label for="name">Họ và tên</label>
                                    <input type="text" name="name" id="name" placeholder="Enter Your Name"
                                        class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="email">Email</label>
                                    <input type="text" name="email" id="email" placeholder="Enter Your Email"
                                        class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="phone">Số điện thoại</label>
                                    <input type="text" name="phone" id="phone" placeholder="Enter Your Phone"
                                        class="form-control">
                                </div>

                                <div class="mb-3">
                                    <label for="phone">Địa chỉ</label>
                                    <textarea name="address" id="address" class="form-control" cols="30" rows="5"
                                        placeholder="Enter Your Address"></textarea>
                                </div>

                                <div class="d-flex">
                                    <button class="btn btn-dark">Cập nhật thông tin</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
