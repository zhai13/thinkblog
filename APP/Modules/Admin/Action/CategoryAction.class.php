<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/5/17
 * Time: 10:39
 */
Class CategoryAction extends CommonAction {
    /*分类列表视图*/
    Public function index() {
        import('Class.Category', APP_PATH);     //引入无限极分类的类
        $cate = M('cate')->order('sort ASC')->select(); //查找出所有分类
        $this->cate = Category::unlimitedForLevel($cate, '&nbsp;&nbsp;--');     //调用无限极分类并赋值到模板
        $this->display();   //显示到模板
    }

    /*添加分类视图*/
    Public function addCate() {
        //$pid = isset($_GET['pid']) ? $_GET['pid'] : 0; 判断是否顶级分类传统写法
        $this->pid = I('pid', 0, 'intval');     //I方法获取传递过来的参数('参数名', 默认值, 转换方式)
        $this->display();
    }

    /*添加分类表单处理*/
    Public function rumAddCate() {
        if (M('cate')->add($_POST)) {   //将数据添加至数据库
            $this->success('添加成功', U(GROUP_NAME . '/Category/index'));    //添加成功后跳转至分类列表
        }
    }

    /*更新排序表单处理*/
    Public function sortCate() {
        $db = M('cate');
        foreach ($_POST as $id => $sort) {
            //更新一个字段↓
            $db->where(array('id' => $id))->setField('sort', $sort);
        }
        $this->redirect(GROUP_NAME . '/Category/index');
    }
}