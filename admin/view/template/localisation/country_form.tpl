<?php echo $header?>
<style>
     #map-canvas {
        height: 400px;
        margin: 0px;
        padding: 0px;
            width: 100%;
      }
    </style>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=drawing"></script>
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
                            <label for="iso_code_2" class="col-sm-2 control-label"><?php echo $entry_iso_code_2; ?></label>
                            <div class="col-sm-1">
                                <input type="text" class="form-control" id="iso_code_2" placeholder="" name="iso_code_2" value="<?php echo $iso_code_2; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="iso_code_3" class="col-sm-2 control-label"><?php echo $entry_iso_code_3; ?></label>
                            <div class="col-sm-1">
                                <input type="text" class="form-control" id="iso_code_3" placeholder="" name="iso_code_3" value="<?php echo $iso_code_3; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="address_format" class="col-sm-2 control-label"><?php echo $entry_address_format; ?></label>
                            <div class="col-sm-4">
                                <textarea name="address_format" cols="40" rows="5" class="form-control"><?php echo $address_format; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="postcode_required" class="col-sm-2 control-label"><?php echo $entry_postcode_required; ?></label>
                            <div class="col-sm-3">
                                <?php if ($postcode_required) { ?>
                                <input type="radio" name="postcode_required" value="1" checked="checked" />
                                <?php echo $text_yes; ?>
                                <input type="radio" name="postcode_required" value="0" />
                                <?php echo $text_no; ?>
                                <?php } else { ?>
                                <input type="radio" name="postcode_required" value="1" />
                                <?php echo $text_yes; ?>
                                <input type="radio" name="postcode_required" value="0" checked="checked" />
                                <?php echo $text_no; ?>
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
