<?php $this->need('header.php'); ?>

<section class="list">
	<?php while($this->next()): ?>
	<article>
		[<?php $this->category(','); ?>] <a class="title" href="<?php $this->permalink() ?>"><?php $this->title() ?></a>   <span class="meta"><?php $this->date('Y-m-d H:i:s'); ?> </span>
	</article>
	<?php endwhile; ?>
	
	<?php $this->pageNav('上一页', '下一页', 5, '...'); ?>
</section>	
	
<?php $this->need('footer.php'); ?>