@extends('public.hindex')

@section('main')
		<div class="w3l_banner_nav_right">
			<div class="w3l_banner_nav_right_banner3">
				<h3>最佳新品<span class="blink_me"></span></h3>
			</div>
			<form action="a"></form>
			<div class="agileinfo_single">
				<h5>{{$list['goods']}}</h5>
				<div class="col-md-4 agileinfo_single_left">
					<img id="example" src="{{$list['picname']}}" alt=" " class="img-responsive" />
				</div>
				<div class="col-md-8 agileinfo_single_right">
					<div class="rating1">
						<span class="starRating">
							<input id="rating5" type="radio" name="rating" value="5">
							<label for="rating5">5</label>
							<input id="rating4" type="radio" name="rating" value="4">
							<label for="rating4">4</label>
							<input id="rating3" type="radio" name="rating" value="3" checked>
							<label for="rating3">3</label>
							<input id="rating2" type="radio" name="rating" value="2">
							<label for="rating2">2</label>
							<input id="rating1" type="radio" name="rating" value="1">
							<label for="rating1">1</label>
						</span>
					</div>
					<div class="w3agile_description">
						<h4>描述:</h4>
						<p>{!!$list['descr']!!}</p>
					</div>
					<div class="snipcart-item block">
						<div class="snipcart-thumb agileinfo_single_right_snipcart">
							<h4>优惠价:￥{{$list['price']}} <span>原价:￥{{$list['orginprice']}}</span></h4>
						</div>
						<div class="snipcart-details agileinfo_single_right_details">
							{{csrf_field()}}
							<input type="hidden" name="id" vlue="{{$list['id']}}">
							<button class="btn btn-danger my-cart-btn hvr-sweep-to-right" >加入购物车</button>

							<!-- <input type="submit" value="加入购物车" class="btn btn-danger my-cart-btn hvr-sweep-to-right"> -->
						</div>
					</div>
				</div>
				<div class="clearfix"> </div>
			</div>
			</form>
		</div>
		<div class="clearfix"></div>
	</div><!-- 不能删 -->
	<div>
	    <ul role="tablist" class="nav nav-tabs" id="myTab">
			<li class="active" role="presentation"><a aria-expanded="true" aria-controls="home" data-toggle="tab" role="tab" id="home-tab" href="#home">商品介绍</a></li>
			<li role="presentation"><a aria-controls="profile" data-toggle="tab" id="profile-tab" role="tab" href="#profile">添加评论</a></li>
			<li class="dropdown" role="presentation">
				<a aria-controls="myTabDrop1-contents" data-toggle="dropdown" class="dropdown-toggle" id="myTabDrop1" href="#">商品评价<span class="caret"></span></a>
				<ul id="myTabDrop1-contents" aria-labelledby="myTabDrop1" role="menu" class="dropdown-menu">
					<li><a aria-controls="dropdown1" data-toggle="tab" id="dropdown1-tab" role="tab" tabindex="-1" href="#dropdown1">好评</a></li>
					<li><a aria-controls="dropdown2" data-toggle="tab" id="dropdown2-tab" role="tab" tabindex="-1" href="#dropdown2">差评</a></li>
				</ul>
			</li>
		</ul>
		<div id="myTabContent" class="tab-content">
			<div role="tabpanel" class="tab-pane fade in active bootstrap-tab-text" id="home" aria-labelledby="home-tab">
				<h5>简介</h5><br>
				<p>{!!$list['descr']!!}</p>
			</div>
			<div role="tabpanel" class="tab-pane fade bootstrap-tab-text" id="profile" aria-labelledby="profile-tab">
				<div class="bootstrap-tab-text-grids">
					<div class="bootstrap-tab-text-grid">
						<div class="clearfix"> </div>
					</div>

					<!-- <div class="add-review">
						<h5>添加评论</h5><br>
						<form action='' method="post">
							姓名：<input type="text" value="Name" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Message...';}" required=""><br><br>
							邮箱：<input type="text" value="Email" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Message...';}" required=""><br><br>
							评论：<textarea type="text" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Message...';}" required="">Message...</textarea><br><br>
							<input type="submit" value="提交">
						</form>
					</div> -->
				</div>
			</div>
			<div role="tabpanel" class="tab-pane fade bootstrap-tab-text" id="dropdown1" aria-labelledby="dropdown1-tab">
				<p>对应好评</p>
			</div>
			<div role="tabpanel" class="tab-pane fade bootstrap-tab-text" id="dropdown2" aria-labelledby="dropdown2-tab">
				<p>对应差评</p>
			</div>
				
		</div>		
	</div>
  
