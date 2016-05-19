<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/5/19
 * Time: 14:29
 * 公用控制器
 */
Class CommonAction extends Action {
    Public function _initialize () {    //_initialize：自动运行的方法
        if (!isset($_SESSION['uid'])) {   //判断如果没有登陆就跳转至登陆页
            $this->redirect(GROUP_NAME . '/Login/index');
        }
    }
}