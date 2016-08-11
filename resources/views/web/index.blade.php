@extends('public.hindex')
@section('main')
<style type="text/css">
	
	#left{
		position:absolute;
		left:320px;
		top:435px;
		border-radius:30px;
		cursor:pointer;
	}
	#right{
		position:absolute;
		left:1440px;
		top:435px;
		border-radius:30px;
		cursor:pointer;
	}
	#dd1{
		width:30px;
		height:30px;
		background-color: orange;
		line-height:30px;
		text-align:center;
		position:absolute;
		left:800px;
		top:650px;
		border-radius:30px;
		cursor:pointer;
	}
</style>
		<div class="w3l_banner_nav_right">
			<section class="slider">
				<div>
					<!-- <ul class="slides"> -->
						<!-- <li> -->
							<!-- <div class="w3l_banner_nav_right_banner"> -->
								<!-- <h3>Make your <span>food</span> with Spicy.</h3> -->
								<!-- <div class="more"> -->
									<!-- <a href="products.html" class="button--saqui button--round-l button--text-thick" data-text="Shop now">Shop now</a> -->
								<!-- </div> -->
							<!-- </div> -->
						<!-- </li> -->
						<!-- <li> -->
							<!-- <div class="w3l_banner_nav_right_banner1"> -->
								<!-- <h3>Make your <span>food</span> with Spicy.</h3> -->
								<!-- <div class="more"> -->
									<!-- <a href="products.html" class="button--saqui button--round-l button--text-thick" data-text="Shop now">Shop now</a> -->
								<!-- </div> -->
							<!-- </div> -->
						<!-- </li> -->
						<!-- <li> -->
						
						
						<a  href="javascript:fun('-')" id="left"><img src="/h/images/left.png" style="width:50px;height:50px"></a>
						<a href="javascript:fun('+')" id="right"><img src="/h/images/right.png" style="width:50px;height:50px" ></a>
						@for($i=0;$i<$imgnu;$i++)
						<div id="dd1" name="anniu"  onclick="fun({{$i}})"></div>
						@endfor
						
						<div id="img" style="height:460px;">
						@foreach($imgs as $val)
						<img src="/uploads/play/{{$val['picname']}}" style="width:100%;height:100%;" name="img">
						@endforeach
						</div>
						
							<!-- <div class="w3l_banner_nav_right_banner2"> -->
								<!-- <h3>upto <i>50%</i> off.</h3> -->
								<!-- <div class="more"> -->
									<!-- <a href="products.html" class="button--saqui button--round-l button--text-thick" data-text="Shop now">Shop now</a> -->
								<!-- </div> -->
							<!-- </div> -->
						<!-- </li> -->
					<!-- </ul> -->
				</div>
			</section>
			<!-- flexSlider -->
				<link rel="stylesheet" href="/h/css/flexslider.css" type="text/css" media="screen" property="" />
				<script defer src="/h/js/jquery.flexslider.js"></script>
				<script defer src="/h/js/jquery-1.8.3.min.js"></script>
				<script type="text/javascript">
				m=0;
				//获取图片集合对象(根据指定的名称获取图片元素集合)
				list=document.getElementsByName('img');
				// alert(list);
				//获取按钮对象集合
				list1=document.getElementsByName('anniu');
				x=750;
				//遍历
				for(var i=0;i<list1.length;i++){
					list1[i].style.left=x+"px";
					list1[i].innerHTML=i+1;
					x+=50;
				}
				function fun(b){
					//清除定时器
					clearTimeout(mytime);
					if(isNaN(b)){
						//switch
						switch(b){
							case "-": 
							m=m-2;
							if(m<-1){
							m={{$imgnu-2}};
							}
							break;
							case "+":
							m=m;
							if(m>{{$imgnu-1}}){
								m=0;
							}
							break;
						}
					}else{
						m=b-1;
					}
					
					running();

				}
				function show(m){
					//遍历
					for(var i=0;i<list.length;i++){
						if(m==i){
							list[i].style.display="block";
						}else{
							list[i].style.display="none";
						}
					}
				}
				function running(){
					m++;
					// alert(m);
					if(m=={{$imgnu}}){
						m=0;
					}
					show(m);
					mytime=setTimeout(running,2000);
				}
				running();
				// $(window).load(function(){
				//   $('.flexslider').flexslider({
				// 	animation: "slide",
				// 	start: function(slider){
				// 	  $('body').removeClass('loading');
				// 	}
				//   });
				// });
			  </script>
			<!-- //flexSlider -->
		</div>
		<div class="clearfix"></div>
	</div><!-- 不能删 -->
