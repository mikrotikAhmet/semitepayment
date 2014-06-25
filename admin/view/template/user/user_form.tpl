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
                    <div class="form-group">
                        <label for="image" class="col-sm-2 control-label"><?php echo $entry_image; ?></label>
                        <div class="col-sm-3">
                            <div class="image"><img src="<?php echo $thumb; ?>" alt="" id="thumb" class="img-thumbnail"/>
                                <input type="hidden" name="image" value="<?php echo $image; ?>" id="image" />
                                <br />
                                <button type="button" onclick="image_upload('image', 'thumb');" class="btn btn-primary btn-xs"><?php echo $text_browse; ?></button>&nbsp;&nbsp;|&nbsp;&nbsp;<button type="button" class="btn btn-danger btn-xs" onclick="$('#thumb').attr('src', '<?php echo $no_image; ?>'); $('#image').attr('value', '');"><?php echo $text_clear; ?></button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                    <label for="username" class="col-sm-2 control-label"><?php echo $entry_username; ?></label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" id="username" placeholder="<?php echo $entry_username; ?>" name="username" value="<?php echo $username; ?>">
                        <?php if ($error_username) { ?>
                        <span class="error"><?php echo $error_username; ?></span>
                        <?php } ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="firstname" class="col-sm-2 control-label"><?php echo $entry_firstname; ?></label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="firstname" placeholder="<?php echo $entry_firstname; ?>" name="firstname" value="<?php echo $firstname; ?>">
                        <?php if ($error_firstname) { ?>
                        <span class="error"><?php echo $error_firstname; ?></span>
                        <?php } ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="lastname" class="col-sm-2 control-label"><?php echo $entry_lastname; ?></label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="lastname" placeholder="<?php echo $entry_lastname; ?>" name="lastname" value="<?php echo $lastname; ?>">
                        <?php if ($error_lastname) { ?>
                        <span class="error"><?php echo $error_lastname; ?></span>
                        <?php } ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="col-sm-2 control-label"><?php echo $entry_email; ?></label>
                    <div class="col-sm-4">
                        <input type="email" class="form-control" id="email" placeholder="<?php echo $entry_email; ?>" name="email" value="<?php echo $email; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="user_group" class="col-sm-2 control-label"><?php echo $entry_user_group; ?></label>
                    <div class="col-sm-2">
                        <select name="user_group_id" class="form-control">
                            <?php foreach ($user_groups as $user_group) { ?>
                            <?php if ($user_group['user_group_id'] == $user_group_id) { ?>
                            <option value="<?php echo $user_group['user_group_id']; ?>" selected="selected"><?php echo $user_group['name']; ?></option>
                            <?php } else { ?>
                            <option value="<?php echo $user_group['user_group_id']; ?>"><?php echo $user_group['name']; ?></option>
                            <?php } ?>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="col-sm-2 control-label"><?php echo $entry_password; ?></label>
                    <div class="col-sm-4">
                        <input type="password" class="form-control" id="password" placeholder="<?php echo $entry_password; ?>" name="password" value="<?php echo $password; ?>">
                        <?php if ($error_password) { ?>
                        <span class="error"><?php echo $error_password; ?></span>
                        <?php } ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="confirm" class="col-sm-2 control-label"><?php echo $entry_confirm; ?></label>
                    <div class="col-sm-4">
                        <input type="password" class="form-control" id="confirm" placeholder="<?php echo $entry_confirm; ?>" name="confirm" value="<?php echo $confirm; ?>">
                        <?php if ($error_confirm) { ?>
                        <span class="error"><?php echo $error_confirm; ?></span>
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
<script type="text/javascript"><!--
function image_upload(field, thumb) {
	$('#dialog').remove();
	
	$('#filemanager').prepend('<div id="dialog" style="padding: 3px 0px 0px 0px;"><iframe src="index.php?route=common/filemanager&token=<?php echo $token; ?>&field=' + encodeURIComponent(field) + '" style="padding:0; margin: 0; display: block; width: 100%; height: 100%;" frameborder="no" scrolling="auto"></iframe></div>');
	
	$('#dialog').dialog({
		title: '<?php echo $text_image_manager; ?>',
		close: function (event, ui) {
			if ($('#' + field).attr('value')) {
				$.ajax({
					url: 'index.php?route=common/filemanager/image&token=<?php echo $token; ?>&image=' + encodeURIComponent($('#' + field).val()),
					dataType: 'text',
					success: function(data) {
						$('#' + thumb).replaceWith('<img src="' + data + '" alt="" id="' + thumb + '" class="img-thumbnail"/>');
					}
				});
			}
		},	
		bgiframe: false,
		width: 800,
		height: 400,
		resizable: false,
		modal: false
	});
};
//--></script> 
<?php echo $footer?>