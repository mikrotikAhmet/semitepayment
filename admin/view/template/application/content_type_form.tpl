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
    <div class="panel panel-default">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form" class="form-horizontal form-bordered" role="form" id="form">
            <div class="panel panel-default">
                <div class="panel-heading"><h6 class="panel-title"><i class="icon-quill2"></i> <?php echo $heading_title?></h6></div>
                <div class="panel-body">
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label"><?php echo $entry_name; ?></label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" id="name" placeholder="" name="name" value="<?php echo $name; ?>">
                            <?php if ($error_name) { ?>
                            <span class="error"><?php echo $error_name; ?></span>
                            <?php } ?>
                        </div>
                    </div>
                    <br />
                    <div class="table-responsive">
                        <table id="field" class="list table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="left"><?php echo $entry_field; ?></th>
                                <th class="center"><?php echo $entry_status; ?></th>
                                <th></th>
                            </tr>
                        </thead>
                         <?php $field_row = 0; ?>
                            <?php foreach ($content_fields as $content_field) { ?>
                            <tbody id="field-row<?php echo $field_row; ?>">
                              <tr>
                                <td class="left"><select name="content_field[<?php echo $field_row; ?>][field]" class="form-control">
                                    <?php foreach ($fields as $key=>$field) { ?>
                                    <?php if ($key == $content_field['field']) { ?>
                                    <option value="<?php echo $key; ?>" selected="selected"><?php echo $field; ?></option>
                                    <?php } else { ?>
                                    <option value="<?php echo $key; ?>"><?php echo $field; ?></option>
                                    <?php } ?>
                                    <?php } ?>
                                  </select></td>
                                <td class="center">
                                    <label class="checkbox-inline checkbox-info">
                                    <?php if ($content_field['status']) { ?>
                                    <input type="checkbox" name="content_field[<?php echo $field_row; ?>][status]" value="1" class="styled" checked="checked"/>
                                    <?php } else { ?>
                                    <input type="checkbox" name="content_field[<?php echo $field_row; ?>][status]" value="1" class="styled"/>
                                    <?php } ?>
                                    </label>
                                </td>
                                <td class="left"><a onclick="$('#field-row<?php echo $field_row; ?>').remove();" class="btn btn-danger"><?php echo $button_remove; ?></a></td>
                              </tr>
                            </tbody>
                            <?php $field_row++; ?>
                            <?php } ?>
                        <tfoot>
                        <tr>
                          <td colspan="2"></td>
                          <td class="left"><a onclick="addField();" class="btn btn-primary"><?php echo $button_add_field; ?></a></td>
                        </tr>
                      </tfoot>
                    </table>
                    </div>
                    <div class="form-actions text-right">
                        <input type="submit" value="<?php echo $button_save; ?>" class="btn btn-primary">
                        <button type="button" onclick="window.location = '<?php echo $cancel?>'" class="btn btn-danger btn-sm"><?php echo $button_cancel; ?></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript"><!--
var field_row = <?php echo $field_row; ?>;

function addField() {
	html  = '<tbody id="field-row' + field_row + '">';
	html += '  <tr>';
	html += '    <td class="left"><select name="content_field[' + field_row + '][field]" class="form-control">';
	<?php foreach ($fields as $key=>$field) { ?>
	html += '<option value="<?php echo $key; ?>"><?php echo addslashes($field); ?></option>';
	<?php } ?>   
	html += '    </select></td>';
	html += '    <td class="left">';
        html += '<label class="checkbox-inline checkbox-info">';
        html += '<input type="checkbox" name="content_field[' + field_row + '][status]" value="1" class="styled"/>';
        html += '</label>';
        html += '</td>';
	html += '    <td class="left"><a onclick="$(\'#field-row' + field_row + '\').remove();" class="btn btn-danger"><?php echo $button_remove; ?></a></td>';
	html += '  </tr>';
	html += '</tbody>';
	
	$('#field > tfoot').before(html);
	
	field_row++;
}
//--></script>
<?php echo $footer?>