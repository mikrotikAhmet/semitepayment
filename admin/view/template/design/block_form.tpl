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
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger fade in block-inner">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <i class="icon-cancel-circle"></i> <?php echo $error_warning; ?>
    </div>
    <?php } ?>
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form" class="form-horizontal form-bordered" role="form" id="form">
            <div class="panel panel-default">
                <div class="panel-heading"><h6 class="panel-title"><i class="icon-cube"></i> <?php echo $heading_title?></h6></div>
                <div class="panel-body">
                    <div class="tabbable page-tabs">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab_general" data-toggle="tab"><?php echo $tab_general ?></a></li>
                            <li><a href="#tab_data" data-toggle="tab"><?php echo $tab_data ?></a></li>
                            <li><a href="#tab_block_content" data-toggle="tab"><?php echo $tab_block_content ?></a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active fade in" id="tab_general">
                                <div id="languages" class="htabs">
                                    <?php foreach ($languages as $language) { ?>
                                    <a href="#language<?php echo $language['language_id']; ?>" ><img src="view/images/custom/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a>
                                    <?php } ?>
                                </div>
                                <?php foreach ($languages as $language) { ?>
                                <div id="language<?php echo $language['language_id']; ?>">
                                    <div class="form-group">
                                        <label for="title" class="col-sm-2 control-label"><?php echo $entry_title; ?></label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" id="title" placeholder="" name="block_description[<?php echo $language['language_id']; ?>][title]" value="<?php echo isset($block_description[$language['language_id']]) ? $block_description[$language['language_id']]['title'] : ''; ?>">
                                            <?php if (isset($error_title[$language['language_id']])) { ?>
                                            <span class="error"><?php echo $error_title[$language['language_id']]; ?></span>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="sub_title" class="col-sm-2 control-label"><?php echo $entry_sub_title; ?></label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" id="sub_title" placeholder="" name="block_description[<?php echo $language['language_id']; ?>][sub_title]" value="<?php echo isset($block_description[$language['language_id']]) ? $block_description[$language['language_id']]['sub_title'] : ''; ?>">
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                            <div class="tab-pane fade in" id="tab_data">
                                <div class="form-group">
                                    <label for="image" class="col-sm-2 control-label"><?php echo $entry_image; ?></label>
                                    <div class="col-sm-3">
                                        <div class="image"><img src="<?php echo $thumb; ?>" alt="" id="thumb" class="img-thumbnail"/>
                                            <input type="hidden" name="image" value="<?php echo $image; ?>" id="image" />
                                            <br />
                                            <button type="button" onclick="image_upload('image', 'thumb');" class="btn btn-primary btn-xs"><?php echo $text_browse; ?></button>&nbsp;&nbsp;|&nbsp;&nbsp;<button type="button" class="btn btn-danger btn-xs" onclick="$('#thumb').attr('src', '<?php echo $no_image; ?>'); $('#image').attr('value', '');"><?php echo $text_clear; ?></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="class" class="col-sm-2 control-label"><?php echo $entry_class; ?></label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" value="<?php echo $class?>" name="class"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="additional_classes" class="col-sm-2 control-label"><?php echo $entry_additional_classes; ?></label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" value="<?php echo $additional_classes?>" name="additional_classes"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="show_image" class="col-sm-2 control-label"><?php echo $entry_show_image; ?></label>
                                    <div class="col-sm-3">
                                        <label class="checkbox-inline checkbox-info">
                                            <?php if ($show_image) {  ?>
                                            <input type="checkbox" class="styled" name="show_image" value="1" checked="checked">
                                            <?php } else { ?>
                                            <input type="checkbox" class="styled" name="show_image" value="1">
                                            <?php } ?>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="show_title" class="col-sm-2 control-label"><?php echo $entry_show_title; ?></label>
                                    <div class="col-sm-3">
                                        <label class="checkbox-inline checkbox-info">
                                            <?php if ($show_title) {  ?>
                                            <input type="checkbox" class="styled" name="show_title" value="1" checked="checked">
                                            <?php } else { ?>
                                            <input type="checkbox" class="styled" name="show_title" value="1">
                                            <?php } ?>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="show_sub_title" class="col-sm-2 control-label"><?php echo $entry_show_sub_title; ?></label>
                                    <div class="col-sm-3">
                                        <label class="checkbox-inline checkbox-info">
                                            <?php if ($show_sub_title) {  ?>
                                            <input type="checkbox" class="styled" name="show_sub_title" value="1" checked="checked">
                                            <?php } else { ?>
                                            <input type="checkbox" class="styled" name="show_sub_title" value="1">
                                            <?php } ?>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade in" id="tab_block_content">
                                Block Content Here!<br/>
                                <p>Rows</p>
                                <p>Row Units</p>
                            </div>
                        </div>
                    </div>
                    <br/>
                    <div class="form-actions text-right">
                        <input type="submit" value="<?php echo $button_save; ?>" class="btn btn-primary">
                        <button type="button" onclick="window.location = '<?php echo $cancel?>'" class="btn btn-danger btn-sm"><?php echo $button_cancel; ?></button>
                    </div>
                </div>
            </div>
        </form>
</div>
<script type="text/javascript"><!--
    $('#languages a').tabs(); 
    //--></script>
<script type="text/javascript"><!--
  
    
function image_upload(field, thumb) {
	$('#dialog').remove();
	
	$('#filemanager').prepend('<div id="dialog" style="padding: 3px 0px 0px 0px;"><iframe src="index.php?route=common/filemanager&token=<?php echo $token; ?>&field=' + encodeURIComponent(field) + '" style="padding:0; margin: 0; display: block; width: 100%; height: 100%;" frameborder="no" scrolling="auto"></iframe></div>');
	
	$('#dialog').dialog({
		title: '<?php echo $text_image_manager; ?>',
		close: function (event, ui) {
			if ($('#' + field).attr('value')) {
				$.ajax({
					url: 'index.php?route=common/filemanager/image&token=<?php echo $token; ?>&image=' + encodeURIComponent($('#' + field).val()),
					dataType: 'text',
					success: function(data) {
						$('#' + thumb).replaceWith('<img src="' + data + '" alt="" id="' + thumb + '" class="img-thumbnail"/>');
					}
				});
			}
		},	
		bgiframe: false,
		width: 800,
		height: 400,
		resizable: false,
		modal: false
	});
};
//--></script> 
<?php echo $footer?>