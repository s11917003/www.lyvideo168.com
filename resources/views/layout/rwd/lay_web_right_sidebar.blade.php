<div id ="nav-link-box-right" class="offcanvas-collapse  nav-link-box open" >
	<div class="navbar-collapse" style=" max-width: 100%; width: 100%; margin: 0;" id="navbarsExampleDefault">
		<div class="navbar-tab"  style="height: 100%;   background-color: #000;" >
			<ul class="navbar-nav mr-auto" style="height:100%">
				
				<li class="nav-item">
	 
					<div id="rs-loginBar">
						<ul class="loginBar">
							@if (Auth::check())
							<li ><button type="button" class="btn btn-primary btn-lg btn-block"><a href="javascript:void(0);">@lang('default.member')：{{Auth::User()->nick_name}}</a></button></li>
							<li ><button type="button" class="btn btn-primary btn-lg btn-block"><a class="logout" href="/logout"  style="float: right;">@lang('default.logout')</a></button></li>
							@else
							<li ><button type="button" class="btn btn-primary btn-lg btn-block"><a href="/login">@lang('default.login')</a></button></li>
							<li ><button type="button" class="btn btn-primary btn-lg btn-block"><a href="/register">@lang('default.register')</a></button></li>
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
				@endif
				<li class="nav-item">
					<a class="nav-link" href="/tag/hot">热门</a>
				</li>
	
				<li class="nav-item dropdown">

					<a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">所有分类</a>
				</li>
				<div id="dropdown-menu" class="dropdown-menu show" style="height:auto;    overflow-y: scroll;" aria-labelledby="dropdown01">
					<a class="dropdown-item" href="/tag/1">日本</a>
					<a class="dropdown-item" href="/tag/2">欧美</a>
					<a class="dropdown-item" href="/tag/3">无修正</a>
					<a class="dropdown-item" href="/tag/33">台湾</a>
					<a class="dropdown-item" href="/tag/25">偷拍</a>

					<a class="dropdown-item" href="/tag/4">素人</a>
					<a class="dropdown-item" href="/tag/5">巨乳</a>
					<a class="dropdown-item" href="/tag/6">制服</a>
					<a class="dropdown-item" href="/tag/7">人妻</a>
					<a class="dropdown-item" href="/tag/8">熟女</a>
					<a class="dropdown-item" href="/tag/9">偶像</a>
					<a class="dropdown-item" href="/tag/10">少女</a>
					<a class="dropdown-item" href="/tag/11">AV女优</a>
					<a class="dropdown-item" href="/tag/12">中出</a>
					<a class="dropdown-item" href="/tag/13">长腿</a>
					<a class="dropdown-item" href="/tag/14">SM</a>
					<a class="dropdown-item" href="/tag/15">口交</a>
					<a class="dropdown-item" href="/tag/16">角色扮演</a>
					<a class="dropdown-item" href="/tag/17">多P</a>
					<a class="dropdown-item" href="/tag/18">同性恋</a>
					<a class="dropdown-item" href="/tag/19">人妖</a>
					<a class="dropdown-item" href="/tag/20">韩国</a>
					<a class="dropdown-item" href="/tag/25">偷拍</a>

					<a class="dropdown-item" href="/tag/27">写真</a>
					<a class="dropdown-item" href="/tag/28">国内</a>

					<a class="dropdown-item" href="/tag/29">处女</a>
					<a class="dropdown-item" href="/tag/30">孕妇</a>
					<a class="dropdown-item" href="/tag/31">自拍</a>
					<a class="dropdown-item" href="/tag/32">肛交</a>
				</div>
			</ul>
	</div>
	<!-- <form class="form-inline my-2 my-lg-0">
	  <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
	  <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
	</form> -->
  </div>
</div> 