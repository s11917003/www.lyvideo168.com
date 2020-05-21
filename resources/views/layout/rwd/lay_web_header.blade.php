
	<!-- HEADER 結束 -->
	<!-- Header -->
	<div id="rs-maintop">	
		<div class="rs-maintop-box" style="DISPLAY: flex;  flex-direction: row; align-items: center;">
			<div class="a navbar navbar-expand-md fixed-top navbar-dark bg-dark navbar-expand-lg">
				
				<button class="navbar-toggler p-0 border-0" type="button" data-toggle="offcanvas">
					<span class="navbar-toggler-icon"></span>
				</button><a class="navbar-brand" href="#"></a>
			</div>	
		
			<div class="rs-logo"><a href="/"></a></div>	
			<!-- <form class="form-signin" method="POST"  style="    max-width: 220px; height: 30px; padding: 0px;">
				<input  style="width: 100px; height: 100%; margin: 0;   padding: 0px;    border-radius: 0; border: 0;" type="text" name="search" id="search" value="{{ old('email') }}" class="form-control" placeholder="Search" required="" autofocus="">
				<div style="margin: 0px 0;height:  99%;background-color:white;padding: 5px 11px 5px 11px;color:#111"><i class="fas  fa-search"></i></div>
			 
			</form> -->
			<div class="filler"></div>			
			@php (isset($postArticle) ? $postArticle : false )
			@if ($postArticle == false)
			<div id="rs-loginBar">
				<ul class="loginBar">
					@if (Auth::check())
					<li ><a href="javascript:void(0);">@lang('default.member')：{{Auth::User()->nick_name}}</a></li>
						<li ><a class="logout" href="/logout">@lang('default.logout')</a></li>
					@else
					<li ><a href="/login">@lang('default.login')</a></li>
					<li ><a href="/register">@lang('default.register')</a></li>
					@endif
					<!-- <li ><a href="/article/post">發佈</a></li> -->
					<!-- <li ><a href="/help">幫助</a></li>			 -->
				</ul>	
			</div>
			@endif
			
		{{--	 
			@if ($device =='ios' || $device == 'android')
			<div class="rs-logo" style="width: 300px; height: 50px; margin: 0 auto; background-color: #cecece">				 
				<script type="text/javascript" data-cfasync="false" async src="https://adserver.juicyads.com/js/jads.js"></script>
				<ins id="697684" data-width="300" data-height="62"></ins>
				<script type="text/javascript" data-cfasync="false" async>(adsbyjuicy = window.adsbyjuicy || []).push({'adzone':697684});</script>
			@else
			<div class="rs-ad" style="width: 100%; height: 90px">
				<script type="text/javascript" data-cfasync="false" async src="https://adserver.juicyads.com/js/jads.js"></script>
				<ins id="714568" data-width="728" data-height="102"></ins>
				<script type="text/javascript" data-cfasync="false" async>(adsbyjuicy = window.adsbyjuicy || []).push({'adzone':714568});</script>
			</div>
			@endif  --}}
			
		</div>
		<!-- <div class="offcanvas-collapse " id="navbarsExampleDefault">
			<ul class="navbar-nav mr-auto">
			  <li class="nav-item active">
				<a class="nav-link" href="#">Dashboard <span class="sr-only">(current)</span></a>
			  </li>
			  <li class="nav-item">
				<a class="nav-link" href="#">Notifications</a>
			  </li>
			  <li class="nav-item">
				<a class="nav-link" href="#">Profile</a>
			  </li>
			  <li class="nav-item">
				<a class="nav-link" href="#">Switch account</a>
			  </li>
			  <li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Settings</a>
				<div class="dropdown-menu" aria-labelledby="dropdown01">
				  <a class="dropdown-item" href="#">Action</a>
				  <a class="dropdown-item" href="#">Another action</a>
				  <a class="dropdown-item" href="#">Something else here</a>
				</div>
			  </li>
			</ul>
			<form class="form-inline my-2 my-lg-0">
			  <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
			  <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
			</form>
		  </div> -->
		<!-- @php (isset($adFloat) ? $adFloat : false ) -->
		@if (isset($adFloat))
		<div id="adRightPanel"  >
			<div 	style="position: relative;  bottom: 0; height: 100%;width:100%;">
				<a href="{{$adFloat->web_url}}"  target="_blank">
					<div data-id='{{$adFloat->id}}' class="adClick"   style="Boverflow: hidden; background-repeat: no-repeat;   background-position: 50% 50%; background-size: contain;height: 100%; width:100%;background-image: url('{{ asset('storage/'.$adFloat->bg_img)}}');" >
					</div>
				</a>
			</div>
		</div> 
		@endif
		<div id="nav-link-mask" class="nav-link-mask"  style="display: none;"></div>
	 
		<div id ="nav-link-box" class="offcanvas-collapse  nav-link-box" >
			<div class="navbar-collapse" id="navbarsExampleDefault">
				<div class="navbar-tab"  style="height: 100%; width: 300px; background-color: #000;" >
					<ul class="navbar-nav mr-auto">
						<li class="nav-item">
							<a class="nav-link" href="/tag/hot">热门</a>
						</li>
			
						<li class="nav-item dropdown">
							@if (isset($title)) 
							<a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{$title}}</a>
							@else
							<a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">所有分类</a>
							@endif
						
							
						</li>
						<div id="dropdown-menu" class="dropdown-menu" aria-labelledby="dropdown01">
							<a class="dropdown-item" href="/tag/1">日本</a>
							<a class="dropdown-item" href="/tag/2">欧美</a>
							<a class="dropdown-item" href="/tag/3">无修正</a>
							<a class="dropdown-item" href="/tag/33">台湾</a>
							<a class="dropdown-item" href="/tag/25">偷拍</a>
						</div>
					</ul>
			</div>
			<!-- <form class="form-inline my-2 my-lg-0">
			  <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
			  <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
			</form> -->
		  </div>
		</div>  
		</div>
	</div>	