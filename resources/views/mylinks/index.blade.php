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
     <div class="dataTables_filter" id="DataTables_Table_1_filter">
      <label>搜索: <input type="text" aria-controls="DataTables_Table_1" /></label>
     </div>
     <table class="mws-datatable-fn mws-table dataTable" id="DataTables_Table_1" aria-describedby="DataTables_Table_1_info"> 
      <thead> 
       <tr role="row">
        <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 203px;" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">ID</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 260px;" aria-label="Browser: activate to sort column ascending">链接名称</th>
        
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 260px;" aria-label="Browser: activate to sort column ascending">链接地址</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 140px;" aria-label="CSS grade: activate to sort column ascending">操作</th>
       </tr> 
      </thead> 
      <tbody role="alert" aria-live="polite" aria-relevant="all">
      	@foreach($list as $row)
       <tr class="odd"> 
        <td class="  sorting_1">{{$row['id']}}</td> 
        <td class=" ">{{$row['name']}}</td> 
        <td class=" ">{{$row['url']}}</td> 
        <td class=" "><a href="/admin/mylinks/del/{{$row['id']}}" class="btn btn-success">删除</a> <a href="/admin/mylinks/edit/{{$row['id']}}" class="btn btn-info">修改</a></td> 
       </tr>
       	@endforeach
      </tbody>
     </table>
     <div class="dataTables_info" id="DataTables_Table_1_info">
      Showing 1 to 10 of 57 entries
     </div>
     <div class="dataTables_paginate paging_full_numbers" id="DataTables_Table_1_paginate">
      <a class="first paginate_button paginate_button_disabled" tabindex="0" id="DataTables_Table_1_first">First</a>
      <a class="previous paginate_button paginate_button_disabled" tabindex="0" id="DataTables_Table_1_previous">Previous</a>
      <span><a class="paginate_active" tabindex="0">1</a><a class="paginate_button" tabindex="0">2</a><a class="paginate_button" tabindex="0">3</a><a class="paginate_button" tabindex="0">4</a><a class="paginate_button" tabindex="0">5</a></span>
      <a class="next paginate_button" tabindex="0" id="DataTables_Table_1_next">Next</a>
      <a class="last paginate_button" tabindex="0" id="DataTables_Table_1_last">Last</a>
     </div>
    </div> 
   </div> 
  </div>
 </body>
</html>
@endsection