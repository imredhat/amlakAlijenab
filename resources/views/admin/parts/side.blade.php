<div class="sidebar-area" id="sidebar-area">
	<div class="logo position-relative">
		<a href="index.html" class="d-block text-decoration-none"> <img src="{{ url ('/') }}/assets/images/logo-icon.png" alt="logo-icon"> <span class="logo-text fw-bold text-dark">مدیریت</span> </a>
		<button class="sidebar-burger-menu bg-transparent p-0 border-0 opacity-0 z-n1 position-absolute top-50 end-0 translate-middle-y" id="sidebar-burger-menu"> <i data-feather="x"></i> </button>
	</div>
	<aside id="layout-menu" class="layout-menu menu-vertical menu active" data-simplebar>
		<ul class="menu-inner">
			<li class="menu-item"> <a href="{{ url('/admin/dashboard') }}" class="menu-link"> داشبورد </a> </li>

			<li class="menu-item">
				<a href="javascript:void(0);" class="menu-link menu-toggle active"> <i data-feather="folder-minus" class="menu-icon tf-icons"></i> <span class="title">آگهی ها</span> </a>
				<ul class="menu-sub">
					<li class="menu-item"> <a href="{{ url('/admin/property/list') }}" class="menu-link"> همه </a> </li>
					<li class="menu-item"> <a href="{{ url('/admin/property?q=accepted') }}" class="menu-link"> تایید نشده </a> </li>
					<li class="menu-item"> <a href="{{ url('/admin/property?q=notaccepted') }}" class="menu-link"> تایید شده </a> </li>
					<li class="menu-item"> <a href="{{ url('/admin/property?q=expired') }}" class="menu-link"> منقضی </a> </li>
				</ul>
			</li>

				<li class="menu-item">
				<a href="javascript:void(0);" class="menu-link menu-toggle active"> <i data-feather="users" class="menu-icon tf-icons"></i> <span class="title">کاربران</span> </a>
				<ul class="menu-sub">
					<li class="menu-item"> <a href="{{ url('/admin/top-agents') }}" class="menu-link"> مدیریت مشاوران برتر </a> </li>
					<li class="menu-item"> <a href="{{ url('/admin/users') }}" class="menu-link"> لیست کاربران </a> </li>
				</ul>
			</li>



			
			<li class="menu-item">
				<a href="javascript:void(0);" class="menu-link menu-toggle active"> <i data-feather="folder-minus" class="menu-icon tf-icons"></i> <span class="title">برگه ها </span> </a>
				<ul class="menu-sub">
					<li class="menu-item"> <a href="{{ url('/admin/sections') }}" class="menu-link"> صفحه نخست </a> </li>

					<li class="menu-item"> <a href="{{ url('/admin/page/about') }}" class="menu-link"> درباره ما </a> </li>
					<li class="menu-item"> <a href="{{ url('/admin/page/contact') }}" class="menu-link"> تماس با ما </a> </li>
					<li class="menu-item"> <a href="{{ url('/admin/page/term') }}" class="menu-link"> شرایط و قوانین </a> </li>
					<li class="menu-item"> <a href="{{ url('/admin/page/faqs') }}" class="menu-link"> سوالات متداول </a> </li>
					<li class="menu-item"> <a href="{{ url('/admin/page/contact-submissions') }}" class="menu-link"> پیامهای تماس </a> </li>
				</ul>
			</li>

			<li class="menu-item">
				<a href="javascript:void(0);" class="menu-link menu-toggle active"> <i data-feather="file-text" class="menu-icon tf-icons"></i> <span class="title">بلاگ</span> </a>
				<ul class="menu-sub">
					<li class="menu-item"> <a href="{{ url('/admin/blog') }}" class="menu-link"> همه مقالات </a> </li>
					<li class="menu-item"> <a href="{{ url('/admin/blog/create') }}" class="menu-link"> افزودن مقاله </a> </li>
					<li class="menu-item"> <a href="{{ url('/admin/blog/comments') }}" class="menu-link"> نظرات </a> </li>
				</ul>
			</li>

		

			<li class="menu-item">
				<a href="javascript:void(0);" class="menu-link menu-toggle active"> <i data-feather="trending-up" class="menu-icon tf-icons"></i> <span class="title">نردبان</span> </a>
				<ul class="menu-sub">
					<li class="menu-item"> <a href="{{ url('/admin/upgrade-packages') }}" class="menu-link"> مدیریت پکیج‌ها </a> </li>
				</ul>
			</li>

			<li class="menu-item">
				<a href="javascript:void(0);" class="menu-link menu-toggle active"> <i data-feather="folder-minus" class="menu-icon tf-icons"></i> <span class="title">تنظیمات سایت </span> </a>
				<ul class="menu-sub">
					<li class="menu-item"> <a href="{{ url('/admin/city') }}" class="menu-link"> شهر ها </a> </li>
					<li class="menu-item"> <a href="{{ url('/admin/neighborhood') }}" class="menu-link"> محله ها </a> </li>
				</ul>
			</li>
		</ul>
	</aside>

</div>