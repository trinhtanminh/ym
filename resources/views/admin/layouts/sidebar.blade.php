			<aside class="main-sidebar sidebar-light-primary elevation-4">
				<a href="#" class="brand-link">
					<img src="{{asset('admin-assets/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
					<span class="brand-text font-weight-light">YM Shop</span>
				</a>
				<div class="sidebar">
					<nav class="mt-2">
						<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
							<li class="nav-item">
								<a href="{{route('admin.dashboard')}}" class="nav-link">
									<i class="nav-icon fas fa-tachometer-alt"></i>
									<p>Bảng điều khiển</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="{{route('categories.index')}}" class="nav-link">
									<i class="nav-icon fas fa-file-alt"></i>
									<p>Danh mục</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="{{route('sub-categories.index')}}" class="nav-link">
									<i class="nav-icon fas fa-file-alt"></i>
									<p>Danh mục con</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="{{route('brands.index')}}" class="nav-link">
									<svg class="h-6 nav-icon w-6 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
										<path stroke-linecap="round" stroke-linejoin="round" d="M16 4v12l-4-2-4 2V4M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
									  </svg>
									<p>Thương hiệu</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="{{route('products.index')}}" class="nav-link">
									<i class="nav-icon fas fa-tag"></i>
									<p>Sản phẩm</p>
								</a>
							</li>

							<li class="nav-item">
								<a href="{{route("shipping.create")}}" class="nav-link">
									<i class="fas fa-truck nav-icon"></i>
									<p>Vận chuyển</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="#" class="nav-link">
									<i class="nav-icon fas fa-shopping-bag"></i>
									<p>Đơn đặt hàng</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="#" class="nav-link">
									<i class="nav-icon  fa fa-percent" aria-hidden="true"></i>
									<p>Mã Giảm giá</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="#" class="nav-link">
									<i class="nav-icon  fas fa-users"></i>
									<p>Người dùng</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="#" class="nav-link">
									<i class="nav-icon  far fa-file-alt"></i>
									<p>Quản Lý Trang</p>
								</a>
							</li>
						</ul>
					</nav>
				</div>
         	</aside>
