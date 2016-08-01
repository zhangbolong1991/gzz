@extends('public.index')
@section('edit')
<script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.all.min.js"> </script>
<!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
<!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
<script type="text/javascript" charset="utf-8" src="/ueditor/lang/zh-cn/zh-cn.js"></script>
<div class="mws-panel grid_8">
            	<div class="mws-panel-header">
                	<span>商品修改</span>
                </div>
                <div class="mws-panel-body no-padding">
                	<form action="/admin/goods/update" class="mws-form" method="post" enctype="multipart/form-data">
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
                                    <label class="mws-form-label">类别</label>
                                    <div class="mws-form-item">
                                        <select class="small" name="typeid">
                                            <option value="0"></option>
                                            @foreach($type as $row)
                                            <option value="{{$row['id']}}" @if($row['id']==$goods['typeid']) selected @endif >{{$row['name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="mws-form-row">
                    				<label class="mws-form-label">商品名称</label>
                    				<div class="mws-form-item">
                    					<input type="text" class="small" value="{{$goods['goods']}}" name="goods">
                    				</div>
                    			</div>

                    			<div class="mws-form-row">
                                    <label class="mws-form-label">生产厂家</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="small" value="{{$goods['company']}}" name="company">
                                    </div>
                                </div>          
                    			<div class="mws-form-row">
                    				<label class="mws-form-label">描述</label>
                    				<script id="editor" type="text/plain" style="width:500px;height:500px;margin-left:150px" name="descr">{!!$goods['descr']!!}</script>
                    			</div>
                    			<div class="mws-form-row">
                                    <label class="mws-form-label">单价</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="small" value="{{$goods['price']}}" name="price">
                                    </div>
                                </div>
                    			
                    			<div class="mws-form-row">
                    				<label class="mws-form-label">图片</label>
                    				<div class="mws-form-item">
                    					<img src="{{$goods['picname']}}" width="100px">
                    					<input type="file" class="small" name="picname">
                    				</div>
                    			</div>
                                <div class="mws-form-row">
                                    <label class="mws-form-label">库存量</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="small" value="{{$goods['store']}}" name="store">
                                    </div>
                                </div>
                                <div class="mws-form-row">
                                    <label class="mws-form-label">状态</label>
                                    <div class="mws-form-item">
                                        <select class="small" name="state">
                                            <option value="1" @if($goods['state']==1) selected @endif>新商品</option>
                                            <option value="2" @if($goods['state']==2) selected @endif>在售</option>
                                            <option value="3" @if($goods['state']==3) selected @endif>下架</option>
                                        </select>
                                    </div>
                                </div>
                    			
                    		</div>
                    		<div class="mws-button-row">
                    			{{csrf_field()}}
                    			<input type="hidden" name="id" value="{{$goods['id']}}">
                    			<input type="submit" class="btn btn-danger" value="修改">
                    			<input type="reset" class="btn " value="重置">
                    		</div>
                    	</form>
                    </div>    	
                </div>
<script type="text/javascript">
//实例化编辑器
//建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
var ue = UE.getEditor('editor');
</script>
@endsection