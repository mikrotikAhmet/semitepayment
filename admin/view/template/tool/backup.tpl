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
        <div class="panel-heading">
            <h6 class="panel-title"><i class="icon-users"></i> <?php echo $heading_title?></h6>
            <div class="form-actions text-right">
                <button type="button" onclick="$('#backup').submit();" class="btn btn-primary btn-sm"><?php echo $button_backup; ?></button>
                <button type="button" onclick="$('#restore').submit();" class="btn btn-primary btn-sm"><?php echo $button_restore; ?></button>
            </div>
        </div>
        <div class="panel-body">
            <form action="<?php echo $restore; ?>" method="post" enctype="multipart/form-data" id="restore" class="form-horizontal" role="form">
                <div class="form-group">
                    <label for="restore" class="col-sm-2 control-label"><?php echo $entry_restore; ?></label>
                    <div class="col-sm-4">
                            <input type="file" class="styled" name="import">
                    </div>
                </div>
            </form>
            <form action="<?php echo $backup; ?>" method="post" enctype="multipart/form-data" id="backup" class="form-horizontal" role="form">
                <div class="form-group">
                    <label for="backup" class="col-sm-2 control-label"><?php echo $entry_backup; ?></label>
                    <div class="col-sm-4">
                        <div class="scrollbox form-control" style="margin-bottom: 5px;">
                            <?php $class = 'odd'; ?>
                            <?php foreach ($tables as $table) { ?>
                            <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
                            <div class="<?php echo $class; ?>">
                                <input type="checkbox" name="backup[]" value="<?php echo $table; ?>" checked="checked" />
                                <?php echo $table; ?></div>
                            <?php } ?>
                        </div>
                        <a onclick="$(this).parent().find(':checkbox').attr('checked', true);"><?php echo $text_select_all; ?></a> / <a onclick="$(this).parent().find(':checkbox').attr('checked', false);"><?php echo $text_unselect_all; ?></a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php echo $footer?>