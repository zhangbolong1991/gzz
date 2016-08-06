<!DOCTYPE html>
<html>
<head>
<title>商城</title>
<!-- for-mobile-apps -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //for-mobile-apps -->
<link href="/h/css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="/h/css/style.css" rel="stylesheet" type="text/css" media="all" />
<!-- font-awesome icons -->
<link href="/h/css/font-awesome.css" rel="stylesheet" type="text/css" media="all" /> 
<!-- //font-awesome icons -->
<!-- js -->
<script src="/h/js/jquery-1.11.1.min.js"></script>
<!-- //js -->
<link href='http://fonts.useso.com/css?family=Ubuntu:400,300,300italic,400italic,500,500italic,700,700italic' rel='stylesheet' type='text/css'>
<link href='http://fonts.useso.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
<!-- start-smoth-scrolling -->
<script type="text/javascript" src="/h/js/move-top.js"></script>
<script type="text/javascript" src="/h/js/easing.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(".scroll").click(function(event){		
			event.preventDefault();
			$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
		});
	});
</script>
<!-- 详情页放大镜站位 -->
@section('fangdajing')
@show
<!-- start-smoth-scrolling -->
</head>
	
<body>
<!-- header -->
	<div class="agileits_header">
		<div class="w3l_offers">
			<a href="products.html">今日特价,high翻全场!</a>
		</div>
		<div class="w3l_search">
			<form action="/web/list/2" method="get">
				<!-- <input type="text" name="Product" value="Search a product..." onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search a product...';}" required=""> -->
				<input type="text"  value="华为" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '华为';}" required="">
				<input type="submit" value=" ">
			</form>
		</div>
		<div class="product_list_header">  
			<div style="cursor: pointer;">
				<span class="glyphicon glyphicon-shopping-cart"  data-toggle="modal" data-target="#Mymodal"></span>
						<!-- Modal -->
						<div class="modal fade" id="Mymodal">
							<div class="modal-dialog">

							<!-- 内容区 -->
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close"data-dismiss="modal">&times;</button>
										<h4 class="modal-title">最新添加的商品</h4>
									</div>

									<!-- body -->
									@if(session('cart'))
									<div class="modal-body">
									<table class="table table-bordered table-hover table-striped table-condensed table-responsive">
									@foreach(session('cart') as $row)
											<tr>
												<td align="center">{!!$row['goods']!!}</td>
												<td align="center"><img src="{{$row['picname']}}" alt="" width="30px"></td>
												<td align="center">￥{!!$row['price']!!}</td>
												<td align="center"><input type="text" value="{{$row['num']}}" name="{{$row['id']}}" size="1px" style="border:0;background:transparent;" disabled></td>
												<td align="center">
												<input type="text" value="￥{{$row['total']}}" id="{{$row['did']}}" size="7px" style="border:0;background:transparent;" disabled></td>
											</tr>
									@endforeach
									</table>
									</div>
									@else
									<div class="modal-body">
										<div class="alert alert-danger">
											空空如也~
										</div>
									</div>
									@endif
									<!-- footer -->
									<div class="modal-footer">
										<button class="btn btn-danger" data-dismiss="modal">关闭</button>
										<a href="/web/cart" class="btn btn-success">去购物车</a>
									</div>
								</div>
							</div>
						</div>
			</div>
		</div>
		<div class="w3l_header_right">
			<ul>
				<li class="dropdown profile_details_drop">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user" aria-hidden="true"></i><span class="caret"></span></a>
					<div class="mega-dropdown-menu">
						<div class="w3ls_vegetables">
							<ul class="dropdown-menu drp-mnu">
								<li><a href="">个人中心</a></li>
								<li><a href="">登录</a></li>
								<li><a href="">注册</a></li>
							</ul>
						</div>                  
					</div>	
				</li>
			</ul>
		</div>
		<div class="w3l_header_right1">
			<h2><a href="mail.html">联系我们</a></h2>
		</div>
		<div class="clearfix"> </div>
	</div>
