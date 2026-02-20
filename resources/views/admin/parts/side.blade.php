<div class="sidebar-area" id="sidebar-area">
		<div class="logo position-relative">
			<a href="index.html" class="d-block text-decoration-none"> <img src="{{ url ('/') }}/assets/images/logo-icon.png" alt="logo-icon"> <span class="logo-text fw-bold text-dark">فارول</span> </a>
			<button class="sidebar-burger-menu bg-transparent p-0 border-0 opacity-0 z-n1 position-absolute top-50 end-0 translate-middle-y" id="sidebar-burger-menu"> <i data-feather="x"></i> </button>
		</div>
		<aside id="layout-menu" class="layout-menu menu-vertical menu active" data-simplebar>
			<ul class="menu-inner">
				<li class="menu-item">
					<a href="javascript:void(0);" class="menu-link active ">  <span class="title">داشبورد</span>  </a>

				</li>
				<li class="menu-title small text-uppercase"> <span class="menu-title-text">آگهی ها</span> </li>
				<li class="menu-item">
					<a href="javascript:void(0);" class="menu-link menu-toggle active"> <i data-feather="folder-minus" class="menu-icon tf-icons"></i> <span class="title">آگهی ها</span> </a>
					<ul class="menu-sub">
						<li class="menu-item"> <a href="{{ url('/admin/property/list') }}" class="menu-link"> همه </a> </li>
						<li class="menu-item"> <a href="{{ url('/admin/property?q=accepted') }}" class="menu-link"> تایید نشده </a> </li>
						<li class="menu-item"> <a href="{{ url('/admin/property?q=notaccepted') }}" class="menu-link"> تایید شده </a> </li>
						<li class="menu-item"> <a href="{{ url('/admin/property?q=expired') }}" class="menu-link"> منقضی </a> </li>
					</ul>
				</li>






			</ul>
		</aside>

	</div>
