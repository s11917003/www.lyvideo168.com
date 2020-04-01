
<!-- Nav -->

<div id="rs-topnav">
	<ul>
		@if (Auth::check())
		<li ><a href="javascript:void(0);">哈友：{{Auth::User()->nick_name}}</a></li>
		<li ><a class="logout" href="/logout">登出</a></li>
		@else
		<li ><a href="/login">登入</a></li>
		@endif
		<!-- <li ><a href="/article/post">發佈</a></li> -->
		<!-- <li ><a href="/help">幫助</a></li>			 -->
	</ul>	
</div>
<!--<div id="rs-topnav">			
	<ul>
		<li><a href="/">段子</a></li>			
		<li><a href="/category/pic">圖片</a></li>			
		<li><a href="/category/video">影片</a></li>	
	</ul>
</div>
-->
<div id="rs-topnav">
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item">
					<a class="nav-link" href="/tag/1">日本JAV</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/tag/2">欧美</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/tag/3">无修正</a>
				</li>	
				<li class="nav-item">
					<a class="nav-link" href="/tag/33">台湾</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/tag/25">偷拍</a>
				</li>													
				<!-- <li class="nav-item">
					<a class="nav-link" href="/censord/">有码数G库</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/uncensord/">无码数G库</a>
				</li>				 -->
			</ul>
		</div>
	</nav>
</div>
