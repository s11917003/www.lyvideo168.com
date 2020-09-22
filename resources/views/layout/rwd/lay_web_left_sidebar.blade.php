<div id ="nav-link-box" class="offcanvas-collapse  nav-link-box open" >
	<div class="navbar-collapse" style=" max-width: 100%; width: 100%; margin: 0;" id="navbarsExampleDefault">
		<div class="navbar-tab"  style="height: 100%;  " >
			<ul class="navbar-nav mr-auto" style="height:100%">
				<li class="nav-item">
					<div class="rs-logo"><a href="/"></a></div>
				</li>	
				<li class="nav-item">
	 
					<div id="rs-loginBar">
						<ul class="loginBar">
							@if (Auth::check())
							<li class="nav-item"><button type="button" class="btn btn-primary btn-lg btn-block"><a href="javascript:void(0);">@lang('default.member')：{{Auth::User()->nick_name}}</a></button></li>
							<li class="nav-item"><button type="button" class="btn btn-primary btn-lg btn-block"><a class="logout" href="/logout"  style="float: right;">@lang('default.logout')</a></button></li>
							@else
							<li class="nav-item"><button type="button" class="btn btn-primary btn-lg btn-block"><a href="/login">@lang('default.login')</a></button></li>
							<li class="nav-item"><button type="button" class="btn btn-primary btn-lg btn-block"><a href="/register">@lang('default.register')</a></button></li>
							@endif
						
						</ul>	
					</div>

				</li>
				@if (Auth::check())
				@if (Auth::User()->user_type == 1)
				<li class="nav-item">
					<a class="nav-link" href="/article/post">上传影片</a>
				</li>
				@endif
				<li class="nav-item">
					<a class="nav-link" href="/userInfo">喜好影片</a>
				</li>
				@endif
				<li class="nav-item">
					<a class="nav-link" href="/tag/hot">热门</a>
				</li>
	
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">所有分类</a>
				
				</li>
				<div id="dropdown-menu" class="dropdown-menu show" style="height:auto;    overflow-y: scroll;" aria-labelledby="dropdown01">
					
				</div>
			</ul>
	</div>
	<!-- <form class="form-inline my-2 my-lg-0">
	  <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
	  <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
	</form> -->
  </div>
</div> 