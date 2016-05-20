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
        $cate = M('cate')->order('sort ASC')->select(); //查找出所有分类
        $this->cate = $cate;    //通过对象的形式把数据分配到模板上,要在模板中输出变量，必须在在Action类中把变量传递给模板
        $this->display();   //显示到模板
    }

    /*添加分类视图*/
    Public function addCate() {
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