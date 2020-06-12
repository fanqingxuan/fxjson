<?php $this->need('header.php'); ?>

<section class="post">
	<article>
		<header>
			<h1><?php $this->title() ?></h1>
			<span class="meta">浏览次数:<?php get_post_view($this); ?>  日期:<?php $this->date('Y-m-d H:i:s'); ?> </span>
		</header>		
		<figure>
			<?php $this->content(); ?>
		</figure>
		<footer>
			<hr>
		</footer>
	</article>
	<?php $this->need('comments.php'); ?>
</section>

<?php $this->need('footer.php'); ?>