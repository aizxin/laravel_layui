<?php
return [
	'title' 	=> '权限管理',
	'desc' 		=> '权限列表',
	'create' 	=> '添加权限',
	'edit' 		=> '修改权限',
	'model' 	=> [
		'id' 			=> '编号',
		'parent_id'     => '上级权限',
		'name' 			=> '权限名称',
		'slug' 			=> '权限别名',
        'ismenu' 	=> '是否菜单',
        'issort' 	=> '权限排序',
        'icon' 		=> '权限图标',
        'description' 		=> '权限描述',
        'created_at' 	=> '创建时间',
        'updated_at' 	=> '修改时间',
	],
	'placeholder' => [
		'parent_id'     => '顶级分类',
		'name' 			=> '请输入权限名称',
		'slug' 			=> '请输入权限别名',
        'ismenu' 	=> '是否菜单',
        'issort' 	=> '权限排序',
        'icon' 		=> '请输入图标',
        'description' 		=> '权限描述',
        'created_at' 	=> '创建时间',
        'updated_at' 	=> '修改时间',
	],

];