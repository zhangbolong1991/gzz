@extends('public.index')
@section('edit')
<script type="text/javascript" charset="utf-8" src="/b/ueditor/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="/b/ueditor/ueditor.all.min.js"> </script>
    <!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
    <!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
    <script type="text/javascript" charset="utf-8" src="/b/ueditor/lang/zh-cn/zh-cn.js"></script>
<div class="mws-panel grid_8">
                    <div class="mws-panel-header">
                        <span>文章修改</span>
                    </div>
                    <div class="mws-panel-body no-padding">
                        <form action="/admin/article/update" class="mws-form" method="post" enctype="multipart/form-data">
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
                                    <label class="mws-form-label">标题</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="large" name="title" value="{{$arc['title']}}">
                                    </div>
                                </div>
                                                 
                                <div class="mws-form-row">
                                    <label class="mws-form-label">内容</label>
                                    <script id="editor" type="text/plain" style="width:980px;height:500px;margin-left:150px" name="content">{!!$arc['content']!!}</script>
                                </div>
                                <div class="mws-form-row">
                                    <label class="mws-form-label">描述</label>
                                    <div class="mws-form-item">
                                        <textarea class="large" cols="" rows="" name="descr" value="{{$arc['descr']}}">{!!$arc['descr']!!}</textarea>
                                    </div>
                                </div>
                                <div class="mws-form-row">
                                    <label class="mws-form-label">类别</label>
                                    <div class="mws-form-item">
                                        <select class="large" name="type_id">
                                            <option value="0"></option>
                                            @foreach($type as $row)
                                            <option value="{{$row['id']}}" @if($arc['type_id']==$row['id']) selected @endif >{{$row['name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="mws-form-row">
                                    <label class="mws-form-label">原图片</label>
                                    <div class="mws-form-item">
                                        <img src="{{$arc['pic']}}" width='100px' height='100px'>
                                    </div>
                                </div>
								<div class="mws-form-row">
                                    <label class="mws-form-label">上传图片</label>
                                    <div class="mws-form-item">
                                        <input type="file" class="medium" name="pic">
                                    </div>
                                </div>
                                
                                
                            </div>
                            <div class="mws-button-row">
                                {{csrf_field()}}
                                <input type="hidden" name="id" value="{{$arc['id']}}">
                                <input type="submit" class="btn btn-danger" value="Submit">
                                <input type="reset" class="btn " value="Reset">
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