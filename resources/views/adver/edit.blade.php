@extends('public.index')
@section('edit')
	  <div class="mws-panel grid_8">
          <div class="mws-panel-header">
               <span>广告修改</span>
          </div>
          <div class="mws-panel-body no-padding">
               <form action="/admin/adver/update" method="post" enctype="multipart/form-data" class="mws-form">
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
                              <label class="mws-form-label">名称:</label>
                              <div class="mws-form-item">
                                   <input  type="text" class="small" name="name" value="{{$adver['name']}}">
                              </div>
                         </div>
                         <div class="mws-form-row">
                              <label class="mws-form-label">图片:</label>
                              <div class="mws-form-item">
                                   <input  type="file" class="small" name="picname">
                              </div>
                         </div>
                         <div class="mws-form-row">
                              <label class="mws-form-label">url地址:</label>
                              <div class="mws-form-item">
                                   <input type="text" name="url" value="{{$adver['url']}}" class="small">
                              </div>
                         </div>
                         <div class="mws-form-row">
                              <label class="mws-form-label">状态:</label>
                              <div class="mws-form-item">
                                   <select name="status">
                                   @if($adver['status']=='1')
                                   	<option value="1" selected>启用</option>
                                   	<option value="0">禁用</option>
                                   @elseif($adver['status']=='0')
                                   	<option value="1" >启用</option>
                                   	<option value="0" selected>禁用</option>
                                   @endif
                                   </select>
                              </div>
                         </div>
                         
                    </div>
                    <div class="mws-button-row">
                        {{csrf_field()}}
                        <input type="hidden" name="id" value="{{$adver['id']}}">
                         <input type="submit" class="btn btn-danger" value="修改">
                         <input type="reset" class="btn " value="重置">
                    </div>
               </form>
          </div>         
      </div>
@endsection