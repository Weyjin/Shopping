<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<link>
    <meta charset="UTF-8">
    <title>用户组列表</title>
    <link rel="stylesheet" href="/Shopping/Public/css/bootstrap.min.css">
    <!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
    <script src="/Shopping/Public/js/jquery-3.1.0.min.js"></script>

    <!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
    <script src="/Shopping/Public/js/bootstrap.min.js"></script>
    
</head>
<body>

<ul class="nav nav-pills" style="margin:20px;">
    <li class="active"><a href="<?php echo U('Admin/Index/index');?>">首页</a></li>
    <li><a href="<?php echo U('Admin/User/logout');?>">注销</a></li>
    <li><a href="<?php echo U('Admin/ProductCategories/addProductCategories');?>">添加产品分类</a></li>
    <li><a href="<?php echo U('Admin/Products/addProducts');?>">添加产品</a></li>
</ul>
<hr/>
<center>
<div class="container">


<?php if(is_array($users)): foreach($users as $key=>$u): echo ($u["id"]); endforeach; endif; ?>


</div>
</center>
</body>
</html>