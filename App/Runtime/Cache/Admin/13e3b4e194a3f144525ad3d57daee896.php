<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<link>
<meta charset="UTF-8">
<title>
    会员列表
</title>
<link rel="stylesheet" href="/Shopping/Public/css/bootstrap.min.css">
<!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
<script src="/Shopping/Public/js/jquery-3.1.0.min.js"></script>

<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
<script src="/Shopping/Public/js/bootstrap.min.js"></script>

    <script type="text/javascript" src="/Shopping/Public/js/base.js"></script>
    <script type="text/javascript" src="/Shopping/Public/js/prototype.js"></script>
    <script type="text/javascript" src="/Shopping/Public/js/mootools.js"></script>
    <script type="text/javascript" src="/Shopping/Public/js/ThinkAjax.js"></script>

</head>
<body>

<ul class="nav nav-pills" style="margin:20px;">
    <li class="active"><a href="<?php echo U('Admin/Index/index');?>">首页</a></li>

    <li><a href="<?php echo U('Admin/User/MemberList');?>">会员列表</a></li>
    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            产品管理 <span class="caret"></span>
        </a>
        <ul class="dropdown-menu">
            <li><a href="<?php echo U('Admin/ProductCategories/addProductCategories');?>">添加产品分类</a></li>
            <li><a href="<?php echo U('Admin/Products/addProducts');?>">添加产品</a></li>
        </ul>
    </li>
    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            权限管理 <span class="caret"></span>
        </a>
        <ul class="dropdown-menu">
            <li><a href="<?php echo U('Admin/User/addRoles');?>">添加角色</a></li>
            <li><a href="<?php echo U('Admin/User/PageDescription');?>">页面说明</a></li>
            <li><a href="#">访问控制</a></li>
        </ul>
    </li>
    <li><a href="<?php echo U('Admin/User/logout');?>">注销</a></li>
</ul>
<hr/>
<center>
    <div class="container">
        


    <table class="table">
        <caption>会员列表</caption>
        <thead>
        <tr>

            <th>邮箱</th>
            <th>姓名</th>
            <th>注册时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php echo ($mList); ?>
        </tbody>
    </table>

    <script>
        function resetPassword(i) {

            ThinkAjax.send("<?php echo U('Admin/User/resetPasswordHandle');?>", 'ajax=1&user_id=' + i, complete, '')
        }
        function complete(data, status) {
            if (status == 1) {
                alert('重置密码成功');
            } else {
                alert('重置密码失败');
            }
        }
    </script>

    </div>
</center>
</body>
</html>