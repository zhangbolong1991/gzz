@extends('public.hindex')
@section('main')
<div style="height:400px">
	<table style="width:200px;border:0px solid red;position:absolute;top:400px;left:700px">
	<tr>
		<th><a href="/encrypted"><button class="btn btn-success">密保找回</button></a></th>
		<th><a href="/forget"><button class="btn btn-success">邮箱找回</button></a></th>
		
	</tr>
</table>
</div>

@endsection