@extends('public.hindex')

@section('main')
		<div class="w3l_banner_nav_right">
			
			
			<div class="w3ls_w3l_banner_nav_right_grid w3ls_w3l_banner_nav_right_grid_sub">
				<!-- <h3 class="w3l_fruit">购物车</h3> -->
				<div class="w3ls_w3l_banner_nav_right_grid1 w3ls_w3l_banner_nav_right_grid1_veg">
					<div style="margin:40px auto;text-align:center;" >
						<h4>我的购物车</h4>
					</div>
					<table width="1000px" class="table-bordered table-hover table-striped table-condensed table-responsive" style="margin:0px auto 200px;">
						@if(session('cart'))
						<tr height="50px">
							<td align="center"><button  onclick="fun(1)" class="btn btn-default btn-sm">全选</button></td>
							<td align="center">名称</td>
							<td align="center">图片</td>
							<td align="center">价格</td>
							<td align="center">数量</td>
							<td align="center">总计</td>
							<td align="center">操作</td>
						</tr>
						
						@foreach($cart as $row)
						
							<tr>
								<td align="center"><input type="checkbox" checked name="check" value="{{$row['id']}}"></td>
								<td align="center">{{$row['goods']}}</td>
								<td align="center"><img src="{{$row['picname']}}" width="50px"></td>
								<td align="center">￥{{$row['price']}}</td>
								<td align="center">
									<!-- <a href="javascript:func(1,{{$row['id']}})" class="btn btn-default btn-sm">-</a> -->
									<a href="/web/downcart?id={{$row['id']}}" class="btn btn-default btn-sm">-</a>
									<!-- <input type="text" value="{{$row['num']}}" name="{{$row['id']}}" size="1px" disabled> -->
									{{$row['num']}}
									<a href="/web/upcart?id={{$row['id']}}" class="btn btn-default btn-sm">+</a>
								</td>
								<td align="center" ><input type="text" value="￥{{$row['total']}}" name="{{$row['id']}}#"  size="7px" disabled></td>
								<td align="center"><a href="/web/delcart?id={{$row['id']}}" class="btn btn-danger">删除</a></td>					
							</tr>
						
						@endforeach

						@else
						<tr>
							<td colspan="6" align="center">空空如也~</td>
						</tr>
						@endif

						@if($h)
						<tr height="50px">
							<td align="center"><button onclick="fun(3)" class="btn btn-default btn-sm">反选</button></td>
							<td colspan="3" align="right"></td>
							<td align="center">{{$h['nums']}}</td>
							<td align="center" style="color:#2e8b5f">￥{{$h['totals']}}</td>
							<td align='center'><a href='' class="btn btn-success">去结算</a></td>
						</tr>
						@endif
					</table>
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
  <script type="text/javascript">
	function fun(b){
		// alert(b);
		//获取check对象集合
		list=document.getElementsByName('check');
		// alert(list);
		//遍历
		for(var i=0;i<list.length;i++){
			// alert(list[i]);
			//switch
			switch(b){
				//全选
				case 1:
				list[i].checked=true;
				break;
				//取反
				case 3:
				list[i].checked=!list[i].checked;
				break; 
			}

		}

	}
	// function func(b,c){
		
	// 	//switch
	// 	switch(b){
	// 		//减
	// 		case 1:
	// 		//获取num对象集合
	// 		list=document.getElementsByName(c);
	// 		lista=document.getElementById(c#);
	// 		//Ajax
	// 		$.ajax({
	// 			url:  '/web/downcart',//url地址
	// 			type: 'get',//请求方式
	// 			data:{id:c},//参数
	// 			dataType:'json',//数据返回的类型格式
	// 			//接收响应数据
	// 			success:
	// 			function(data){
	// 				// alert(data);
	// 				a = data[0];
	// 				num = data[1];
	// 				total = data[2];
	// 				totals = data[3];
	// 				for (var i = 0; i < list.length; i++) {
	// 					list[i].value=a;
	// 				};
	// 				// alert(total);
	// 				for (var i = 0; i < lista.length; i++) {
	// 					lista[i].value=total;
	// 				};


	// 			},
	// 			//Ajax响应失败
	// 			error:
	// 			function(){
	// 				alert('Ajax响应失败');
	// 			}
	// 		});
	// 		break; 
	// 		//加
	// 		case 2:
	// 		//获取num对象集合
	// 		li=document.getElementsByName(c);
	// 		lia=document.getElementById(c#);
	// 		//Ajax
	// 		$.ajax({
	// 			url:  '/web/upcart',//url地址
	// 			type: 'get',//请求方式
	// 			data:{id:c},//参数
	// 			dataType:'json',//数据返回的类型格式	
	// 			//接收响应数据
	// 			success:
	// 			function(data){
	// 				// alert(a);
	// 				a = data[0];
	// 				num = data[1];
	// 				total = data[2];
	// 				totals = data[3];
	// 				for (var i = 0; i < list.length; i++) {
	// 					li[i].value=a;
	// 				};
	// 				// alert(total);
	// 				for (var i = 0; i < lista.length; i++) {
	// 					lia[i].value=total;
	// 				};
	// 			},
	// 			//Ajax响应失败
	// 			error:
	// 			function(){
	// 				alert('Ajax响应失败');
	// 			}
	// 		});
	// 		break; 

	// 	}
	// }
	

</script>
</body>
</html>
@endsection