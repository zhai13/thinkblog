<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
		"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>Document</title>
	<link rel="stylesheet" type="text/css" href="__PUBLIC__/Css/public.css" />
</head>
<body>
	<form action="<?php echo U(GROUP_NAME . '/Category/sortCate');?>" method="post">
		<table class="table">
			<tr>
				<th>ID</th>
				<th>名称</th>
				<th>级别</th>
				<th>排序</th>
				<th>操作</th>
			</tr>
			<!--
			foreach 循环：
			name（必须）：要输出的数据模板变量
			item（必须）：循环单元变量
			key（可选）：循环的key变量，默认值为ke
			如：
			<?php if(is_array($list)): foreach($list as $key=>$vo): echo ($vo["id"]); ?>
				<?php echo ($vo["name"]); endforeach; endif; ?>
			-->
			<?php if(is_array($cate)): foreach($cate as $key=>$v): ?><tr>
					<td><?php echo ($v["id"]); ?></td>	<!--用点语法输出数组中的键值-->
					<td><?php echo ($v["html"]); echo ($v["name"]); ?></td>
					<td><?php echo ($v["level"]); ?></td>
					<td>
						<input type="text" name="<?php echo ($v["id"]); ?>" value="<?php echo ($v["sort"]); ?>"/>
					</td>
					<td>
						[<a href="<?php echo U(GROUP_NAME . '/Category/addCate', array('pid' => $v['id']));?>">添加子分类</a>]
						[<a href="#">修改</a>]
						[<a href="#">删除</a>]
					</td>
				</tr><?php endforeach; endif; ?>
			<tr>
				<td colspan="5" align="center">
					<input type="submit" value="排序"/>
				</td>
			</tr>
		</table>
	</form>
</body>
</html>