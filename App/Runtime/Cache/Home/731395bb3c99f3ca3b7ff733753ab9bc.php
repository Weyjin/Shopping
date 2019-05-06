<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<link>
<meta charset="UTF-8">
<title>
    购物车
</title>
<link rel="stylesheet" href="/Shopping/Public/css/bootstrap.min.css" type="text/css">
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
        

    <div class="form-group">


        <h2>购物车</h2>
        <table class="table">
            <tr>
                <th>
                    商品名称
                </th>
                <th>
                    商品价格
                </th>

                <th>
                    商品数量
                </th>
                <th>
                    总价
                </th>
                <th>
                    操作
                </th>

            </tr>
            <!--
            <?php if(is_array($products)): foreach($products as $key=>$m): ?><tr>
                    <td><?php echo ($m["name"]); ?></td>
                    <td><?php echo ($m["price"]); ?></td>
                    <td><?php echo ($m["num"]); ?></td>
                    <td><?php echo ($m["num"]); ?>*<?php echo ($m["price"]); ?></td>
                </tr><?php endforeach; endif; ?>
            -->
            <?php echo ($mQry); ?>
        </table>
        <div class="row show-grid">
            <div class="col-md-2 col-md-offset-10">
                <label>合计:&nbsp;￥<?php echo ($mPrice); ?></label>
            </div>
        </div>
    </div>
    <div class="row show-grid">
        <div class="col-md-offset-10">
            <?php echo ($mBtn); ?>

        </div>
    </div>
    <div class="row show-grid">
        <a href="<?php echo U('Home/Index/index');?>" class="col-md-1">返回首页</a>

    </div>

    <!--javascript-->
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
        <!--删除产品-->
        function removeToCart(i) {

            ThinkAjax.send("<?php echo U('Home/Cart/RemoveToCartHandle');?>", 'ajax=1&productsid=' + i, completeRemove, '')
        }
        function completeRemove(data, status) {
            if (status == 1) {
                alert('移除产品成功');
            } else {
                alert('移除产品失败');
            }
        }

        <!--清空购物车-->
        function clearToCart() {

            if (window.confirm("是否确认要清空购物车?")) {
                // 确认时做的操作
                ThinkAjax.send("<?php echo U('Home/Cart/ClearToCartHandle');?>", 'ajax=1', completeClear, '')
            } else {
                // 取消时做的操作
                return false;
            }

        }
        function completeClear(data, status) {
            if (status == 1) {
                alert('移除购物车成功');
                window.location = "<?php echo U('Home/Cart/index');?>";
            } else {
                alert('移除购物车失败');
            }
        }
        <!--提交订单-->

        function priceOrderToCart() {

            if (window.confirm("是否确认提交订单吗?")) {

                window.location = "<?php echo U('Home/OrderHeader/index',array('total'=>$mPrice));?>";
            } else {
                // 取消时做的操作
                return false;
            }

        }

    </script>

    </div>
</center>
</body>
</html>