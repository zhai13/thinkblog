<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/5/17
 * Time: 10:39
 * 后台登陆控制器
 */
Class LoginAction extends Action {
    //登陆页面视图
    Public function index() {
        $this->display();
    }
    Public function verify() {
        import('Class.Image', APP_PATH);    //引入自定义类
        Image::verify();    //调用verify函数
    }
}