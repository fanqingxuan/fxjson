	<footer>
	<p class="ftlinks"><?php if ($this->options->links){	$this->options->links(); } ?></p>
	<a href="<?php $this->options->siteurl(); ?>"><?php $this->options->title(); ?></a> 版权所有.<?php if ($this->options->beian){	$this->options->beian(); } ?><div style="display:none;"><?php $this->options->stat(); ?></div></footer><!-- end #footer -->
</main>
<span class="water"></span>
<?php $this->footer(); ?>
</body>
</html>
