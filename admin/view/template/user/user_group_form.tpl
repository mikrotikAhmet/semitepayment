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
                <div class="panel-heading"><h6 class="panel-title"><i class="icon-tree2"></i> <?php echo $heading_title?></h6></div>
                <div class="panel-body">

                    <div class="form-group">
                    <label for="name" class="col-sm-2 control-label"><?php echo $entry_name; ?></label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" id="name" placeholder="<?php echo $entry_name; ?>" name="name" value="<?php echo $name; ?>">
                        <?php if ($error_name) { ?>
                        <span class="error"><?php echo $error_name; ?></span>
                        <?php } ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="access" class="col-sm-2 control-label"><?php echo $entry_access; ?></label>
                    <div class="col-sm-2">
                        <div class="scrollbox form-control">
                            <?php $class = 'odd'; ?>
                            <?php foreach ($permissions as $permission) { ?>
                            <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
                            <div class="<?php echo $class; ?>">
                                <?php if (in_array($permission, $access)) { ?>
                                <input type="checkbox" name="permission[access][]" value="<?php echo $permission; ?>" checked="checked" />
                                <?php echo $permission; ?>
                                <?php } else { ?>
                                <input type="checkbox" name="permission[access][]" value="<?php echo $permission; ?>" />
                                <?php echo $permission; ?>
                                <?php } ?>
                            </div>
                            <?php } ?>
                        </div>
                        <a onclick="$(this).parent().find(':checkbox').attr('checked', true);"><?php echo $text_select_all; ?></a> / <a onclick="$(this).parent().find(':checkbox').attr('checked', false);"><?php echo $text_unselect_all; ?></a>
                    </div>
                </div>
                <div class="form-group">
                    <label for="modify" class="col-sm-2 control-label"><?php echo $entry_modify; ?></label>
                    <div class="col-sm-2">
                        <div class="scrollbox form-control">
                            <?php $class = 'odd'; ?>
                            <?php foreach ($permissions as $permission) { ?>
                            <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
                            <div class="<?php echo $class; ?>">
                                <?php if (in_array($permission, $modify)) { ?>
                                <input type="checkbox" name="permission[modify][]" value="<?php echo $permission; ?>" checked="checked" />
                                <?php echo $permission; ?>
                                <?php } else { ?>
                                <input type="checkbox" name="permission[modify][]" value="<?php echo $permission; ?>" />
                                <?php echo $permission; ?>
                                <?php } ?>
                            </div>
                            <?php } ?>
                        </div>
                        <a onclick="$(this).parent().find(':checkbox').attr('checked', true);"><?php echo $text_select_all; ?></a> / <a onclick="$(this).parent().find(':checkbox').attr('checked', false);"><?php echo $text_unselect_all; ?></a>
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