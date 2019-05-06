<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<link>
<meta charset="UTF-8">
<title>
    用户登录
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
    
    <li><a href="<?php echo U('Home/User/register');?>">注册</a></li>
    <li><a href="<?php echo U('Home/User/Login');?>">登录</a></li>

</ul>
<hr/>
<center>
    <div class="container">
        

    <div class="col-lg-offset-4">
        <div style="height: 100px;"></div>
        <center>
        <form role="form" method="post" class="form-horizontal" action="<?php echo U('Home/User/LoginHandle');?>">
            <div class="form-group">
                <table>

                    <tr>
                        <td width="70px">
                            <label>邮箱</label>
                        </td>
                        <td>
                            <input type="text" class="form-control" id="email"name="email" placeholder="邮箱">
                        </td>

                    </tr>
                    <tr>
                        <td><span>&nbsp;</span></td>
                    </tr>
                    <tr>
                        <td width="70px">
                            <label>密&nbsp;&nbsp;码</label>
                        </td>
                        <td>
                            <input type="password" class="form-control" id="password"name="password" placeholder="密码">
                        </td>

                    </tr>
                    <tr>
                        <td><span>&nbsp;</span></td>
                    </tr>
                    <tr>
                        <td width="70px">

                        </td>
                        <td align="right">
                            &nbsp;<button type="submit" class="btn btn-primary">登录</button>
                        </td>
                    </tr>
                </table>


            </div>

        </form>
        </center>
    </div>

<style>

    .col-lg-offset-4{
        width: 500px;height:300px;margin: 20px;
        background: #eeeeee;
        background-color: #eeeeee;
        border: 1px solid #eeeeee;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
        border-bottom-left-radius: 10px;
        border-bottom-right-radius: 10px;
    }
</style>

    </div>
</center>
</body>
</html>