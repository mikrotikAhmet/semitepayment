<?php echo $header?>
<?php if ($this->page->getFeatured()) { ?>
    <div class="featured">
        <div class="container"><?php echo $this->page->getFeatured() ?></div>
    </div>
<?php } ?>
<?php if ($this->page->getPageTitle()) { ?>
<div class="dark">
    <div class="jumbotron">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <h1 class="primary-text"><?php echo $this->page->getPageTitle()?></h1>
          <p class="secondary-text"><?php echo $this->page->getPageSubTitle()?></p>
        </div>
      </div>
    </div>
  </div>
</div>
<?php } ?>
<?php echo $footer?>