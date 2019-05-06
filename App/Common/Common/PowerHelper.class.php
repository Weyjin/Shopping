<?php
/**
 * Created by PhpStorm.
 * Date: 2016/10/20
 * Time: 0:39
 * 用于获取Controller和Action
 */
namespace Common\Common;


class PowerHelper
{
    //构造函数
    public function _cunstruct()
    {
    }

    /**
     * 获取Admin下的Controller和Action
     * @return mixed
     */
    public function getRuleToAdmin()
    {
        $modules = array('Admin');  //模块名称
        $i = 0;
        foreach ($modules as $module) {
            $all_controller = $this->getController($module);
            foreach ($all_controller as $controller) {
                $controller_name = $controller;
                $all_action = $this->getAction($module, $controller_name);

                foreach ($all_action as $action) {
                    $data[$i] = array(
                        'name' => $module . '/' . $controller . '/' . $action,
                        'status' => 1,

                    );
                    $i++;
                }
            }
        }
        return $data;
    }

    /**
     * 获取Home下的Controller和Action
     * @return mixed
     */
    public function getRuleToHome()
    {
        $modules = array('Home');  //模块名称
        $i = 0;
        foreach ($modules as $module) {
            $all_controller = $this->getController($module);
            foreach ($all_controller as $controller) {
                $controller_name = $controller;
                $all_action = $this->getAction($module, $controller_name);

                foreach ($all_action as $action) {
                    $data[$i] = array(
                        'name' => $module . '/' . $controller . '/' . $action,

                    );
                    $i++;
                }
            }
        }
        return $data;
    }
    /**
     * @cc 获取所有控制器名称
     *
     * @param $module
     *
     * @return array|null
     */
    protected function getController($module)
    {
        if (empty($module)) return null;
        $module_path = APP_PATH . '/' . $module . '/Controller/';  //控制器路径
        if (!is_dir($module_path)) return null;
        $module_path .= '/*.class.php';
        $ary_files = glob($module_path);
        foreach ($ary_files as $file) {
            if (is_dir($file)) {
                continue;
            } else {
                $files[] = basename($file, C('DEFAULT_C_LAYER') . '.class.php');
            }
        }
        return $files;
    }


    /**
     * @cc 获取所有方法名称
     *
     * @param $module
     * @param $controller
     *
     * @return array|null
     */
    protected function getAction($module, $controller)
    {
        if (empty($controller)) return null;
        $content = file_get_contents(APP_PATH . '/' . $module . '/Controller/' . $controller . 'Controller.class.php');

        preg_match_all("/.*?public.*?function(.*?)\\(.*?\\)/i", $content, $matches);
        $functions = $matches[1];

        //排除部分方法
        $inherents_functions = array('_before_index', '_after_index', '_initialize', '__construct', 'getActionName', 'isAjax', 'display', 'show', 'fetch', 'buildHtml', 'assign', '__set', 'get', '__get', '__isset', '__call', 'error', 'success', 'ajaxReturn', 'redirect', '__destruct', '_empty');
        //排除以指定前缀开头的方法
        $pre_inherents_functions = array('_before_', '_after_');
        foreach ($functions as $func) {
            $func = trim($func);
            foreach ($pre_inherents_functions as $pre) {
                if (stripos($func, $pre) === 0) {
                    continue 2;
                }
            }
            //过滤包含Handle的方法
            if (strstr($func, 'Handle')) {
                continue;
            }
            if (in_array($func, $inherents_functions)) {
                continue;
            }
            if (!in_array($func, $inherents_functions) && $func) { //这个地方加个判断，不然会多获取一个空的方法
                $customer_functions[] = $func;
            }

        }
        return $customer_functions;
    }
}