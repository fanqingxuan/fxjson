<!DOCTYPE html>
<html>
<head>
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
	
	<meta http-equiv="Cache-Control" content="no-siteapp"/>
	<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=yes"/>
	
	<link rel="apple-touch-icon-precomposed" href="logo_icon.png">
	<link rel="shortcut icon" href="<?php $this->options->themeUrl('favicon.ico'); ?>" >	
	
	<!-- 输出HTML头部信息 -->
	<meta name="site" content="<?php $this->options->siteUrl(); ?>" />
	<meta name="description" content="<?php $this->options->description(); ?>" />
	<meta name="keywords" content="<?php $this->options->keywords(); ?>" />	
	<title><?php if($this->is('index')){ ?> 
	<?php if ($this->options->subtitle): 
		$this->options->subtitle(); 
	else: echo '你可能没有填写副标题'; 
	endif; ?> - <?php $this->options->title(); ?> <?php if($this->_currentPage>1) echo ' 第 '.$this->_currentPage.' 页 '; ?><?php } else  { ?><?php $this->archiveTitle('', '', ''); ?> - <?php $this->options->title(); ?><?php } ?>
	</title>
	
	<link rel="stylesheet" type="text/css" media="all" href="<?php $this->options->themeUrl('style.css'); ?>">
	
	<?php $this->header('description=&keywords=&generator=&template=&pingback=&xmlrpc=&wlw=&rss1=&rss2=&atom='); ?>
</head>

<body>
	<div class="mask mt"></div><div class="mask mb"></div><div class="mask ml"></div><div class="mask mr"></div>
	<main>
		<header>
			<h1><a href="<?php $this->options->siteUrl(); ?>" alt="<?php $this->options->title() ?>"><?php $this->options->title() ?></a></h1>
			<span><?php if ($this->options->subtitle): 
		$this->options->subtitle(); 
	else: echo '你可能没有填写副标题'; 
	endif; ?></span>
		</header>
	
		<div class="box">
            <nav>
                <?php $this->widget('Widget_Metas_Category_List')->parse('<a href="{permalink}">{name}</a>'); ?>
                <?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
                    <?php while($pages->next()): ?>
                    <a<?php if($this->is('page', $pages->slug)): ?> class="current"<?php endif; ?> href="<?php $pages->permalink(); ?>" title="<?php $pages->title(); ?>"><?php $pages->title(); ?></a>
                <?php endwhile; ?>
            </nav>
            <div class="site-search">
                <form class="site-search-form" id="search" method="post" action="" role="search">
                    <input id="st-search-input" type="text" name="s" class="text" placeholder="<?php _e('输入关键字搜索'); ?>" />
                </form>
            </div>
       </div>
		