<div id="comments">

<?php $this->comments()->to($comments); ?>

<?php if($this->allow('comment')): ?>	
	<div id="<?php $this->respondId(); ?>" class="respond">
        <div class="cancel-comment-reply">
            <?php $comments->cancelReply(); ?>
		</div>
        
		<span id="response" class="widget-title text-left"><?php _e('添加新评论'); ?> &raquo;</span>
        <form method="post" action="<?php $this->commentUrl() ?>" id="comment-form">
			<?php if($this->user->hasLogin()): ?>
			<p style="line-height: 30px;">当前登录用户 <a href="<?php $this->options->profileUrl(); ?>"><?php $this->user->screenName(); ?></a>. <a href="<?php $this->options->logoutUrl(); ?>" title="Logout"><?php _e('退出'); ?> &raquo;</a></p>
			<?php else: ?>
            <input type="text" name="author" id="author" placeholder="Name *" required value="<?php $this->remember('author'); ?>">
            <input type="email" name="mail" id="mail" placeholder="Email *" required value="<?php $this->remember('mail'); ?>">
            <input type="url" name="url" id="url" placeholder="http:// *" required value="<?php $this->remember('url'); ?>">
            <?php endif; ?>
			<p><textarea rows="5" name="text" id="textarea" required placeholder="请勿做无意义的评论..." style="resize:none;"><?php $this->remember('text'); ?></textarea></p>
            <p><input type="submit" value="<?php _e('提交评论'); ?>" data-now="刚刚" data-init="Submit" data-posting="提交评论中..." data-posted="评论提交成功" data-empty-comment="必须填写评论内容" class="button" id="submit"></p>
            <input type="hidden" name="_" value="c7d0b8d21ccb592d2bac2aa446cb5f8b"></form>
    </div>
<?php else: ?>
    <h4><?php _e('评论已关闭'); ?></h4>
<?php endif; ?>

<?php if ($comments->have()): ?>
	<div class="comments">
		<h4 class="title"><?php $this->commentsNum(_t('当前暂无评论'), _t('仅有一条评论'), _t('已有 %d 条评论')); ?> &raquo;</h4>
		<?php $comments->pageNav(); ?>
		<?php $comments->listComments(); ?>
	</div>   
<?php endif; ?>

</div>