<!-- 评论结束 -->
  <br><br>
	<div class="clearfix"></div>
	</div>
<!-- //banner -->
<!-- brands -->
	<div class="w3ls_w3l_banner_nav_right_grid w3ls_w3l_banner_nav_right_grid_popular">
		<div class="container">
			<h3>时尚精品 魅力品牌</h3>
				<div class="w3ls_w3l_banner_nav_right_grid1">
					<h6>手机</h6>
					@foreach($data as $row)
					<div class="col-md-3 w3ls_w3l_banner_left" style="margin-bottom:15px">
						<div class="hover14 column">
						<div class="agile_top_brand_left_grid w3l_agile_top_brand_left_grid">
							<div class="agile_top_brand_left_grid_pos">
								<img src="/h/images/offer.png" alt=" " class="img-responsive" />
							</div>
							<div class="agile_top_brand_left_grid1">
								<figure>
									<div class="snipcart-item block">
										<div class="snipcart-thumb">
											<a href="/web/detail/{{$row['id']}}"><img src="{{$row['picname']}}" alt=" " style="width:300px;height:120px" class="img-responsive" /></a>
											<center>
												<p>{{$row['goods']}}</p>
												<h4>￥{{$row['price']}}<span>￥{{$row['orginprice']}}</span></h4>
											</center>
										</div>
										<div class="snipcart-details">
											<button class="btn btn-danger my-cart-btn hvr-sweep-to-right">加入购物车</button>
										</div>
									</div>
								</figure>
							</div>
						</div>
						</div>
					</div>
					@endforeach
					<div class="clearfix"> </div>
				</div>
				<div class="w3ls_w3l_banner_nav_right_grid1">
					<h6>笔记本电脑</h6>
					@foreach($data1 as $row)				
					<div class="col-md-3 w3ls_w3l_banner_left" style="margin-bottom:15px">
						<div class="hover14 column">
						<div class="agile_top_brand_left_grid w3l_agile_top_brand_left_grid">
							<div class="agile_top_brand_left_grid_pos">
								<img src="/h/images/offer.png" alt=" " class="img-responsive" />
							</div>
							<div class="agile_top_brand_left_grid1">
								<figure>
									<div class="snipcart-item block">
										<div class="snipcart-thumb">
											<a href="/web/detail/{{$row['id']}}"><img src="{{$row['picname']}}" alt=" " class="img-responsive" style="width:300px;height:120px"/></a>
											<center>
												<p>{{$row['goods']}}</p>
												<h4>￥{{$row['price']}}<span>￥{{$row['orginprice']}}</span></h4>
											</center>
										</div>
										<div class="snipcart-details">
											<button class="btn btn-danger my-cart-btn hvr-sweep-to-right" data-id="9" data-name="Fresh spinach" data-summary="summary 9" data-price="2.00" data-quantity="1" data-image="/h/images/9.png">加入购物车</button>
										</div>
									</div>
								</figure>
							</div>
						</div>
						</div>
					</div>
					@endforeach
					<div class="clearfix"> </div>
				</div>
		</div>
	</div>
<!-- //brands -->
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
      var $image = $('<img width="30px" height="30px" src="/h/' + $addTocartBtn.data("image") + '"/>').css({"position": "fixed", "z-index": "999"});
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

  <!-- //js -->
 <script src='/h/js/okzoom.js'></script>
  <script>
    $(function(){
      $('#example').okzoom({
        width: 150,
        height: 150,
        border: "1px solid black",
        shadow: "0 0 5px #000"
      });
    });
  </script>
</body>
</html>
@endsection