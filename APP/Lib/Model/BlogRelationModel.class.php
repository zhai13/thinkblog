<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/5/23 0023
 * Time: 22:23
 */
/*关联模型*/
Class BlogRelationModel extends RelationModel {
    Protected $tableName = 'blog';  //指定要执行的表
    Protected $_link = array(   //定义关联哪些表
        'attr' => array(
            'mapping_type' => MANY_TO_MANY, //多对多的关系
            'mapping_name' => 'attr',   //指定关联表的名称 
            'foreign_key' => 'bid',   //定义外键
            'relation_foreign_key' => 'aid',
            'relation_table' => 'thinkblog_blog_attr', //中间表
        ),
    );
}