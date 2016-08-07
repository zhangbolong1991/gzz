<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>城市级联</title>
	<link rel="stylesheet" href="/bs/css/bootstrap.min.css">
	<script src="/bs/js/jquery.min.js"></script>	
	<script src="/bs/js/bootstrap.min.js"></script>
	<script src="/bs/js/holder.min.js"></script>
</head>
<body>
	<div class="container">
		<button class="btn btn-success" data-toggle="modal" data-target="#Mymodal">城市级联</button>
		<!-- Modal -->
		<div class="modal fade" id="Mymodal">
			<div class="modal-dialog">

			<!-- 内容区 -->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close"data-dismiss="modal">&times;</button>
						<h4 class="modal-title">城市级联</h4>
					</div>

					<!-- body -->
					<div class="modal-body">
						<script type="text/javascript" src="/bs/jquery-1.8.3.min.js"></script>
						<script type="text/javascript">
							 // alert($);
							//获取第一级数据
							//Ajax
							$.ajax({
								url:  '/s',//url地址
								type: 'get',//请求方式
								data:{upid:0},//参数
								dataType:'json',//数据返回的类型格式
								//接收响应数据
								success:
								function(data){
									// alert(data);
									for(var i=0;i<data.length;i++){
										// alert(data[i].name);
										var s='<option value="'+data[i].id+'">'+data[i].name+'</option>';
										// alert(s);
										$("#cid").append(s);
									}
								},
								//Ajax响应失败
								error:
								function(){
									alert('Ajax响应失败');
								}
							});

							//子级
							$("select").live('change',function(){
								ss=$(this);
								//获取upid （父id）
								//清除当前下框对象的nextAll元素节点
								ss.nextAll('select').remove();
								//获取父id （upid）
								id=ss.val();
								// alert(id);
								//Ajax
								$.ajax({
									url:'/s',//url地址
									type:'get',//请求方式
									data: {upid:id},//参数
									dataType:'json',//数据的返回格式
									//接受响应数据
									success:
									function(data){
										// alert(data);
										info=$("<select><option value=''>--请选择--</option></select>");//创建select
										//判断
										if(data.length>0){
											//遍历
											for(var i=0;i<data.length;i++){
												// alert(data[i].name);
												//把数据放在下拉选项里
												var so='<option value="'+data[i].id+'">'+data[i].name+'</option>';
												// alert(ss);
												//把含有数据的下拉选项内部插入到info
												info.append(so);
											}
											//追加select
											ss.after(info);
										}
										
									},
									error:
									function(){
										alert('Ajax响应失败');
									}
								})
							})

							//获取数据
							// $("button").live('click',function(){
							// 	//遍历
							// 	$("select option:selected").each(function(){
							// 		alert($(this).html());
							// 	})
							// })
						</script>
						<form role="form" action="" method="post">
							<h1>jQuery+Ajax  无刷新城市级联</h1>
							<select id="cid">
								<option value="">--请选择---</option>
							</select>
							<!-- <button>获取</button -->
							
					</div>

					<!-- footer -->
					<div class="modal-footer">
						<button type="submit"class="btn btn-success">提交</button>
						<button type="reset" class="btn btn-danger">重置</button>
					</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	
</body>
</html>