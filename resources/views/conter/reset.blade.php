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
          <h4>重置密码</h4>
          <form action="/reset" method="post">
          
          </div>
            <div class="form-group"> 
                  <div class="col-md-12">
            <input type="password" name="password" placeholder="新密码" required=" " onblur="fun()" id="uid">
           <div>
            <span id="span"></span>
           </div>
            </div>
            </div>

            <div class="form-group"> 
                  <div class="col-md-12">           
            <input type="password" name="repassword" placeholder="确认密码" required=" ">
            </div>
            </div>

                 
            {{csrf_field()}}
            @foreach($list as $row)
            <input type="hidden" name="id" value="{{$row['id']}}">
            <div  style="margin-top:30px">
            <input type="submit" value="修改">
            </div>
            @endforeach
          </form>
          </div>
        </div>
      </div>
@endsection