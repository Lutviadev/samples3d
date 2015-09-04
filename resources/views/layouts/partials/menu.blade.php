<div class="menu">

	<div id="sidebar" class="left-side close-hover-dropdown-no-boots">
		<div class="mobile-listener"></div>
		<div class="sidebar-controller colapser hidden-xs hidden-sm max" data-action="minimize"><i class="colapser-btn glyphicon glyphicon-circle-arrow-left"></i></div>
		<ul class="navbar-sidebar slim">
			<li class="botn max">
				<a class="botn-link index" href="{{ route('dashboard') }}"><i class="glyphicon glyphicon-fire"></i><span class="text">Dashboard</span></a>
			</li>
			<li class="separador">
				<h4><i class="glyphicon glyphicon-chevron-down"></i>Menu</h4>
			</li>

			@if (Auth::user()->level() >=999 || Auth::user()->can('total.animation') || Auth::user()->can('index.animation') || Auth::user()->can('create.animation') || Auth::user()->can('update.animation') || Auth::user()->can('delete.animation') || Auth::user()->can('create.animation') )

				<li class="botn max" id="menu_animation">
					<a class="botn-link botn-link-toggler" href="javascript:void(0)">
						<i class="material-icons">videocam</i>
						<span class="text">Animations</span>
						<span class="arrow-sidebar glyphicon glyphicon-triangle-bottom"></span>
					</a>
					<ul class="sub">

						@if (Auth::user()->level() >=999 || Auth::user()->can('total.animation') || Auth::user()->can('index.animation') || Auth::user()->can('update.animation') || Auth::user()->can('delete.animation'))
							<li><a class="list first" href="{{ route('animation_index') }}">List Animations</a></li>
						@endif

						@if (Auth::user()->level() >=999 || Auth::user()->can('total.animation') || Auth::user()->can('create.animation'))
							<li><a class="create" href="{{ route('animation_create') }}">Create Animation</a></li>
						@endif

					</ul>
				</li>

			@endif

			@if (Auth::user()->level() >=999 || Auth::user()->can('total.render') || Auth::user()->can('index.render') || Auth::user()->can('create.render') || Auth::user()->can('update.render') || Auth::user()->can('delete.render') || Auth::user()->can('create.render'))

				<li class="botn max" id="menu_render">
					<a class="botn-link botn-link-toggler" href="javascript:void(0)">
						<i class="material-icons">wallpaper</i>
						<span class="text">Renders Galleries</span>
						<span class="arrow-sidebar glyphicon glyphicon-triangle-bottom"></span>
					</a>
					<ul class="sub">

						@if (Auth::user()->level() >=999 || Auth::user()->can('total.render') || Auth::user()->can('index.render') || Auth::user()->can('update.render')|| Auth::user()->can('delete.render'))
							<li><a class="list first" href="{{ route('render_index') }}">List Galleries</a></li>
						@endif

						@if (Auth::user()->level() >=999 || Auth::user()->can('total.render') || Auth::user()->can('create.render'))
							<li><a class="create" href="{{ route('render_create') }}">Create Gallery</a></li>
						@endif

						@role('superadmin|owner')

							<li><a class="maincategory" href="{{ route('maincategory_index') }}">Main Categories</a></li>
							<li><a class="category" href="{{ route('category_index') }}">Categories</a></li>
							<li><a class="subcategory last" href="{{ route('subcategory_index') }}">Subcategories</a></li>

						@endrole

					</ul>
				</li>

			@endif

			@if (Auth::user()->level() >=999 || Auth::user()->can('total.tour') || Auth::user()->can('index.tour') || Auth::user()->can('create.tour') || Auth::user()->can('update.tour') || Auth::user()->can('delete.tour'))

				<li class="botn max" id="menu_tour">
					<a class="botn-link botn-link-toggler" href="javascript:void(0)">
						<i class="material-icons">3d_rotation</i>
						<span class="text">Virtual Tours</span>
						<span class="arrow-sidebar glyphicon glyphicon-triangle-bottom"></span>
					</a>
					<ul class="sub">

						@if (Auth::user()->level() >=999 || Auth::user()->can('total.tour') || Auth::user()->can('index.tour') || Auth::user()->can('update.tour') || Auth::user()->can('delete.tour') || Auth::user()->can('create.tour'))
							<li><a class="list first" href="{{ route('tour_index') }}">List Tours</a></li>
						@endif

						@if (Auth::user()->level() >=999 || Auth::user()->can('total.tour') || Auth::user()->can('create.tour'))
							<li><a class="create" href="{{ route('tour_create') }}">Create Tour</a></li>
						@endif

					</ul>
				</li>

			@endif

			@if (Auth::user()->level() >=999 || Auth::user()->can('total.portfolio') || Auth::user()->can('index.portfolio') || Auth::user()->can('create.portfolio') || Auth::user()->can('update.portfolio') || Auth::user()->can('delete.portfolio'))

				<li class="botn max" id="menu_portfolio">
					<a class="botn-link botn-link-toggler" href="javascript:void(0)">
						<i class="material-icons">shop_two</i>
						<span class="text">Portfolios</span>
						<span class="arrow-sidebar glyphicon glyphicon-triangle-bottom"></span>
					</a>
					<ul class="sub">

						@if (Auth::user()->level() >=999 || Auth::user()->can('total.portfolio') || Auth::user()->can('index.portfolio') || Auth::user()->can('update.portfolio') || Auth::user()->can('delete.portfolio') || Auth::user()->can('create.portfolio'))
							<li><a class="list first" href="{{ route('portfolio_index') }}">List Portfolios</a></li>
						@endif

						@if (Auth::user()->level() >=999 || Auth::user()->can('total.portfolio') || Auth::user()->can('create.portfolio'))
							<li><a class="create" href="{{ route('portfolio_create') }}">Create Portfolio</a></li>
						@endif

					</ul>
				</li>

			@endif

			@role('superadmin|owner')

			<li class="separador">
				<h4><i class="glyphicon glyphicon-chevron-down"></i>Extras</h4>
			</li>

			<li class="botn max" id="menu_briefcase">
				<a class="botn-link botn-link-toggler" href="javascript:void(0)">
					<i class="material-icons">work</i>
					<span class="text">Briefcases</span>
					<span class="arrow-sidebar glyphicon glyphicon-triangle-bottom"></span>
				</a>
				<ul class="sub">
					<li><a class="list first" href="{{ route('briefcase_index') }}">List Briefcases</a></li>
					<li><a class="create" href="{{ route('briefcase_create') }}">Create Briefcase</a></li>
				</ul>
			</li>

			<li class="botn max" id="menu_group">
				<a class="botn-link botn-link-toggler" href="javascript:void(0)">
					<i class="material-icons">group_work</i>
					<span class="text">Groups & Permissions</span>
					<span class="arrow-sidebar glyphicon glyphicon-triangle-bottom"></span>
				</a>
				<ul class="sub">
					<li><a class="list first" href="{{ route('group_index') }}">List Groups</a></li>
					<li><a class="create" href="{{ route('group_create') }}">Create Group</a></li>
				</ul>
			</li>

			<li class="botn max" id="menu_user">
				<a class="botn-link botn-link-toggler" href="javascript:void(0)">
					<i class="material-icons">group</i>
					<span class="text">Users</span>
					<span class="arrow-sidebar glyphicon glyphicon-triangle-bottom"></span>
				</a>
				<ul class="sub">
					<li><a class="list first" href="{{ route('user_index') }}">List Users</a></li>
					<li><a class="create last" href="{{ route('user_create') }}">Create User</a></li>
				</ul>
			</li>

			@endrole

			<li class="fin"></li>
		</ul>
	</div>

</div>