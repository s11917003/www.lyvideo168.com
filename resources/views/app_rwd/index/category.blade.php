@extends('layout.rwd.lay_web_basic')
@section('title')
{{--  @php echo mb_substr(strip_tags($post->title) , 0 , 25, 'UTF-8'); @endphp --}}
@stop
@section('des')
 
@stop
@section('topscript')
{{-- <meta itemprop="name" content="@lang('default.description')">
<meta itemprop="description" content="{{strip_tags($post->title)}}">
<meta name="csrf-token" content="{{ csrf_token() }}" /> --}}
<script src="/js/bundle.min.js"></script>

<script>
	 
</script>
@stop
@section('maincontent')

<div class="container">
	<div class="container__header">{{__('ui.Category_Search')}}</div>
	<div class="category ">
	  <div class="category__title">{{__('ui.tag.Source')}}</div>
	  <ul id='category_source' class="category__tags">
		<li name="all" class="category__tags-item category__tags-item--active"><a href="#">ALL</a></li>
		<li name="censored_f" class="category__tags-item category__tags-item--active"><a href="#">{{__('ui.title.censored')}} - FANZA</a></li>
		<li name="censored_p" class="category__tags-item category__tags-item--active "> <a href="#">{{__('ui.title.censored')}} - PRESTIGE</a> </li>
		<li name="uncensored"  class="category__tags-item category__tags-item--active "> <a href="#">{{__('ui.title.uncensored')}}</a> </li>
		<li name="FC2" class="category__tags-item category__tags-item--active"><a href="#">{{__('ui.title.amateur')}}</a></li>
	  </ul>
	  <div class=" category_more category_source_more" ><a href="#"><span>{{__('ui.more')}}</span> <i class="i-arrow"></i></a></div>
	</div>

	<div class="category">
	  <div class="category__title">{{__('ui.tag.Form')}}</div>
	  <ul id="category_form" class="category__tags">
		<li name="217" class="category__tags-item"><a href="#">{{__('ui.tag.HiDef')}}</a></li>
		<li name="236" class="category__tags-item"><a href="#">{{__('ui.tag.VRExclusive')}}</a></li>
		<li name="112" class="category__tags-item"><a href="#">{{__('ui.tag.Featured_Actress')}}</a></li>
		<li name="211" class="category__tags-item"><a href="#">{{__('ui.tag.Debut')}}</a></li>
	  </ul> 
	  <div class="category_more"><a href="#"><span>{{__('ui.more')}}</span> <i class="i-arrow "></i></a></div>
	</div>

	<div class="category">
	  <div class="category__title">{{__('ui.tag.Role')}}</div>
	  <ul  id="category_role"  class="category__tags">
		<li name="2" class="category__tags-item"><a href="#">{{__('ui.tag.Beautiful_Girl')}}</a></li>
		<li name="38" class="category__tags-item"><a href="#">{{__('ui.tag.School_Girl')}}</a></li>
		<li name="8" class="category__tags-item"><a href="#">{{__('ui.tag.College_Girl')}}</a></li>
		<li name="15" class="category__tags-item"><a href="#">{{__('ui.tag.Gal')}}</a></li>
		<li name="22" class="category__tags-item"><a href="#">{{__('ui.tag.Married_Woman')}}</a></li>
		<li name="49" class="category__tags-item"><a href="#">{{__('ui.tag.Young_Wife')}}</a></li>
		<li name="24" class="category__tags-item"><a href="#">{{__('ui.tag.Mature_Woman')}}</a></li>
		<li name="93" class="category__tags-item"><a href="#">{{__('ui.tag.Amateur')}}</a></li>
		<!-- <li name="vr" class="category__tags-item"><a href="#">OL</a></li> -->
		<li name="14" class="category__tags-item"><a href="#">{{__('ui.tag.Female_Teacher')}}</a></li>
	  </ul>
	  <div class=" category_more "><a href="#"><span>{{__('ui.more')}}</span> <i class="i-arrow "></i></a></div>
	</div>

	<div class="category">
	  <div class="category__title">{{__('ui.tag.figure')}}</div>
	  <ul   id="category_figure" class="category__tags">
		<li name="51" class="category__tags-item"><a href="#">{{__('ui.tag.Beautiful_Tits')}}</a></li>
		<li name="53" class="category__tags-item"><a href="#">{{__('ui.tag.Big_Tits')}}</a></li>
		<li name="52" class="category__tags-item"><a href="#">{{__('ui.tag.Big_Asses')}}</a></li>
		<li name="57" class="category__tags-item"><a href="#">{{__('ui.tag.Chubby')}}</a></li>
		<li name="64" class="category__tags-item"><a href="#">{{__('ui.tag.Slender')}}</a></li>
		<li name="67" class="category__tags-item"><a href="#">{{__('ui.tag.Tall_Girl')}}</a></li>
		<li name="63" class="category__tags-item"><a href="#">{{__('ui.tag.Petite')}}</a></li>
		<li name="65" class="category__tags-item"><a href="#">{{__('ui.tag.Small_Tits')}}</a></li>
		<li name="69" class="category__tags-item"><a href="#">{{__('ui.tag.Youthful')}}</a></li>
		<li name="137" class="category__tags-item"><a href="#">{{__('ui.tag.Shaved_Pussy')}}</a></li>
		<li name="95" class="category__tags-item"><a href="#">{{__('ui.tag.Ass_Lover')}}</a></li>
	  </ul>
	  <div class=" category_more"><a href="#"><span>{{__('ui.more')}}</span> <i class="i-arrow "></i></a></div>
	</div>

	<div class="category">
	  <div class="category__title">{{__('ui.tag.playing')}}</div>
	  <ul id="category_play" class="category__tags">
		<li name="203" class="category__tags-item"><a href="#">{{__('ui.tag.Titty_Fuck')}}</a></li>
		<li name="155" class="category__tags-item"><a href="#">{{__('ui.tag.Breast_Milk')}}</a></li>
		<li name="154" class="category__tags-item"><a href="#">{{__('ui.tag.Blowjob')}}</a></li>
		<li name="162" class="category__tags-item"><a href="#">{{__('ui.tag.Deep_Throat')}}</a></li>
		<li name="172" class="category__tags-item"><a href="#">{{__('ui.tag.Footjob')}}</a></li>
		<li name="169" class="category__tags-item"><a href="#">{{__('ui.tag.Facial')}}</a></li>
		<li name="160" class="category__tags-item"><a href="#">{{__('ui.tag.Cum_Swallowing')}}</a></li>
		<li name="159" class="category__tags-item"><a href="#">{{__('ui.tag.Creampie')}}</a></li>
		<li name="175" class="category__tags-item"><a href="#">{{__('ui.tag.Handjob')}}</a></li>
		<li name="197" class="category__tags-item"><a href="#">{{__('ui.tag.Squirting')}}</a></li>
	  </ul>
	  <div class=" category_more"><a href="#"><span>{{__('ui.more')}}</span> <i class="i-arrow "></i></a></div>
	</div>

	<div class="category">
		<div class="category__title">{{__('ui.tag.Clothing')}}</div>
	  <ul id="category_clothing" class="category__tags">
		<li name="103" class="category__tags-item"><a href="#">{{__('ui.tag.Cosplay')}}</a></li>
		<li name="84" class="category__tags-item"><a href="#">{{__('ui.tag.Pantyhose')}}</a></li>
		<li name="90" class="category__tags-item"><a href="#">{{__('ui.tag.Uniform')}}</a></li>
		<li name="75" class="category__tags-item"><a href="#">{{__('ui.tag.Gym_Clothes')}}</a></li>
		<li name="86" class="category__tags-item"><a href="#">{{__('ui.tag.School_Swimsuits')}}</a></li>
		<li name="76" class="category__tags-item"><a href="#">{{__('ui.tag.KIMONO')}}</a></li>
		<li name="88" class="category__tags-item"><a href="#">{{__('ui.tag.Swimsuits')}}</a></li>
		<li name="59" class="category__tags-item"><a href="javascript:void(0);">{{__('ui.tag.Glasses')}}</a></li>
	  </ul>
	  <div class="category_more"><a href="#"><span>{{__('ui.more')}}</span> <i class="i-arrow "></i></a></div>
	</div>
	<!-- <div id ="custom" class="category category--open" style='display: none;'>
		<div class="category__title">{{__('ui.tag.Custom')}}</div>
			<ul id="category_clothing" class="category__tags">
			</ul>
	  	<div class="category__more category_clothing_more" style="display: none;"><a href="#"><span>{{__('ui.more')}}</span> <i class="i-arrow"></i></a></div>
	</div> -->
	<div id ="customCombo" class="category category--open">
		<div class="category__title">{{__('ui.tag.Custom')}}</div>
		  <span class="example" style="width: 300px;"></span>
	  	<!-- <div class="category_more"><a href="#"><span>{{__('ui.more')}}</span> <i class="i-arrow"></i></a></div> -->
	</div>
	<div class="list" style=" display: inline;">
		<div class="list__wrap" style="width: 100%;"> 
		  <div  id="video_list"  class="list">
		  </div>
		</div>
	  </div>
  </div>
 
