@extends('front.layouts.app')

@section('content')
    <section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="#">Trang chủ</a></li>
                    <li class="breadcrumb-item"><a class="white-text" href="#">Cửa hàng</a></li>
                    <li class="breadcrumb-item">Thanh toán</li>
                </ol>
            </div>
        </div>
    </section>

    <section class="section-9 pt-4">
        <div class="container">
            <form id="orderForm" name="orderForm" action="" method="post">
                <div class="row">
                    <div class="col-md-8">
                        <div class="sub-title">
                            <h2>Địa chỉ giao hàng</h2>
                        </div>
                        <div class="card shadow-lg border-0">
                            <div class="card-body checkout-form">
                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <input type="text" name="first_name" id="first_name" class="form-control"
                                                placeholder="Họ" value="{{(!empty($customerAddress)) ?  $customerAddress->first_name : ''}}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <input type="text" name="last_name" id="last_name" class="form-control"
                                                placeholder="Tên" value="{{(!empty($customerAddress)) ?  $customerAddress->last_name : ''}}">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <input type="text" name="email" id="email" class="form-control"
                                                placeholder="Email" value="{{(!empty($customerAddress)) ?  $customerAddress->email : ''}}">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <select name="country" id="country" class="form-control">
                                                <option value="">Chọn khu vực</option>
                                                @if ($countries->isNotEmpty())
                                                    @foreach ($countries as $country)
                                                        <option {{(!empty($customerAddress) && $customerAddress->country_id == $country->id) ? 'selected' : ''}} value="{{ $country->id }}">{{ $country->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <textarea name="address" id="address" cols="30" rows="3" placeholder="Địa chỉ" class="form-control">{{(!empty($customerAddress)) ? $customerAddress->address : ''}}</textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <input type="text" name="apartment" id="apartment" class="form-control"
                                                placeholder="Căn hộ, phòng, đơn vị, v.v. (tuỳ chọn)" value="{{(!empty($customerAddress)) ? $customerAddress->apartment : ''}}">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <input type="text" name="city" id="city" class="form-control"
                                                placeholder="Thành Phố" value="{{(!empty($customerAddress)) ? $customerAddress->city : ''}}">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <input type="text" name="state" id="state" class="form-control"
                                                placeholder="Tỉnh/Thành phố" value="{{(!empty($customerAddress)) ? $customerAddress->state : ''}}">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <input type="text" name="zip" id="zip" class="form-control"
                                                placeholder="Mã zip (mã bưu điện)" value="{{(!empty($customerAddress)) ? $customerAddress->zip : ''}}">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <input type="text" name="mobile" id="mobile" class="form-control"
                                                placeholder="Số điện thoại di động" value="{{(!empty($customerAddress)) ? $customerAddress->mobile : ''}}">
                                        </div>
                                    </div>


                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <textarea name="order_notes" id="order_notes" cols="30" rows="2" placeholder="Ghi chú đơn hàng (tuỳ chọn)"
                                                class="form-control"></textarea>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="sub-title">
                            <h2>Tóm tắt đơn hàng</h3>
                        </div>
                        <div class="card cart-summery">
                            <div class="card-body">
                                @foreach (Cart::content() as $item)
                                    <div class="d-flex justify-content-between pb-2">
                                        <div class="h6">{{ $item->name }} X {{ $item->qty }}</div>
                                        <div class="h6">{{ $item->price * $item->qty }}đ</div>
                                    </div>
                                @endforeach


                                <div class="d-flex justify-content-between summery-end">
                                    <div class="h6"><strong>Giá trị sản phẩm: </strong></div>
                                    <div class="h6"><strong>{{ Cart::subtotal() }}đ</strong></div>
                                </div>
                                <div class="d-flex justify-content-between mt-2">
                                    <div class="h6"><strong>Phí vận chuyển: </strong></div>
                                    <div class="h6">0đ<strong></strong></div>
                                </div>
                                <div class="d-flex justify-content-between mt-2 summery-end">
                                    <div class="h5"><strong>Tổng thanh toán:</strong></div>
                                    <div class="h5"><strong>{{ Cart::subtotal() }}đ</strong></div>
                                </div>
                            </div>
                        </div>

                        <div class="card payment-form">
                            <div class="">
                                <input checked type="radio" name="payment_method" value="cod"
                                    id="payment_method_one">
                                <label for="payment_method_one" class="form-check-label">Thanh toán khi nhận hàng</label>
                            </div>

                            <div class="">
                                <input type="radio" name="payment_method" value="stripe" id="payment_method_two">
                                <label for="payment_method_two" class="form-check-label">Thanh toán online</label>
                            </div>


                            <div class="card-body p-0 d-none mt-3" id="card-payment-form">
                                <div class="mb-3">
                                    <label for="card_number" class="mb-2">Số thẻ</label>
                                    <input type="text" name="card_number" id="card_number"
                                        placeholder="Valid Card Number" class="form-control">
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="expiry_date" class="mb-2">Ngày hết hạn</label>
                                        <input type="text" name="expiry_date" id="expiry_date" placeholder="MM/YYYY"
                                            class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="expiry_date" class="mb-2">Mã CVV</label>
                                        <input type="text" name="expiry_date" id="expiry_date" placeholder="123"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="pt-4">
                                <button type="submit" class="btn-dark btn btn-block w-100">Thanh toán Ngay</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection

@section('customJS')
    <script>
        $("#payment_method_one").click(function() {
            if ($(this).is(":checked") == true) {
                $('#card-payment-form').addClass('d-none');
            }
        });

        $("#payment_method_two").click(function() {
            if ($(this).is(":checked") == true) {
                $('#card-payment-form').removeClass('d-none');
            }
        });

        $("#orderForm").submit(function(event) {
            event.preventDefault();

            $('button[type="submit"]').prop('disabled',true);


            $.ajax({
                url: '{{ route('front.processCheckout') }}', //
                type: 'post',
                data: $(this).serializeArray(),
                dataType: 'json',
                success: function(response) {
                    var errors = response.errors;

                    $('button[type="submit"]').prop('disabled',false);

                    if (response.status == false) {
                        function updateFieldValidation(fieldId, errorKey) {
                            const $field = $(`#${fieldId}`);
                            const $errorContainer = $field.siblings("p");

                            if (errors[errorKey]) {
                                $field.addClass('is-invalid');
                                $errorContainer.addClass('invalid-feedback').html(errors[errorKey]);
                            } else {
                                $field.removeClass('is-invalid');
                                $errorContainer.removeClass('invalid-feedback').html('');
                            }
                        }
                        updateFieldValidation('first_name', 'first_name');
                        updateFieldValidation('last_name', 'last_name');
                        updateFieldValidation('email', 'email');
                        updateFieldValidation('country', 'country');
                        updateFieldValidation('address', 'address');
                        updateFieldValidation('state', 'state');
                        updateFieldValidation('city', 'city');
                        updateFieldValidation('zip', 'zip');
                        updateFieldValidation('mobile', 'mobile');
                    } else {
                         window.location.href = "{{ url('/thanks/') }}/" + response.orderId;
                    }
                }
            });
        });
    </script>
@endsection
