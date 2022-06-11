<?php

//载入配置支持  
require_once 'config.inc.php';

//载入数据库支持  
require_once 'Typecho/Db.php';
//wechat 
require_once 'var/wechat.class.php';



$options = array(
        'token'=>'hdboy2018', //填写你设定的key
        'encodingaeskey'=>'eWjW9H3UpgbHwk5puTMHqPFTzkZKMAt91k7ovYCTxJR', //填写加密用的EncodingAESKey
        'appid'=>'wx94c9216187e73c86', //填写高级调用功能的app id
        'appsecret'=>'19cf39d532dc69cf7a270a18906dffdd' //填写高级调用功能的密钥
    );
$weObj = new Wechat($options);
$weObj->valid();
$type = $weObj->getRev()->getRevType();
$optionObj = Helper::options();

switch($type) {
    case Wechat::MSGTYPE_TEXT:
        $keywords = $weObj->getRev()->getRevContent();
        $news = getArticleList($keywords);
        $weObj->news($news)->reply();
        break;
    case Wechat::MSGTYPE_EVENT:
    case Wechat::MSGTYPE_IMAGE:
        $news = getArticleList();
        $weObj->news($news)->replay();
        break;
    default:
        $weObj->text("help info")->reply();
}


function getArticleList($keywords) {
    
    global $db,$optionObj;

    $query = $db->select('cid','title')
            ->from('table.contents')
            ->where("status = ?","publish")
            ->where("type = ?",'post');
    if($keywords) {
         $searchQuery = '%' . str_replace(' ', '%', $keywords) . '%';
        /** 搜索无法进入隐私项保护归档 */
        $query = $query->where('table.contents.password IS NULL')
        ->where('table.contents.title LIKE ? OR table.contents.text LIKE ?', $searchQuery, $searchQuery);
    }       
    
    $sql = $query->order('created',Typecho_Db::SORT_ASC)
            ->limit(10);
    $list = $db->fetchAll($sql);

    $newsList = [];
    foreach($list as $value) {
        $newsInfo = [
            'Title'         =>  $value['title'],
            'Description'   =>  $value['title'],
            'PicUrl'        =>  "www",
            'Url'           =>  Typecho_Common::url("/archives/".$value['cid'], $optionObj->index)
        ];
        $newsList[] = $newsInfo;
    }
    return $newsList;
}
