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
                <div class="panel-heading"><h6 class="panel-title"><i class="icon-earth"></i> <?php echo $heading_title?></h6></div>
                <div class="panel-body">

                    <div class="form-group">
                    <label for="title" class="col-sm-2 control-label"><?php echo $entry_title; ?></label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" id="title" placeholder="" name="title" value="<?php echo $title; ?>">
                        <?php if ($error_title) { ?>
                        <span class="error"><?php echo $error_title; ?></span>
                        <?php } ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="code" class="col-sm-2 control-label"><?php echo $entry_code; ?></label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="code" placeholder="" name="code" value="<?php echo $code; ?>">
                        <?php if ($error_code) { ?>
                        <span class="error"><?php echo $error_code; ?></span>
                        <?php } ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="symbol_left" class="col-sm-2 control-label"><?php echo $entry_symbol_left; ?></label>
                    <div class="col-sm-1">
                        <input type="text" class="form-control" id="symbol_left" placeholder="" name="symbol_left" value="<?php echo $symbol_left; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="symbol_right" class="col-sm-2 control-label"><?php echo $entry_symbol_right; ?></label>
                    <div class="col-sm-1">
                        <input type="text" class="form-control" id="symbol_right" placeholder="" name="symbol_right" value="<?php echo $symbol_right; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="decimal_place" class="col-sm-2 control-label"><?php echo $entry_decimal_place; ?></label>
                    <div class="col-sm-1">
                        <input type="text" class="form-control" id="decimal_place" placeholder="" name="decimal_place" value="<?php echo $decimal_place; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="value" class="col-sm-2 control-label"><?php echo $entry_value; ?></label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" id="value" placeholder="" name="value" value="<?php echo $value; ?>">
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