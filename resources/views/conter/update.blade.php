@extends('conter.conter')
@section('right')
		<div class="w3l_banner_nav_right">
<!-- login -->
		<div class="w3_login">
			<!-- <h3>登陆</h3> -->
			<div class="w3_login_module">
				<div class="module form-module">
				  
				  <div class="form">
					<h2>请您登录</h2>
					 @if(session('err'))
            		<div class="alert alert-warning alert-dismissable">             	        
 
            		{{session('err')}}
            		</div>
            		@endif
				  </div>
				  <div class="form">
				  @if(session('error'))
            		<div class="alert alert-warning alert-dismissable">
               	        
                    
            		{{session('error')}}
            		</div>
            		@endif
            	   @if (count($errors) > 0)
                    <div class="alert alert-warning alert-dismissable">

                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                    </div>
                    @endif

                    @if(session('ror'))
                    <div class="alert alert-info" role="alert">
					<strong>{{session('ror')}}</strong> 
				</div>
					@endif
					<h2>修改个人信息</h2>
					<form action="/update" method="post">
					
					  <div class="form-group"> 
            		  <div class="col-md-12">
					  <input type="text" value="{{$rows['username']}}" name="username" required=" " onblur="fun()" id="uid">
					 <div>
					  <span id="span"></span>
					 </div>
					  </div>	
					  </div>
					 
					 <div class="form-group"> 
            		  <div class="col-md-12">
					  <input type="text" value="{{$rows['name']}}" name="name" placeholder="昵称:" required=" " onblur="fun()" id="uid">
					 <div>
					  <span id="span"></span>
					 </div>
					  </div>
					  </div>
					
					  <div class="form-group"> 
            		  <div class="col-md-12">
					  <input type="text" value="{{$rows['address']}}" name="address" placeholder="输入地址" required=" ">
					  </div>
					  </div>

					  <div class="form-group"> 
            		  <div class="col-md-12">						
					  <input type="text" value="{{$rows['phone']}}" name="phone" placeholder="输入电话" required=" " 
					  onblur="funct()" id="phone">
					  <div>
					  	<span id="sp"></span>
					  </div>
					  </div>
					  </div>

					  <div class="form-group"> 
            		  <div class="col-md-12">						
					  <input type="email" value="{{$rows['email']}}"	name="email" placeholder="输入邮箱 如:123@qq.com" required=" ">
					  </div>
					  </div>
						<input type="hidden" name="id" value="{{$rows['id']}}">
					  {{csrf_field()}}
					  <div  style="margin-top:30px">
					  <input type="submit" value="确认修改">
					  </div>
					</form>
				  </div>
				</div>
			</div>
			<script>
				$('.toggle').click(function(){
				  // Switches the Icon
				  $(this).children('i').toggleClass('fa-pencil');
				  // Switches the forms  
				  $('.form').animate({
					height: "toggle",
					'padding-top': 'toggle',
					'padding-bottom': 'toggle',
					opacity: "toggle"
				  }, "slow");
				});
				
			</script>
			<script type="text/javascript">
				span=document.getElementById('span')
				function fun(){
					uid=document.getElementById('uid');
					uv=uid.value;
					if(uv.match(/^\w{5,11}$/)==null){
						span.innerHTML="请输入5-11位任意数字,字母,下划线";
						span.style.color="red";
					}else{
						span.innerHTML="输入正确";
						span.style.color="green";
					}
				}

				ss=document.getElementById('ss')
				function demo(){
					zhang=document.getElementById('zhang');
					zhangs=zhang.value;
					if(zhangs.match(/^\w{5,11}$/)==null){
						ss.innerHTML="请输入5-11位任意数字,字母,下划线";
						ss.style.color="red";
					}else{
						ss.innerHTML="输入正确";
						ss.style.color="green";
					}
				}

				an=document.getElementById('an')
				function mima(){
					pa=document.getElementById('pa');
					pas=pss.value;
					if(pas.match(/^\w{5,11}$/)==null){
						an.innerHTML="请输入6-11位任意数字,字母,下划线";
						an.style.color="red";
					}else{
						an.innerHTML="输入正确";
						an.style.color="green";
					}
				}
			</script>
			<script type="text/javascript">
			spa=document.getElementById('spa')
				function func(){
					ui=document.getElementById('ui');
					us=ui.value;
					if(us.match(/^\w{6,11}$/)==null){
						spa.innerHTML="请输入6-11位任意数字,字母,下划线";
						spa.style.color="red";
					}else{
						spa.innerHTML="输入正确";
						spa.style.color="green";
					}
				}

				sp=document.getElementById('sp')
				function funct(){
					phone=document.getElementById('phone');
					phonev=phone.value;
					if(phonev.match(/^\d{11}$/)==null){
						sp.innerHTML="输入11位有效电话";
						sp.style.color="red";
					}else{
						sp.innerHTML="输入正确";
						sp.style.color="green";
					}
				}
			</script>
		</div>
<!-- //login -->
		</div>
		<div class="clearfix"></div>
	</div>
<!-- //banner -->
<!-- newsletter-top-serv-btm -->
	<div class="newsletter-top-serv-btm">
		<div class="container">
			<div class="col-md-4 wthree_news_top_serv_btm_grid">
				<div class="wthree_news_top_serv_btm_grid_icon">
					<i class="fa fa-shopping-cart" aria-hidden="true"></i>
				</div>
				<h3>Nam libero tempore</h3>
				<p>Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus 
					saepe eveniet ut et voluptates repudiandae sint et.</p>
			</div>
			<div class="col-md-4 wthree_news_top_serv_btm_grid">
				<div class="wthree_news_top_serv_btm_grid_icon">
					<i class="fa fa-bar-chart" aria-hidden="true"></i>
				</div>
				<h3>officiis debitis aut rerum</h3>
				<p>Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus 
					saepe eveniet ut et voluptates repudiandae sint et.</p>
			</div>
			<div class="col-md-4 wthree_news_top_serv_btm_grid">
				<div class="wthree_news_top_serv_btm_grid_icon">
					<i class="fa fa-truck" aria-hidden="true"></i>
				</div>
				<h3>eveniet ut et voluptates</h3>
				<p>Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus 
					saepe eveniet ut et voluptates repudiandae sint et.</p>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
<!-- //newsletter-top-serv-btm -->
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