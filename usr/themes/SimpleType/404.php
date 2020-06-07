<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=yes"/>
<link rel="shortcut icon" href="<?php $this->options->themeUrl('favicon.ico'); ?>" >

<title>404没有这个页面</title>
<style type="text/css">
<!--
.error404{background-color: #0099CC;font-family: "微软雅黑";}
.error404title{font-size: 100px;}
.error404go{font-size: 24px;}
.error404des{font-size: 16px;}
.error404des a{border:1px solid #eee;color:#fff;border-radius:5px;padding:3px 5px;text-decoration: none;}
.error404des a:hover{border:1px solid #eee;color:#fff;}
-->
</style>
</head>
<body class="error404">
<script language="javascript" type="text/javascript">
    setTimeout(function () { this.location.href = "<?php $this->options->siteUrl(); ?>" }, 5000);
</script>
<span class="error404title">&nbsp;:(</span>
<p class="error404go">对不起，您输入的网址没有找到。<br/>5秒后为您跳转到首页！</p>
<p class="error404des">如果您想了解更多信息，点击该链接: <a href="<?php $this->options->siteUrl(); ?>404error.html">404 页面未找到怎么办？</a></p>
</body>
</html>