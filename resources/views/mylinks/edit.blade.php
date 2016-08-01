@extends('public/index')
@section('edit')
	            <div class="mws-panel grid_8">
          <div class="mws-panel-header">
               <span>修改链接</span>
          </div>
          <div class="mws-panel-body no-padding">
               <form action="/admin/mylinks/update" method="post" class="mws-form">
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
                              <label class="mws-form-label">链接名称:</label>
                              <div class="mws-form-item">
                                   <input value="{{$stu['name']}}" type="text" class="small" name="name">
                              </div>
                         </div>
                     
                         <div class="mws-form-row">
                              <label class="mws-form-label">链接地址:</label>
                              <div class="mws-form-item">
                                   <input value="{{$stu['url']}}" type="text" name="url" class="small">
                              </div>
                         </div>
                         <div class="mws-form-row">
                              <label class="mws-form-label">状态:</label>
                              <div class="mws-form-item">
                                   <select name="status" id="" value="{{$stu['status']}}">
                                   @if($stu['status']==1)
                                     <option value="1" selected>启用</option>
                                     <option value="0">禁用</option>
                                    @elseif($stu['status']==0)
                                    <option value="1">启用</option>
                                    <option value="0" selected>禁用</option>
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