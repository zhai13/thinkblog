<?php
    /*递归类*/
    Class Category {
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
    }
?>