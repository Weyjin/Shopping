<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<link>
    <meta charset="UTF-8">
    <title>用户登录</title>
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

<h3>后台登陆</h3>
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