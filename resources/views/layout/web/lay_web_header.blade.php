	<!-- HEADER 開始 -->
	<div class="maintop">
		<!-- LOGO 開始 -->
		<div class="logobox">
			<div class="toplogo"><a href="/" title="回哈哈TV首頁"></a></div>
			<div class="top-r-icon">
				<ul>@if(Session::has('USER'))
					<li><a href="/member/login">哈友：{{ Session('USER.NICK_NAME')}}</a>
					</li>
					<li><a class="logout" href="/member/logout">登出</a></li>
					@else
					<li><a href="/member/login">登入</a></li>
					@endif
					<li><a href="/article/post">發佈</a></li>
					<li><a href="/help">幫助</a></li>
				</ul>
			</div>
		</div>
		<!-- LOGO 結束 -->	
	</div>
	<!-- HEADER 結束 -->