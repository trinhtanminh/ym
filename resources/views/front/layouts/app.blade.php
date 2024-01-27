<!DOCTYPE html>
<html class="no-js" lang="vi">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>YM Online Shop</title>
        <meta name="description" content="" />
        <meta name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=1, user-scalable=no" />

        <meta name="HandheldFriendly" content="True" />
        <meta name="pinterest" content="nopin" />
        <meta property="og:locale" content="vi" />
        <meta property="og:type" content="website" />
        <meta property="fb:admins" content="" />
        <meta property="fb:app_id" content="" />
        <meta property="og:site_name" content="" />
        <meta property="og:title" content="" />
        <meta property="og:description" content="" />
        <meta property="og:url" content="" />
        <meta property="og:image" content="" />
        <meta property="og:image:type" content="image/jpeg" />
        <meta property="og:image:width" content="" />
        <meta property="og:image:height" content="" />
        <meta property="og:image:alt" content="" />

        <meta name="twitter:title" content="" />
        <meta name="twitter:site" content="" />
        <meta name="twitter:description" content="" />
        <meta name="twitter:image" content="" />
        <meta name="twitter:image:alt" content="" />
        <meta name="twitter:card" content="summary_large_image" />


        <link rel="stylesheet" type="text/css" href="{{ asset('front-assets/css/slick.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('front-assets/css/slick-theme.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('front-assets/css/style.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('front-assets/css/ion.rangeSlider.min.css') }}" />

        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link
            href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
            rel="stylesheet">


        <!-- Fav Icon -->
        <link rel="shortcut icon" type="image/x-icon" href="#" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>

    <body data-instant-intensity="mousedown">
        <header class="bg-dark">
            <div class="container">
                <nav class="navbar navbar-expand-xl" id="navbar">
                    <a href="index.php" class="text-decoration-none mobile-logo">
                    </a>
                    <button class="navbar-toggler menu-btn" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <i class="navbar-toggler-icon fas fa-bars"></i>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <a class="navbar-brand" href="{{ route('front.home') }}">
                                <img src="{{ asset('front-assets/images/logo-ym.png') }}" alt="logo"
                                    class="img-fluid w-25"></a>

                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="{{ route('front.home') }}"
                                    title="Products"><b>Trang Chủ</b></a>
                            </li>
                            @if (getCategories()->isNotEmpty())
                                @foreach (getCategories() as $category)
                                    <li class="nav-item dropdown">
                                        <button class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            {{ $category->name }}
                                        </button>
                                        @if ($category->sub_category->isNotEmpty())
                                            <ul class="dropdown-menu dropdown-menu-dark">
                                                @foreach ($category->sub_category as $subCategory)
                                                    <li><a class="dropdown-item nav-link"
                                                            href="{{ route('front.shop', [$category->slug, $subCategory->slug]) }}">{{ $subCategory->name }}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                    <form class="d-flex">
                        <div class="input-group">
                            <input type="text" placeholder="Tìm kiếm sản phẩm" class="form-control"
                                aria-label="Amount (to the nearest dollar)">
                            <span class="input-group-text">
                                <i class="fa fa-search"></i>
                            </span>
                        </div>
                    </form>
                    <a href="{{ route('account.profile') }}" class="nav-link text-light">Tài khoản</a>
                    <a href="{{ route('front.cart') }}" class="ml-3 d-flex">
                        <i class="fas fa-shopping-cart text-primary"></i>
                    </a>
                </nav>
            </div>
        </header>




        <main>
            @yield('content')
        </main>

        <footer class="bg-dark mt-5">
            <div class="container pb-5 pt-3">
                <div class="row">
                    <div class="col-md-4">
                        <div class="footer-card">
                            <h3>Về YM</h3>
                            <p>Chào mừng bạn đến với YM - địa chỉ mua sắm trực tuyến đa dạng và tiện lợi. Với kho hàng đầy đủ từ thời trang đến công nghệ, YM cam kết mang lại trải nghiệm mua sắm tuyệt vời. Giao diện thân thiện và ưu đãi hấp dẫn đang chờ đón bạn. Khám phá ngay để trải nghiệm sự đổi mới và phong cách tại YM!</p>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="footer-card">
                            <h3>CHĂM SÓC KHÁCH HÀNG</h3>
                            <ul>
                                <li><a href="#" title="About">Trung Tâm Trợ Giúp</a></li>
                                <li><a href="#" title="Contact Us">Hướng Dẫn Mua Hàng</a></li>
                                <li><a href="#" title="Privacy">Thanh Toán</a></li>
                                <li><a href="#" title="Privacy">Vận Chuyển</a></li>
                                <li><a href="#" title="Privacy">Trả Hàng & Hoàn Tiền</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="footer-card">
                            <h3>THEO DÕI CHÚNG TÔI</h3>
                            <ul>
                                <li><iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fymshop2002%2F&tabs=timeline&width=340&height=120&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" width="340" height="120" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="copyright-area bg-dark">
                <div class="container">
                    <div class="row">
                        <div class="col-12 mt-3">
                            <div class="copy-right text-center">
                                <hr>
                                <p>© Copyright 2023 YM Shop. All Rights Reserved</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <script src="{{ asset('front-assets/js/jquery-3.6.0.min.js') }}"></script>
        <script src="{{ asset('front-assets/js/bootstrap.bundle.5.1.3.min.js') }}"></script>
        <script src="{{ asset('front-assets/js/lazyload.17.6.0.min.js') }}"></script>
        <script src="{{ asset('front-assets/js/slick.min.js') }}"></script>
        <script src="{{ asset('front-assets/js/custom.js') }}"></script>
        <script src="{{ asset('front-assets/js/ion.rangeSlider.min.js') }}"></script>
        <script>
            // Thiết lập sự kiện cuộn trang để kích hoạt hàm myFunction
            window.onscroll = function() {
                myFunction()
            };

            // Lấy đối tượng thanh điều hướng (navbar) và lưu trữ vị trí offset của nó
            var navbar = document.getElementById("navbar");
            var sticky = navbar.offsetTop;

            // Hàm kiểm tra vị trí cuộn và thêm hoặc loại bỏ class "sticky"
            function myFunction() {
                if (window.pageYOffset >= sticky) {
                    navbar.classList.add("sticky");
                } else {
                    navbar.classList.remove("sticky");
                }
            }

            // Thiết lập Ajax để đặt tiêu đề 'X-CSRF-TOKEN' cho mọi yêu cầu
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Hàm thêm sản phẩm vào giỏ hàng thông qua Ajax
            function addToCart(id) {
                $.ajax({
                    url: '{{ route('front.addToCart') }}',
                    type: 'post',
                    data: {
                        id: id
                    },
                    dataType: "json",
                    success: function(response) {
                        // Xử lý kết quả từ yêu cầu Ajax
                        if (response.status == true) {
                            // Nếu thành công, chuyển hướng người dùng đến trang giỏ hàng
                            window.location.href = "{{ route('front.cart') }}";
                        } else {
                            // Nếu không thành công, hiển thị cảnh báo với thông điệp từ response.message
                            alert(response.message);
                        }
                    }
                });
            }
        </script>

    </body>
    @yield('customJS')

</html>
