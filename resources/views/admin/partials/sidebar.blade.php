 <!--
	====================================
	——— LEFT SIDEBAR WITH FOOTER
	=====================================
-->
<aside class="left-sidebar bg-sidebar">
	<div id="sidebar" class="sidebar sidebar-with-footer">
		<!-- Aplication Brand -->
		<div class="app-brand">
			<a href="">
			<span class="brand-name">Klontong Dashboard</span>
			</a>
		</div>
		<!-- begin sidebar scrollbar -->
		<div class="sidebar-scrollbar">

			<!-- sidebar menu -->
			<ul class="nav sidebar-inner" id="sidebar-menu">
				<li  class="has-sub active expand" >
					<a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#dashboard"
                        aria-expanded="false" aria-controls="dashboard">
						<i class="mdi mdi-store"></i>
						<span class="nav-text">Barang</span> <b class="caret"></b>
					</a>
					<ul  class="collapse show"  id="dashboard"
						data-parent="#sidebar-menu">
						<div class="sub-menu">
                            @if (Auth::user()->role_id == "1")
                            <li  class="active" >
								<a class="sidenav-item-link" href="{{ route('stores.index') }}">
								<span class="nav-text">Toko</span>
								</a>
							</li>
							<li>
								<a class="sidenav-item-link" href="{{ route('categories.index') }}">
								<span class="nav-text">Kategori</span>
								</a>
							</li>
							<li>
								<a class="sidenav-item-link" href="{{ route('products.index') }}">
								<span class="nav-text">Produk</span>
								</a>
                            </li>
                            <li>
								<a class="sidenav-item-link" href="{{ route('users.index') }}">
								<span class="nav-text">User</span>
								</a>
							</li>
                            @else

                            @endif
						</div>
					</ul>
				</li>
			</ul>
		</div>
	</div>
</aside>
