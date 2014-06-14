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
        <div class="panel-heading"><h6 class="panel-title"><i class="icon-quill2"></i> <?php echo $heading_title?></h6></div>
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
                            <th class="left"><?php if ($sort == 'cd.title') { ?>
                                <a href="<?php echo $sort_title; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_title; ?></a>
                                <?php } else { ?>
                                <a href="<?php echo $sort_title; ?>"><?php echo $column_title; ?></a>
                                <?php } ?></th>
                            <th class="left"><?php if ($sort == 'c.type') { ?>
                                <a href="<?php echo $sort_type; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_type; ?></a>
                                <?php } else { ?>
                                <a href="<?php echo $sort_type; ?>"><?php echo $column_type; ?></a>
                                <?php } ?></th>
                            <th class="left"><?php echo $column_author; ?></th>
                            <th class="left"><?php if ($sort == 'c.status') { ?>
                                <a href="<?php echo $sort_status; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_status; ?></a>
                                <?php } else { ?>
                                <a href="<?php echo $sort_status; ?>"><?php echo $column_status; ?></a>
                                <?php } ?></th>
                            <th class="left"><?php if ($sort == 'c.date_modified') { ?>
                                <a href="<?php echo $sort_date_modifies; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_date_modified; ?></a>
                                <?php } else { ?>
                                <a href="<?php echo $sort_date_modified; ?>"><?php echo $column_date_modified; ?></a>
                                <?php } ?></th>
                            <th class="right"><?php echo $column_action; ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($contents) { ?>
                        <?php foreach ($contents as $content) { ?>
                        <tr>
                            <td style="text-align: center;"><?php if ($content['selected']) { ?>
                                <input type="checkbox" name="selected[]" value="<?php echo $content['content_id']; ?>" checked="checked" />
                                <?php } else { ?>
                                <input type="checkbox" name="selected[]" value="<?php echo $content['content_id']; ?>" />
                                <?php } ?></td>
                            <td class="left"><?php echo $content['title']; ?></td>
                            <td class="left"><?php echo $content['type']; ?></td>
                            <td class="left"><?php echo $content['author']; ?></td>
                            <td class="left"><?php echo $content['status']; ?></td>
                            <td class="left"><?php echo $content['date_modified']; ?></td>
                            <td class="right"><?php foreach ($content['action'] as $action) { ?>
                                [ <a href="<?php echo $action['href']; ?>"><?php echo $action['text']; ?></a> ]
                                <?php } ?></td>
                        </tr>
                        <?php } ?>
                        <?php } else { ?>
                        <tr>
                            <td class="center" colspan="7"><?php echo $text_no_results; ?></td>
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