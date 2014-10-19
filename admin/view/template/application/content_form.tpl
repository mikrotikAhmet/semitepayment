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
                            <li><a href="#tab_link" data-toggle="tab"><?php echo $tab_links ?></a></li>
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
                                    <?php if (in_array('description', $fields)) { ?>
                                    <div class="form-group">
                                        <label for="description" class="col-sm-2 control-label"><?php echo $entry_description; ?></label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control" placeholder="" name="content_description[<?php echo $language['language_id']; ?>][description]" id="description<?php echo $language['language_id']; ?>"><?php echo isset($content_description[$language['language_id']]) ? $content_description[$language['language_id']]['description'] : ''; ?></textarea>
                                                <?php if (isset($error_description[$language['language_id']])) { ?>
                                                <span class="error"><?php echo $error_description[$language['language_id']]; ?></span>
                                                <?php } ?>
                                            </div>
                                    </div>
                                    <?php } ?>
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
                                    <label for="glyp_icon" class="col-sm-2 control-label"><?php echo $entry_glyp_icon; ?></label>
                                    <div class="col-sm-3">
                                        <input type="text" name="glyp_icon" value="<?php echo $glyp_icon?>" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="replace_image" class="col-sm-2 control-label"><?php echo $entry_replace_image; ?></label>
                                    <div class="col-sm-3">
                                        <label class="checkbox-inline checkbox-info">
                                            <?php if ($replace_image) {  ?>
                                            <input type="checkbox" class="styled" name="replace_image" value="1" checked="checked">
                                            <?php } else { ?>
                                            <input type="checkbox" class="styled" name="replace_image" value="1">
                                            <?php } ?>
                                        </label>
                                    </div>
                                </div>
                                <input type="hidden" name="type" value="<?php echo $type?>">
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
				<h5><?php echo $text_no_revision?></h5>
				<p><?php echo $text_revision_howto?></p>
                                </div>
                            </div>
                            <div class="tab-pane fade in" id="tab_link">
                                <div class="form-group">
                                    <label for="link" class="col-sm-2 control-label"><?php echo $entry_link; ?></label>
                                    <div class="col-sm-10">
                                        <select data-placeholder="<?php echo $heading_title?>" name="link_id" class="clear-results" tabindex="2">
                                            <option value=""></option> 
                                            <?php foreach ($links as $link) { ?>
                                            <?php if ($link['content_id'] == $link_id) { ?>
                                            <option value="<?php echo $link['content_id']?>" selected="selected"><?php echo $link['title']?></option>
                                            <?php } else { ?>
                                            <option value="<?php echo $link['content_id']?>"><?php echo $link['title']?></option>
                                            <?php } ?>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="application" class="col-sm-2 control-label"><?php echo $entry_application; ?></label>
                                    <div class="col-sm-2">
                                        <div class="scrollbox">
                                            <?php $class = 'even'; ?>
                                            <div class="<?php echo $class; ?>">
                                              <?php if (in_array(0, $content_application)) { ?>
                                              <input type="checkbox" name="content_application[]" value="0" checked="checked" />
                                              <?php echo $text_default; ?>
                                              <?php } else { ?>
                                              <input type="checkbox" name="content_application[]" value="0" />
                                              <?php echo $text_default; ?>
                                              <?php } ?>
                                            </div>
                                            <?php foreach ($applications as $application) { ?>
                                            <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
                                            <div class="<?php echo $class; ?>">
                                              <?php if (in_array($application['application_id'], $content_application)) { ?>
                                              <input type="checkbox" name="content_application[]" value="<?php echo $application['application_id']; ?>" checked="checked" />
                                              <?php echo $application['name']; ?>
                                              <?php } else { ?>
                                              <input type="checkbox" name="content_application[]" value="<?php echo $application['application_id']; ?>" />
                                              <?php echo $application['name']; ?>
                                              <?php } ?>
                                            </div>
                                            <?php } ?>
                                          </div>
                                    </div>
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
// Manufacturer
$('input[name=\'link\']').autocomplete({
	delay: 500,
	source: function(request, response) {
		$.ajax({
			url: 'index.php?route=application/content/autocomplete&token=<?php echo $token; ?>&filter_title=' +  encodeURIComponent(request.term),
			dataType: 'json',
			success: function(json) {		
				response($.map(json, function(item) {
					return {
						label: item.title,
						value: item.content_id
					}
				}));
			}
		});
	}, 
	select: function(event, ui) {
		$('input[name=\'link\']').attr('value', ui.item.label);
		$('input[name=\'link_id\']').attr('value', ui.item.value);
	
		return false;
	},
	focus: function(event, ui) {
      return false;
   }
});

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