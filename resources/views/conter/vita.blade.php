@extends('conter.conter')
@section('right')
<div class="container" style="position:absolute; top:300px; left:330px;">
		@if(session('error')>0)
		<div class="alert alert-success">
  			{{session('error')}}
		</div>
		@endif
		<table class="table table-bordered table-hover table-striped table-condensed table-responsive" style="margin:auto">
			<tbody><tr  class="success">
				<th>账户</th>
				<th>昵称</th>
				<th>性别</th>
				<th>地址</th>
				<th>电话</th>
				<th>邮箱</th>
				<th>操作</th>
			</tr>
			<tr>
			@foreach($list as $row)
				<td>{{$row['username']}}</td>
				<td>{{$row['name']}}</td>
				@if($row['sex']=='m')
				<td>男</td>
				@endif
				@if($row['sex']=='w')
				<td>女</td>
				@endif
				<td>{{$row['address']}}</td>
				<td>{{$row['phone']}}</td>
				<td>{{$row['email']}}</td>
						
				<td><a href="/update?id={{$row['id']}}"><span class="label label-success">修改</span></a>
				<a href="/guarb?id={{$row['id']}}"><span class="label label-success">设置密保</span></a>
				</td>
				@endforeach	
			</tr>
		</tbody></table>
	</div>
@endsection