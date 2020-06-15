<div id ="nav-link-box-right" class="offcanvas-collapse  nav-link-box open" >
	<div class="navbar-collapse" style=" max-width: 100%; width: 100%; margin: 0;" id="navbarsExampleDefault">
		<div class="navbar-tab"  style="height: 100%;   " >
			<ul class="navbar-nav mr-auto" style="height:100%">
				
				<li class="nav-item">
					 <button type="button" class="btn btn-primary btn-lg btn-block"><a href="javascript:void(0);">{{config('app.web_name')}}</a></button>
				</li>
			
				<li class="nav-item dropdown">
					<div class="title">
						<span>网站信息</span>
					</div> 
				</li>
				 
				<li class="nav-item">
					<i class="fa fa-home" aria-hidden="true"></i>资源总数：<span class="all" data-toggle="dropdown" > 0 </span>
				</li> 
				<li class="nav-item">
					<i class="fas fa-video"></i>今日更新：<span class="today" data-toggle="dropdown"> 0 </span>
				</li> 
				<!-- <li class="nav-item">
					<i class="fas fa-info-circle"></i><span> test </span>
				</li> -->
				<li class="nav-item dropdown">
					<div class="title">
						<span>服务器信息</span>
					</div> 
				</li>
				<li class="nav-item">
					<i class="far fa-clock"></i><span> {{ date('Y-m-d') }}</span>
				</li> 
				<li class="nav-item dropdown">
					<div class="title">
						<span>联系方式</span>
					</div> 
				</li>
				<li class="nav-item">
					<i class="fas fa-envelope"></i><span> test@gmail.com </span>
				</li> 
				<li class="nav-item">
					<i class="fas fa-phone"></i><span> 0900000000</span>
				</li> 
				 
				
			</ul>
	</div>
	<!-- <form class="form-inline my-2 my-lg-0">
	  <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
	  <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
	</form> -->
  </div>
</div> 
<script>
	$(function(){
		$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
		});
		$(document).ready(function(){
			// $.ajax({
			// 	type:"get",
			// 	url:"/videoinfo",
			// 	success:function(result){
			// 		var all = result['all'];
			// 		var today = result['today'];
			// 		$("#nav-link-box-right .all").html(all);
			// 		$("#nav-link-box-right .today").html(today);
			// 	}
			// });	

		})
	});
</script>