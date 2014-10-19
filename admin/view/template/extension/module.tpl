<?php echo $header?>
<!-- Page content -->
<div class="page-content">
    <!-- Page header -->
    <div class="page-header">
        <div class="page-title">
            <h3><?php echo $heading_title?> <small><?php echo $heading_sub_title?></small></h3>
        </div>
    </div>
    <!-- /page header -->
    <!-- Breadcrumb line -->
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <?php foreach ($breadcrumbs as $breadcrumb) { ?>
            <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
            <?php } ?>
        </ul>
    </div>
    <!-- /breadcrumb line -->
            <?php if ($success) { ?>
    <div class="alert alert-success fade in block-inner">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <i class="icon-cancel-circle"></i> <?php echo $success; ?>
    </div>
    <?php } ?>
    <div class="panel panel-default">
        <div class="panel-heading"><h6 class="panel-title"><i class="icon-puzzle4"></i> <?php echo $heading_title?></h6></div>
        <?php if ($extensions) { ?>
            <div class="list-group">
                <?php foreach ($extensions as $extension) { ?>
                <div class="list-group-item">
                    <h4 class="list-group-item-heading"><?php echo $extension['name']; ?></h4>
                    <p class="list-group-item-text"><?php echo $extension['description']; ?></p>
                    <div class="buttons">
                        <?php foreach ($extension['action'] as $action) { ?>
                        <a class="btn-sm <?php echo $action['class']?>" href="<?php echo $action['href']; ?>"><?php echo $action['text']; ?></a> 
                        <?php } ?>
                    </div>
                </div>
                <?php } ?>
            </div>
            <?php } ?>
    </div>
</div>
<?php echo $footer?>