<!-- banner -->
	<div class="banner_bottom">
			<div class="wthree_banner_bottom_left_grid_sub">
			</div>
			<!-- <div class="wthree_banner_bottom_left_grid_sub1">
				<div class="col-md-4 wthree_banner_bottom_left">
					<div class="wthree_banner_bottom_left_grid">
						<img src="/h/images/4.jpg" alt=" " class="img-responsive" />
						<div class="wthree_banner_bottom_left_grid_pos">
							<h4>Discount Offer <span>25%</span></h4>
						</div>
					</div>
				</div>
				<div class="col-md-4 wthree_banner_bottom_left">
					<div class="wthree_banner_bottom_left_grid">
						<img src="/h/images/5.jpg" alt=" " class="img-responsive" />
						<div class="wthree_banner_btm_pos">
							<h3>introducing <span>best store</span> for <i>groceries</i></h3>
						</div>
					</div>
				</div>
				<div class="col-md-4 wthree_banner_bottom_left">
					<div class="wthree_banner_bottom_left_grid">
						<img src="/h/images/6.jpg" alt=" " class="img-responsive" />
						<div class="wthree_banner_btm_pos1">
							<h3>Save <span>Upto</span> $10</h3>
						</div>
					</div>
				</div>
				<div class="clearfix"> </div>
			</div> -->
			<div class="clearfix"> </div>
	</div>
<!-- top-brands -->
	<div class="top-brands">
		<div class="container">
			<h3>火爆优惠</h3>
			@foreach($store as $row)
					<div class="col-md-3 w3ls_w3l_banner_left w3ls_w3l_banner_left_asdfdfd" style="margin-top:20px;">
						<div class="hover14 column">
						<div class="agile_top_brand_left_grid w3l_agile_top_brand_left_grid">
							<div class="agile_top_brand_left_grid_pos">
								<img src="/h/images/offer.png" alt=" " class="img-responsive" />
							</div>
							<div class="agile_top_brand_left_grid1">
								<form action="/web/addcart" method="post">
								<figure>
									<div class="snipcart-item block">
										<div class="snipcart-thumb">
											<a href="/web/detail/{{$row['id']}}"><img src="{{$row['picname']}}" alt=" " class="img-responsive" /></a>
											<p style="text-align:center;">{{$row['goods']}}</p>
											<h4 style="text-align:center;">￥{{$row['price']}}<span>￥{{floor($row['price']*1.2)}}</span></h4>
										</div>
										<div class="snipcart-details">
											<button type="submit" class="btn my-cart-btn hvr-sweep-to-right" data-id="{{$row['id']}}" data-name="{{$row['goods']}}" data-summary="summary {{$row['id']}}" data-price="{{$row['price']}}" data-quantity="1" data-image="{{$row['picname']}}">加入购物车</button>
										</div>
										<input type="hidden" name="id" value="{{$row['id']}}">
										{{csrf_field()}}
									</div>
								</figure>
								</form>
							</div>
						</div>
						</div>
					</div>
					@endforeach
		</div>
	</div>
