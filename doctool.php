<?php

/** 载入配置支持 */
require_once 'config.inc.php';

/** 载入数据库支持 */
require_once 'Typecho/Db.php';

/*****************************************************
 *													 *
 *													 *
 *					查询数据库相关内容				 *
 *													 *
 *													 *
 *****************************************************/
/**查询已发布,公开的文章**/
$sql = $db->select('cid','title','text')
			->from('table.contents')
			->where("status = ?","publish")
			->where("type = ?",'post')
			->order('created',Typecho_Db::SORT_ASC);
$list = $db->fetchAll($sql);
$articleDict = array_column($list,null,'cid');

/**查询已发布,公开的单页**/
$sql = $db->select('cid','title','text')
			->from('table.contents')
			->where("status = ?","publish")
			->where("type = ?",'page')
			->order('created',Typecho_Db::SORT_ASC);
$pageList = $db->fetchAll($sql);

/**查询分类**/
$sql = $db->select('mid','name')
			->from('table.metas')
			->where("type = ?","category")
			->where("parent = ?",0)
			->order('order',Typecho_Db::SORT_ASC);
$catlist = $db->fetchAll($sql);
$catDict = array_column($catlist,'name','mid');

/**分类文章关系**/
$sql = $db->select('mid','cid')
			->from('table.relationships');
$tmprelationShip = $db->fetchAll($sql);
$relationDict = array();
foreach($tmprelationShip as $value) {
	$relationDict[$value['mid']][] = $value['cid'];
}

/*****************************************************
 *													 *
 *													 *
 *			生成markdown,推送到github        		 *
 *													 *
 *													 *
 *****************************************************/
 
$markdown_dir = "markdown";
mkdir($markdown_dir,755);
mkdir($markdown_dir."/src",755);
$readme_text = <<<EOF
# 个人博客

> 记录工作或者开发过程中遇到的各种问题，同时将碎片化知识进行整理记录，一来给有需要的朋友以帮助，二来作为笔记，避免重复入坑，降低效率。


目录

EOF;
foreach($relationDict as $mid => $_list) {
	$readme_text .= "* ".$catDict[$mid].PHP_EOL;
	foreach($_list as $cid) {
		if(!isset($articleDict[$cid])) continue;
		print_r($articleDict[$cid]['text']);
		$dest_file = "src/".$articleDict[$cid]['title'].".md";
		$readme_text .= "\t* [".$articleDict[$cid]['title']."](".$dest_file.")".PHP_EOL;
		file_put_contents($markdown_dir."/".$dest_file,$articleDict[$cid]['text']."");
	}
	
}
file_put_contents($markdown_dir."/Readme.md",$readme_text);
//deldir($markdown_dir.'/');

function deldir($path){
   //如果是目录则继续
   if(is_dir($path)){
		//扫描一个文件夹内的所有文件夹和文件并返回数组
		$p = scandir($path);
		foreach($p as $val){
			//排除目录中的.和..
			if($val !="." && $val !=".."){
				//如果是目录则递归子目录，继续操作
				if(is_dir($path.$val)){
					//子目录中操作删除文件夹和文件
					deldir($path.$val.'/');
					//目录清空后删除空文件夹
					@rmdir($path.$val.'/');
				}else{
				  //如果是文件直接删除
				  unlink($path.$val);
				}
			}
		}
		@rmdir($path);
	}
}