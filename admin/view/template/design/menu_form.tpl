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
                <div class="panel-heading"><h6 class="panel-title"><i class="icon-menu"></i> <?php echo $heading_title?></h6></div>
                <div class="panel-body">
                    <div class="tabbable page-tabs">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab_general" data-toggle="tab"><?php echo $tab_general ?></a></li>
                            <li><a href="#tab_data" data-toggle="tab"><?php echo $tab_data ?></a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active fade in" id="tab_general">
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
                                            <input type="text" class="form-control" id="title" placeholder="" name="menu_description[<?php echo $language['language_id']; ?>][title]" value="<?php echo isset($menu_description[$language['language_id']]) ? $menu_description[$language['language_id']]['title'] : ''; ?>">
                                            <?php if (isset($error_title[$language['language_id']])) { ?>
                                            <span class="error"><?php echo $error_title[$language['language_id']]; ?></span>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                            <div class="tab-pane fade in" id="tab_data">
                                <div class="form-group">
                                    <label for="position" class="col-sm-2 control-label"><?php echo $entry_position; ?></label>
                                    <div class="col-sm-2">
                                        <?php if ($position == 'right') { ?>
                                        <label class="radio-inline radio-info">
                                                <input type="radio" name="position" class="styled" value="left">
                                                <?php echo $text_left?>
                                        </label>
                                        <label class="radio-inline radio-info">
                                                <input type="radio" name="position" class="styled" checked="checked" value="right">
                                                <?php echo $text_right?>
                                        </label>
                                        <?php } else if ($position == 'left') { ?>
                                        <label class="radio-inline radio-info">
                                                <input type="radio" name="position" class="styled" checked="checked" value="left">
                                                <?php echo $text_left?>
                                        </label>
                                        <label class="radio-inline radio-info">
                                                <input type="radio" name="position" class="styled" value="right">
                                                <?php echo $text_right?>
                                        </label>
                                        <?php } else { ?>
                                        <label class="radio-inline radio-info">
                                                <input type="radio" name="position" class="styled" checked="checked" value="left">
                                                <?php echo $text_left?>
                                        </label>
                                        <label class="radio-inline radio-info">
                                                <input type="radio" name="position" class="styled" value="right">
                                                <?php echo $text_right?>
                                        </label>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="bottom" class="col-sm-2 control-label"><?php echo $entry_bottom; ?></label>
                                    <div class="col-sm-3">
                                        <label class="checkbox-inline checkbox-info">
                                            <?php if ($bottom) {  ?>
                                            <input type="checkbox" class="styled" name="bottom" value="1" checked="checked">
                                            <?php } else { ?>
                                            <input type="checkbox" class="styled" name="bottom" value="1">
                                            <?php } ?>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                <label class="col-sm-2 control-label"><?php echo $entry_link?> </label>
                                        <div class="col-sm-7">
                                        <select data-placeholder="<?php echo $text_data_link?>" name="page_link" class="select-full" tabindex="2">
                                            <option value=""><?php echo $text_select?></option> 
                                            <?php foreach ($pages as $page) { ?>
                                            <?php if ($page['page_id'] == $page_link) { ?>
                                            <option value="page_id=<?php echo $page['page_id']?>" selected="selected"><?php echo $page['title']?></option>
                                            <?php } else { ?>
                                            <option value="page_id=<?php echo $page['page_id']?>"><?php echo $page['title']?></option>
                                            <?php }?>
                                            <?php } ?>
                                        </select>
                                        </div>
                                </div>
                                <div class="form-group">
                                    <label for="sort_order" class="col-sm-2 control-label"><?php echo $entry_external_link; ?></label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="external_link" placeholder="" name="external_link" value="<?php echo $external_link; ?>">
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
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="sort_order" placeholder="" name="sort_order" value="<?php echo $sort_order; ?>">
                                    </div>
                                </div>
                            </div>
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
<script type="text/javascript"><!--
    $('#languages a').tabs(); 
    //--></script>
<?php echo $footer?>