@extends('public.index')
@section('add')
 <div class="mws-panel grid_8">
          <div class="mws-panel-header">
               <span>类别添加</span>
          </div>
          <div class="mws-panel-body no-padding">
               <form action="/admin/type/insert" method="post" class="mws-form">
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
                                   <input value="{{old('name')}}" type="text" class="small" name="name">
                              </div>
                         </div>
                         <div class="mws-form-row">
                              <label class="mws-form-label">父类别:</label>
                              <div class="mws-form-item">
                                   <select name="pid" class="small">
	                                   <option value="0">--请选择--</option>
										@foreach($list as $row)
										<option value="{{$row['id']}}">{{$row['name']}}</option>
                                  		@endforeach
                                   </select>
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