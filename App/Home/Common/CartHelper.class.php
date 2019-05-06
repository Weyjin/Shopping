<?php
/**
 * Created by PhpStorm.
 * Date: 2016/10/15
 * Time: 15:04
 * 功能：实现购物车的类，通过$_SESSION['Cart']来实现购物车
 */
namespace Home\Common;


class CartHelper
{

    //构造函数
    public function _cunstruct()
    {

        //判断指定的变量是否被设置
        if (!isset($_SESSION['Cart'])) {
            $_SESSION['Cart'] = array();//如果没有设置则对$_SESSION['Cart']
        }
    }


    /**
     * 把产品添加到购物车
     * @param $id 产品id
     * @param $name 产品名称
     * @param $price 产品价格
     * @param int $num 产品数量(默认为1)
     * @return int 1
     */
    public function addItem($id, $name, $price, $num = 1)
    {

        //1.如果该产品已经存在，则数量累加
        if ($this->deep_in_array($id, $_SESSION['Cart'])) {

            $k = $this->key_array($id, $_SESSION['Cart']);
            $_SESSION['Cart'][$k]['num'] += $num;
            return 1;
        }
            //如果该产品不存在，则必须先初始化
            $item = array();
            $item['id'] = $id;
            $item['name'] = $name;
            $item['price'] = $price;
            $item['num'] = $num;

            $_SESSION['Cart'][] = $item;

            return 1;

    }


    /**
     * @return int 返回购物车中所有产品
     */
    public function allProduct()
    {
        if (count($_SESSION['Cart']) == 0) {
            return 0;
        }
        return $_SESSION['Cart'];
    }

    /**
     * 如果产品存在，则数量减一
     * 否则直接删除该产品
     *
     * @param $id 产品id
     * @param int $num 产品数量
     * @return int 删除产品是否成功
     */
    public function deleteItem($id, $num = 1)
    {

        //获取对应产品的下标
        $k = $this->key_array($id, $_SESSION['Cart']);
        //如果产品减一后数量为0，则直接删除该产品
        //unset: 释放变量，即删除该变量的值
        if ($_SESSION['Cart'][$k]['num'] - 1 < 1) {
            unset($_SESSION['Cart'][$k]);
            return 1;
        } else {
            $_SESSION['Cart'][$k]['num'] -= $num;
            return 1;
        }


    }

    /**
     * 清空购物车
     */
    public function clear()
    {
        $_SESSION['Cart'] = array();
    }


    /**
     * 判断在二维数组中产品id是否存在
     * @param $value
     * @param $array
     * @return bool
     */
    public function deep_in_array($value, $array)
    {
        foreach ($array as $item) {
            if (!is_array($item)) {
                if ($item == $value) {
                    return true;
                } else {
                    continue;
                }
            }

            if (in_array($value, $item)) {
                return true;
            }
        }
        return false;
    }


    /**
     * @param $value
     * @param $array
     * @return int|string 返回二维数组下标
     */
    public function key_array($value, $array)
    {
        foreach ($array as $k => $item) {

            if ($item['id'] == $value) {
                return $k;
            }

        }
    }
}