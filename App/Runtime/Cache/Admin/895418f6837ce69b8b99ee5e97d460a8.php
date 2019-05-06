<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<link>
<meta charset="UTF-8">
<title>
    添加产品分类
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
        
            <form role="form" method="post" class="form-horizontal" action="<?php echo U('Admin/ProductCategories/AddProductCategoriesHandle');?>">
                <div class="form-group">
                    <table>
                        <tr style="line-height:20px;">
                            <td width="70px">
                                <label>产品名称</label>
                            </td>
                            <td>
                                <input type="text" class="form-control" id="ProductCategoriesName"name="ProductCategoriesName" placeholder="请输入产品名称">
                            </td>
                        </tr>
                        <tr>
                            <td><span>&nbsp;</span></td>
                        </tr>
                        <tr>
                            <td width="70px">

                            </td>
                            <td align="right">
                                &nbsp;<button type="submit" class="btn btn-primary">添加</button>
                            </td>
                        </tr>
                    </table>



                </div>

            </form>
           <hr/>
        <table class="table table-hover">
            <caption>产品分类</caption>
            <thead>
            <tr>
                <th>分类名称</th>
                <th>操作</th>

            </tr>
            </thead>
            <tbody>
<!--
                <?php if(is_array($mQry)): foreach($mQry as $key=>$m): ?><tr>
                    <td><?php echo ($m["name"]); ?></td>
                    <td><a href="<?php echo U('Home/ProductCategories/deleteProductCategoriesHandle',array('id'=>$m['id']));?>">删除</a></td>
                    </tr><?php endforeach; endif; ?>

-->
            <?php echo ($mQry); ?>
            </tbody>
        </table>
    
    </div>
</center>
</body>
</html>