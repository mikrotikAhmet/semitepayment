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
<?php foreach ($page_blocks as $block) { ?>
<section class="<?php echo $block['block_data']['class']?> <?php echo str_replace(',','',$block['block_data']['additional_classes']) ?>">
    <div class="container">
        <header class="<?php echo $block['block_data']['class']?>-header">
            <?php if($block['block_data']['show_image']) { ?>
            <figure class="text-center"><img src="public/view/theme/semitepayment/img/bitcoin-outline-white.png" alt="bitcoin" width="150"></figure>
            <?php } ?>
            <?php if($block['block_data']['show_title']) { ?>
                <h2><?php echo $block['block_data']['title']?></h2>
            <?php } ?>
            <?php if($block['block_data']['show_sub_title']) { ?>
            <p class="lead"><?php echo $block['block_data']['sub_title']?></p>
            <?php } ?>
        </header>
    </div>
</section>
<?php } ?>
<?php echo $footer?>