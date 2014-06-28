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
            <?php if ($success) { ?>
    <div class="alert alert-success fade in block-inner">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <i class="icon-cancel-circle"></i> <?php echo $success; ?>
    </div>
    <?php } ?>
    <div class="panel panel-default">
        <div class="panel-heading"><h6 class="panel-title"><i class="icon-users2"></i> <?php echo $heading_title?></h6></div>
        <ul class="panel-toolbar">
            <li><a href="<?php echo $insert; ?>" title=""><i class="icon-plus"></i> <?php echo $button_insert; ?></a></li>
            <li><a href="javascript:void(0)" onclick="$('form').submit();" title=""><i class="icon-close"></i> <?php echo $button_delete; ?></a></li>
        </ul>
        <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form" class="form-horizontal" role="form">
            <div class="table-responsive">
                <table class="table table-bordered table-check">
                    <thead>
                        <tr class="">
                        <td></td>
                        <td><input type="text" name="filter_name" value="<?php echo $filter_name; ?>" class="form-control"/></td>
                        <td><input type="text" name="filter_email" value="<?php echo $filter_email; ?>" class="form-control"/></td>
                        <td><select name="filter_customer_group_id" class="form-control">
                            <option value="*"></option>
                            <?php foreach ($customer_groups as $customer_group) { ?>
                            <?php if ($customer_group['customer_group_id'] == $filter_customer_group_id) { ?>
                            <option value="<?php echo $customer_group['customer_group_id']; ?>" selected="selected"><?php echo $customer_group['name']; ?></option>
                            <?php } else { ?>
                            <option value="<?php echo $customer_group['customer_group_id']; ?>"><?php echo $customer_group['name']; ?></option>
                            <?php } ?>
                            <?php } ?>
                          </select></td>
                        <td><select name="filter_status" class="form-control">
                            <option value="*"></option>
                            <?php if ($filter_status) { ?>
                            <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                            <?php } else { ?>
                            <option value="1"><?php echo $text_enabled; ?></option>
                            <?php } ?>
                            <?php if (!is_null($filter_status) && !$filter_status) { ?>
                            <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                            <?php } else { ?>
                            <option value="0"><?php echo $text_disabled; ?></option>
                            <?php } ?>
                          </select></td>
                        <td><select name="filter_approved" class="form-control">
                            <option value="*"></option>
                            <?php if ($filter_approved) { ?>
                            <option value="1" selected="selected"><?php echo $text_yes; ?></option>
                            <?php } else { ?>
                            <option value="1"><?php echo $text_yes; ?></option>
                            <?php } ?>
                            <?php if (!is_null($filter_approved) && !$filter_approved) { ?>
                            <option value="0" selected="selected"><?php echo $text_no; ?></option>
                            <?php } else { ?>
                            <option value="0"><?php echo $text_no; ?></option>
                            <?php } ?>
                          </select></td>
                        <td><input type="text" name="filter_date_added" value="<?php echo $filter_date_added; ?>" size="12" id="date" class="form-control"/></td>
                        <td align="right"><a onclick="filter();" class="btn btn-primary btn-sm"><i class="icon-search3"></i> <?php echo $button_filter; ?></a></td>
                      </tr>
                        <tr>
                            <th width="1" style="text-align: center;"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></th>
                            <th class="left"><?php if ($sort == 'name') { ?>
                            <a href="<?php echo $sort_name; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_name; ?></a>
                            <?php } else { ?>
                            <a href="<?php echo $sort_name; ?>"><?php echo $column_name; ?></a>
                            <?php } ?></th>
                          <th class="left"><?php if ($sort == 'c.email') { ?>
                            <a href="<?php echo $sort_email; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_email; ?></a>
                            <?php } else { ?>
                            <a href="<?php echo $sort_email; ?>"><?php echo $column_email; ?></a>
                            <?php } ?></th>
                          <th class="left"><?php if ($sort == 'customer_group') { ?>
                            <a href="<?php echo $sort_customer_group; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_customer_group; ?></a>
                            <?php } else { ?>
                            <a href="<?php echo $sort_customer_group; ?>"><?php echo $column_customer_group; ?></a>
                            <?php } ?></th>
                          <th class="left"><?php if ($sort == 'c.status') { ?>
                            <a href="<?php echo $sort_status; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_status; ?></a>
                            <?php } else { ?>
                            <a href="<?php echo $sort_status; ?>"><?php echo $column_status; ?></a>
                            <?php } ?></th>
                          <th class="left"><?php if ($sort == 'c.approved') { ?>
                            <a href="<?php echo $sort_approved; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_approved; ?></a>
                            <?php } else { ?>
                            <a href="<?php echo $sort_approved; ?>"><?php echo $column_approved; ?></a>
                            <?php } ?></th>
                          <th class="left"><?php if ($sort == 'c.date_added') { ?>
                            <a href="<?php echo $sort_date_added; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_date_added; ?></a>
                            <?php } else { ?>
                            <a href="<?php echo $sort_date_added; ?>"><?php echo $column_date_added; ?></a>
                            <?php } ?></th>
                          <th class="right"><?php echo $column_action; ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($customers) { ?>
                        <?php foreach ($customers as $customer) { ?>
                        <tr>
                          <td style="text-align: center;"><?php if ($customer['selected']) { ?>
                            <input type="checkbox" name="selected[]" value="<?php echo $customer['customer_id']; ?>" checked="checked" />
                            <?php } else { ?>
                            <input type="checkbox" name="selected[]" value="<?php echo $customer['customer_id']; ?>" />
                            <?php } ?></td>
                          <td class="left"><?php echo $customer['name']; ?></td>
                          <td class="left"><?php echo $customer['email']; ?></td>
                          <td class="left"><?php echo $customer['customer_group']; ?></td>
                          <td class="left"><?php echo $customer['status']; ?></td>
                          <td class="left"><?php echo $customer['approved']; ?></td>
                          <td class="left"><?php echo $customer['date_added']; ?></td>
                          <td class="right"><?php foreach ($customer['action'] as $action) { ?>
                            [ <a href="<?php echo $action['href']; ?>"><?php echo $action['text']; ?></a> ]
                            <?php } ?></td>
                        </tr>
                        <?php } ?>
                        <?php } else { ?>
                        <tr>
                          <td class="center" colspan="9"><?php echo $text_no_results; ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>

                </table>

            </div>
        </form>
        <div class="table-footer">
            <?php echo $pagination; ?>
        </div>
    </div>
</div>
<script type="text/javascript"><!--
function filter() {
	url = 'index.php?route=account/customer&token=<?php echo $token; ?>';
        
	var filter_name = $('input[name=\'filter_name\']').val();
	
	if (filter_name) {
		url += '&filter_name=' + encodeURIComponent(filter_name);
	}
	
	var filter_email = $('input[name=\'filter_email\']').val();
	
	if (filter_email) {
		url += '&filter_email=' + encodeURIComponent(filter_email);
	}
	
	var filter_customer_group_id = $('select[name=\'filter_customer_group_id\']').val();
	
	if (filter_customer_group_id != '*') {
		url += '&filter_customer_group_id=' + encodeURIComponent(filter_customer_group_id);
	}	
	
	var filter_status = $('select[name=\'filter_status\']').val();
	
	if (filter_status != '*') {
		url += '&filter_status=' + encodeURIComponent(filter_status); 
	}	
	
	var filter_approved = $('select[name=\'filter_approved\']').val();
	
	if (filter_approved != '*') {
		url += '&filter_approved=' + encodeURIComponent(filter_approved);
	}	
	
	var filter_ip = $('input[name=\'filter_ip\']').val();
	
	if (filter_ip) {
		url += '&filter_ip=' + encodeURIComponent(filter_ip);
	}
		
	var filter_date_added = $('input[name=\'filter_date_added\']').val();
	
	if (filter_date_added) {
		url += '&filter_date_added=' + encodeURIComponent(filter_date_added);
	}
	
	location = url;
}
//--></script>
<script type="text/javascript"><!--
$(document).ready(function() {
	$('#date').datepicker({dateFormat: 'yy-mm-dd'});
});
//--></script>
<?php echo $footer?>