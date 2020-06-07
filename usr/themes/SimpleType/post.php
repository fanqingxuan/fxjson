<?php $this->need('header.php'); ?>

<section class="post">
	<article>
		<header>
			<h1><?php $this->title() ?></h1>
			<span class="meta">浏览次数:<?php get_post_view($this); ?> 日期:<?php $this->date('Y-m-d H:i:s'); ?> </span>
		</header>		
		<figure>
			<?php $this->content(); ?>
			<p>最后更新时间为: <?php echo formatTime($this->modified);?> (<?php $this->date('Y-m-d H:i:s'); ?>)</p>
		</figure>
		<footer>
			<hr>
                原创作品，转载请注明出处
			<hr>
		</footer>
	</article>
	
	<ul class="post-near">
		<li>上一篇: <?php $this->thePrev('%s','没有了'); ?></li>
		<li>下一篇: <?php $this->theNext('%s','没有了'); ?></li>
	</ul>
	
	<?php $this->need('comments.php'); ?>
</section>
	
<?php $this->need('footer.php'); ?>
