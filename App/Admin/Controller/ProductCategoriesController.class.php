<?php
/**
 * Created by PhpStorm.
 * Date: 2016/9/26
 * Time: 18:04
 * 功能：
 */

namespace Admin\Controller;

use Admin\Common\Comm;
use Admin\Common\AuthController;

class ProductCategoriesController extends AuthController
{

    //添加产品分类
    public function addProductCategories()
    {

        $ProductCategories = D('productcategories');

        $m = $ProductCategories->order('sortid desc')->select();


        $mQry = '';
        if (count($m) > 0) {
            foreach ($m as $item) {
                $mQry .= '<tr><td>'.$item['name'].'</td>'.'<td>';

                $url='';
                $url .= U('ProductCategories/DeleteProductCategoriesHandle', array('id' => $item['id']));

                $mQry.='<a href="'.$url.'">';
                $mQry.='删除';
                $mQry.='</a><td></tr>';

            }
        }


        $this->assign('mQry', $mQry);

        $this->display();
    }


    public function AddProductCategoriesHandle()
    {

        $id = Comm::getNewGuid();
        $ProductCategoriesName = $_POST['ProductCategoriesName'];//原生php方法

        if (empty($ProductCategoriesName)) {
            $this->error('产品名称不能为空！', 'addProductCategories', 1);
        }


        $sortid = Comm::newSortID('productcategories');

        $data['id'] = $id;
        $data['name'] = $ProductCategoriesName;
        $data['sortid'] = $sortid;

        $ProductCategories = D('productcategories');

        //对数据进行验证，此验证要用到D方法
        if ($ProductCategories->create($data)) {
            $ProductCategories->add($data);

            $m = $ProductCategories->order('sortid desc')->select();

            $mQry = '';
            if (count($m) > 0) {
                foreach ($m as $item) {
                    $mQry .= '<tr><td>'.$item['name'].'</td>'.'<td>';
                    $mQry.='<a href="DeleteProductCategoriesHandle?id='.$item['id'].'">';
                    $mQry.='删除';
                    $mQry.='</a><td></tr>';

                }
            }


            $this->assign('mQry', $mQry);
            $this->display('addProductCategories');
        } else {
            $this->error('信息不完整！', 'register', 1);
        }

    }

    //删除产品分类
    public function DeleteProductCategoriesHandle($id)
    {

        $ProductCategories = M('productcategories');
        //$id=$_POST['id'];
        $ProductCategories->where('id=\'' . $id . '\'')->delete();
        $this->redirect('Home/ProductCategories/addProductCategories');

    }

}