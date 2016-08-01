<!DOCTYPE html>
<html>	
<head>
<title>Login</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<meta name="keywords" content="Flat Dark Web Login Form Responsive Templates, Iphone Widget Template, Smartphone login forms,Login form, Widget Template, Responsive Templates, a Ipad 404 Templates, Flat Responsive Templates" />
<link href="/b/css/style.css" rel='stylesheet' type='text/css' />
<link rel="stylesheet" type="text/css" href="/b/bootstrap/css/bootstrap.min.css" media="screen">

<!--webfonts-->
<link href='http://fonts.useso.com/css?family=PT+Sans:400,700,400italic,700italic|Oswald:400,300,700' rel='stylesheet' type='text/css'>
<link href='http://fonts.useso.com/css?family=Exo+2' rel='stylesheet' type='text/css'>
<!--//webfonts-->
<script src="http://ajax.useso.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
</head>
<body>

<script>$(document).ready(function(c) {
	$('.close').on('click', function(c){
		$('.login-form').fadeOut('slow', function(c){
	  		$('.login-form').remove();
		});
	});	  
});
</script>
 <!--SIGN UP-->
 <h1>GZZ商城后台登陆</h1>
<div class="login-form">
	<div class="close"> </div>
		<div class="head-info">
			<!-- 显示验证错误 -->
                    @if (count($errors) > 0)
                    <div class="mws-form-message error">

                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li class="label label-default">{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                    </div>
                    @endif
                    @if(session('error'))
                    <div class="mws-form-message error">
                        {{session('error')}}
                    </div>
                    @endif
		</div>
			<div class="clear"> </div>
	<div class="avtar">
		<!-- <img src="/b/images/avtar.png" /> -->
		
	</div>

			<form action="/admin/login" method="post">
					<input type="text" class="text" name="username" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '请输入账号';}" >
						<div class="key">
					<input type="password" name="password" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Password';}">
						</div>
				<div class="signin">
					 {{csrf_field()}}
					<input type="submit" value="登陆" >
				</div>
			</form>
	
</div>
 <div class="copy-rights">
					<p>Copyright &copy; 2015.Company name All rights reserved.<a target="_blank" href="http://sc.chinaz.com/moban/">&#x7F51;&#x9875;&#x6A21;&#x677F;</a></p>
			</div>

</body>
</html>