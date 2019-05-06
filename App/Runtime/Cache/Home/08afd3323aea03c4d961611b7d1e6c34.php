<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<link>
<meta charset="UTF-8">
<title>
    用户注册
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

    
    <li><a href="<?php echo U('Home/User/register');?>">注册</a></li>
    <li><a href="<?php echo U('Home/User/Login');?>">登录</a></li>

</ul>
<hr/>
<center>
    <div class="container">
        

    <!-- 引入模板页 -->
    
    <block name="RenderBody">

        <div style="width: 500px;margin: 20px;">
            <form role="form" method="post" action="<?php echo U('Home/User/registerHandle');?>">
                <div class="form-group">
                    <table>
                        <tr style="line-height:20px;">
                            <td width="70px">
                                <label>Email</label>
                            </td>
                            <td>
                                <input type="email" class="form-control" id="email"name="email" placeholder="邮箱">
                            </td>
                        </tr>
                        <tr>
                            <td><span>&nbsp;</span></td>
                        </tr>
                        <tr>
                            <td width="70px">
                                <label>昵&nbsp;&nbsp;称</label>
                            </td>
                            <td>
                                <input type="text" class="form-control" id="name"name="name" placeholder="姓名">
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
                                <label>确认密码</label>
                            </td>
                            <td>
                                <input type="password" class="form-control" id="Confirmpassword"name="Confirmpassword" placeholder="确认密码">
                            </td>

                        </tr>
                        <tr>
                            <td><span>&nbsp;</span></td>
                        </tr>
                        <tr>
                            <td width="70px">

                            </td>
                            <td align="right">
                                &nbsp;<button type="submit" class="btn btn-primary">提交</button>
                            </td>
                        </tr>
                    </table>



                </div>

            </form>
        </div>
    
    </div>
</center>
</body>
</html>