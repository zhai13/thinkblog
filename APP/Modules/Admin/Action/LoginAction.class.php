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
    Public function varify() {
        import('ORG.Util.Image');
        Image::buildImageVerify();
    }
}