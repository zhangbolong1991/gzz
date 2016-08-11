@extends('public.hindex')

@section('header')
	<style type="text/css">
	*{
		padding:0px;
		margin:0px;
	}
	#small{
		width:300px;
		height:300px;
		border:1px dashed #ccc;
		position:absolute;
		/*left:70px;
		top:200px;*/
	}
	#simg{
		position:absolute;
	}
	#move{
		width:30px;
		height:30px;
		position:absolute;
		left:0px;
		top:0px;
		background-image: url(/h/images/bg.png);
		display:none;

	}
	#big{
		width:300px;
		height:300px;
		position:absolute;
		left:700px;
		/*top:700px;*/
		overflow:hidden;
		display:none;
		z-index:1;
	}
	#bimg{
		position:absolute;
	}
	#imgs{
		width:410px;
		height:100px;
		position:absolute;
		top:1020px;
		left:365px;
		list-style-type:none;
	}
	.imgh{
		width:100px;
		height:100px;
		float:left;
		border:1px dashed #ccc;
		margin-left:10px;
    cursor: pointer;
	}
	</style>
@endsection
@section('main')
	
		<div class="w3l_banner_nav_right">
			<div class="w3l_banner_nav_right_banner3">
				<h3>最佳新品<span class="blink_me"></span></h3>
			</div>
			<form action="/web/addcart" method="post">

				<div class="agileinfo_single" style="height:600px; width:100%;">
				<h5>{{$list['goods']}}</h5>
				<div class="">
					<div id="small">
						<img src="{{$list['picname']}}" id="simg" width="100%" height="300px">
						<div id="move"></div>
					</div>
					<div id="big">
						<img src="{{$list['picname']}}" id="bimg" width="800px" height="800px">
					</div>
					<ul id="imgs">
						<li><img src="{{$list['picname']}}" onmousemove=fun(0) width="100%" height="100px" class='imgh'></li>
						<li><img src="{{$list['picname']}}"  onmousemove=fun(1) alt="测试图片" width="100%" height="100px" class='imgh'></li>
						<li><img src="{{$list['picname']}}" onmousemove=fun(2) alt="测试图片" width="100%" height="100px" class='imgh'></li>
						
					</ul>
				</div>
				<div class="col-sm-offset-4 col-md-8 agileinfo_single_right">
					<div class="rating1">
						<span class="starRating">
							<input id="rating5" type="radio" name="rating" value="5" checked>
							<label for="rating5">5</label>
							<input id="rating4" type="radio" name="rating" value="4">
							<label for="rating4">4</label>
							<input id="rating3" type="radio" name="rating" value="3">
							<label for="rating3">3</label>
							<input id="rating2" type="radio" name="rating" value="2">
							<label for="rating2">2</label>
							<input id="rating1" type="radio" name="rating" value="1">
							<label for="rating1">1</label>
						</span>
					</div>
					<div class="w3agile_description">
						<h4>库存量:{{$list['store']}}</h4>
					</div>
					<div class="w3agile_description">
						<h4>销售量:{{$list['num']}}</h4>
					</div>
					<div class="w3agile_description">
						<h4>点击量:{{$list['clicknum']}}</h4>
					</div>
					<div class="snipcart-item block">
						<div class="snipcart-thumb agileinfo_single_right_snipcart">
							<h4>优惠价:￥{{$list['price']}} <span>原价:￥{{floor($list['price']*1.25)}}</span></h4>
						</div>
						<div class="snipcart-details agileinfo_single_right_details">
							{{csrf_field()}}
							<input type="hidden" name="id" value="{{$list['id']}}">
							<!-- <button class="btn btn-danger my-cart-btn hvr-sweep-to-right">加入购物车</button> -->
							<input type="submit" value="加入购物车" class="btn btn-danger my-cart-btn hvr-sweep-to-right">
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
			<li role="presentation"><a aria-controls="comment" data-toggle="tab" id="comment-tab" role="tab" href="#comment">商品评价</a></li>
			<!-- <li class="dropdown" role="presentation">
				<a aria-controls="myTabDrop1-contents" data-toggle="dropdown" class="dropdown-toggle" id="myTabDrop1" href="#">商品评价<span class="caret"></span></a>
				<ul id="myTabDrop1-contents" aria-labelledby="myTabDrop1" role="menu" class="dropdown-menu">
					<li><a aria-controls="dropdown1" data-toggle="tab" id="dropdown1-tab" role="tab" tabindex="-1" href="#dropdown1">好评</a></li>
					<li><a aria-controls="dropdown2" data-toggle="tab" id="dropdown2-tab" role="tab" tabindex="-1" href="#dropdown2">差评</a></li>
				</ul>
			</li> -->
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

					<div class="add-review">
						<h5>添加评论</h5><br>
						<form action='/comment/add' method="post" enctype="multipart/form-data">
							<table style="border-collapse:separate;border-spacing:5px;">
							<tr><td>昵称:</td><td><input type="text" name="username" value="匿名..." onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '匿名...';}" required=""></td>
			
							<tr><td>评论:</td><td><textarea type="text"  name="content" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '说说你的看法...';}" required="">说说你的看法...</textarea></td>
							<tr><td>图片:</td><td><input  type="file" name="picname"></td>
							</table>

							<input type="hidden" name="goods_id" value="{{$list['id']}}">
							<input type="hidden" name="goods" value="{{$list['goods']}}">
							{{csrf_field()}}
							<input type="submit" value="提交">
						</form>
					</div>
				</div>
			</div>
			<div role="tabpanel" class="tab-pane fade  bootstrap-tab-text" id="comment" aria-labelledby="comment-tab">
				@foreach($data2 as $row)
				<div>
					<span>用户:{{$row['username']}}</span>
					<span><strong>评论:{{$row['content']}}</strong></span>
					@if($row['picname'])
					<span>上传图片:<img src="{{$row['picname']}}" width="80px" height="80px"></span>
					@endif
				</div>
				@endforeach
			</div>
			<!-- <div role="tabpanel" class="tab-pane fade bootstrap-tab-text" id="dropdown1" aria-labelledby="dropdown1-tab">
				<p>对应好评</p>
			</div>
			<div role="tabpanel" class="tab-pane fade bootstrap-tab-text" id="dropdown2" aria-labelledby="dropdown2-tab">
				<p>对应差评</p>
			</div> -->
				
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
					<form action="/web/addcart" method="post">
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
												<h4>￥{{$row['price']}}<span>￥{{floor($row['price']*1.25)}}</span></h4>
											</center>
										</div>
										<div class="snipcart-details">
											{{csrf_field()}}
											<input type="hidden" name="id" value="{{$row['id']}}">
											<!-- <button class="btn btn-danger my-cart-btn hvr-sweep-to-right">加入购物车</button> -->
											<input type="submit" value="加入购物车" class="btn btn-danger my-cart-btn hvr-sweep-to-right">
										</div>
									</div>
								</figure>
							</div>
						</div>
						</div>
						</form>
					</div>
					@endforeach
					<div class="clearfix"> </div>
				</div>
				<div class="w3ls_w3l_banner_nav_right_grid1">
					<h6>笔记本电脑</h6>
					@foreach($data1 as $row)				
					<div class="col-md-3 w3ls_w3l_banner_left" style="margin-bottom:15px">
					<form action="/web/addcart" method="post">
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
												<h4>￥{{$row['price']}}<span>￥{{floor($row['price']*1.25)}}</span></h4>
											</center>
										</div>
										<div class="snipcart-details">
											{{csrf_field()}}
											<input type="hidden" name="id" value="{{$row['id']}}">
											<!-- <button class="btn btn-danger my-cart-btn hvr-sweep-to-right">加入购物车</button> -->
											<input type="submit" value="加入购物车" class="btn btn-danger my-cart-btn hvr-sweep-to-right">
										</div>
									</div>
								</figure>
							</div>
						</div>
						</div>
						</form>
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
<script type="text/javascript">
	//获取div元素对象
	small=document.getElementById('small');
	simg=document.getElementById('simg');
	move=document.getElementById('move');
	big=document.getElementById('big');
	bimg=document.getElementById('bimg');
	imgs=document.getElementById('imgs');
	//给small去绑定一个鼠标的移动事件
	small.onmousemove=function(e){
		move.style.display="block";
		big.style.display="block";
		move.style.cursor="move";
		//浏览器的兼容处理
		ee=e||window.event;
		//获取横坐标和纵坐标
		//获取偏移文档 的坐标
		x=ee.pageX;
		y=ee.pageY;
		// clientX
		// clientY
		//获取x1和y1
		x1=small.offsetLeft;
		y1=small.offsetTop;
		//获取move的自身元素的高度和宽度一半
		m_w=move.offsetWidth/2;
		m_h=move.offsetHeight/2;
		//获取left和top
		l=x-x1-m_w;
		t=y-y1-m_h;
		//上
		if(t<0){
			t=0;
		}
		//下
		if(t>small.offsetHeight-move.offsetHeight){
			t=small.offsetHeight-move.offsetHeight;
		}
		//左
		if(l<0){
			l=0;
		}
		//右
		if(l>small.offsetWidth-move.offsetWidth){
			l=small.offsetWidth-move.offsetWidth;
		}
		//把l和t赋给move的left和top
		move.style.left=l+"px";
		move.style.top=t+"px";
		// alert(l+':'+t);

		//计算大图移动left和top值

		//求比例
		x=l/small.offsetWidth;
		y=t/small.offsetHeight;
		//求大图的height和width
		B_w=bimg.offsetWidth;
		B_h=bimg.offsetHeight;
		ll=x*B_w;
		tt=y*B_h;
		//获取大图的left和top值
		bimg.style.left=-ll+"px";
		bimg.style.top=-tt+"px";
		//求右边比例
		xx=big.offsetWidth/bimg.offsetWidth;
		yy=big.offsetHeight/bimg.offsetHeight;
		//重新给move赋height和width
		//获取small的width和height
		s_w=small.offsetWidth;
		s_h=small.offsetHeight;
		m_w=s_w*xx;
		m_h=s_h*yy;
		move.style.width=m_w+"px";
		move.style.height=m_h+"px";



	}

	//移出
	small.onmouseout=function(){
		move.style.display="none";
		big.style.display="none";
	}

	//获取图片结合节点
	// list=document.getElementsByTagName('img');
	// //遍历
	// for(var i=0;i<list.length;i++){
	// 	list[i].onmousemove=function(){
	// 		var src=this.getAttribute('src');
	// 		// alert(src);
	// 		simg.src=src;
	// 		bimg.src=src;
	// 		this.style="border:1px solid red";
	// 		this.onmouseout=function(){
	// 		this.style="1px dashed #ccc";
	// 		 }
	// 	}
	// }
	//获取图片集合节点
	function fun(m){
		list=imgs.getElementsByTagName('img');
		
			var src=list[m].getAttribute('src');
			simg.src=src;
			bimg.src=src;
			// alert(m);
			switch(m){
				case 0:
				list[0].style.border="1px solid red";
				list[1].style.border="1px dashed #ccc";
				list[2].style.border="1px dashed #ccc";
				break;
				case 1:
				list[0].style.border="1px dashed #ccc";
				list[1].style.border="1px solid red";
				list[2].style.border="1px dashed #ccc";
				break;
				case 2:
				list[0].style.border="1px dashed #ccc";
				list[1].style.border="1px dashed #ccc";
				list[2].style.border="1px solid red";
				break;
			}
			
		
	}
</script>
@endsection