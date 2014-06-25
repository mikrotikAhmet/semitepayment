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
                <div class="panel-heading"><h6 class="panel-title"><i class="icon-pagebreak"></i> <?php echo $heading_title?></h6></div>
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
                    <table id="route" class="table table-hover">
                        <thead>
                            <tr>
                                <th class="left"><?php echo $entry_application; ?></th>
                                <th class="left"><?php echo $entry_route; ?></th>
                                <th></th>
                            </tr>
                        </thead>
                        <?php $route_row = 0; ?>
                        <?php foreach ($layout_routes as $layout_route) { ?>
                        <tbody id="route-row<?php echo $route_row; ?>">
                            <tr>
                                <td class="left"><select name="layout_route[<?php echo $route_row; ?>][application_id]" class="form-control">
                                        <option value="0"><?php echo $text_default; ?></option>
                                        <?php foreach ($applications as $application) { ?>
                                        <?php if ($application['application_id'] == $layout_route['application_id']) { ?>
                                        <option value="<?php echo $application['application_id']; ?>" selected="selected"><?php echo $application['name']; ?></option>
                                        <?php } else { ?>
                                        <option value="<?php echo $application['application_id']; ?>"><?php echo $application['name']; ?></option>
                                        <?php } ?>
                                        <?php } ?>
                                    </select></td>
                                    <td class="left"><input type="text" name="layout_route[<?php echo $route_row; ?>][route]" value="<?php echo $layout_route['route']; ?>" class="form-control" /></td>
                                <td class="left"><a onclick="$('#route-row<?php echo $route_row; ?>').remove();" class="btn btn-danger"><?php echo $button_remove; ?></a></td>
                            </tr>
                        </tbody>
                        <?php $route_row++; ?>
                        <?php } ?>
                        <tfoot>
                            <tr>
                                <td colspan="2"></td>
                                <td class="left"><a onclick="addRoute();" class="btn btn-primary"><?php echo $button_add_route; ?></a></td>
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
var route_row = <?php echo $route_row; ?>;

function addRoute() {
	html  = '<tbody id="route-row' + route_row + '">';
	html += '  <tr>';
	html += '    <td class="left"><select name="layout_route[' + route_row + '][application_id]" class="form-control">';
	html += '    <option value="0"><?php echo $text_default; ?></option>';
	<?php foreach ($applications as $application) { ?>
	html += '<option value="<?php echo $application['application_id']; ?>"><?php echo addslashes($application['name']); ?></option>';
	<?php } ?>   
	html += '    </select></td>';
	html += '    <td class="left"><input type="text" name="layout_route[' + route_row + '][route]" value="" class="form-control"/></td>';
	html += '    <td class="left"><a onclick="$(\'#route-row' + route_row + '\').remove();" class="btn btn-danger"><?php echo $button_remove; ?></a></td>';
	html += '  </tr>';
	html += '</tbody>';
	
	$('#route > tfoot').before(html);
	
	route_row++;
}
//--></script> 
<?php echo $footer?>