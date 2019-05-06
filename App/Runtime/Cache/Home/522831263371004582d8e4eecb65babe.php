<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<link>
<meta charset="UTF-8">
<title>
    结算订单
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
        

    <form role="form" method="post" class="form-horizontal" action="<?php echo U('Home/OrderHeader/SettlementOrderHandle');?>">
    <div class="form-horizontal">

        <div class="form-group">
            <label class="control-label col-md-2">收件人姓名</label>
            <div class="col-md-10">

                <input type="text" name="ContactName" placeholder="*必填*" class="form-control"/>
                <label class="col-md-2"></label>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-2">电话号码</label>
            <div class="col-md-10">

                <input type="text" name="ContactPhoneNo" placeholder="*必填*" class="form-control"/>
                <label class="col-md-2"></label>

            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-2">地址</label>
            <div class="col-md-10">
                <input type="text" name="ContactAddress" placeholder="*必填*" class="form-control"/>
                <label class="col-md-2"></label>

            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-2">订单金额</label>
            <div class="col-md-10">
                <p style="height:20px;margin-top:7px;"name="total"><strong>¥<?php echo ($total); ?></strong></p>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-2">订单备注</label>
            <div class="col-md-10">
                <input type="text" name="Memo" placeholder="*可省略*" class="form-control"/>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-2">订购时间</label>
            <div class="col-md-10">
                <p style="height:20px;margin-top:8px;"><strong><?php echo ($time); ?></strong></p>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-offset-2 col-md-10">
                <input type="submit" value="结算订单" class="btn-primary"/>
            </div>
        </div>
    </div>
         </form>
    <style>
        .col-md-10{
            width:300px;
        }
    </style>

    </div>
</center>
</body>
</html>