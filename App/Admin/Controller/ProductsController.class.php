<?php
/**
 * Created by PhpStorm.
 * Date: 2016/9/26
 * Time: 17:54
 * 功能：
 */

namespace Admin\Controller;

use Admin\Common\AuthController;
use Admin\Common\Comm;

class ProductsController extends AuthController
{

    //添加产品
    public function addProducts()
    {

        //获取产品分类列表
        $ProductCategories = M('productcategories');
        $m = $ProductCategories->order('sortid desc')->select();

        $mQry = '';

        foreach ($m as $item) {
            $mQry .= '<option value=\'' . $item['id'] . '\'>';
            $mQry .= $item['name'] . '</option>';
        }

        //下拉数据
        $this->assign('classify', $mQry);


        //产品列表
        $products = M('products');

        $products = $products->order('sortid asc')->select();
        $mProducts = '';
        $num = 1;
        if (count($products) > 0) {
            foreach ($products as $item) {
                $mProducts .= '<tr>';

                $mProducts .= '<th>';
                $mProducts .= $num;
                $mProducts .= '</th>';
                $mProducts .= '<td>';
                $mProducts .= $item['name'];
                $mProducts .= '</td>';

                $mProducts .= '<td>';
                $mProducts .= $item['description'];
                $mProducts .= '</td>';

                $mProducts .= '<td>';
                $mProducts .= $item['color'];
                $mProducts .= '</td>';

                $mProducts .= '<td>';
                $mProducts .= $item['price'];
                $mProducts .= '</td>';

                $mProducts .= '<td>';
                $mProducts .= '编辑';
                $mProducts .= '</td>';

                $mProducts .= '</tr>';

                $num++;
            }
            $this->assign('mProducts', $mProducts);
        }


        $this->display();
    }

    public function AddProductsHandle()
    {

        $id = Comm::getNewGuid();
        $ProductName = $_POST['name'];//原生php方法
        $description = I('post.description');
        $color = I('post.color');
        $price = I('post.price');

        $productcategories_productsid = I('post.classify');

        if (empty($productcategories_productsid)) {

            $this->error('请先添加产品分类！', U('Admin/ProductCategories/addProductCategories'), 1);
        }

        if (is_int($price)) {
            $this->error('价格一定要是数字');
        }

        $sortid = Comm::newSortID('products');

        $data['id'] = $id;
        $data['name'] = $ProductName;
        $data['description'] = $description;
        $data['color'] = $color;
        $data['publishon'] = date('Y-m-d', time());
        $data['price'] = $price;
        $data['productcategories_productsid'] = $productcategories_productsid;
        $data['sortid'] = $sortid;

        $Product = D('products');

        if ($Product->create($data)) {

            $Product->add($data);


            $this->success('添加成功');
        } else {
            $e = $Product->getError();
            $this->error($e);
        }

    }


}
