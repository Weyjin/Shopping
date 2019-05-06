<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<link>
<meta charset="UTF-8">
<title>
    产品详情
</title>
<link rel="stylesheet" href="/Shopping/Public/css/bootstrap.min.css" type="text/css">
<!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
<script src="/Shopping/Public/js/jquery-3.1.0.min.js"></script>

<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
<script src="/Shopping/Public/js/bootstrap.min.js"></script>

</head>
<body>

<ul class="nav nav-pills" style="margin:20px;">
    <li class="active"><a href="<?php echo U('Home/Index/index');?>">首页</a></li>
    <!--根据session来决定显示-->
    <?php if(isset($_SESSION['user'])): ?><li><a href="<?php echo U('Home/User/index');?>">用户信息</a></li>
        <li><a href="<?php echo U('Home/Cart/index');?>">购物车</a></li>
        <li><a href="<?php echo U('Home/User/logout');?>">注销</a></li>

        <?php else: ?>

        <li><a href="<?php echo U('Home/Index/register');?>">注册</a></li>
        <li><a href="<?php echo U('Home/Index/Login');?>">登录</a></li><?php endif; ?>
    



</ul>
<hr/>
<center>
    <div class="container">
        

    <h2>您正在浏览【<?php echo ($mProduct["name"]); ?>】商品详细信息</h2>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>商品简介</th>
                <td><?php echo ($mProduct["description"]); ?></td>

            </tr>
            </thead>
            <tbody>
            <tr>
                <th>商品价格</th>
                <td>￥<?php echo ($mProduct["price"]); ?></td>

            </tr>
            <tr>
                <th>上架时间</th>
                <td><?php echo ($mProduct["publishon"]); ?></td>

            </tr>
            </tbody>
        </table>
    </div>
    <p>

    <div class="row show-grid">
    <div class="col-md-10 col-md-offset-6">
     <?php echo ($mCart); ?>
    </div>
    </div>

    <div class="row show-grid">

    <span class="col-md-1" style="width:200px;">
         <a href="<?php echo U('Home/Index/index');?>">返回首页</a>&nbsp;|&nbsp;
        <a href="<?php echo U('Home/Index/index');?>">返回产品列表</a>

    </span>
    </div>
    </p>



    </div>
</center>
</body>
</html>