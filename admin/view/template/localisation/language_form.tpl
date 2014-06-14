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
                        <label for="name" class="col-sm-2 control-label"><?php echo $entry_name; ?></label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" id="name" placeholder="" name="name" value="<?php echo $name; ?>">
                            <?php if ($error_name) { ?>
                            <span class="error"><?php echo $error_name; ?></span>
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
                        <label for="locale" class="col-sm-2 control-label"><?php echo $entry_locale; ?></label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="locale" placeholder="" name="locale" value="<?php echo $locale; ?>">
                            <?php if ($error_locale) { ?>
                            <span class="error"><?php echo $error_locale; ?></span>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="image" class="col-sm-2 control-label"><?php echo $entry_image; ?></label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="image" placeholder="" name="image" value="<?php echo $image; ?>">
                            <?php if ($error_image) { ?>
                            <span class="error"><?php echo $error_image; ?></span>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="directory" class="col-sm-2 control-label"><?php echo $entry_directory; ?></label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="directory" placeholder="" name="directory" value="<?php echo $directory; ?>">
                            <?php if ($error_directory) { ?>
                            <span class="error"><?php echo $error_directory; ?></span>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="filename" class="col-sm-2 control-label"><?php echo $entry_filename; ?></label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="filename" placeholder="" name="filename" value="<?php echo $filename; ?>">
                            <?php if ($error_filename) { ?>
                            <span class="error"><?php echo $error_filename; ?></span>
                            <?php } ?>
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
                    <div class="form-group">
                        <label for="sort_order" class="col-sm-2 control-label"><?php echo $entry_sort_order; ?></label>
                        <div class="col-sm-1">
                            <input type="text" class="form-control" id="sort_order" placeholder="" name="sort_order" value="<?php echo $sort_order; ?>">
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