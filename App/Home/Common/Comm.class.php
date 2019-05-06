<?php

/**
 * Created by PhpStorm.
 * Date: 2016/9/25
 * Time: 17:51
 * 功能：
 */

namespace Home\Common;

use Think\Page;
use Think\Think;

class Comm
{

    public static function addUser($email, $password, $name)
    {

        $user = D('user');
        $data['email'] = $email;
        //判断email是否已经被注册

        $condtion['email'] = $email;

        $exitEmail = $user->where($condtion)->find();

        if (count($exitEmail) > 0) {
            return 0;
        }

        $data['password'] = $password;
        $data['name'] = $name;
        $now_time = date('Y-m-d', time());

        $data['registeron'] = $now_time;
        $data['user_groupid'] = Comm::getGroupID();

        if ($user->create($data)) {

            $user->add($data);
            $auth_group_access=M('auth_group_access');

            $uid=Comm::getUserID($email);
            $group_id=Comm::getGroupID();

            $data_access['uid']=$uid;
            $data_access['group_id']=$group_id;

            $auth_group_access->add($data_access);

            return 1;
        } else {
            return 2;
        }


    }

    private static function getUserID($email){
        $users=M('user');
        $condtion['email']=$email;
        $user=$users->where($condtion)->find();

        if (empty($user)){
            return 0;
        }else{
            return $user['id'];
        }
    }
    /**
     * 获取用户组ID，默认用户组为user
     * @return mixed 返回GroupID
     */
    private static function getGroupID()
    {

        $groups = M('auth_group');
        $conditon['title'] = 'user';
        $group = $groups->where($conditon)->find();
        if (empty($group)) {

            $data['title'] = 'user';
            $data['status'] = 1;
            $data['rules'] = 1;

            $groups->add($data);


            return $group['id'];

        } else {
            return $group['id'];
        }


    }

    /**
     * 验证邮箱和密码是否正确
     *
     * @param $email 邮箱
     * @param $password 密码
     * @return bool true:表示验证成功  false:表示验证失败
     */
    public static function checkUer($email, $password)
    {

        $users = M('user');
        $conditon['email'] = $email;
        $conditon['password'] = $password;

        //把查询条件传入查询方法
        $userdata = $users->where($conditon)->find();

        if (count($userdata) > 0) {
            $_SESSION['email'] = $email;
            session('uid',$userdata['id']);
            session('user_groupid', $userdata['user_groupid']);
           session('user',$userdata);
            return true;
        } else {
            return false;
        }

    }

    /**
     * 获得一个随机的Guid
     * @return string 返回Guid字符串
     */
    public static function getNewGuid()
    {
        $Guid = new Guid();
        return $Guid->getGuid();
    }

    /**
     * @param $tableName 表名
     * @return int 返回排序的int值
     */

    public static function newSortID($tableName)
    {

        $m = M($tableName);
        $mQry = $m->order('sortid desc')->find();

        $newSortID = 0;

        if (count($mQry) == 0) {
            $newSortID = 1;

        } else {
            $newSortID = $mQry['sortid'] + 1;
        }

        return $newSortID;

    }

    /**
     * @return string 返回当前订单的id
     */
    public static function getOrderHeadersId()
    {
        $m = M('orderheaders');
        $mQry = $m->order('sortid desc')->find();


        if (!empty($mQry)) {
            return $mQry['id'];
        } else {
            return '';
        }

    }

    /**
     * @param $id 产品分类id
     * @return mixed 产品分类名称
     */
    public static function getProductCategoryName($id)
    {
        //产品分类名称
        $ProductCategories = M('productcategories');
        $data['id'] = $id;
        $ProductCategory = $ProductCategories->where($data)->find();
        $name = $ProductCategory['name'];
        return $name;
    }


    /**
     * TODO 基础分页的相同代码封装，使前台的代码更少
     * @param $m 模型，引用传递
     * @param $where 查询条件
     * @param int $pagesize 每页查询条数
     * @return \Think\Page
     */
    public static function getpage(&$m, $where, $pagesize = 10)
    {
        $m1 = clone $m;//浅复制一个模型
        $count = $m->where($where)->count();//连惯操作后会对join等操作进行重置
        $m = $m1;//为保持在为定的连惯操作，浅复制一个模型
        $p = new \Think\Page($count, $pagesize);

        $p->lastSuffix = false;
        $p->setConfig('header', '<li class="rows">共<b>%TOTAL_ROW%</b>条记录&nbsp;&nbsp;每页<b>' . $pagesize . '</b>条&nbsp;&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>');
        $p->setConfig('prev', '上一页');
        $p->setConfig('next', '下一页');
        $p->setConfig('last', '末页');
        $p->setConfig('first', '首页');
        $p->setConfig('theme', '%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');

        $p->parameter = I('get.');

        $m->limit($p->firstRow, $p->listRows);

        return $p;
    }
}