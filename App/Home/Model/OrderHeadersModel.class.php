<?php
/**
 * Created by PhpStorm.
 * Date: 2016/10/17
 * Time: 11:13
 * 订单
 */

namespace Home\Model;
use Think\Model;

class OrderHeadersModel extends Model{

    //用来定义并对数据进行验证
    protected $_validate=array(
        array('contactname','require','收件人不能为空！'),
        array('contactphoneno','require','电话不能为空！'),
        array('contactaddress','require','收货地址不能为空！'),

    );


}