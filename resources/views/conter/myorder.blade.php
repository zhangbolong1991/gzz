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
				<th>金额</th>
				<th>状态</th>
				<th>订单号</th>
			</tr>
			@foreach($list as $row)
			<tr>
				<td>{{$d}}</td>
				<td>{{$b}}</td>
				<td>{{$c}}</td>
				<td>{{$row['total']}}</td>
				<td>{{$row['status']}}</td>
				<td>{{$row['order_num']}}</td>						
			</tr>
			@endforeach	
		</tbody></table>
	</div>
@endsection