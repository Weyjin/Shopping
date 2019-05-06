<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<link>
<meta charset="UTF-8">
<title>
    产品列表
</title>
<link rel="stylesheet" href="/Shopping/Public/css/bootstrap.min.css" type="text/css">
<!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
<script src="/Shopping/Public/js/jquery-3.1.0.min.js"></script>

<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
<script src="/Shopping/Public/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="/Shopping/Public/css/productList.css" type="text/css">
    <script type="text/javascript" src="/Shopping/Public/js/base.js"></script>
    <script type="text/javascript" src="/Shopping/Public/js/prototype.js"></script>
    <script type="text/javascript" src="/Shopping/Public/js/mootools.js"></script>
    <script type="text/javascript" src="/Shopping/Public/js/ThinkAjax.js"></script>

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
        


    <script>
        function buy(i) {

            ThinkAjax.send("<?php echo U('Home/Cart/AddToCartHandle');?>", 'ajax=1&productsid=' + i, complete, '')
        }
        function complete(data, status) {
            if (status == 1) {
                alert('添加购物车成功');
            } else {
                alert('添加购物车失败');
            }
        }
    </script>


    <div class="form-group">


        <h2>【<?php echo ($ProductCategoryName); ?>】列表信息</h2>
        <table class="table">
            <tr>
                <th>
                    商品名称
                </th>
                <th>
                    商品简介
                </th>

                <th>
                    商品价格
                </th>
                <th>
                    添加购物车
                </th>

            </tr>
            <?php if(is_array($list)): foreach($list as $key=>$m): ?><tr>
                    <td><a href="<?php echo U('Home/Index/productDetail',array('id'=>$m['id']));?>"><?php echo ($m["name"]); ?></a></td>
                    <td><?php echo ($m["description"]); ?></td>
                    <td><?php echo ($m["price"]); ?></td>
                    <td><a href="#" onclick="buy('<?php echo ($m["id"]); ?>')">添加</a></td>
                </tr><?php endforeach; endif; ?>
        </table>

    </div>
    <div class="row show-grid">
        <a href="<?php echo U('Home/Index/index');?>" class="col-md-1">返回首页</a>
    </div>

    <div class="page">
        　　<?php echo ($page); ?>
    </div>


    </div>
</center>
</body>
</html>