@stop	
@section('pagination')
<div class="row pt-4"></div>
	<div class="col">
		<div id='pagination' class="pagination   d-flex justify-content-center"></div>
	</div>
</div>
@stop		
@section('footscript')
</script>
<script>
	var arr =[]
	var instance ;
	var page = 1 ;
	function sendAjax(tag,page){
		this.page = page; 
		if(page == 1 ){
			$("#video_list").empty();
		}
		$.ajax({
				type:"POST",
				url:"/{{$lang}}/category",
				dataType:"json",
				data:{tag,page},
				success:function(result){
					
					// if(result.secondary_tag) {
					// 	// $("#custom").find('ul').empty()
					// 	// $('#custom').hide();
					// 	// if(result.secondary_tag.length !=0){
					// 	// 	$('#custom').show();
					// 	// }
					// 	result.secondary_tag.forEach(function(item){
					// 		$('#custom').find('ul').append(`<li style="display:inline-flex; margin-right: 0px;"  name="`+ item.id+`" class="category__tags-item `+ (item.check && 'category__tags-item--active')   +`">
					// 			<a style="    border-top-right-radius: 0px;border-bottom-right-radius: 0px; padding-right: 0px;" href="javascript:void(0);">`+ item['{{$lang}}']+`
							
					// 			</a>
					// 			<div onclick="cancelCustomCate(`+item.id+`)" class="cancel `+ (item.check && 'category__tags-item--active')  +`"><i class="fas fa-times"></i></div>
					// 			</li>
					// 			`)
						 
 
					// 	});

					// 	$('#custom').find('li').each(function(){
					// 		cate_cilck(this);
					// 	});
					// } 
					result.video.data.forEach(function(item){
				 
						video = `<a href="/{{$lang}}/video/`+item.video_id+`$`+item.actress+`" class="list__item">
						<figure><img src="`  +item.cover_img+  `"></figure>
						<div class="list__item-info">
						<h5>`  +item.video_id+  `</h5>
						<h1>【`  +item.title+  `】</h1>
						<div class="date">`  +  ( item.release_date || '' )+  `</div>
						</div>
						</a>`
					
						$("#video_list").append(video)
						var newString = result['pagination'].replace(/href="(.*?)"/ig, "href=\"javascript:void(0)\" onclick=\"tablePagination\(`$1`\)\"");
                		// $('#pagination').html(newString);
						//window.scrollTo({ top: 0, behavior: 'smooth' });
						return;
					});
				}
			});	
	}
	function tablePagination(link) {

		postlink = link.split('?')[0]
		para = link.split('?')[1].split('&')
		var page =1;
		for(var i=0;i<para.length;i++){
			var match = para[i].match(/page=(.*?)/);
			page = para[i].replace(/page=(.*?)/,'$1')
		}
		arr =[]
		$('.category__tags').find('li').each(function(){
			if($(this).hasClass('category__tags-item--active')) {
				
				arr.push($(this).attr('name'))
			}
		});
		var custom_tag = instance.value()
		custom_tag.forEach(function(v){
			arr.push(v)
		});
		 sendAjax(arr,page);
		
		
	}
	function customTag(page = 1) {
		var arr = []
		$('.category__tags').find('li').each(function(){
			if($(this).hasClass('category__tags-item--active')) {
				arr.push($(this).attr('name'))
			}
		});
		var custom_tag = instance.value()
		custom_tag.forEach(function(v){
			arr.push(v)
		});
		sendAjax(arr,page);
	}
	function getSearchParams(k){
		var p={};
		location.search.replace(/[?&]+([^=&]+)=([^&]*)/gi,function(s,k,v){p[k]=v})
		return k?p[k]:p;
	}
	function cancelCustomCate(id){
		 
			arr =[];
			$("li[name="+id+"]").removeClass('category__tags-item--active')
		 
			$('.category__tags').find('li').each(function(){
				if($(this).hasClass('category__tags-item--active')) {
					arr.push($(this).attr('name'))
				}
			
			});

			 
			$.ajax({
				type:"POST",
				url:"/{{$lang}}/category/cancel",
				dataType:"json",
				data:{tag:arr,customTag:id,page:1},
				success:function(result){ 
					// if(result.secondary_tag) {
					// 	$("#custom").find('ul').empty()
					// 	$('#custom').hide();
					// 	if(result.secondary_tag.length !=0){
					// 		$('#custom').show();
					// 	}
					 
					// 	result.secondary_tag.forEach(function(item){
					// 		$('#custom').find('ul').append(`<li style="display:inline-flex; margin-right: 0px;"  name="`+ item.id+`" class="category__tags-item `+ (item.check && 'category__tags-item--active')   +`">
					// 			<a style="    border-top-right-radius: 0px;border-bottom-right-radius: 0px; padding-right: 0px;" href="javascript:void(0);">`+ item.jp+`
					// 			</a>
					// 			<div onclick="cancelCustomCate(`+item.id+`)" class="cancel `+ (item.check && 'category__tags-item--active')  +`"><i class="fas fa-times"></i></div>
					// 			</li>
					// 			`)
					// 	});

					// 	$('#custom').find('li').each(function(){
					// 		cate_cilck(this);
					// 	});

					 

					// } 
					result.video.data.forEach(function(item){
						video = `<a href="/{{$lang}}/video/`+item.video_id+`$`+item.actress+`" class="list__item">
						<figure><img src="`  +item.cover_img+  `"></figure>
						<div class="list__item-info">
						<h5>`  +item.video_id+  `</h5>
						<h6>【`  +item.title+  `】</h6>
						<div class="date">`  +  ( item.release_date || '' )+   `</div>
						</div>
						</a>`
					
						$("#video_list").append(video)
						var newString = result['pagination'].replace(/href="(.*?)"/ig, "href=\"javascript:void(0)\" onclick=\"tablePagination\(`$1`\)\"");
                		$('#pagination').html(newString);
						window.scrollTo({ top: 0, behavior: 'smooth' });
						return;
					});
				}
			});	
			event.stopPropagation()
	}
	function cate_cilck(e){
	
		$(e).click(function(){
		
			arr =[]
			if($.inArray($(this).attr('name'), ['all','censored_f','censored_p','uncensored','FC2'])!=-1){
				if($(this).attr('name') == 'all' ){
					if(!$(this).hasClass('category__tags-item--active')){ //要全選
						$("li[name=all]").addClass('category__tags-item--active')
						$("li[name=censored_f]").addClass('category__tags-item--active')
						$("li[name=censored_p]").addClass('category__tags-item--active')
						$("li[name=uncensored]").addClass('category__tags-item--active')
						$("li[name=FC2]").addClass('category__tags-item--active')
					} else {//要全選取消
					
					}
				} else {
						if($(this).hasClass('category__tags-item--active')) {
							$(this).removeClass('category__tags-item--active')
							$("li[name=all]").removeClass('category__tags-item--active')
						} else {
							$(this).addClass('category__tags-item--active')
						}
						var all =true;
						['censored_f','censored_p','uncensored','FC2'].forEach(function(value){
							if(! $("li[name="+value+"]").hasClass('category__tags-item--active')){
								all = false
							}
						});
						if(all)
							$("li[name=all]").addClass('category__tags-item--active')
				}
			} else {
				if($(this).hasClass('category__tags-item--active')) {
					$(this).removeClass('category__tags-item--active')

					$(this).find('.cancel').removeClass('category__tags-item--active')
				} else {
					$(this).addClass('category__tags-item--active')
					$(this).find('.cancel').addClass('category__tags-item--active')
				}
			}
	 
			$('.category__tags').find('li').each(function(){
				if($(this).hasClass('category__tags-item--active')) {
					arr.push($(this).attr('name'))
				}
			
			});
			var custom_tag = instance.value()
			custom_tag.forEach(function(v){
				arr.push(v)
			});
			sendAjax(arr,1);
		});
		
		return;
		
	} 

	function checkMoreBtn(e){
		var arr = ["source","form","role","figure","play","clothing"];
		
		for (let i=0; i<arr.length; i++) {
			console.log($(".category_"+arr[i]+"_more i").hasClass('active'))
			
		}
	}
	 
	$(window).resize(function() {
		checkMoreBtn() 
	});
	var currentscrollHeight = 0;
	$(window).on("scroll", function () {
		const scrollHeight = $(document).height();
		const scrollPos = Math.floor($(window).height() + $(window).scrollTop());
		const isBottom = scrollHeight - 100 < scrollPos;

		if (isBottom && currentscrollHeight < scrollHeight) {
		 
			customTag(this.page +1)
			currentscrollHeight = scrollHeight;
		}
	});
	window.onload = function() {
		checkMoreBtn()
		$('.category_more').on('click', function(e) {
		e.preventDefault();
		const $this = $(this);
		$this.find('.i-arrow').toggleClass('active');
		$this.parent('.category').toggleClass('category--open');
		});
		const a = @json($combo_tag);
		cate = getSearchParams('cate');
		let cateArr = []
		if(cate){
			cateArr = cate.split(',');
		}
		 
		let myOptions = []
		let Selected = []
	
		a.map(function(value){
			if(cateArr.indexOf(''+value.id)>-1 ) {
				Selected.push(''+value.id)
			}
			myOptions.push({
				label: value[`{{$lang}}`],
				value: ''+value.id,
			})
		})
 
		instance = new SelectPure(".example", {
			value:Selected,
			options: myOptions,
			multiple: true, // default: false
			autocomplete: true, // default: false
			icon: "fa fa-times", 
			classNames: {
			select: "select-pure__select",
			dropdownShown: "select-pure__select--opened",
			multiselect: "select-pure__select--multiple",
			label: "select-pure__label",
			placeholder: "select-pure__placeholder",
			dropdown: "select-pure__options",
			option: "select-pure__option",
			autocompleteInput: "select-pure__autocomplete",
			selectedLabel: "select-pure__selected-label",
			selectedOption: "select-pure__option--selected",
			placeholderHidden: "select-pure__placeholder--hidden",
			optionHidden: "select-pure__option--hidden",
			},
			onChange: value => { 
				customTag()
			}
		});
     
		
	 
		cate = getSearchParams('cate');

		
		findCate = false;
		arr =[]
		if(cate){
			cateArr = cate.split(',');
			cateArr.forEach(function(value){
				if($("li[name="+value+"]").length){
					findCate = true 
				}
				$("li[name="+value+"]").addClass('category__tags-item--active')
				$("li[name=all]").removeClass('category__tags-item--active')
				$("li[name=censored_f]").removeClass('category__tags-item--active')
				$("li[name=censored_p]").removeClass('category__tags-item--active')
				$("li[name=uncensored]").removeClass('category__tags-item--active')
				$("li[name=FC2]").removeClass('category__tags-item--active')
				arr.push(value)
			});

		
		}
 
		$('.category__tags').find('li').each(function(){
			if($(this).hasClass('category__tags-item--active')) {
				arr.push($(this).attr('name'))
			}
		});

		sendAjax(arr,1);
		$('.category').find('li').each(function(){
			$(this).find('a').attr("href","javascript:void(0);");
			cate_cilck(this);
		});
	}
</script>
@stop
 