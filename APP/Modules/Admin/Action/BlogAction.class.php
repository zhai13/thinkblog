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
        $this->display();
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
        if (isset($_POST['aid'])) {
            $data['attr'] = array();
            foreach ($_POST['aid'] as $v) {
                $data['attr'][] = $v;
            }
        }
        D('BlogRelation')->relation(true)->add($data);
        $this->display();
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