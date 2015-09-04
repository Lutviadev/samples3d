<div id="head">
	<nav class="navbar">
		<div class="navbar-header">
			<a class="navbar-brand" href="#"><i class="glyphicon glyphicon-th-large"></i>SAMPLES <b>3D</b></a>
	    </div>

		<ul class="nav navbar-nav navbar-right navbar-user">
			<a href="#" class="navbar-locker hidden-xs"><i class="glyphicon glyphicon-lock"></i></a>
			<li>
			<button type="button" class="navbar-toggle sidebar-controller close-click-dropdown-no-boots" data-action="toggle">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>	
			</li>
			<li class="navbar-userdata dropdown">
				<a href="#" class="dropdown-toggle dropdown-user">
					
					@if(isset(Auth::user()->images[0]) && isset(Auth::user()->images[0]->path))
						{!! HTML::image(Auth::user()->images[0]->path, '', ['class' => 'avatar']) !!}	
					@else
						{!! HTML::image('img/avatar.png', '', ['class' => 'avatar']) !!}
					@endif
					
					@if (Auth::user()->profile->firstname != '')						
						<span class="hidden-xs">{{ Auth::user()->profile->firstname }} {{ Auth::user()->profile->lastname }}</span>
					@else					
						<span class="hidden-xs">{{ Auth::user()->username }}</span>
					@endif

					<span class="caret"></span>
				</a>
				<ul class="dropdown-menu dropdown-user-menu dropdown-no-boots">	
					<li><a href="#"><i class="glyphicon glyphicon-user"></i>Edit Profile</a></li>
					<li class="divider visible-xs visible-sm"></li>
					<li><a href="#"><i class="glyphicon glyphicon-cog"></i>Configuration</a></li>
					<li class="divider"></li>
					<li><a href="#"><i class="glyphicon glyphicon-lock"></i>Session Lock</a></li>
					<li class="divider"></li>
					<li><a href="{{ route('logout') }}"><i class="glyphicon glyphicon-log-out"></i>Logout</a></li>
				</ul>
			</li>			
		</ul>
	</nav>	
</div>