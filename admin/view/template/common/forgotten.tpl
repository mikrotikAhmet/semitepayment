<?php echo $header?>
<!-- forgotten wrapper -->
<div class="forgotten-wrapper">
    <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="forgotten" class="" role="form">
        <div class="popup-header">
            <a href="<?php echo $home?>" class="pull-left"><i class="icon-user-plus"></i></a>
            <span class="text-semibold"><?php echo $heading_title; ?></span>
        </div>
        <div class="well">
            <div class="form-group has-feedback">
                <label><?php echo $entry_email; ?></label>
                <input type="text" class="form-control" placeholder="">
                <i class="icon-mail form-control-feedback"></i>
            </div>
            <div class="row form-actions">
                <div class="col-xs-6">
                    <button type="button" class="btn btn-danger pull-left" onclick="window.location='<?php echo $cancel?>'"><i class="icon-cancel-circle"></i> <?php echo $button_cancel?></button>
                </div>
                <div class="col-xs-6">
                    <button type="button" class="btn btn-primary pull-right" onclick="$('#forgotten').submit();"><i class="icon-checkmark"></i> <?php echo $button_reset?></button>
                </div>
            </div>
            <?php if ($error_warning) { ?>
            <div class="bg-danger with-padding">
                <?php echo $error_warning; ?>
            </div>
            <?php } ?>
        </div>
    </form>
</div>  
<!-- /forgotten wrapper -->
<script type="text/javascript"><!--
    $('#forgotten input').keydown(function(e) {
        if (e.keyCode == 13) {
            $('#forgotten').submit();
        }
    });
//--></script> 