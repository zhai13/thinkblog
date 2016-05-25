<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/5/17
 * Time: 10:39
 */
Class BlogAction extends CommonAction {
    //博文列表
    Public function index() {
        $field = array('del');  //不想读取的字段
        $where = array('del' => 0);
        $this->blog = D('BlogRelation')->field($field, true)->where($where)->relation(true)->select();    //关联所有的表
        $this->display();
    }
    //回收站
    Public function trach() {

    }

    //添加博文
    Public function blog() {
        //博文所属分类
        import('Class.Category', APP_PATH);
        $cate = M('cate')->order('sort')->select();
        $this->cate = Category::unlimitedForLevel($cate);
        //博文属性
        $this->attr = M('attr')->select();
        $this->display();
    }

    //添加博文表单处理
    Public function addBlog() {
        $data = array(
            'title' => $_POST['title'],
            'content' => $_POST['content'],
            'time' => time(),
            'click' => (int) $_POST['click'],
            'cid' => (int) $_POST['cid'],
        );
        /*
        if (isset($_POST['aid'])) {
            $data['attr'] = array();
            foreach ($_POST['aid'] as $v) {
                $data['attr'][] = $v;
            }
        }
        D('BlogRelation')->relation(true)->add($data);
        */
        //组合SQL
        if ($bid = M('blog')->add($data)) {
            if (isset($_POST['aid'])) {
                $sql = 'INSERT INTO `' . C('DB_PREFIX') . 'blog_attr` (bid, aid) VALUES';
                foreach ($_POST['aid'] as $v) {
                    $sql .= '(' . $bid . ',' . $v . '),';
                }
                $sql = rtrim($sql, ',');
                M('blog_attr')->query($sql);
            }
            $this->success('添加成功', U(GROUP_NAME . '/Blog/index'));
        } else {
            $this->error('添加失败');
        }
    }
    //编辑器图片上传处理
    Public function upload() {
        import('ORG.Net.UploadFile');
        $upload = new UploadFile();
        $upload->autoSub = true;
        $upload->subType = 'date';
        $upload->dateFormat = 'Ym';
        if ($upload->upload('./Uploads/')) {
            $info = $upload->getUploadFileInfo();
            //import('ORG.Util.Image');
            //Image::water('./Uploads/' . $info[0]['savename'], './Data/logo.png');
            import('Class.Image', APP_PATH);
            Image::water('./Uploads/' . $info[0]['savename']);
            echo json_encode(array(
                'url' => $info[0]['savename'],
                'title' => htmlspecialchars($_POST['pictitle'], ENT_QUOTES),
                'original' => $info[0]['name'],
                'state' => 'SUCCESS',
            ));
        } else {
            echo json_encode(array(
                'state' => $upload->getErrorMsg()
            ));

        }
    }
}