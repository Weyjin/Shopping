<?php
/**
 * Created by PhpStorm.
 * Date: 2016/9/25
 * Time: 17:40
 * 功能：
 */

namespace Home\Model;
use Think\Model;

class UserModel extends Model{

    //用来定义并对数据进行验证
    protected $_validate=array(
        array('email','require','邮箱不能为空！'),
        array('name','require','昵称不能为空！'),
        array('password','require','密码不能为空！'),

    );


}