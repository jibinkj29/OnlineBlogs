<aside class="app-sidebar">
					<div class="app-sidebar__logo">
						<a class="header-brand" href="">
							<img src="/assests/images/brand/logo.png" class="header-brand-img desktop-lgo" alt="Azea logo">
							<img src="/assests/images/brand/logo.png" class="header-brand-img dark-logo" alt="Azea logo">
							<img src="/assests/images/brand/logo.png" class="header-brand-img dark-logo" alt="Azea logo">
							<img src="/assests/images/brand/favicon.png" class="header-brand-img mobile-logo" alt="Azea logo">
							<img src="/assests/images/brand/favicon.png" class="header-brand-img darkmobile-logo" alt="Azea logo">
						</a>
					</div>
					<ul class="side-menu app-sidebar3">
						<li class="side-item side-item-category">Main</li>
						<li class="slide">
							<a class="side-menu__item"  href="{{ route('user.dashboard') }}">
								<div class="side-menu__icon" width="24" height="24">
								    		<i class="far fa-home"></i>
								</div>
							
					
							
							
							<span class="side-menu__label">Dashboard</span></a>
						</li>
				
				
					
					    	<li class="slide">
							<a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
								<svg xmlns="http://www.w3.org/2000/svg"  class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24"><path d="M12 22c4.879 0 9-4.121 9-9s-4.121-9-9-9-9 4.121-9 9 4.121 9 9 9zm0-16c3.794 0 7 3.206 7 7s-3.206 7-7 7-7-3.206-7-7 3.206-7 7-7zm5.284-2.293 1.412-1.416 3.01 3-1.413 1.417zM5.282 2.294 6.7 3.706l-2.99 3-1.417-1.413z"/><path d="M11 9h2v5h-2zm0 6h2v2h-2z"/></svg>
							<span class="side-menu__label">  Blog Posts </span><i class="angle fe fe-chevron-right"></i></a>
							<ul class="slide-menu">
							<li><a href="{{ route('categories.index') }}" class="slide-item">Category </a></li>
							<li><a href="{{ route('blogs.index') }}" class="slide-item"> Blog Posts </a></li>  
							</ul>
					    	</li>

							<li class="slide">
								<a class="side-menu__item"  href="{{ route('user.profile') }}">
									<div class="side-menu__icon" width="24" height="24">
												<i class="far fa-home"></i>
									</div>
								
								<span class="side-menu__label">Profile</span></a>
							</li>
							
							<li class="slide">
								<a class="side-menu__item"  href="{{ route('user.logout') }}">
									<div class="side-menu__icon" width="24" height="24">
												<i class="far fa-home"></i>
									</div>
							
								<span class="side-menu__label">Logout</span></a>
							</li>

							
					    	
					    	
						
					</ul>
				</aside>