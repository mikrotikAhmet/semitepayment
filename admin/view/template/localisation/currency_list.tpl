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
        <div class="panel-heading"><h6 class="panel-title"><i class="icon-earth"></i> <?php echo $heading_title?></h6></div>
        <ul class="panel-toolbar">
            <li><a href="<?php echo $insert; ?>" title=""><i class="icon-plus"></i> <?php echo $button_insert; ?></a></li>
            <li><a href="javascript:void(0)" onclick="$('form').submit();" title=""><i class="icon-close"></i> <?php echo $button_delete; ?></a></li>
        </ul>
        <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form" class="form-horizontal" role="form">
            <div class="table-responsive">
                <table class="table table-bordered table-check">
                    <thead>
                        <tr>
                            <th width="1" style="text-align: center;"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></th>
                            <th class="left"><?php if ($sort == 'title') { ?>
                            <a href="<?php echo $sort_title; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_title; ?></a>
                            <?php } else { ?>
                            <a href="<?php echo $sort_title; ?>"><?php echo $column_title; ?></a>
                            <?php } ?></th>
                          <th class="left"><?php if ($sort == 'code') { ?>
                            <a href="<?php echo $sort_code; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_code; ?></a>
                            <?php } else { ?>
                            <a href="<?php echo $sort_code; ?>"><?php echo $column_code; ?></a>
                            <?php } ?></th>
                          <th class="right"><?php if ($sort == 'value') { ?>
                            <a href="<?php echo $sort_value; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_value; ?></a>
                            <?php } else { ?>
                            <a href="<?php echo $sort_value; ?>"><?php echo $column_value; ?></a>
                            <?php } ?></th>
                          <th class="left"><?php if ($sort == 'date_modified') { ?>
                            <a href="<?php echo $sort_date_modified; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_date_modified; ?></a>
                            <?php } else { ?>
                            <a href="<?php echo $sort_date_modified; ?>"><?php echo $column_date_modified; ?></a>
                            <?php } ?></th>
                            <th class="right"><?php echo $column_action; ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($currencies) { ?>
                        <?php foreach ($currencies as $currency) { ?>
                        <tr>
                          <td style="text-align: center;"><?php if ($currency['selected']) { ?>
                            <input type="checkbox" name="selected[]" value="<?php echo $currency['currency_id']; ?>" checked="checked" />
                            <?php } else { ?>
                            <input type="checkbox" name="selected[]" value="<?php echo $currency['currency_id']; ?>" />
                            <?php } ?></td>
                          <td class="left"><?php echo $currency['title']; ?></td>
                          <td class="left"><?php echo $currency['code']; ?></td>
                          <td class="right"><?php echo $currency['value']; ?></td>
                          <td class="left"><?php echo $currency['date_modified']; ?></td>
                          <td class="right"><?php foreach ($currency['action'] as $action) { ?>
                            [ <a href="<?php echo $action['href']; ?>"><?php echo $action['text']; ?></a> ]
                            <?php } ?></td>
                        </tr>
                        <?php } ?>
                        <?php } else { ?>
                        <tr>
                          <td class="center" colspan="6"><?php echo $text_no_results; ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>

                </table>

            </div>
        </form>
        <div class="table-footer">
            <?php echo $pagination; ?>
        </div>
    </div>
</div>
<?php echo $footer?>