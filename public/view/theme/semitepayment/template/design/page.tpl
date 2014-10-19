<?php echo $header?>
<?php if ($this->page->getFeatured()) { ?>
    <div class="featured">
        <div class="container"><?php echo $this->page->getFeatured() ?></div>
    </div>
<?php } else?>
<?php if ($this->page->getPageTitle()) { ?>
<div class="dark">
    <div class="jumbotron">
    <div class="container">
      <div class="row">
        <div class="col-md-8 col-md-offset-2 text-center" id="centered-title">
          <h1 class="primary-text"><?php echo $this->page->getPageTitle()?></h1>
          <p class="lead"><?php echo $this->page->getPageSubTitle()?></p>
        </div>
      </div>
    </div>
  </div>
</div>
<?php } ?>
<?php foreach ($page_blocks as $block) { ?>
<section class="<?php echo $block['block_data']['class']?> <?php echo str_replace(',','',$block['block_data']['additional_classes']) ?>">
    <div class="container">
        <?php if ($block['block_data']['show_title']) { ?>
        <header class="<?php echo $block['block_data']['class']?>-header">
            <?php if($block['block_data']['show_image']) { ?>
            <figure class="text-center"><img src="<?php echo $block['block_data']['image']?>" alt="bitcoin" width="150"></figure>
            <?php } ?>
            <?php if($block['block_data']['show_title']) { ?>
                <h2><?php echo $block['block_data']['title']?></h2>
            <?php } ?>
            <?php if($block['block_data']['show_sub_title']) { ?>
            <p class="lead"><?php echo $block['block_data']['sub_title']?></p>
            <?php } ?>
        </header>
        <?php } ?>
        <?php foreach ($block['block_unit_data']['block_unit'] as $block_unit) { 
            $subjects = unserialize($block_unit['subject']);
        ?>
        <div class="<?php echo $block_unit['class']?> <?php echo $block_unit['additional_class']?>">
            <?php if ($subjects) { ?>
            <?php foreach ($subjects as $subject) { ?>
            <div class="<?php echo $subject['column']?>">
                <?php if ($subject['type'] == 'content') { ?>
                <?php $this->content->setContent($subject['subject_id'])?>
                
                <?php if ($this->content->getReplaceImage()) { ?>
                <i class="<?php echo $this->content->getGlypIcon()?>"></i>
                <?php } else { ?>
                <?php if ($this->content->getImage()) { ?>
                <?php if (empty($block_unit['additional_class'])) { ?>
                    <span><img src="<?php echo $this->content->getImage()?>"></span>
                <?php } else { ?>
                    <span class="img-responsive wow fade-in-up animated" style="visibility: visible;"><img src="<?php echo $this->content->getImage($this->config->get('config_featured_image_width'),$this->config->get('config_featured_image_height'))?>"></span>
                <?php } ?>
                <?php } ?>
                <?php } ?>
                <?php if ($this->content->getTitle()) { ?>
                <h3 class="h4"><?php echo $this->content->getTitle()?></h3>
                <?php } ?>
                <?php if ($this->content->getContent()) { ?>
                <?php echo $this->content->getContent()?>
                <?php } ?>
                <?php } elseif ($subject['type'] == 'module') {  ?>
                <?php 
                    if ($modules){
                        foreach ($modules as $key=>$module){
                            
                                echo $module;
                                $modules = array();
                            
                        }
                    }
                ?>
                <?php } ?>
            </div>
            <?php } ?>
            <?php } ?>
        </div>
        <?php } ?>
    </div>
</section>
<?php } ?>
<?php echo $footer?>