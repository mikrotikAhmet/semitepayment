<?php echo $header?>
<!-- Login wrapper -->
<div class="login-wrapper">
    <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form" class="" role="form">
        <div class="popup-header">
            <a href="<?php echo $home?>" class="pull-left"><i class="icon-user-plus"></i></a>
            <span class="text-semibold"><?php echo $text_login; ?></span>
        </div>
        <div class="well">
            <div class="form-group has-feedback">
                <label><?php echo $entry_username; ?></label>
                <input type="text" name="username" class="form-control" placeholder="">
                <i class="icon-users form-control-feedback"></i>
            </div>

            <div class="form-group has-feedback">
                <label><?php echo $entry_password; ?></label>
                <input type="password" name="password" class="form-control" placeholder="">
                <i class="icon-lock form-control-feedback"></i>
            </div>

            <div class="row form-actions">
                <div class="col-xs-6">
                    <div class="checkbox checkbox-success">
                        <label>
                            <?php if ($forgotten) { ?>
                            <a href="<?php echo $forgotten; ?>"><?php echo $text_forgotten; ?></a>
                            <?php } ?>
                        </label>
                    </div>
                </div>

                <div class="col-xs-6">
                    <button type="submit" class="btn btn-warning pull-right" onclick="$('#form').submit();"><i class="icon-unlocked2"></i> <?php echo $button_login?></button>
                    <?php if ($redirect) { ?>
                    <input type="hidden" name="redirect" value="<?php echo $redirect; ?>" />
                    <?php } ?>
                </div>
            </div>
            <?php if ($error_warning) { ?>
            <div class="bg-danger with-padding">
                <?php echo $error_warning; ?>
            </div>
            <?php } ?>
        </div>
        <br/>
        <div class="col-xs-5">
            <img src="view/images/loginSecureIcons.png"/>
        </div>
    </form>
</div>  
<!-- /login wrapper -->
<script type="text/javascript"><!--
    $('#form input').keydown(function(e) {
        if (e.keyCode == 13) {
            $('#form').submit();
        }
    });
//--></script> 