<!-- script-for sticky-nav -->
	<script>
	$(document).ready(function() {
		 var navoffeset=$(".agileits_header").offset().top;
		 $(window).scroll(function(){
			var scrollpos=$(window).scrollTop(); 
			if(scrollpos >=navoffeset){
				$(".agileits_header").addClass("fixed");
			}else{
				$(".agileits_header").removeClass("fixed");
			}
		 });
		 
	});
	</script>
<!-- //script-for sticky-nav -->
	<div class="logo_products">
		<div class="container">
			<div class="w3ls_logo_products_left">
				<h1><a href="/web/index"><span>商城</span>GZZ</a></h1>
			</div>
			<div class="w3ls_logo_products_left1">
				<ul class="special_items">
				@if(session('nav'))
					@foreach(session('nav') as $row)
			        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">{{$row['name']}} <i class="fa fa-angle-down"></i> </a> 
						@if($row['sub'])
						<ul class="dropdown-menu drp-mnu"> 
							@foreach($row['sub'] as $v)
							<li class="dropdown-submenu"> <a href="#">{{$v['name']}}</a> 
								<!-- @if($v['sub'])
								<ul class="dropdown-menu"> 
									@foreach($v['sub'] as $r)
									<li><a href="/dd/{{$r['id']}}">{{$r['name']}}</a></li> 
									@endforeach            
								</ul>
								@endif -->
							</li> 
							@endforeach
						</ul>
						@endif
						</li>  
			        @endforeach
				@endif
				</ul>
			</div>
			<!-- <div class="w3ls_logo_products_left1">
				<ul class="phone_email">
					<li><i class="fa fa-phone" aria-hidden="true"></i>(+010) 1234888</li>
					<li><i class="fa fa-envelope-o" aria-hidden="true"></i><a href="18510805368@163.com">18510805368@163.com</a></li>
				</ul>
			</div> -->
			<div class="clearfix"> </div>
		</div>
	</div>
<!-- //header -->

<!-- products-breadcrumb -->
	<div class="products-breadcrumb">
		<div class="container">
			<ul>
				<li><i class="fa fa-home" aria-hidden="true"></i><a href="/web/index">首页</a><span>|</span></li>
			</ul>
		</div>
	</div>
<!-- //products-breadcrumb -->

<!-- banner -->
	<div class="banner">
		<div class="w3l_banner_nav_left">
			<nav class="navbar nav_bottom">
			 <!-- Brand and toggle get grouped for better mobile display -->
			  <div class="navbar-header nav_2">
				  <button type="button" class="navbar-toggle collapsed navbar-toggle1" data-toggle="collapse" data-target="#bs-megadropdown-tabs">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				  </button>
			   </div> 
			   <!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-megadropdown-tabs">
					<ul class="nav navbar-nav nav_1">
						<li><a href="/web/list/2">华为</a></li>
						<li><a href="/web/list/2">三星</a></li>
						<li class="dropdown mega-dropdown active">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">苹果<span class="caret"></span></a>				
							<div class="dropdown-menu mega-dropdown-menu w3ls_vegetables_menu">
								<div class="w3ls_vegetables">
									<ul>	
										<li><a href="/web/list/2">港版</a></li>
										<li><a href="/web/list/2">国行</a></li>
									</ul>
								</div>                  
							</div>				
						</li>
						<li><a href="/web/list/2">小米</a></li>
						<li><a href="/web/list/2">魅族</a></li>
						<li><a href="/web/list/2">格力</a></li>
						<li><a href="/web/list/2">诺基亚</a></li>
						<li><a href="/web/list/2">酷派</a></li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">其他<span class="caret"></span></a>
							<div class="dropdown-menu mega-dropdown-menu w3ls_vegetables_menu">
								<div class="w3ls_vegetables">
									<ul>
										<li><a href="/web/list/2">国产手机</a></li>
										<li><a href="/web/list/2">非国产手机</a></li>
									</ul>
								</div>                  
							</div>	
						</li>
					</ul>
				 </div><!-- /.navbar-collapse -->
			</nav>
		</div>
