<?php
/**
 * Created by PhpStorm.
 * Date: 2016/10/18
 * Time: 15:51
 * 用于用户
 */
namespace Common\Common;
class UserHelper
{

    //构造函数
    public function _cunstruct()
    {

    }

    /**
     * 超级用户重置密码
     * @param $id 用户id
     * @return  bool
     */
    public function resetPassword($id)
    {
        $users = M('user');
        $condtion['id'] = $id;


        if (!empty($users)) {
            $data['password'] = '123456';
            $users->where($condtion)->save($data);
            return true;
        }
        return false;

    }

    /**
     * 修改密码
     * @param $id 用户id
     * @param $oldPassword 旧密码
     * @param $newPassword 新密码
     * @return int 修改密码是否成功
     */
    public function editPassword($id, $oldPassword, $newPassword)
    {

        $users = M('user');
        $condtion['id'] = $id;


        if ($this->checkPassword($id, $oldPassword)) {
            if (empty($newPassword)){
                return 2;
            }else{
                $data['password'] = $newPassword;
                $users->where($condtion)->save($data);
                return 3;
            }

        } else {
            return 1;
        }


    }

    /**
     * 校验密码是否正确
     *
     * @param $id 用户id
     * @param $password 需要校验的密码
     * @return bool 密码是否正确
     */
    private function checkPassword($id, $password)
    {

        $users = M('user');
        $condtion['id'] = $id;

        $user = $users->where($condtion)->find();

        if (!empty($user)) {

            if ($user['password'] == $password) {
                return true;
            } else {
                return false;
            }

        } else {
            return false;
        }

    }


    /**
     * @param $user_id 用户id
     * @param $name 用户昵称
     * @return bool 返回false表示昵称不能为空
     */
    public function EditName($user_id, $name)
    {

        $users = M('user');
        $condtion['id'] = $user_id;

        if (empty($name)){

            return false;
        }else{
            $data['name'] = $name;
            $users->where($condtion)->save($data);
            return true;
        }
    }

    /**
     * 初始化Rule表
     */
    public function initRule(){

        $rules=M('auth_rule');

        $rule=$rules->find();

        //如果rlue表里没有数据，则初始化rule表
        if (empty($rule)){
            $helper=new PowerHelper();

            $admin=$helper->getRuleToAdmin();
            $home=$helper->getRuleToHome();

            foreach($admin as $item){

                $data['name']=$item['name'];
                $data['type']=1;
                $data['status']=1;
                $rules->add($data);
            }

            foreach($home as $item){

                $data['name']=$item['name'];
                $data['type']=1;
                $data['status']=1;
                $rules->add($data);
            }
        }

    }

    /**
     * 保存描述
     * @param $id auth_rule的id
     * @param $descrie 描述
     */
    public function saveDescrie($id,$descrie){

        $rules=M('auth_rule');
        $condtion['id']=$id;
        $data['title']=$descrie;

       $rules->where($condtion)->save($data);

    }

    /**
     * 添加角色
     *
     * @param $name 角色名称
     * @return int
     */
    public function addRoles($name){
        $auth_group=M('auth_group');

        $condtion['title']=$name;
        $group=$auth_group->where($condtion)->select();

        if (!empty($group)){
            return 1;
        }
        if (strtolower($name)=='admin'||trim($name)=='admin'){
            return 2;
        }
        $data['title']=$name;
        $auth_group->add($data);
         return 3;
    }

    /**
     * 给管理组添加规则
     *
     * @param $id auth_group的id
     * @param $rules 规则
     */
    public function setRulesToGroup($id,$rules){

        $auth_group=M('auth_group');
        $condtion['id']=$id;
        $data['rules']=$rules;

        $auth_group->where($condtion)->save($data);
    }

}