@extends('public.hindex')
@section('main')
			<div class="w3_login_module">
				<div class="module form-module">
				  
				  <div class="form">
				  <div class="toggle"><i class="fa fa-times fa-pencil"></i>
					<div class="tooltip">点击我注册</div>
				  </div>
					<h2>请您登录</h2>
					 @if(session('err'))
            		<div class="alert alert-warning alert-dismissable">             	        
 
            		{{session('err')}}
            		</div>
            		@endif
					<form action="/register/login" method="post">
					  <input type="text" name="username" placeholder="账号:" required=" " onblur="demo()" id="zhang">
					  <div>
					  	<span id="ss"></span>
					  </div>
					  <input type="password" name="password" placeholder="密码:" required=" " onblur="mima()" id="pa">
						<div>
							<span id="an"></span>
						</div>
					  {{csrf_field()}}

					  <input type="submit" value="登录">
					</form>
				  <div class="cta" style="margin-top:30px"><a href="/forget">忘记密码?</a></div>
				  
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
					<h4>验证密保</h4>
					<form action="/find" method="post">
					
				  </div>
					  <div class="form-group"> 
            		  <div class="col-md-12">
					  <input type="text" name="username" placeholder="输入账户:" required=" " onblur="fun()" id="uid">
					 <div>
					  <span id="span"></span>
					 </div>
					  </div>
					  </div>

					  <div class="form-group"> 
            		  <div class="col-md-12">						
					  <select name="issue" id="" class="form-control">
					  <option value="1">您小时候的好友</option>
					  	<option value="2">您青梅竹马的炮友(从小一起点炮仗的朋友)?</option>
					  	<option value="3">觉得小军军是男是女</option>
					  </select>
					  </div>
					  </div>

					<div class="form-group"> 
            		  <div class="col-md-12">
					  <input type="text" name="answer" placeholder="输入答案:" required=" " onblur="fun()" id="uid">
					 <div>
					  <span id="span"></span>
					 </div>
					  </div>
					  </div>
           			 
					  {{csrf_field()}}
					  <div  style="margin-top:30px">
					  <input type="submit" value="点击找回">
					  </div>
					</form>
				  </div>
				</div>
			</div>
@endsection
@section('show')
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