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
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form" class="form-horizontal form-bordered" role="form" id="form">
            <div class="panel panel-default">
                <div class="panel-heading"><h6 class="panel-title"><i class="icon-quill2"></i> <?php echo $heading_title?></h6></div>
                <div class="panel-body">
                    <div id="languages" class="htabs">
                                    <?php foreach ($languages as $language) { ?>
                                    <a href="#language<?php echo $language['language_id']; ?>" ><img src="view/images/custom/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a>
                                    <?php } ?>
                                </div>
                                <?php foreach ($languages as $language) { ?>
                                <div id="language<?php echo $language['language_id']; ?>">
                                    <div class="form-group">
                                        <label for="title" class="col-sm-2 control-label"><?php echo $entry_title; ?></label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" id="title" placeholder="" name="mail_description[<?php echo $language['language_id']; ?>][title]" value="<?php echo isset($mail_description[$language['language_id']]) ? $mail_description[$language['language_id']]['title'] : ''; ?>">
                                            <?php if (isset($error_title[$language['language_id']])) { ?>
                                            <span class="error"><?php echo $error_title[$language['language_id']]; ?></span>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="mail_template" class="col-sm-2 control-label"><?php echo $entry_template; ?></label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control" placeholder="" id="mail_template<?php echo $language['language_id']?>" name="mail_description[<?php echo $language['language_id']; ?>][mail_template]"><?php echo isset($mail_description[$language['language_id']]) ? $mail_description[$language['language_id']]['template'] : ''; ?></textarea>
                                            </div>
                                    </div>
                                </div>
                                <?php } ?>
                                <br/>
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
                    <br/>
                    <div class="form-actions text-right">
                        <input type="submit" value="<?php echo $button_save; ?>" class="btn btn-primary">
                        <button type="button" onclick="window.location = '<?php echo $cancel?>'" class="btn btn-danger btn-sm"><?php echo $button_cancel; ?></button>
                    </div>
                </div>
            </div>
        </form>
</div>
<script type="text/javascript" src="view/javascript/ckeditor/ckeditor.js"></script> 
<script type="text/javascript"><!--
<?php foreach ($languages as $language) { ?>
CKEDITOR.replace('mail_template<?php echo $language['language_id']; ?>', {
	filebrowserBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserImageBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserFlashBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserImageUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserFlashUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>'
});
<?php } ?>
//--></script>
<script type="text/javascript"><!--
    $('#languages a').tabs(); 
    //--></script>
<?php echo $footer?>