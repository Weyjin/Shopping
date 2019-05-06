<?php
/**
 * Created by PhpStorm.
 * Date: 2016/10/17
 * Time: 11:44
 */
namespace Home\Model;
use Think\Model;
class OrderDetailsModel extends Model{

    //用来定义并对数据进行验证
    protected $_validate=array(
        array('price','require','价格不能为空！'),
        array('amount','require','数量不能为空！'),
        array('orderdetails_productsid','require','产品不能为空！'),
        array('orderdetails_orderheaderid','require','订单不能为空！'),
    );
}