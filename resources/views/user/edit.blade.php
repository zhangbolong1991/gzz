@extends('public/index')
@section('edit')
     <div class="mws-panel grid_8">
          <div class="mws-panel-header">
               <span>用户修改</span>
          </div>
          <div class="mws-panel-body no-padding">
               <form action="/admin/user/update" method="post" class="mws-form">
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
                                   <input value="{{$stu['username']}}" type="text" class="small" name="username">
                              </div>
                         </div>
                         <div class="mws-form-row">
                              <label class="mws-form-label">昵称:</label>
                              <div class="mws-form-item">
                                   <input value="{{$stu['name']}}" type="text" class="small" name="name">
                              </div>
                         </div>
                         <!-- <div class="mws-form-row">
                              <label class="mws-form-label">性别:</label>
                              <div class="mws-form-item">
                                   <input type="radio" name="sex" value="m">男
                                   <input type="radio" name="sex" value="w">女
                              </div>
                         </div> -->
                         <div class="mws-form-row">
                              <label class="mws-form-label">地址:</label>
                              <div class="mws-form-item">
                                   <input type="text" name="address" value="{{$stu['address']}}" class="small">
                              </div>
                         </div>
                         <div class="mws-form-row">
                              <label class="mws-form-label">电话:</label>
                              <div class="mws-form-item">
                                   <input type="text" name="phone" value="{{$stu['phone']}}" class="small">
                              </div>
                         </div>
                         <div class="mws-form-row">
                              <label class="mws-form-label">邮箱:</label>
                              <div class="mws-form-item">
                                   <input value="{{$stu['email']}}" type="text" name="email" class="small">
                              </div>
                         </div>
                          <div class="mws-form-row">
                              <label class="mws-form-label">状态:</label>
                              <div class="mws-form-item">
                                    <select name="status" class="small">
                                      @if($stu['status']==0)
                                      <option value="0" selected>禁用</option>
                                      <option value="1">普通会员</option>
                                      <option value="2">管理员</option>
                                      <option value="3">未激活</option>
                                      @elseif($stu['status']==1)
                                       <option value="0">禁用</option>
                                      <option value="1" selected>普通会员</option>
                                      <option value="2">管理员</option>
                                      <option value="3">未激活</option>
                                      @elseif($stu['status']==2)
                                      <option value="0">禁用</option>
                                      <option value="1">普通会员</option>
                                      <option value="2" selected>管理员</option>
                                      <option value="3">未激活</option>
                                       @elseif($stu['status']==3)
                                      <option value="0">禁用</option>
                                      <option value="1">普通会员</option>
                                      <option value="2">管理员</option>
                                      <option value="3" selected>未激活</option>
                                      @endif
                                    </select>
                              </div>
                         </div>
                    </div>
                    <div class="mws-button-row">
                        {{csrf_field()}}
                         <input type="hidden" name="id" value="{{$stu['id']}}">
                         <input type="submit" class="btn btn-danger" value="修改">
                         <input type="reset" class="btn " value="重置">
                    </div>
               </form>
          </div>         
      </div>
@endsection