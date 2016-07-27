@extends('public.index')
@section('edit')
 <div class="mws-panel grid_8">
          <div class="mws-panel-header">
               <span>类别修改</span>
          </div>
          <div class="mws-panel-body no-padding">
               <form action="/admin/type/update" method="post" class="mws-form">
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
                              <label class="mws-form-label">类别名称:</label>
                              <div class="mws-form-item">
                                   <input value="{{$type['name']}}" type="text" class="small" name="name">
                              </div>
                         </div>
                         <!-- <div class="mws-form-row">
                              <label class="mws-form-label">父类别:</label>
                              <div class="mws-form-item">
                                   <select name="pid" class="small">
	                                   <option value="0">--请选择--</option>
										                  @foreach($list as $row)
										                  <option value="{{$row['id']}}" @if($row['id']==$type['pid']) selected @endif>{{$row['name']}}</option>
                                  		@endforeach
                                   </select>
                              </div>
                         </div> -->
                         
                    </div>
                    <div class="mws-button-row">
                        {{csrf_field()}}
                         <input type="hidden" name="id" value="{{$type['id']}}">
                         <input type="submit" class="btn btn-danger" value="修改">
                         <input type="reset" class="btn " value="重置">
                    </div>
               </form>
          </div>         
      </div>
@endsection