<!-- //top-brands -->
<!-- fresh-vegetables -->
	<div class="fresh-vegetables">
		<div class="container">
		<!-- <div> -->
			<!-- 横框 -->
			<div class="w3l_fresh_vegetables_grids">
				<div style="width:100%;margin:10px 10px 20px;">
					<h1>新品上市</h1>
				</div>
				<div class="col-md-3 w3l_fresh_vegetables_grid w3l_fresh_vegetables_grid_left">
					<div class="w3l_fresh_vegetables_grid2">
						<a href="{{$adver[0]['url']}}"><img src="/uploads/advertisements/{{$adver[0]['picname']}}" width="100%"></a>
					</div>
				</div>
				<div class="col-md-9 w3l_fresh_vegetables_grid_right">
						@foreach($new as $row)
						<div  style="border:1px solid #aaa;float:left;text-align:center;margin:12px;" class="col-md-2">
							<a href="/web/detail/{{$row['id']}}">
								<img src="{{$row['picname']}}" width="100px" height="110px">
								<span>{{$row['goods']}}</span> 
							</a>
						</div>
						@endforeach
					<div class="clearfix"> </div>
					<!-- 右下角闪光提示语 -->
					<!-- <div class="agileinfo_move_text">
						<div class="agileinfo_marquee">
							<h4>get <span class="blink_me">25% off</span> on first order and also get gift voucher</h4>
						</div>
						<div class="agileinfo_breaking_news">
							<span> </span>
						</div>
						<div class="clearfix"></div>
					</div> -->
				</div>
				<div class="clearfix"> </div>
			</div>
			<!-- //横框 -->
			<!-- 横框2-->
			<div class="w3l_fresh_vegetables_grids">
				<div style="width:100%;margin:10px 10px 20px;">
					<h1>最高关注</h1>
				</div>
				<div class="col-md-3 w3l_fresh_vegetables_grid w3l_fresh_vegetables_grid_left">
					<div class="w3l_fresh_vegetables_grid2">
						<a href="{{$adver[1]['url']}}"><img src="/uploads/advertisements/{{$adver[1]['picname']}}" width="100%"></a>
					</div>
				</div>
				<div class="col-md-9 w3l_fresh_vegetables_grid_right">
						@foreach($clicknum as $row)
						<div  style="border:1px solid #aaa;float:left;text-align:center;margin:12px;" class="col-md-2">
							<a href="/web/detail/{{$row['id']}}">
								<img src="{{$row['picname']}}" width="100px" height="110px">
								<span>{{$row['goods']}}</span> 
							</a>
						</div>
						@endforeach
					<div class="clearfix"> </div>
					<!-- 右下角闪光提示语 -->
					<!-- <div class="agileinfo_move_text">
						<div class="agileinfo_marquee">
							<h4>get <span class="blink_me">25% off</span> on first order and also get gift voucher</h4>
						</div>
						<div class="agileinfo_breaking_news">
							<span> </span>
						</div>
						<div class="clearfix"></div>
					</div> -->
				</div>
				<div class="clearfix"> </div>
			</div>
			<!-- //横框2-->
			<!-- 横框3-->
			<div class="w3l_fresh_vegetables_grids">
				<div style="width:100%;margin:10px 10px 20px;">
					<h1>热卖商品</h1>
				</div>
				<div class="col-md-3 w3l_fresh_vegetables_grid w3l_fresh_vegetables_grid_left">
					<div class="w3l_fresh_vegetables_grid2">
						<a href="{{$adver[2]['url']}}"><img src="/uploads/advertisements/{{$adver[2]['picname']}}" width="100%"></a>
					</div>
				</div>
				<div class="col-md-9 w3l_fresh_vegetables_grid_right">
						@foreach($num as $row)
						<div  style="border:1px solid #aaa;float:left;text-align:center;margin:12px;" class="col-md-2">
							<a href="/web/detail/{{$row['id']}}">
								<img src="{{$row['picname']}}" width="100px" height="110px">
								<span>{{$row['goods']}}</span> 
							</a>
						</div>
						@endforeach
					<div class="clearfix"> </div>
					<!-- 右下角闪光提示语 -->
					<!-- <div class="agileinfo_move_text">
						<div class="agileinfo_marquee">
							<h4>get <span class="blink_me">25% off</span> on first order and also get gift voucher</h4>
						</div>
						<div class="agileinfo_breaking_news">
							<span> </span>
						</div>
						<div class="clearfix"></div>
					</div> -->
				</div>
				<div class="clearfix"> </div>
			</div>
			<!-- //横框3-->
		</div>
	</div>
<!-- //fresh-vegetables -->
@endsection

@section('js')
<!-- Bootstrap Core JavaScript -->
<script src="/h/js/bootstrap.min.js"></script>
<script>
$(document).ready(function(){
    $(".dropdown").hover(            
        function() {
            $('.dropdown-menu', this).stop( true, true ).slideDown("fast");
            $(this).toggleClass('open');        
        },
        function() {
            $('.dropdown-menu', this).stop( true, true ).slideUp("fast");
            $(this).toggleClass('open');       
        }
    );
});
</script>
<!-- here stars scrolling icon -->
	<script type="text/javascript">
		$(document).ready(function() {
			/*
				var defaults = {
				containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear' 
				};
			*/
								
			$().UItoTop({ easingType: 'easeOutQuart' });
								
			});
	</script>
<!-- //here ends scrolling icon -->/h/
<script type='text/javascript' src="/h/js/jquery.mycart.js"></script>
<script type="text/javascript">
  $(function () {

    var goToCartIcon = function($addTocartBtn){
      var $cartIcon = $(".my-cart-icon");
      var $image = $('<img width="30px" height="30px" src="' + $addTocartBtn.data("image") + '"/>').css({"position": "fixed", "z-index": "999"});
      $addTocartBtn.prepend($image);
      var position = $cartIcon.position();
      $image.animate({
	  
      }, 500 , "linear", function() {
        $image.remove();
      });
    }

    $('.my-cart-btn').myCart({
      classCartIcon: 'my-cart-icon',
      classCartBadge: 'my-cart-badge',
      affixCartIcon: true,
      checkoutCart: function(products) {
        $.each(products, function(){
          console.log(this);
        });
      },
      clickOnAddToCart: function($addTocart){
        goToCartIcon($addTocart);
      },
      getDiscountPrice: function(products) {
        var total = 0;
        $.each(products, function(){
          total += this.quantity * this.price;
        });
        return total * 1;
      }
    });

  });
  </script>
</body>
</html>
@endsection