<?php echo $header?>
<?php if ($this->page->getFeatured()) { ?>
<di class="featured">
    <div class="container"><?php echo $this->page->getFeatured() ?></div>
</di>
<?php } ?>
<?php echo $footer?>