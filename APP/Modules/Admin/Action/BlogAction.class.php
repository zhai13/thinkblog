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
        $this->blog = D('BlogRelation')->getBlogs();
        $this->display();
    }
    //删除到回收站/还原
    Public function toTrach () {
        $type = (int) $_GET['type'];
        $msg = $type ? '删除' : '还原';
        $update = array(
            'id' => (int) $_GET['id'],
            'del' => $type,
        );
        if (M('blog')->save($update)) {
            $this->success($msg . '成功', U(GROUP_NAME . '/Blog/index'));
        } else {
            $this->error($msg . '失败');
        }
    }

    //回收站
    Public function trach() {
        $this->blog = D('BlogRelation')->getBlogs(1);
        $this->display('index');
    }

    //彻底删除
    Public function delete() {
        $id = (int) $_GET['id'];
        if (M('blog')->delete($id)) {
            M('blog_attr')->where(array('bid' => $id))->delete();
            $this->success('删除成功', U(GROUP_NAME . '/Blog/trach'));
        } else {
            $this->error('删除失败');
        }
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