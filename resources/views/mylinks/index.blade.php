@extends('public/index')
@section('index')
<html>
 <head></head>
 <body>
  <div class="mws-panel grid_8"> 
   <div class="mws-panel-header"> 
    <span><i class="icon-table"></i>友情链接列表</span> 
   </div> 
   <div class="mws-panel-body no-padding"> 
    <div role="grid" class="dataTables_wrapper" id="DataTables_Table_1_wrapper">
     <form action="/admin/mylinks/index" method="get">
     <div class="dataTables_filter" id="DataTables_Table_1_filter">
      <label><button class="btn btn-success">搜索</button><input type="text" aria-controls="DataTables_Table_1" name="keywords"/></label>
     </div>
     </form>
     <table class="mws-datatable-fn mws-table dataTable" id="DataTables_Table_1" aria-describedby="DataTables_Table_1_info"> 
      <thead> 
       <tr role="row">
        <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 203px;" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">ID</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 260px;" aria-label="Browser: activate to sort column ascending">链接名称</th>
        
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 260px;" aria-label="Browser: activate to sort column ascending">链接地址</th>
         <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 260px;" aria-label="Browser: activate to sort column ascending">状态</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 140px;" aria-label="CSS grade: activate to sort column ascending">操作</th>
       </tr> 
      </thead> 
      <tbody role="alert" aria-live="polite" aria-relevant="all">
      	@foreach($list as $row)
       <tr class="odd"> 
        <td class="  sorting_1">{{$row['id']}}</td> 
        <td class=" ">{{$row['name']}}</td> 
        <td class=" ">{{$row['url']}}</td> 
        <td class=" ">@if($row['status']==1)
                      启用
                      @elseif($row['status']==0)
                      禁用
                      @endif
        </td> 
        <td class=" "><a href="/admin/mylinks/del/{{$row['id']}}" class="btn btn-success"><i class="icon-trash"></i></a> <a href="/admin/mylinks/edit/{{$row['id']}}" class="btn btn-info"><i class="icon-pencil"></i></a></td> 
       </tr>
       	@endforeach
      </tbody>
     </table>
     <div class="dataTables_info" id="DataTables_Table_1_info">
      Showing 1 to 10 of 57 entries
     </div>
     <div class="dataTables_paginate paging_full_numbers" id="pages">
      {!!$list->appends($request)->render()!!}
     </div>
    </div> 
   </div> 
  </div>
 </body>
</html>
@endsection