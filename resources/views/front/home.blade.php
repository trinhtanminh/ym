 @extends('front.layouts.app')

 @section('content')
     <section class="section-1">
         <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-bs-ride="carousel"
             data-bs-interval="false">
             <div class="carousel-inner">
                 <div class="carousel-item active">
                     <!-- <img src="images/carousel-1.jpg" class="d-block w-100" alt=""> -->

                     <picture>
                         <source media="(max-width: 799px)" srcset="{{ asset('front-assets/images/carousel-1-ym.gif') }}" />
                         <source media="(min-width: 800px)" srcset="{{ asset('front-assets/images/carousel-1-ym.gif') }}" />
                         <img src="{{ asset('front-assets/images/carousel-1-ym.gif') }}" alt="" />
                     </picture>

                     <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                         <div class="p-3">
                             <h1 class="display-4 text-white mb-3">Sức Mạnh và Phong Cách</h1>
                             <p class="mx-md-5 px-5">Trải nghiệm cuộc sống hiện đại với MacBook, nơi sự hòa quện giữa thiết
                                 kế đẳng cấp và hiệu suất mạnh mẽ</p>
                             <a class="btn btn-outline-light py-2 px-4 mt-3" href="{{route("front.shop")}}">Mua ngay</a>
                         </div>
                     </div>
                 </div>
                 <div class="carousel-item">

                     <picture>
                         <source media="(max-width: 799px)" srcset="{{ asset('front-assets/images/carousel-2-ym.gif') }}" />
                         <source media="(min-width: 800px)" srcset="{{ asset('front-assets/images/carousel-2-ym.gif') }}" />
                         <img src="{{ asset('front-assets/images/carousel-2-ym.gif') }}" alt="" />
                     </picture>

                     <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                         <div class="p-3">
                             <h1 class="display-4 text-white mb-3">Yêu sức mạnh.Yêu luôn giá trị.</h1>
                             <p class="mx-md-5 px-5">Hiệu năng mạnh mẽ, dẫn đầu xu hướng cùng IPhone 15</p>
                             <a class="btn btn-outline-light py-2 px-4 mt-3" href="{{route("front.shop")}}">Shop Now</a>
                         </div>
                     </div>
                 </div>
                 <div class="carousel-item">
                     <picture>
                         <source media="(max-width: 799px)"
                             srcset="{{ asset('front-assets/images/carousel-3-ym.jpeg') }}" />
                         <source media="(min-width: 800px)"
                             srcset="{{ asset('front-assets/images/carousel-3-ym.jpeg') }}" />
                         <img src="{{ asset('front-assets/images/carousel-3-ym.jpeg') }}" alt="" />
                     </picture>

                     <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                         <div class="p-3">
                             <h1 class="display-4 text-white mb-3">Nâng tầm làm việc với Samsung S24</h1>
                             <p class="mx-md-5 px-5">Nâng tầm công việc của bạn với Samsung S24 - Sự kết hợp hoàn hảo giữa hiệu suất và thiết kế đẳng cấp</p>
                             <a class="btn btn-outline-light py-2 px-4 mt-3" href="{{route("front.shop")}}">Mua Ngay</a>
                         </div>
                     </div>
                 </div>
             </div>
             <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                 data-bs-slide="prev">
                 <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                 <span class="visually-hidden">Trước đó</span>
             </button>
             <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                 data-bs-slide="next">
                 <span class="carousel-control-next-icon" aria-hidden="true"></span>
                 <span class="visually-hidden">Tiếp theo</span>
             </button>
         </div>
     </section>
     <section class="section-2">
         <div class="container">
             <div class="row">
                 <div class="col-lg-3">
                     <div class="box shadow-lg rounded">
                         <div class="fa icon fa-check text-primary m-0 mr-3"></div>
                         <h2 class="font-weight-semi-bold m-0">Sản phẩm chất lượng</h5>
                     </div>
                 </div>
                 <div class="col-lg-3 ">
                     <div class="box shadow-lg rounded">
                         <div class="fa icon fa-shipping-fast text-primary m-0 mr-3"></div>
                         <h2 class="font-weight-semi-bold m-0">Miễn phí vận chuyển</h2>
                     </div>
                 </div>
                 <div class="col-lg-3">
                     <div class="box shadow-lg rounded">
                         <div class="fa icon fa-exchange-alt text-primary m-0 mr-3"></div>
                         <h2 class="font-weight-semi-bold m-0">Đổi trả - 7 ngày</h2>
                     </div>
                 </div>
                 <div class="col-lg-3 ">
                     <div class="box shadow-lg rounded">
                         <div class="fa icon fa-phone-volume text-primary m-0 mr-3"></div>
                         <h2 class="font-weight-semi-bold m-0">Hổ trợ 24/7</h5>
                     </div>
                 </div>
             </div>
         </div>
     </section>
     <section class="section-3">
         <div class="container">
             <div class="section-title">
                 <h2>Danh mục</h2>
             </div>
             <div class="row pb-3 ">
                 @if (getCategories()->isNotEmpty())
                     @foreach (getCategories() as $category)
                         <div class="col-lg-3 ">
                             <div class="cat-card rounded">
                                 <div class="left">
                                     @if ($category->image != '')
                                         <img src="{{ asset('uploads/category/thumb/' . $category->image) }}" alt=""
                                             class="img-fluid rounded">
                                     @endif
                                 </div>
                                 <div class="right">
                                     <div class="cat-data">
                                         <h2>{{ $category->name }}</h2>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     @endforeach
                 @endif
             </div>
         </div>
     </section>

     <section class="section-4 pt-5">
         <div class="container">
             <div class="section-title">
                 <h2>Sản phẩm Nổi bật</h2>
             </div>
             <div class="row pb-3">
                 @if ($featuredProducts->isNotEmpty())
                     @foreach ($featuredProducts as $product)
                         @php
                             $productImage = $product->product_images->first();
                         @endphp
                         <div class="col-md-3">
                             <div class="card product-card">
                                 <div class="product-image position-relative">
                                     <a href="{{ route('front.product', $product->slug) }}" class="product-img">

                                         @if (!empty($productImage->image))
                                             <img class="card-img-top"
                                                 src="{{ asset('uploads/product/small/' . $productImage->image) }}">
                                         @else
                                             <img class="card-img-top"
                                                 src="{{ asset('admin-assets/img/default-150x150.png') }}">
                                         @endif

                                     </a>
                                     <a class="whishlist" href="222"><i class="far fa-heart"></i></a>

                                     <div class="product-action">
                                         <a class="btn btn-dark" href="javascript:void(0);"
                                             onclick="addToCart({{ $product->id }});">
                                             <i class="fa fa-shopping-cart"></i> Add To Cart
                                         </a>
                                     </div>
                                 </div>
                                 <div class="card-body text-center mt-3">
                                     <a class="h6 link" href="product.php">{{ $product->title }}</a>
                                     <div class="price mt-2">
                                         <span class="h5"><strong>{{ $product->price }} đ</strong></span>
                                         @if ($product->compare_price > 0)
                                             <span class="h6 text-underline"><del>{{ $product->compare_price }}
                                                     đ</del></span>
                                         @endif
                                     </div>
                                 </div>
                             </div>
                         </div>
                     @endforeach
                 @endif
             </div>
         </div>
     </section>

     <section class="section-4 pt-5">
         <div class="container">
             <div class="section-title">
                 <h2>Sản phẩm Mới Nhất</h2>
             </div>
             <div class="row pb-3">
                 @if ($latestProducts->isNotEmpty())
                     @foreach ($latestProducts as $product)
                         @php
                             $productImage = $product->product_images->first();
                         @endphp
                         <div class="col-md-3">
                             <div class="card product-card">
                                 <div class="product-image position-relative">
                                     <a href="{{ route('front.product', $product->slug) }}" class="product-img">

                                         @if (!empty($productImage->image))
                                             <img class="card-img-top"
                                                 src="{{ asset('uploads/product/small/' . $productImage->image) }}">
                                         @else
                                             <img class="card-img-top"
                                                 src="{{ asset('admin-assets/img/default-150x150.png') }}">
                                         @endif

                                     </a>
                                     <a class="whishlist" href="222"><i class="far fa-heart"></i></a>

                                     <div class="product-action">
                                         <a class="btn btn-dark" href="javascript:void(0);"
                                             onclick="addToCart({{ $product->id }});">
                                             <i class="fa fa-shopping-cart"></i> Add To Cart
                                         </a>
                                     </div>
                                 </div>
                                 <div class="card-body text-center mt-3">
                                     <a class="h6 link" href="product.php">{{ $product->title }}</a>
                                     <div class="price mt-2">
                                         <span class="h5"><strong>{{ $product->price }} đ</strong></span>
                                         @if ($product->compare_price > 0)
                                             <span class="h6 text-underline"><del>{{ $product->compare_price }}
                                                     đ</del></span>
                                         @endif
                                     </div>
                                 </div>
                             </div>
                         </div>
                     @endforeach
                 @endif
             </div>
         </div>
     </section>
 @endsection
