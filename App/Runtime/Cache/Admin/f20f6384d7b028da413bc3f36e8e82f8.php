<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<link>
<meta charset="UTF-8">
<title>
    页面控制
</title>
<link rel="stylesheet" href="/Shopping/Public/css/bootstrap.min.css">
<!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
<script src="/Shopping/Public/js/jquery-3.1.0.min.js"></script>

<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
<script src="/Shopping/Public/js/bootstrap.min.js"></script>

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
        
    <h1><?php echo ($title); ?></h1>
    <hr/>
    <?php echo ($mQry); ?>
    <div class="form-group">
        <br/>
        <div class="col-md-offset-1">
            <button id="btn_save">保存</button>
        </div>
    </div>
    <script>
        $(function () {

           $('#btn_save').click(function () {

               var rules="";
               var id='<?php echo ($group_id); ?>';
               $("input[name='checkbox']:checked").each(function() {
                   rules+=$(this).val()+",";
               });
             var string=rules;

               $.ajax({
                   url:'<?php echo U("Admin/User/setPageControlHandle");?>',//后台的方法(url不能错误)
                   type: 'post',//数据提交
                   dataType: 'json',//后台返回的数据类型
                   error:function (e) {
                       alert(e.message);
                   },
                   success: function a(data) {
                       if (data == "保存成功!") {
                           alert(data);
                       } else {
                           alert(data);
                           location.reload();
                       }

                   },
                   data: {id:id,rules: string},//前端的传值
               })


           })

        })


    </script>


    </div>
</center>
</body>
</html>