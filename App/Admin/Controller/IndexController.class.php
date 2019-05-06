<?php
namespace Admin\Controller;

use Admin\Common\AuthController;


class IndexController extends AuthController
{
    public function index()
    {

        $this->display();
    }

}