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
											
												<label>地址:</label>
												<select id="cid">
													<option value="">--请选择---</option>
												</select>
												<input type="text" name="adds" class="form-control" value="">
											</div>
											<div class="form-group">
												<label>电话:</label>
												<input type="text" name="phone" class="form-control">
											</div>
										

									</div>

									<!-- footer -->
									<div class="modal-footer">
										{{csrf_field()}}
										<button type="submit" id="submit" class="btn btn-success">提交</button>
										<button type="reset" class="btn btn-danger">重置</button>
									</div>
									</form>
								</div>
							</div>
						</div>
					</div>
					<!-- 添加地址模态框结束 -->
					 @if(session('error'))
                    <div class="mws-form-message error">
                  		{{session('error')}}
                      
                    </div>
                    @endif 
                    <!-- 显示验证错误 -->
                    @if (count($errors) > 0)
                    <div class="mws-form-message error">

                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                    </div>
                    @endif
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
	//选择地址
	$("#did1 .did").click(function(){
		$(this).siblings().removeClass('active');
		$(this).addClass('active');
		id=$(this).attr('value');
		// alert(id);
		$('input[name="address_id"]').val(id);
	})

	//地址引入城市级联
//获取第一级数据
	//Ajax
	$.ajax({
		url:  '/s',//url地址
		type: 'get',//请求方式
		data:{upid:0},//参数
		dataType:'json',//数据返回的类型格式
		//接收响应数据
		success:
		function(data){
			// alert(data);
			for(var i=0;i<data.length;i++){
				// alert(data[i].name);
				var s='<option value="'+data[i].id+'">'+data[i].name+'</option>';
				// alert(s);
				$("#cid").append(s);
			}
		},
		//Ajax响应失败
		error:
		function(){
			alert('Ajax响应失败');
		}
	});

	//子级
	$("select").live('change',function(){
		ss=$(this);
		//获取upid （父id）
		//清除当前下框对象的nextAll元素节点
		ss.nextAll('select').remove();
		//获取父id （upid）
		id=ss.val();
		// alert(id);
		//Ajax
		$.ajax({
			url:'/s',//url地址
			type:'get',//请求方式
			data: {upid:id},//参数
			dataType:'json',//数据的返回格式
			//接受响应数据
			success:
			function(data){
				// alert(data);
				info=$("<select><option value=''>--请选择--</option></select>");//创建select
				//判断
				if(data.length>0){
					//遍历
					for(var i=0;i<data.length;i++){
						// alert(data[i].name);
						//把数据放在下拉选项里
						var so='<option value="'+data[i].id+'">'+data[i].name+'</option>';
						// alert(ss);
						//把含有数据的下拉选项内部插入到info
						info.append(so);
					}
					//追加select
					ss.after(info);
				}
				
			},
			error:
			function(){
				alert('Ajax响应失败');
			}
		})
	})
//获取数据

 $("#submit").live('click',function(){
// 	//遍历
	b='';
	$("select option:selected").each(function(){
		//alert($(this).html());
		a=$(this).html();
		b+=a;
	})
	 // alert(b);
	 b+=$('input[name="adds"]').val();
	 $('input[name="adds"]').val(b);
})

</script>
@endsection