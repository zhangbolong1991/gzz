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
				<th>商品名称</th>
				<th>单价</th>
				<th>数量</th>
			</tr>
			@foreach($data as $row)
			<tr>
				<td>{{$row['shopname']}}</td>
				<td>{{$row['price']}}</td>
				<td>{{$row['num']}}</td>			
			</tr>
			@endforeach
		</table>
		</tbody>
	</div>
@endsection