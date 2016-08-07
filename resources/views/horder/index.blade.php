@extends('public.hindex')
@section('header')
	<link rel="stylesheet" href="/bs/css/bootstrap.min.css">
	<script src="/bs/js/jquery.min.js"></script>
	<script src="/bs/js/bootstrap.min.js"></script>
	<script src="/bs/js/holder.min.js"></script>
	<style type="text/css">
		.did{
			width:200px;height:200px;border:1px solid red;line-height:50px;float:left;margin-left:10px;
		}
		.active{
			background-color: orange;
		}
	</style>
@endsection
@section('main')
		<div class="w3l_banner_nav_right">
			
			
			<div class="w3ls_w3l_banner_nav_right_grid w3ls_w3l_banner_nav_right_grid_sub">
				<!-- <h3 class="w3l_fruit">购物车</h3> -->
				<div class="w3ls_w3l_banner_nav_right_grid1 w3ls_w3l_banner_nav_right_grid1_veg">
					<div style="margin:40px auto;text-align:center;" >
						<h4>我的订单</h4>
					</div>
					<!-- 添加地址模态框开始 -->
					<div class="container">
						<button class="btn btn-success" data-toggle="modal" data-target="#Addressmodal">添加地址</button>
						<!-- Modal -->
						<div class="modal fade" id="Addressmodal">
							<div class="modal-dialog">

							<!-- 内容区 -->
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close"data-dismiss="modal">&times;</button>
										<h4 class="modal-title">添加地址</h4>
									</div>

									<!-- body -->
									<div class="modal-body">
										<form role="form" action="/addressinsert" method="post">
											<div class="form-group">
												<label>收件人:</label>
												<input type="text" name="name" class="form-control">
											</div>
											<div class="form-group">
												<!-- 自己做城市级联 -->
												<label>地址:</label>
												<input type="text" name="adds" class="form-control">
											</div>
											<div class="form-group">
												<label>电话:</label>
												<input type="text" name="phone" class="form-control">
											</div>
										
										

									</div>

									<!-- footer -->
									<div class="modal-footer">
										{{csrf_field()}}
										<button type="submit"class="btn btn-success">提交</button>
										<button type="reset" class="btn btn-danger">重置</button>
									</div>
									</form>
								</div>
							</div>
						</div>
					</div>
					<!-- 添加地址模态框结束 -->
					<h4>收货地址:</h4>
					<form action="/order/create" method="post">
					<div id="did1">
						@foreach($address as $row)
						<div class="did" name="cid" value="{{$row['id']}}">
							<h4>收件人:{{$row['name']}}</h4>
							<h4>地址:{{$row['adds']}}</h4>
							<h4>电话:{{$row['phone']}}</h4>
							<input type="hidden" name="address_id" value="">
						</div>
						@endforeach
						</div>
						<div class="clearfix"> </div><br>
							{{csrf_field()}}
							<input type="submit" value="生成订单">		
						</form>
					<div class="clearfix"> </div>
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
<script type="text/javascript">
	$("#did1 .did").click(function(){
		$(this).siblings().removeClass('active');
		$(this).addClass('active');
		id=$(this).attr('value');
		// alert(id);
		$('input[name="address_id"]').val(id);
	})

</script>
@endsection