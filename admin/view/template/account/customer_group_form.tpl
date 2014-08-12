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
                <div class="panel-heading"><h6 class="panel-title"><i class="icon-users2"></i> <?php echo $heading_title?></h6></div>
                <div class="panel-body">
                    <div id="languages" class="htabs">
                    <?php foreach ($languages as $language) { ?>
                    <a href="#language<?php echo $language['language_id']; ?>" onclick="$( 'a[href=\'#menu-language<?php echo $language['language_id']?>\']' ).trigger( 'click' );"><img src="view/images/custom/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a>
                    <?php } ?>
                </div>
                <?php foreach ($languages as $language) { ?>
                        <div id="language<?php echo $language['language_id']; ?>">
                            <div class="form-group">
                                <label for="title" class="col-sm-2 control-label"><?php echo $entry_name; ?></label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="title" placeholder="" name="customer_group_description[<?php echo $language['language_id']; ?>][name]" value="<?php echo isset($customer_group_description[$language['language_id']]) ? $customer_group_description[$language['language_id']]['name'] : ''; ?>">
                                    <?php if (isset($error_name[$language['language_id']])) { ?>
                                    <span class="error"><?php echo $error_name[$language['language_id']]; ?></span>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="meta_description" class="col-sm-2 control-label"><?php echo $entry_description; ?></label>
                                    <div class="col-sm-5">
                                        <textarea class="form-control" placeholder="" name="customer_group_description[<?php echo $language['language_id']; ?>][description]"><?php echo isset($customer_group_description[$language['language_id']]) ? $customer_group_description[$language['language_id']]['description'] : ''; ?></textarea>
                                    </div>
                            </div>
                        </div>
                        <?php } ?>
                        <div class="form-group">
                            <label for="approval" class="col-sm-3 control-label"><?php echo $entry_approval; ?></label>
                            <div class="col-sm-2">
                                <?php if ($approval) { ?>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="approval" id="optionsRadios1" value="1" checked>
                                        <?php echo $text_yes; ?>
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="approval" id="optionsRadios2" value="0">
                                        <?php echo $text_no; ?>
                                    </label>
                                </div>
                                <?php } else { ?>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="approval" id="optionsRadios1" value="1">
                                        <?php echo $text_yes; ?>
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="approval" id="optionsRadios2" value="0" checked>
                                        <?php echo $text_no; ?>
                                    </label>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="company_id_display" class="col-sm-3 control-label"><?php echo $entry_company_id_display; ?></label>
                            <div class="col-sm-2">
                                <?php if ($company_id_display) { ?>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="company_id_display" id="optionsRadios1" value="1" checked>
                                        <?php echo $text_yes; ?>
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="company_id_display" id="optionsRadios2" value="0">
                                        <?php echo $text_no; ?>
                                    </label>
                                </div>
                                <?php } else { ?>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="company_id_display" id="optionsRadios1" value="1">
                                        <?php echo $text_yes; ?>
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="company_id_display" id="optionsRadios2" value="0" checked>
                                        <?php echo $text_no; ?>
                                    </label>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="company_id_required" class="col-sm-3 control-label"><?php echo $entry_company_id_required; ?></label>
                            <div class="col-sm-2">
                                <?php if ($company_id_required) { ?>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="company_id_required" id="optionsRadios1" value="1" checked>
                                        <?php echo $text_yes; ?>
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="company_id_required" id="optionsRadios2" value="0">
                                        <?php echo $text_no; ?>
                                    </label>
                                </div>
                                <?php } else { ?>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="company_id_required" id="optionsRadios1" value="1">
                                        <?php echo $text_yes; ?>
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="company_id_required" id="optionsRadios2" value="0" checked>
                                        <?php echo $text_no; ?>
                                    </label>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tax_id_display" class="col-sm-3 control-label"><?php echo $entry_tax_id_display; ?></label>
                            <div class="col-sm-2">
                                <?php if ($tax_id_display) { ?>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="tax_id_display" id="optionsRadios1" value="1" checked>
                                        <?php echo $text_yes; ?>
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="tax_id_display" id="optionsRadios2" value="0">
                                        <?php echo $text_no; ?>
                                    </label>
                                </div>
                                <?php } else { ?>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="tax_id_display" id="optionsRadios1" value="1">
                                        <?php echo $text_yes; ?>
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="tax_id_display" id="optionsRadios2" value="0" checked>
                                        <?php echo $text_no; ?>
                                    </label>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tax_id_required" class="col-sm-3 control-label"><?php echo $entry_tax_id_required; ?></label>
                            <div class="col-sm-2">
                                <?php if ($tax_id_required) { ?>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="tax_id_required" id="optionsRadios1" value="1" checked>
                                        <?php echo $text_yes; ?>
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="tax_id_required" id="optionsRadios2" value="0">
                                        <?php echo $text_no; ?>
                                    </label>
                                </div>
                                <?php } else { ?>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="tax_id_required" id="optionsRadios1" value="1">
                                        <?php echo $text_yes; ?>
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="tax_id_required" id="optionsRadios2" value="0" checked>
                                        <?php echo $text_no; ?>
                                    </label>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="form-group">
                                <label for="sort_order" class="col-sm-2 control-label"><?php echo $entry_sort_order; ?></label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" id="title" placeholder="" name="sort_order" value="<?php echo $sort_order?>">
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
    $('#languages a').tabs(); 
    //--></script>  
<?php echo $footer?>