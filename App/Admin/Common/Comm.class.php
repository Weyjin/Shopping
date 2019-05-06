<?php

/**
 * Created by PhpStorm.
 * Date: 2016/9/25
 * Time: 17:51
 * 功能：
 */

namespace Admin\Common;

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
            return 1;
        } else {
            return 2;
        }
    }



    /**
     * 初始化超级用户账号
     */
    public static function initAdminAccount(){
        $users=M('user');
        $conditon['name']='admin';
        $account=$users->where($conditon)->find();

        if (empty($account)) {

            $data['email'] = 'admin@.com';
            $data['name'] = 'admin';
            $data['password'] = 1;
            $data['registeron'] =date('Y-m-d H:i:s', time());
            $data['user_groupid'] =Comm::getAdminGroupID();

            $users->add($data);
        }

    }

    private static function getAdminGroupID(){

        $groups = M('auth_group');
        $conditon['title'] = 'admin';
        $group = $groups->where($conditon)->find();
        if (empty($group)) {

            $data['title'] = 'admin';
            $data['status'] = 1;
            $data['rules'] = 1;

            $groups->add($data);
             return 1;
        }else{
            return $group['id'];
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
            session('user_groupid', $userdata['user_groupid']);

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
           $newSortID=$mQry['sortid']+1;
        }

        return $newSortID;

    }

}