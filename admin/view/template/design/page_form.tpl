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
                            <li><a href="#tab_links" data-toggle="tab"><?php echo $tab_links ?></a></li>
                            <li><a href="#tab_blocks" data-toggle="tab"><?php echo $tab_blocks ?></a></li>
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
                                            <input type="text" class="form-control" id="title" placeholder="" name="page_description[<?php echo $language['language_id']; ?>][title]" value="<?php echo isset($page_description[$language['language_id']]) ? $page_description[$language['language_id']]['title'] : ''; ?>">
                                            <?php if (isset($error_title[$language['language_id']])) { ?>
                                            <span class="error"><?php echo $error_title[$language['language_id']]; ?></span>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="sub_title" class="col-sm-2 control-label"><?php echo $entry_sub_title; ?></label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" id="sub_title" placeholder="" name="page_description[<?php echo $language['language_id']; ?>][sub_title]" value="<?php echo isset($page_description[$language['language_id']]) ? $page_description[$language['language_id']]['sub_title'] : ''; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="meta_description" class="col-sm-2 control-label"><?php echo $entry_meta_description; ?></label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control" placeholder="" name="page_description[<?php echo $language['language_id']; ?>][meta_description]"><?php echo isset($page_description[$language['language_id']]) ? $page_description[$language['language_id']]['meta_description'] : ''; ?></textarea>
                                            </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="meta_keyword" class="col-sm-2 control-label"><?php echo $entry_meta_keyword; ?></label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control" placeholder="" name="page_description[<?php echo $language['language_id']; ?>][meta_keyword]"><?php echo isset($page_description[$language['language_id']]) ? $page_description[$language['language_id']]['meta_keyword'] : ''; ?></textarea>
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
                                    <label for="application" class="col-sm-2 control-label"><?php echo $entry_application; ?></label>
                                    <div class="col-sm-2">
                                        <div class="scrollbox">
                                            <?php $class = 'even'; ?>
                                            <div class="<?php echo $class; ?>">
                                              <?php if (in_array(0, $page_application)) { ?>
                                              <input type="checkbox" name="page_application[]" value="0" checked="checked" />
                                              <?php echo $text_default; ?>
                                              <?php } else { ?>
                                              <input type="checkbox" name="page_application[]" value="0" />
                                              <?php echo $text_default; ?>
                                              <?php } ?>
                                            </div>
                                            <?php foreach ($applications as $application) { ?>
                                            <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
                                            <div class="<?php echo $class; ?>">
                                              <?php if (in_array($application['application_id'], $page_application)) { ?>
                                              <input type="checkbox" name="page_application[]" value="<?php echo $application['application_id']; ?>" checked="checked" />
                                              <?php echo $application['name']; ?>
                                              <?php } else { ?>
                                              <input type="checkbox" name="page_application[]" value="<?php echo $application['application_id']; ?>" />
                                              <?php echo $application['name']; ?>
                                              <?php } ?>
                                            </div>
                                            <?php } ?>
                                          </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="layout" class="col-sm-2 control-label"><?php echo $entry_layout; ?></label>
                                    <div class="col-sm-10">
                                        <select data-placeholder="<?php echo $entry_layout; ?>" name="page_layout[page_id]" class="clear-results" tabindex="2">
                                            <option value=""></option>
                                            <?php foreach ($layouts as $layout) { ?>
                                            <?php if ($page_layout[0] == $layout['layout_id']) { ?>
                                            <option value="<?php echo $layout['layout_id']; ?>" selected="selected"><?php echo $layout['name']; ?></option>
                                            <?php } else { ?>
                                            <option value="<?php echo $layout['layout_id']; ?>"><?php echo $layout['name']; ?></option>
                                            <?php } ?>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="show_header" class="col-sm-2 control-label"><?php echo $entry_show_header; ?></label>
                                    <div class="col-sm-3">
                                        <label class="checkbox-inline checkbox-info">
                                            <?php if ($show_header) {  ?>
                                            <input type="checkbox" class="styled" name="show_header" value="1" checked="checked">
                                            <?php } else { ?>
                                            <input type="checkbox" class="styled" name="show_header" value="1">
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
                                <div class="form-group">
                                    <label for="show_breadcrumb" class="col-sm-2 control-label"><?php echo $entry_show_breadcrumb; ?></label>
                                    <div class="col-sm-3">
                                        <label class="checkbox-inline checkbox-info">
                                            <?php if ($show_breadcrumb) {  ?>
                                            <input type="checkbox" class="styled" name="show_breadcrumb" value="1" checked="checked">
                                            <?php } else { ?>
                                            <input type="checkbox" class="styled" name="show_breadcrumb" value="1">
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
                            <div class="tab-pane fade in" id="tab_links">
                                <div class="form-group">
                                    <label for="keyword" class="col-sm-2 control-label"><?php echo $entry_keyword; ?></label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="keyword" placeholder="" name="keyword" value="<?php echo $keyword; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="permalink" class="col-sm-2 control-label"><?php echo $entry_permalink; ?></label>
                                    <div class="col-sm-3">
                                        <?php echo $permalink?><b><i  class="permalink"><?php echo $keyword; ?></i></b>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="ssl" class="col-sm-2 control-label"><?php echo $entry_ssl; ?></label>
                                    <div class="col-sm-3">
                                        <label class="checkbox-inline checkbox-info">
                                            <?php if ($ssl) {  ?>
                                            <input type="checkbox" class="styled" name="ssl" value="1" checked="checked">
                                            <?php } else { ?>
                                            <input type="checkbox" class="styled" name="ssl" value="1">
                                            <?php } ?>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="protected" class="col-sm-2 control-label"><?php echo $entry_protected; ?></label>
                                    <div class="col-sm-3">
                                        <label class="checkbox-inline checkbox-info">
                                            <?php if ($protected) {  ?>
                                            <input type="checkbox" class="styled" name="protected" value="1" checked="checked">
                                            <?php } else { ?>
                                            <input type="checkbox" class="styled" name="protected" value="1">
                                            <?php } ?>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade in" id="tab_blocks">
                                <div class="table-responsive">
                                <table id="block" class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th class="left"><?php echo $entry_block; ?></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <?php $block_row = 0; ?>
                                    <?php foreach ($page_blocks as $page_block) { ?>
                                    <tbody id="block-row<?php echo $block_row; ?>">
                                        <tr>
                                            <td class="left"><select name="page_block[<?php echo $block_row; ?>][block_id]" class="form-control">
                                                  <?php foreach ($blocks as $block) { ?>
                                                  <?php if ($page_block == $block['block_id']) { ?>
                                                  <option value="<?php echo $block['block_id']?>" selected="selected"><?php echo $block['title']?></option>
                                                  <?php } else { ?>
                                                  <option value="<?php echo $block['block_id']?>"><?php echo $block['title']?></option>
                                                  <?php } ?>
                                                  <?php } ?>
                                                </select></td>
                                            <td class="right"><a onclick="$('#block-row<?php echo $block_row; ?>').remove();" class="btn btn-danger"><?php echo $button_remove; ?></a></td>
                                        </tr>
                                    </tbody>
                                    <?php $block_row++; ?>
                                    <?php } ?>
                                    <tfoot>
                                        <tr>
                                            <td colspan="3"></td>
                                            <td class="right"><a onclick="addBlock();" class="btn btn-primary"><?php echo $button_add_block; ?></a></td>
                                        </tr>
                                    </tfoot>
                                </table>
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
<script type="text/javascript"><!--
    $('#languages a').tabs(); 
    //--></script>
<script type="text/javascript"><!--
var block_row = <?php echo $block_row; ?>;

function addBlock() {
	html  = '<tbody id="block-row' + block_row + '">';
	html += '  <tr>';
	html += '    <td class="left"><select name="page_block[' + block_row + '][block_id]" class="form-control">';
        <?php foreach ($blocks as $block) { ?>
        html +='<option value="<?php echo $block['block_id']?>"><?php echo $block['title']?></option>';
        <?php } ?>
	html += '    </select></td>';
	html += '    <td class="left"><a onclick="$(\'#block-row' + block_row + '\').remove();" class="btn btn-danger"><?php echo $button_remove; ?></a></td>';
	html += '  </tr>';
	html += '</tbody>';
	
	$('#block > tfoot').before(html);
	
	block_row++;
}
//--></script>
<script type="text/javascript"><!--

$("input[name=\'keyword\']").keyup(function(){
    $('.permalink').html(this.value);
});
   
    
function image_upload(field, thumb) {
	$('#dialog').remove();
	
	$('#filemanager').prepend('<div id="dialog" style="padding: 3px 0px 0px 0px;"><iframe src="index.php?block=common/filemanager&token=<?php echo $token; ?>&field=' + encodeURIComponent(field) + '" style="padding:0; margin: 0; display: block; width: 100%; height: 100%;" frameborder="no" scrolling="auto"></iframe></div>');
	
	$('#dialog').dialog({
		title: '<?php echo $text_image_manager; ?>',
		close: function (event, ui) {
			if ($('#' + field).attr('value')) {
				$.ajax({
					url: 'index.php?block=common/filemanager/image&token=<?php echo $token; ?>&image=' + encodeURIComponent($('#' + field).val()),
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