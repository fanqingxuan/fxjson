<?php

// 设置时区
date_default_timezone_set('Asia/Shanghai');

function themeConfig($form) {
    $subtitle = new Typecho_Widget_Helper_Form_Element_Text('subtitle', NULL, NULL, _t('网站副标题'), _t('将显示在首页标题和首页Logo下'));
    $form->addInput($subtitle);
	
	$links = new Typecho_Widget_Helper_Form_Element_Textarea('links', NULL, '', _t('友情链接'), _t('网页底部友情链接，直接填写代码即可'));
    $form->addInput($links);
	
	$beian = new Typecho_Widget_Helper_Form_Element_Text('beian', NULL, NULL, _t('网站备案号'), _t('网页底部的备案号'));
    $form->addInput($beian);
	
	$stat = new Typecho_Widget_Helper_Form_Element_Textarea('stat', NULL, NULL, _t('统计代码'), _t('网站统计代码'));
    $form->addInput($stat);
}

/*文章阅读次数统计*/
function get_post_view($archive) {
    $cid = $archive->cid;
    $db = Typecho_Db::get();
    $prefix = $db->getPrefix();
    if (!array_key_exists('views', $db->fetchRow($db->select()->from('table.contents')))) {
        $db->query('ALTER TABLE `' . $prefix . 'contents` ADD `views` INT(10) DEFAULT 0;');
        echo 0;
        return;
    }
    $row = $db->fetchRow($db->select('views')->from('table.contents')->where('cid = ?', $cid));
    if ($archive->is('single')) {
        $views = Typecho_Cookie::get('extend_contents_views');
        if (empty($views)) {
            $views = array();
        } else {
            $views = explode(',', $views);
        }
        if (!in_array($cid, $views)) {
            $db->query($db->update('table.contents')->rows(array('views' => (int)$row['views'] + 1))->where('cid = ?', $cid));
            array_push($views, $cid);
            $views = implode(',', $views);
            Typecho_Cookie::set('extend_contents_views', $views); //记录查看cookie
            
        }
    }
    echo $row['views'];
}



/**
* 格式化时间
*/
function formatTime($time){
    $text='';
    $time=intval($time);
    $ctime=time();
    $t=$ctime-$time;//时间差
    if($t<0){
		returndate('Y-m-d',$time);
    }
    $y=date('Y',$ctime)-date('Y',$time);//是否跨年
    switch($t){
		case$t==0:
			$text='刚刚';
			break;
		case$t<60://一分钟内
			$text=$t.'秒前';
			break;
		case$t<3600://一小时内
			$text=floor($t/60).'分钟前';
			break;
		case$t<86400://一天内
			$text=floor($t/3600).'小时前';//一天内
			break;
		case$t<2592000://30天内
			if($time>strtotime(date('Ymd',strtotime("-1day")))){
				$text='昨天';
			}elseif($time>strtotime(date('Ymd',strtotime("-2days")))){
				$text='前天';
			}else{
				$text=floor($t/86400).'天前';
			}
			break;
		case$t<31536000&&$y==0://一年内不跨年
			$m=date('m',$ctime)-date('m',$time)-1;
			if($m==0){
				$text=floor($t/86400).'天前';
			}else{
				$text=$m.'个月前';
			}
			break;
		case$t<31536000&&$y>0://一年内跨年
			$text=(11-date('m',$time)+date('m',$ctime)).'个月前';
			break;
		default:
			$text=(date('Y',$ctime)-date('Y',$time)).'年前';
			break;
	}
    return$text;
}

// 手机端判断
function isMobile()
{ 
    // 如果有HTTP_X_WAP_PROFILE则一定是移动设备
    if (isset ($_SERVER['HTTP_X_WAP_PROFILE']))
    {
        return true;
    } 
    // 如果via信息含有wap则一定是移动设备,部分服务商会屏蔽该信息
    if (isset ($_SERVER['HTTP_VIA']))
    { 
        // 找不到为flase,否则为true
        return stristr($_SERVER['HTTP_VIA'], "wap") ? true : false;
    } 
    // 脑残法，判断手机发送的客户端标志,兼容性有待提高
    if (isset ($_SERVER['HTTP_USER_AGENT']))
    {
        $clientkeywords = array ('nokia',
            'sony',
            'ericsson',
            'mot',
            'samsung',
            'htc',
            'sgh',
            'lg',
            'sharp',
            'sie-',
            'philips',
            'panasonic',
            'alcatel',
            'lenovo',
            'iphone',
            'ipod',
            'blackberry',
            'meizu',
            'android',
            'netfront',
            'symbian',
            'ucweb',
            'windowsce',
            'palm',
            'operamini',
            'operamobi',
            'openwave',
            'nexusone',
            'cldc',
            'midp',
            'wap',
            'mobile'
            ); 
        // 从HTTP_USER_AGENT中查找手机浏览器的关键字
        if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT'])))
        {
            return true;
        } 
    } 
    // 协议法，因为有可能不准确，放到最后判断
    if (isset ($_SERVER['HTTP_ACCEPT']))
    { 
        // 如果只支持wml并且不支持html那一定是移动设备
        // 如果支持wml和html但是wml在html之前则是移动设备
        if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html'))))
        {
            return true;
        } 
    } 
    return false;
} 
