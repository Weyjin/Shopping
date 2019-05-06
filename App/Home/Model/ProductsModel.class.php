<?php
/**
 * Created by PhpStorm.
 * Date: 2016/9/28
 * Time: 20:59
 */
namespace Home\Model;
use Think\Model;

class ProductsModel extends Model
{
    //用来定义并对数据进行验证
    protected $_validate=array(

        array('name','require','产品名称不能为空！'),
        array('description','require','产品描述不能为空！'),
        array('color','require','产品颜色不能为空！'),
        array('price','require','产品价格不能为空！'),
    );

}