<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/5/17
 * Time: 10:39
 * 后台首页控制器
 */
Class IndexAction extends CommonAction {
    //首页视图
    Public function index() {
        $this->display();
    }

    //退出登录
    Public function logout() {
        session_unset();    //销毁会话
        session_destroy();  //彻底终结session
        $this->redirect(GROUP_NAME . '/Login/index');
    }
}