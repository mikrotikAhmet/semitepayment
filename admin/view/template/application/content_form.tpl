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
                <div class="panel-heading"><h6 class="panel-title"><i class="icon-quill2"></i> <?php echo $heading_title?></h6></div>
                <div class="panel-body">
                    <div class="tabbable page-tabs">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab_general" data-toggle="tab"><?php echo $tab_general ?></a></li>
                            <li><a href="#tab_data" data-toggle="tab"><?php echo $tab_data ?></a></li>
                            <li><a href="#tab_revision" data-toggle="tab"><?php echo $tab_revision; ?> <?php echo ($has_revision ? '<span class="label label-danger"> '.$has_revision.' </span>' : null)?></a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active fade in" id="tab_general">
                                <div id="languages" class="htabs">
                                    <?php foreach ($languages as $language) { ?>
                                    <a href="#language<?php echo $language['language_id']; ?>" onclick="$( 'a[href=\'#menu-language<?php echo $language['language_id']?>\']' ).trigger( 'click' );"><img src="view/images/custom/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a>
                                    <?php } ?>
                                </div>
                                <?php foreach ($languages as $language) { ?>
                                <div id="language<?php echo $language['language_id']; ?>">
                                    <div class="form-group">
                                        <label for="title" class="col-sm-2 control-label"><?php echo $entry_title; ?></label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" id="title" placeholder="" name="content_description[<?php echo $language['language_id']; ?>][title]" value="<?php echo isset($content_description[$language['language_id']]) ? $content_description[$language['language_id']]['title'] : ''; ?>">
                                            <?php if (isset($error_title[$language['language_id']])) { ?>
                                            <span class="error"><?php echo $error_title[$language['language_id']]; ?></span>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="description" class="col-sm-2 control-label"><?php echo $entry_description; ?></label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control" placeholder="" name="content_description[<?php echo $language['language_id']; ?>][description]" id="description<?php echo $language['language_id']; ?>"><?php echo isset($content_description[$language['language_id']]) ? $content_description[$language['language_id']]['description'] : ''; ?></textarea>
                                                <?php if (isset($error_description[$language['language_id']])) { ?>
                                                <span class="error"><?php echo $error_description[$language['language_id']]; ?></span>
                                                <?php } ?>
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
                                </div><div class="form-group">
                                    <label for="type" class="col-sm-2 control-label"><?php echo $entry_type; ?></label>
                                    <div class="col-sm-3">
                                        <select name="type"  class="form-control">
                                            <option value=""><?php echo $text_select?></option>
                                            <?php foreach ($types as $content_type) { ?>
                                            <?php if ($type == $content_type['content_type_id']) { ?>
                                                <option value="<?php echo $content_type['content_type_id']?>" selected="selected"><?php echo $content_type['name']?></option>
                                                 <?php } else { ?>
                                                 <option value="<?php echo $content_type['content_type_id']?>"><?php echo $content_type['name']?></option>
                                                 <?php } ?>
                                            <?php } ?>
                                          </select>
                                        <?php if (isset($error_type)) { ?>
                                            <span class="error"><?php echo $error_type; ?></span>
                                            <?php } ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="keyword" class="col-sm-2 control-label"><?php echo $entry_keyword; ?></label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="keyword" placeholder="" name="keyword" value="<?php echo $keyword; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="revision" class="col-sm-2 control-label"><?php echo $entry_revision; ?></label>
                                    <div class="col-sm-3">
                                        <label class="checkbox-inline checkbox-info">
                                            <?php if ($revision) {  ?>
                                            <input type="checkbox" class="styled" name="revision" value="1" checked="checked">
                                            <?php } else { ?>
                                            <input type="checkbox" class="styled" name="revision" value="1">
                                            <?php } ?>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="revision_log" class="col-sm-2 control-label"><?php echo $entry_revision_log; ?></label>
                                    <div class="col-sm-8">
                                        <textarea class="form-control" id="revision_log" placeholder="" name="revision_log"><?php echo $revision_log; ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="review" class="col-sm-2 control-label"><?php echo $entry_review; ?></label>
                                    <div class="col-sm-3">
                                        <label class="checkbox-inline checkbox-info">
                                            <?php if ($comment) {  ?>
                                            <input type="checkbox" class="styled" name="comment" value="1" checked="checked">
                                            <?php } else { ?>
                                            <input type="checkbox" class="styled" name="comment" value="1">
                                            <?php } ?>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="status" class="col-sm-2 control-label"><?php echo $entry_status; ?></label>
                                    <div class="col-sm-2">
                                        <select name="status" class="form-control">
                                            <?php if ($status) { ?>
                                            <option value="0"><?php echo $text_disabled; ?></option>
                                            <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                                            <?php } else { ?>
                                            <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                                            <option value="1"><?php echo $text_enabled; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade in" id="tab_revision">
                                <div class="callout callout-danger fade in">
				<h5>You do not have Revisions yet.</h5>
				<p>You can start tracking Revisions for this Content by clicking the checkbox on <b>Data Tab</b> named <b>Create a new revision</b> item.</p>
                                </div>
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
<script type="text/javascript" src="view/javascript/ckeditor/ckeditor.js"></script> 
<script type="text/javascript"><!--
<?php foreach ($languages as $language) { ?>
CKEDITOR.replace('description<?php echo $language['language_id']; ?>', {
	filebrowserBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserImageBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserFlashBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserImageUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserFlashUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>'
});
<?php } ?>
//--></script>
<script type="text/javascript"><!--
    $('#languages a').tabs(); 
    //--></script>
<script type="text/javascript"><!--
<?php if ($has_revision) { ?>

    $('#tab_revision').load('index.php?route=application/content/revision&token=<?php echo $token; ?>&content_id=<?php echo $content_id?>');
    
<?php } ?>
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