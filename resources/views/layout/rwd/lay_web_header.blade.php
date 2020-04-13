
	<!-- HEADER 結束 -->
	<!-- Header -->
	<div id="rs-maintop">	
		<div class="rs-maintop-box">				
			<div class="rs-logo"><a href="/"></a></div>
			{{ isset($postArticle) ? $postArticle : false }} 
			@if ($postArticle == false)
			<div id="rs-loginBar">
				<ul class="loginBar">
					@if (Auth::check())
					<li ><a class="logout" href="/logout">登出</a></li>
					<li ><a href="javascript:void(0);">哈友：{{Auth::User()->nick_name}}</a></li>
					
					@else
					<li ><a href="/login">登入</a></li>
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
		</div>
	</div>	