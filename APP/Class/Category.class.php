<?php
    /*递归类*/
    Class Category {
        //组合一维数组
        Static Public function unlimitedForLevel($cate, $html ='--', $pid = 0, $level = 0) {
            $arr = array();
            foreach ($cate as $v) {
                if ($v['pid'] == $pid) {
                    $v['level'] = $level + 1;
                    $v['html'] = str_repeat($html, $level); //str_repeat填充函数
                    $arr[] = $v;    //将$v 放入$arr 下面
                    $arr = array_merge($arr, self::unlimitedForLevel($cate, $html, $v['id'], $level + 1));   //合并
                }
            }
            return $arr;
        }
        //组合多为数组
        Static Public function unlimitedForLayer($cate, $name ='child', $pid = 0) {
            $arr = array();
            foreach ($cate as $v) {
                if ($v['pid'] == $pid) {
                   $v[$name] = self::unlimitedForLayer($cate, $name, $v['id']);
                   $arr[] = $v;
                }
            }
            return $arr;
        }
        //传递一个子分类ID，返回所有的父级分类
        Static Public function getParents($cate, $id) {
            $arr = array();
            foreach ($cate as $v) {
                if ($v['id'] == $id) {
                    $arr[] = $v;
                    $arr = array_merge(self::getParents($cate, $v['pid']), $arr);
                }
            }
            return $arr;
        }
        //传递一个父级分类ID返回所有的子分类ID
        Static Public function getChildsId($cate, $pid) {
            $arr = array();
            foreach ($cate as $v) {
                if ($v['pid'] == $pid) {
                    $arr[] = $v['id'];
                    $arr = array_merge($arr, self::getChildsId($cate, $v['id']));
                }
            }
            return $arr;
        }
        //传递一个父级分类ID返回所有子级分类
        Static Public function getChildsIds($cate, $pid) {
            $arr = array();
            foreach ($cate as $v) {
                if ($v['pid'] == $pid) {
                    $arr[] = $v;
                    $arr = array_merge($arr, self::getChildsIds($cate, $v['id']));
                }
            }
            return $arr;
        }
    }
?>