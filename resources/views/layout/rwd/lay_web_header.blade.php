
	<!-- HEADER 結束 -->
	<!-- Header -->
	<div id="rs-maintop">	
		<div class="rs-maintop-box" style="DISPLAY: flex;  flex-direction: row; align-items: center;">
			<div class="a navbar navbar-expand-md fixed-top navbar-dark bg-dark navbar-expand-lg">
				
				<button class="navbar-toggler p-0 border-0" type="button" data-toggle="offcanvas">
					<span class="navbar-toggler-icon"></span>
				</button><a class="navbar-brand" href="#"></a>
			</div>	
		
			<div class=" b rs-logo"><a href="/"></a></div>
			<div class="c filler"></div>			
			{{ isset($postArticle) ? $postArticle : false }} 
			@if ($postArticle == false)
			<div id="rs-loginBar" class="d">
				<ul class="loginBar">
					@if (Auth::check())
					<li ><a href="javascript:void(0);">哈友：{{Auth::User()->nick_name}}</a></li>
						<li ><a class="logout" href="/logout">登出</a></li>
					@else
					<li ><a href="/login">登入</a></li>
					<li ><a href="/register">註冊</a></li>
					@endif
					<!-- <li ><a href="/article/post">發佈</a></li> -->
					<!-- <li ><a href="/help">幫助</a></li>			 -->
				</ul>	
			</div>
			@endif
		{{--	JuicyAds v3.0 -->
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
		<div id="nav-link-mask" class="nav-link-mask"  style="display:none;"></div>
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