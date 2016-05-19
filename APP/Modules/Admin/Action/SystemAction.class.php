<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/5/17
 * Time: 10:39
 * 系统设置控制器
 */

Class SystemAction extends CommonAction {
    //验证码设置
    Public function verify() {
        $this->display();
    }
    //更新验证码配置文件
    Public function updateVerify() {
        //F('文件的名称', 要写入的数据, 写文件的位置)方法，写文件 || CONF_PATH:配置项路径
        if (F('verify', $_POST, CONF_PATH)) {
            $this->success('修改成功', U(GROUP_NAME . '/System/verify'));
        } else {
            $this->success('修改失败，请修改' . CONF_PATH . 'verify.php权限');
        }
    }
}