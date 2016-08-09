@extends('conter.conter')
@section('right')
<div class="container" style="position:absolute; top:300px; left:400px;">
		@if(session('error')>0)
		<div class="alert alert-success">
  			{{session('error')}}
		</div>
		@endif
		<table class="table table-bordered table-hover table-striped table-condensed table-responsive" style="margin:auto">
			<tbody><tr  class="success">
				<th>收件人</th>
				<th>收货地址</th>
				<th>电话</th>
				<th>商品名称</th>
				<th>金额</th>
				<th>订单号</th>
				<th>状态</th>
				<th>操作</th>
			</tr>
			@foreach($list as $row)
			<tr>
				<td>{{$row['name']}}</td>
				<td>{{$row['adds']}}</td>
				<td>{{$row['phone']}}</td>
				<td>{{$row['shopname']}}</td>
				<td>{{$row['total']}}</td>
				<td>{{$row['order_num']}}</td>
				<td>{{$row['status']}}</td>
				<td><a href=""><button class="btn btn-success">确认收货</button></a>
					<a href="/del/{{$row['id']}}"><button class="btn btn-success">删除</button></a>
				</td>
			</tr>
			@endforeach
		</table>
		</tbody>
	</div>
@endsection