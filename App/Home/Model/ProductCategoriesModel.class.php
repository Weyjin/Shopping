<?php
/**
 * Created by PhpStorm.
 * Date: 2016/9/28
 * Time: 15:05
 * 功能：
 */

namespace Home\Model;
use Think\Model;

class ProductCategoriesModel extends Model
{
    //用来定义并对数据进行验证
    protected $_validate=array(

        array('name','require','产品分类不能为空！'),

    );

}