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
                <div class="panel-heading"><h6 class="panel-title"><i class="icon-cart-checkout"></i> <?php echo $heading_title?></h6></div>
                <div class="panel-body">
                    <div class="form-group">
                        <label for="company_name" class="col-sm-2 control-label"><?php echo $entry_company; ?></label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="company_name" placeholder="<?php echo $entry_company; ?>" name="vpos_module[company_name]" value="<?php echo $module['company_name']; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="company_owner" class="col-sm-2 control-label"><?php echo $entry_company_owner; ?></label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="company_owner" placeholder="<?php echo $entry_company_owner; ?>" name="vpos_module[company_owner]" value="<?php echo $module['company_owner']; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="company_code" class="col-sm-2 control-label"><?php echo $entry_company_code; ?></label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="company_code" placeholder="<?php echo $entry_company_code; ?>" name="vpos_module[company_code]" value="<?php echo $module['company_code']; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="terminal" class="col-sm-2 control-label"><?php echo $entry_terminal; ?></label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="terminal" placeholder="<?php echo $entry_terminal; ?>" name="vpos_module[terminal]" value="<?php echo $module['terminal']; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="organization" class="col-sm-2 control-label"><?php echo $entry_organization; ?></label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="organization" placeholder="<?php echo $entry_organization; ?>" name="vpos_module[organization]" value="<?php echo $module['organization']; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="merchant_id" class="col-sm-2 control-label"><?php echo $entry_merchant_id; ?></label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="merchant_id" placeholder="<?php echo $entry_merchant_id; ?>" name="vpos_module[merchant_id]" value="<?php echo $module['merchant_id']; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="merchant_key" class="col-sm-2 control-label"><?php echo $entry_merchant_key; ?></label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="merchant_key" placeholder="<?php echo $entry_merchant_key; ?>" name="vpos_module[merchant_key]" value="<?php echo $module['merchant_key']; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="3dsecure" class="col-sm-2 control-label"><?php echo $entry_3dsecure; ?></label>
                        <div class="col-sm-3">
                            <label class="checkbox-inline checkbox-info">
                                <?php if (isset($module['secure'])) {  ?>
                                <input type="checkbox" class="styled" name="vpos_module[secure]" value="1" checked="checked">
                                <?php } else { ?>
                                <input type="checkbox" class="styled" name="vpos_module[secure]" value="1">
                                <?php } ?>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="status" class="col-sm-2 control-label"><?php echo $entry_status; ?></label>
                        <div class="col-sm-2">
                            <select name="vpos_module[status]" class="form-control">
                                <?php if ($module['status']) { ?>
                                <option value="0"><?php echo $text_disabled; ?></option>
                                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                                <?php } else { ?>
                                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                                <option value="1"><?php echo $text_enabled; ?></option>
                                <?php } ?>
                            </select>
                        </div>
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
<?php echo $footer?>