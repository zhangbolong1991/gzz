@extends('public/index')
@section('user')
	            <div class="mws-panel grid_8">
          <div class="mws-panel-header">
               <span>用户添加</span>
          </div>
          <div class="mws-panel-body no-padding">
               <form action="/admin/user/insert" method="post" class="mws-form">
                  <!--   @if(session('error'))
                    <div class="mws-form-message error">
                  {{session('error')}}
                      
                    </div>
                    @endif -->
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

                    <div class="mws-form-inline">
                         <div class="mws-form-row">
                              <label class="mws-form-label">账户:</label>
                              <div class="mws-form-item">
                                   <input value="{{old('username')}}" type="text" class="small" name="username">
                              </div>
                         </div>
                         <div class="mws-form-row">
                              <label class="mws-form-label">密码:</label>
                              <div class="mws-form-item">
                                   <input type="password" name="password" value="{{old('password')}}"class="small">
                              </div>
                         </div>
                         <div class="mws-form-row">
                              <label class="mws-form-label">确认密码:</label>
                              <div class="mws-form-item">
                                   <input type="password" name="repassword" value="{{old('repassword')}}" class="small">
                              </div>
                         </div>
                         <div class="mws-form-row">
                              <label class="mws-form-label">性别:</label>
                              <div class="mws-form-item">
                                @if(old('sex')=='m')
                                <input type="radio" name="sex" checked value="m">男
                                <input type="radio" name="sex" value="w">女  
                                 @elseif(old('sex')=='w')
                                <input type="radio" name="sex" value="m">男
                                <input type="radio" name="sex" checked value="w">女 
                                @else
                                <input type="radio" name="sex" value="m">男
                                <input type="radio" name="sex" value="w">女
                                @endif 
                              </div>
                         </div>
                         <div class="mws-form-row">
                              <label class="mws-form-label">地址:</label>
                              <div class="mws-form-item">
                                   <input type="text" name="address" value="{{old('address')}}"class="small">
                              </div>
                         </div>
                         <div class="mws-form-row">
                              <label class="mws-form-label">电话:</label>
                              <div class="mws-form-item">
                                   <input type="text" name="phone" value="{{old('phone')}}" class="small">
                              </div>
                         </div>
                         <div class="mws-form-row">
                              <label class="mws-form-label">邮箱:</label>
                              <div class="mws-form-item">
                                   <input value="{{old('email')}}" type="text" name="email" class="small">
                              </div>
                         </div>
                    </div>
                    <div class="mws-button-row">
                        {{csrf_field()}}
                         <input type="submit" class="btn btn-danger" value="添加">
                         <input type="reset" class="btn " value="重置">
                    </div>
               </form>
          </div>         
      </div>

@endsection