@section('main')
@show

<!-- newsletter -->
	<div class="newsletter">
		<div class="container">
			<div class="w3agile_newsletter_left">
				<h3>订阅GZZ资讯</h3>
			</div>
			<div class="w3agile_newsletter_right">
				<form action="#" method="post">
					<input type="email" name="Email" value="Email" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Email';}" required="">
					<input type="submit" value="subscribe now">
				</form>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
<!-- //newsletter -->
<!-- footer -->
	<div class="footer">
		<div class="container">
			<div class="col-md-3 w3_footer_grid">
				<h3>information</h3>
				<ul class="w3_footer_grid_list">
					<li><a href="events.html">Events</a></li>
					<li><a href="about.html">About Us</a></li>
					<li><a href="products.html">Best Deals</a></li>
					<li><a href="services.html">Services</a></li>
					<li><a href="short-codes.html">Short Codes</a></li>
				</ul>
			</div>
			<div class="col-md-3 w3_footer_grid">
				<h3>policy info</h3>
				<ul class="w3_footer_grid_list">
					<li><a href="faqs.html">FAQ</a></li>
					<li><a href="privacy.html">privacy policy</a></li>
					<li><a href="privacy.html">terms of use</a></li>
				</ul>
			</div>
			<div class="col-md-3 w3_footer_grid">
				<h3>what in stores</h3>
				<ul class="w3_footer_grid_list">
					<li><a href="pet.html">Pet Food</a></li>
					<li><a href="frozen.html">Frozen Snacks</a></li>
					<li><a href="kitchen.html">Kitchen</a></li>
					<li><a href="products.html">Branded Foods</a></li>
					<li><a href="household.html">Households</a></li>
				</ul>
			</div>
			<div class="col-md-3 w3_footer_grid">
				<h3>twitter posts</h3>
				<ul class="w3_footer_grid_list1">
					<li><label class="fa fa-twitter" aria-hidden="true"></label><i>01 day ago</i><span>Non numquam <a href="#">http://sd.ds/13jklf#</a>
						eius modi tempora incidunt ut labore et
						<a href="#">http://sd.ds/1389kjklf#</a>quo nulla.</span></li>
					<li><label class="fa fa-twitter" aria-hidden="true"></label><i>02 day ago</i><span>Con numquam <a href="#">http://fd.uf/56hfg#</a>
						eius modi tempora incidunt ut labore et
						<a href="#">http://fd.uf/56hfg#</a>quo nulla.</span></li>
				</ul>
			</div>
			<div class="clearfix"> </div>
			<div class="agile_footer_grids">
				<div class="col-md-3 w3_footer_grid agile_footer_grids_w3_footer">
					<div class="w3_footer_grid_bottom">
						<h4>安全支付</h4>
						<img src="/h/images/card.png" alt=" " class="img-responsive" />
					</div>
				</div>
				<div class="col-md-3 w3_footer_grid agile_footer_grids_w3_footer">
					<div class="w3_footer_grid_bottom">
						<h5>联系我们</h5>
						<ul class="agileits_social_icons">
							<li><a href="#" class="facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
							<li><a href="#" class="twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
							<li><a href="#" class="google"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
							<li><a href="#" class="instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
							<li><a href="#" class="dribbble"><i class="fa fa-dribbble" aria-hidden="true"></i></a></li>
						</ul>
					</div>
				</div>
				<div class="clearfix"> </div>
			</div>
			<div class="wthree_footer_copy">
				<p>Copyright &copy; 2016.Company name All rights reserved.<a target="_blank" href="http://sc.chinaz.com/moban/"></a></p>
			</div>
		</div>
	</div>
<!-- //footer -->

@section('js')
@show