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
    <div class="panel panel-default">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form" class="form-horizontal form-bordered" role="form" id="form">
            <div class="panel panel-default">
                <div class="panel-heading"><h6 class="panel-title"><i class="icon-quill2"></i> <?php echo $heading_title?></h6></div>
                <div class="panel-body">
                    <div class="tab-pane fade in" id="tab_revision">
                        <div class="callout callout-danger fade in">
                        <h5><?php echo $heading_title?></h5>
                        <p><?php echo $text_content_howto?></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="content_type" class="col-sm-2 control-label"><?php echo $entry_select_type; ?></label>
                        <div class="col-sm-2">
                            <?php foreach ($content_types as $content_type) { ?>
                            <label class="radio-inline radio-info">
                                    <input type="radio" onclick="setType(this.value);" name="type" class="styled" value="<?php echo $content_type['content_type_id']?>">
                                    <?php echo $content_type['name']?>
                            </label>
                            <div class=clearfix""></div>
                            <?php } ?>
                            
                        </div>
                    </div>
                    <div class="form-actions text-right">
                        <button type="button" onclick="continueContent()" class="btn btn-primary"><?php echo $button_continue; ?></button>
                        <button type="button" onclick="window.location = '<?php echo $cancel?>'" class="btn btn-danger btn-sm"><?php echo $button_cancel; ?></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    var selection = "";
    $.removeCookie("content_type");
    
    function setType(value){
    
    selection = value;
}

function continueContent(){
    $.cookie("content_type", selection);
    
    window.location = 'index.php?route=application/content/insert&token=<?php echo $token?>';
}
</script>
<?php echo $footer?>