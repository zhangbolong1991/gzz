@extends('public.hindex')
@section('header')
	<!-- <link rel="stylesheet" href="/bs/css/bootstrap.min.css"> -->
	<script src="/bs/js/jquery.min.js"></script>
	<script src="/bs/js/bootstrap.min.js"></script>
	<script src="/bs/js/holder.min.js"></script>
	<style type="text/css">
		.did{
			width:380px;height:190px;border:1px solid #ccc;line-height:30px;float:left;margin:10px;
		}
		.active{
			background-color: #84c639;
		}
	</style>
	<!-- 添加地址模态框开始 -->
<div class="container">
	<!-- <button class="btn btn-success" data-toggle="modal" data-target="#Addressmodal">添加地址</button> -->
	<!-- Modal -->
	<div class="modal fade" id="Addressmodal">
		<div class="modal-dialog">

		<!-- 内容区 -->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title" style="color:green;text-align:center;">添加地址</h4>
				</div>

				<!-- body -->
				<div class="modal-body">
					
					<form role="form" action="/addressinsert" method="post" onsubmit="return demo()">
					<table class="table table-bordered table-hover table-striped table-condensed table-responsive">
						<tr class="warning"><div class="form-group">
							<td><label>收件人:</label></td>
							<!-- <input type="text" name="name" class=""> -->
							<td><input type="text" name="name" id="name" onblur="fun()" value="" >
							<span id='s'></span></td>
						</div>
						</tr>
						<tr class="warning">
							<div class="form-group">
								<td><label>地址:</label></td>
								<td><select id="cid">
									<option value="">--请选择--</option>
								</select></td>						
							</div>
						</tr>
						<tr class="warning">
							<div class="form-group">
								<td><label>街道:</label></td>
								<td><input type="text" name="address" id="address" >
								<span id='ss'></span></td>
							</div>
						</tr>
						<tr class="warning">
							<div class="form-group">
								<td><label>电话:</label></td>
								<td><input type="text" name="phone" id="phone" onblur="funcc()" >
								<span id='sss'></span></td>
							</div>
						</tr>
					</table>

				</div>

				<!-- footer -->
				<div class="modal-footer">
					{{csrf_field()}}
					<input type="hidden" name="adds" id="adds" value="">
					<button type="submit" id="submit" class="btn btn-success">保存</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">关闭</button>
				</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- 添加地址模态框结束 -->
@endsection
@section('main')


		<div class="w3l_banner_nav_right">
			
			
			<div class="w3ls_w3l_banner_nav_right_grid w3ls_w3l_banner_nav_right_grid_sub">
				<!-- <h3 class="w3l_fruit">购物车</h3> -->
				<div class="w3ls_w3l_banner_nav_right_grid1 w3ls_w3l_banner_nav_right_grid1_veg">
					<div style="margin:10px auto;text-align:center;" >
						<h4>我的订单</h4>
					</div>
					<button class="btn btn-success" data-toggle="modal" data-target="#Addressmodal">添加地址</button>
					<br><br>
					<h4>收货地址:</h4><br>
					<form action="/order/create" method="post" onsubmit="return ordersub();">
					<div id="did1">
						@foreach($address as $row)
						<div class="did" name="cid" value="{{$row['id']}}">
						<table width="340px">
							<tr><td width="80px">收件人:</td><td>{{$row['name']}}</td></tr>
							<tr line-height="100px"><td width="80px">地址:</td><td>{{$row['adds']}}</td></tr>
							<tr><td width="80px">电话:</td><td>{{$row['phone']}}</td></tr>
							<tr><td align="right" colspan="2"><a href="/addressdel/{{$row['id']}}" class="btn btn-success">删除</a></td></tr>
						</table>
							<input type="hidden" name="address_id" value="">
						</div>
						@endforeach
						</div>
						<div class="clearfix"> </div><br>
							{{csrf_field()}}
							@if(session('cart'))
							<input type="hidden" name="cartcheck" value="1">
							@else
							<input type="hidden" name="cartcheck" value="">	
							@endif
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
		if(a=='--请选择--'){
			a='';
		}
		b+=a;
	})
	 // alert(b);
	 b+=$('input[name="address"]').val();
	 $('input[name="adds"]').val(b);
})
 	//验证
 	s=document.getElementById('s');
	ss=document.getElementById('ss');
	sss=document.getElementById('sss');

	//收件人
	function fun(){
		//获取id值u节点
		uu=document.getElementById('name');
		//获取value值
		users=uu.value;
		if(users.match(/^\D{2,12}$/)==null){
			s.innerHTML="x 收件人不能为空或输入格式非法";
			s.style.color="red";
			return false;
		}else{
			s.innerHTML="√";
			s.style.color="green";
			return true;
		}

	}
	// //地址
	//  $('#address').live('blur',function(){

	// 	address=$('#address').val();
	// 	if(address.match(/[\w+?]|[\D+?]/)==null){
	// 		ss.innerHTML="x 地址不能为空";
	// 		ss.style.color="red";
	// 		return false;
	// 	}else{
	// 		ss.innerHTML="√";
	// 		ss.style.color="green";
	// 		return true;
	// 	}

	// })
	//手机
	function funcc(){
		//获取id值u节点
		pp=document.getElementById('phone');
		//获取value值
		ps=pp.value;
		if(ps.match(/^\d{11}$/)==null){
			sss.innerHTML="x 请输入11位有效电话号码";
			sss.style.color="red";
			return false;
		}else{
			sss.innerHTML="√";
			sss.style.color="green";
			return true;
		}

	}
	//异常时阻止表单提交
	function demo(){
		return fun()&&funcc();
	}
	//购物车为空或地址未选择的情况下阻止表单提交	
	function ordersub(){
		// var a=$('input[name="address_id"]').attr('value');
		var a=$('input[name="address_id"]').val();
		var b=$('input[name="cartcheck"]').val();
		if(a&&b){
			// alert('111');
			return true;
		}else{
			// alert('000');
			return false;
		}		
	}
</script>
@endsection