<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/5/19
 * Time: 13:56
 */
//自定义P方法打印
function p($arr) {
    echo '<pre>' .print_r($arr, true) . '</pre>';
}