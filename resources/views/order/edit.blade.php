@extends('public.index')
@section('edit')
<div class="mws-panel grid_8">
          <div class="mws-panel-header">
               <span>修改订单状态</span>
          </div>
          <div class="mws-panel-body no-padding">
               <form action="/admin/order/update" method="post" class="mws-form">
               
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
                              <label class="mws-form-label">联系人:</label>
                              <div class="mws-form-item">
                                   <input value="{{$list['linkman']}}" readonly type="text" class="small" name="linkman">
                              </div>
                         </div>
                     
                         <div class="mws-form-row">
                              <label class="mws-form-label">收件人地址:</label>
                              <div class="mws-form-item">
                                   <input value="{{$list['address']}}" readonly type="text" name="address" class="small">
                              </div>
                         </div>
                         <div class="mws-form-row">
                              <label class="mws-form-label">邮编:</label>
                              <div class="mws-form-item">
                                   <input value="{{$list['code']}}" readonly type="text" name="code" class="small">
                              </div>
                         </div>
                         <div class="mws-form-row">
                              <label class="mws-form-label">电话:</label>
                              <div class="mws-form-item">
                                   <input value="{{$list['phone']}}" readonly type="text" name="phone" class="small">
                              </div>
                         </div>
                         <div class="mws-form-row">
                              <label class="mws-form-label">总金额:</label>
                              <div class="mws-form-item">
                                   <input value="{{$list['total']}}" readonly type="text" name="total" class="small">
                              </div>
                         </div>
                           <div class="mws-form-row">
                              <label class="mws-form-label">状态:</label>
                              <div class="mws-form-item">
                                   <select name="status" id="">
                                    <option value="0">新订单</option>
                                    <option value="1">已发货</option>
                                    <option disabled value="2">已收货</option>
                                    <option value="3">无效订单</option>
                                   </select>
                              </div>
                         </div> 
                    </div>
                    <div class="mws-button-row">
                        {{csrf_field()}}
                         <input type="hidden" name="id" value="{{$list['id']}}">
                         <input type="submit" class="btn btn-danger" value="修改">
                         <input type="reset" class="btn " value="重置">
                    </div>
               </form>
          </div>         
      </div>
@endsection