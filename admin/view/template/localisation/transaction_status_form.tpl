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
                <div class="panel-heading"><h6 class="panel-title"><i class="icon-users"></i> <?php echo $heading_title?></h6></div>
                <div class="panel-body">
                    <?php foreach ($languages as $language) { ?>
                    <div class="form-group">
                        <label for="transaction_status" class="col-sm-2 control-label"><?php echo $entry_name; ?></label>
                        <div class="col-sm-2">
                            <input type="text" style="background: url(view/images/custom/flags/<?php echo $language['image']; ?>) no-repeat scroll 7px 10px;padding-left:30px;" class="form-control" id="transaction_status" placeholder="" name="transaction_status[<?php echo $language['language_id']; ?>][name]" value="<?php echo isset($transaction_status[$language['language_id']]) ? $transaction_status[$language['language_id']]['name'] : ''; ?>">
                            
                            <?php if (isset($error_name[$language['language_id']])) { ?>
                            <span class="error"><?php echo $error_name[$language['language_id']]; ?></span><br />
                            <?php } ?>
                        </div>
                    </div>
                    <?php } ?>

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