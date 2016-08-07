@extends('public.hindex')

@section('main')
		<div class="w3l_banner_nav_right">
			<!-- 广告 -->
			<!-- <div >
				<img src="/uploads/advertisements/" width="100%" alt="">
			</div> -->
					<!-- 筛选条件 -->
					<!-- <div id="main-rightone">
						<span> 商品筛选</span>
					</div>
					<div class="clear"></div>
					<div class="main-rightthree">
						<ul>
							<li><a href="/web/price?l=0&h=1000">0-1000</a></li>
							<li><a href="/web/price?l=1000&h=2000">1000-2000</a></li>
							<li><a href="/web/price?l=2000&h=3000">2000-3000</a></li>
							<li><a href="/web/price?l=3000&h=4000">3000-4000</a></li>
							<li><a href="/web/price?l=4000&h=100000">4000以上</a></li>
						</ul>
						<span>价格:</span>
					</div>
					
					<div class="main-rightthree">
						<ul>
							<li><a href="#">按销量</a></li>
							<li><a href="#">按库存</a></li>
							<li><a href="#">按厂家</a></li>
							<li><a href="#">按添加时间</a></li>
						</ul>
						<span>排序:</span>
					</div> -->
			
			<div class="w3ls_w3l_banner_nav_right_grid w3ls_w3l_banner_nav_right_grid_sub">
				<!-- <h3 class="w3l_fruit">列表页</h3> -->
				<div class="w3ls_w3l_banner_nav_right_grid1 w3ls_w3l_banner_nav_right_grid1_veg">
					@if($goods)
					@foreach($goods as $row)
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
					@endif
					<div class="clearfix"> </div>
				</div>
				<!-- 分页 -->
				<div style="margin:100px 400px;">
					<div class="dataTables_paginate paging_full_numbers" id="pages">
				      {!!$goods->render()!!}
				     </div>
				</div>
				
			</div>
		</div>

		<div class="clearfix"></div>
	</div>
<!-- //banner -->
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
<script type="text/javascript" id="snipcart" src="/h/js/snipcart.js" data-api-key="ZGQxNzVjZTItOWRmNS00YjJhLTlmNGUtMDE4NjdiY2RmZGNj"></script>
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
<!-- //here ends scrolling icon -->
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