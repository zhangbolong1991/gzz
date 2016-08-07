@extends('public.index')
@section('index')
<html>
 <head></head>
 <body>
  <div class="mws-panel grid_8"> 
   <div class="mws-panel-header"> 
    <span><i class="icon-table"></i> 商品列表</span> 
   </div> 
   <div class="mws-panel-body no-padding"> 
    <div role="grid" class="dataTables_wrapper" id="DataTables_Table_1_wrapper">
		<form action="/admin/goods/index" method="get">
		<div class="dataTables_filter" id="DataTables_Table_1_filter">
		<label><input type="text" name="keyword" aria-controls="DataTables_Table_1" / value="{{$request['keyword'] or ''}}"></label><button class="btn btn-success">搜索</button>
		</div>
	    </form>
     <table class="mws-datatable-fn mws-table dataTable" id="DataTables_Table_1" aria-describedby="DataTables_Table_1_info"> 
      <thead> 
       <tr role="row">
        <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 203px;" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">ID</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 220px;" aria-label="Browser: activate to sort column ascending">类别</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 220px;" aria-label="Browser: activate to sort column ascending">商品名称</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 220px;" aria-label="Platform(s): activate to sort column ascending">生产厂家</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 220px;" aria-label="Engine version: activate to sort column ascending">描述</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 180px;" aria-label="Platform(s): activate to sort column ascending">单价</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 200px;" aria-label="Engine version: activate to sort column ascending">图片</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 180px;" aria-label="Platform(s): activate to sort column ascending">库存量</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 180px;" aria-label="Platform(s): activate to sort column ascending">销售量</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 180px;" aria-label="Platform(s): activate to sort column ascending">点击量</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 220px;" aria-label="Platform(s): activate to sort column ascending">添加时间</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 220px;" aria-label="Platform(s): activate to sort column ascending">状态</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 127px;" aria-label="CSS grade: activate to sort column ascending">操作</th>
       </tr> 
      </thead> 
      <tbody role="alert" aria-live="polite" aria-relevant="all">
      	@foreach($goods as $row)
       <tr class="odd"> 
        <td class="  sorting_1">{{$row['gid']}}</td> 
        <td class=" ">{{$row['name']}}</td> 
        <td class=" ">{{$row['goods']}}</td> 
        <td class=" ">{{$row['company']}}</td> 
        <td class=" ">{!!$row['descr']!!}</td> 
        <td class=" ">{{$row['price']}}</td>
        <td class=" "><img src="{{$row['picname']}}" width="50px"></td> 
        <td class=" ">{{$row['store']}}</td> 
        <td class=" ">{{$row['num']}}</td> 
        <td class=" ">{{$row['clicknum']}}</td> 
        <td class=" ">{{$row['addtime']}}</td> 
        <td class=" ">
        @if($row['state']=='1')
          新商品
        @elseif($row['state']=='2')
          在售
        @elseif($row['state']=='3')
          下架
        @endif
        </td>
        <td class=" "><a href="/admin/goods/del/{{$row['gid']}}" class="btn btn-success"><i class="icon-trash"></i></a> <a href="/admin/goods/edit/{{$row['gid']}}" class="btn btn-info"><i class="icon-pencil"></i></a></td> 
       </tr>
       	@endforeach
      </tbody>
     </table>
     <div class="dataTables_info" id="DataTables_Table_1_info">
      <!-- Showing 1 to 10 of 57 entries -->
     </div>
     <div class="dataTables_paginate paging_full_numbers" id="pages">
      {!!$goods->appends($request)->render()!!}
     </div>
    </div> 
   </div> 
  </div>
 </body>
</html>
@endsection