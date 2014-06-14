<?php echo $header?>
<!-- Page content -->
<div class="page-content">
    <!-- Page header -->
    <div class="page-header">
        <div class="page-title">
            <h3><?php echo $heading_title?> <small><?php echo $heading_sub_title?></small></h3>
        </div>
    </div>
    <!-- /layout header -->
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
                <div class="panel-heading"><h6 class="panel-title"><i class="icon-cog"></i> <?php echo $heading_title?></h6></div>
                <div class="panel-body">
                    <div class="tabbable page-tabs">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab_general" data-toggle="tab"><?php echo $tab_general; ?></a></li>
                            <li><a href="#tab_application" data-toggle="tab"><?php echo $tab_application; ?></a></li>
                            <li><a href="#tab_local" data-toggle="tab"><?php echo $tab_local; ?></a></li>
                            <li><a href="#tab_option" data-toggle="tab"><?php echo $tab_option; ?></a></li>
                            <li><a href="#tab_image" data-toggle="tab"><?php echo $tab_image; ?></a></li>
                            <li><a href="#tab_ftp" data-toggle="tab"><?php echo $tab_ftp; ?></a></li>
                            <li><a href="#tab_mail" data-toggle="tab"><?php echo $tab_mail; ?></a></li>
                            <li><a href="#tab_server" data-toggle="tab"><?php echo $tab_server; ?></a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade in active" id="tab_general">
                                <div class="form-group">
                                    <label for="config_name" class="col-sm-3 control-label"><?php echo $entry_name; ?></label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="config_name" placeholder="<?php echo $entry_name; ?>" name="config_name" value="<?php echo $config_name; ?>">
                                        <?php if ($error_name) { ?>
                                        <span class="error"><?php echo $error_name; ?></span>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="config_owner" class="col-sm-3 control-label"><?php echo $entry_owner; ?></label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="config_owner" placeholder="<?php echo $entry_owner; ?>" name="config_owner" value="<?php echo $config_owner; ?>">
                                        <?php if ($error_owner) { ?>
                                        <span class="error"><?php echo $error_owner; ?></span>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="config_address" class="col-sm-3 control-label"><?php echo $entry_address; ?></label>
                                    <div class="col-sm-5">
                                        <textarea class="form-control" id="config_address" placeholder="<?php echo $entry_address; ?>" name="config_address"><?php echo $config_address; ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="config_email" class="col-sm-3 control-label"><?php echo $entry_email; ?></label>
                                    <div class="col-sm-3">
                                        <input type="email" class="form-control" id="config_email" placeholder="<?php echo $entry_email; ?>" name="config_email" value="<?php echo $config_email; ?>">
                                        <?php if ($error_email) { ?>
                                        <span class="error"><?php echo $error_email; ?></span>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="config_telephone" class="col-sm-3 control-label"><?php echo $entry_telephone; ?></label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="config_telephone" placeholder="<?php echo $entry_telephone; ?>" name="config_telephone" value="<?php echo $config_telephone; ?>">
                                        <?php if ($error_telephone) { ?>
                                        <span class="error"><?php echo $error_telephone; ?></span>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="config_fax" class="col-sm-3 control-label"><?php echo $entry_fax; ?></label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="config_fax" placeholder="<?php echo $entry_fax; ?>" name="config_fax" value="<?php echo $config_fax; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tab_application">
                                <div class="form-group">
                                    <label for="config_title" class="col-sm-3 control-label"><?php echo $entry_title; ?></label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="config_title" placeholder="<?php echo $entry_title; ?>" name="config_title" value="<?php echo $config_title; ?>">
                                        <?php if ($error_title) { ?>
                                        <span class="error"><?php echo $error_title; ?></span>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="config_meta_description" class="col-sm-3 control-label"><?php echo $entry_meta_description; ?></label>
                                    <div class="col-sm-5">
                                        <textarea class="form-control" id="config_meta_description" placeholder="<?php echo $entry_meta_description; ?>" name="config_meta_description"><?php echo $config_meta_description; ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="config_template" class="col-sm-3 control-label"><?php echo $entry_template; ?></label>
                                    <div class="col-sm-2">
                                        <select name="config_template" onchange="$('#template').load('index.php?route=setting/setting/template&token=<?php echo $token; ?>&template=' + encodeURIComponent(this.value));" class="form-control">
                                            <?php foreach ($templates as $template) { ?>
                                            <?php if ($template == $config_template) { ?>
                                            <option value="<?php echo $template; ?>" selected="selected"><?php echo $template; ?></option>
                                            <?php } else { ?>
                                            <option value="<?php echo $template; ?>"><?php echo $template; ?></option>
                                            <?php } ?>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="config_template" class="col-sm-3 control-label"></label>
                                    <div class="col-sm-3" id="template"></div>
                                </div>
                                <div class="form-group">
                                    <label for="config_layout_id" class="col-sm-3 control-label"><?php echo $entry_layout; ?></label>
                                    <div class="col-sm-2">
                                        <select name="config_layout_id"  class="form-control">
                                            <?php foreach ($layouts as $layout) { ?>
                                            <?php if ($layout['layout_id'] == $config_layout_id) { ?>
                                            <option value="<?php echo $layout['layout_id']; ?>" selected="selected"><?php echo $layout['name']; ?></option>
                                            <?php } else { ?>
                                            <option value="<?php echo $layout['layout_id']; ?>"><?php echo $layout['name']; ?></option>
                                            <?php } ?>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tab_local">
                                <div class="form-group">
                                    <label for="config_country" class="col-sm-3 control-label"><?php echo $entry_country; ?></label>
                                    <div class="col-sm-2">
                                        <select name="config_country_id"  class="form-control">
                                            <?php foreach ($countries as $country) { ?>
                                            <?php if ($country['country_id'] == $config_country_id) { ?>
                                            <option value="<?php echo $country['country_id']; ?>" selected="selected"><?php echo $country['name']; ?></option>
                                            <?php } else { ?>
                                            <option value="<?php echo $country['country_id']; ?>"><?php echo $country['name']; ?></option>
                                            <?php } ?>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="config_zone" class="col-sm-3 control-label"><?php echo $entry_zone; ?></label>
                                    <div class="col-sm-2">
                                        <select name="config_zone_id"  class="form-control">
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="config_language" class="col-sm-3 control-label"><?php echo $entry_language; ?></label>
                                    <div class="col-sm-2">
                                        <select name="config_language"  class="form-control">
                                            <?php foreach ($languages as $language) { ?>
                                            <?php if ($language['code'] == $config_language) { ?>
                                            <option value="<?php echo $language['code']; ?>" selected="selected"><?php echo $language['name']; ?></option>
                                            <?php } else { ?>
                                            <option value="<?php echo $language['code']; ?>"><?php echo $language['name']; ?></option>
                                            <?php } ?>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="config_admin_language" class="col-sm-3 control-label"><?php echo $entry_admin_language; ?></label>
                                    <div class="col-sm-2">
                                        <select name="config_admin_language"  class="form-control">
                                            <?php foreach ($languages as $language) { ?>
                                            <?php if ($language['code'] == $config_admin_language) { ?>
                                            <option value="<?php echo $language['code']; ?>" selected="selected"><?php echo $language['name']; ?></option>
                                            <?php } else { ?>
                                            <option value="<?php echo $language['code']; ?>"><?php echo $language['name']; ?></option>
                                            <?php } ?>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="config_currency" class="col-sm-3 control-label"><?php echo $entry_currency; ?></label>
                                    <div class="col-sm-2">
                                        <select name="config_currency"  class="form-control">
                                            <?php foreach ($currencies as $currency) { ?>
                                            <?php if ($currency['code'] == $config_currency) { ?>
                                            <option value="<?php echo $currency['code']; ?>" selected="selected"><?php echo $currency['title']; ?></option>
                                            <?php } else { ?>
                                            <option value="<?php echo $currency['code']; ?>"><?php echo $currency['title']; ?></option>
                                            <?php } ?>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="config_currency_auto" class="col-sm-3 control-label"><?php echo $entry_currency_auto; ?></label>
                                    <div class="col-sm-2">
                                        <?php if ($config_currency_auto) { ?>
                                        <input type="radio" name="config_currency_auto" value="1" checked="checked" />
                                        <?php echo $text_yes; ?>
                                        <input type="radio" name="config_currency_auto" value="0" />
                                        <?php echo $text_no; ?>
                                        <?php } else { ?>
                                        <input type="radio" name="config_currency_auto" value="1" />
                                        <?php echo $text_yes; ?>
                                        <input type="radio" name="config_currency_auto" value="0" checked="checked" />
                                        <?php echo $text_no; ?>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tab_option">
                                <h2><?php echo $text_items?></h2>
                                <div class="form-group">
                                    <label for="config_admin_limit" class="col-sm-3 control-label"><?php echo $entry_admin_limit; ?></label>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" id="config_admin_limit" placeholder="" name="config_admin_limit" value="<?php echo $config_admin_limit; ?>">
                                        <?php if ($error_admin_limit) { ?>
                                        <span class="error"><?php echo $error_admin_limit; ?></span>
                                        <?php } ?>
                                    </div>
                                </div>
                                <h2><?php echo $text_account?></h2>
                                <div class="form-group">
                                    <label for="config_customer_online" class="col-sm-3 control-label"><?php echo $entry_customer_online; ?></label>
                                    <div class="col-sm-2">
                                        <?php if ($config_customer_online) { ?>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="config_customer_online" id="optionsRadios1" value="1" checked>
                                                <?php echo $text_yes; ?>
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="config_customer_online" id="optionsRadios2" value="0">
                                                <?php echo $text_no; ?>
                                            </label>
                                        </div>
                                        <?php } else { ?>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="config_customer_online" id="optionsRadios1" value="1">
                                                <?php echo $text_yes; ?>
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="config_customer_online" id="optionsRadios2" value="0" checked>
                                                <?php echo $text_no; ?>
                                            </label>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="config_customer_group" class="col-sm-3 control-label"><?php echo $entry_customer_group; ?></label>
                                    <div class="col-sm-2">
                                        <select name="config_customer_group_id"  class="form-control">
                                            <?php foreach ($customer_groups as $customer_group) { ?>
                                            <?php if ($customer_group['customer_group_id'] == $config_customer_group_id) { ?>
                                            <option value="<?php echo $customer_group['customer_group_id']; ?>" selected="selected"><?php echo $customer_group['name']; ?></option>
                                            <?php } else { ?>
                                            <option value="<?php echo $customer_group['customer_group_id']; ?>"><?php echo $customer_group['name']; ?></option>
                                            <?php } ?>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="customer_group_display" class="col-sm-3 control-label"><?php echo $entry_customer_group_display; ?></label>
                                    <div class="col-sm-2">
                                        <div class="scrollbox form-control">
                                            <?php $class = 'odd'; ?>
                                            <?php foreach ($customer_groups as $customer_group) { ?>
                                            <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
                                            <div class="<?php echo $class; ?>">
                                                <?php if (in_array($customer_group['customer_group_id'], $config_customer_group_display)) { ?>
                                                <input type="checkbox" name="config_customer_group_display[]" value="<?php echo $customer_group['customer_group_id']; ?>" checked="checked" />
                                                <?php echo $customer_group['name']; ?>
                                                <?php } else { ?>
                                                <input type="checkbox" name="config_customer_group_display[]" value="<?php echo $customer_group['customer_group_id']; ?>" />
                                                <?php echo $customer_group['name']; ?>
                                                <?php } ?>
                                            </div>
                                            <?php } ?>
                                        </div>
                                        <?php if ($error_customer_group_display) { ?>
                                        <span class="error"><?php echo $error_customer_group_display; ?></span>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="config_account" class="col-sm-3 control-label"><?php echo $entry_account; ?></label>
                                    <div class="col-sm-4">
                                        <select name="config_account_id"  class="form-control">
                                            <?php foreach ($contents as $content) { ?>
                                            <?php if ($content['content_id'] == $config_account_id) { ?>
                                            <option value="<?php echo $content['content_id']; ?>" selected="selected"><?php echo $content['title']; ?></option>
                                            <?php } else { ?>
                                            <option value="<?php echo $content['content_id']; ?>"><?php echo $content['title']; ?></option>
                                            <?php } ?>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <h2><?php echo $text_menu?></h2>
                                <div class="form-group">
                                    <label for="config_main_menu" class="col-sm-3 control-label"><?php echo $entry_main_menu; ?></label>
                                    <div class="col-sm-4">
                                        <select name="config_main_menu_id"  class="form-control">
                                            <?php foreach ($menu_groups as $menu_group) { ?>
                                            <?php if ($menu_group['menu_group_id'] == $config_main_menu_id) { ?>
                                            <option value="<?php echo $menu_group['menu_group_id']; ?>" selected="selected"><?php echo $menu_group['title']; ?></option>
                                            <?php } else { ?>
                                            <option value="<?php echo $menu_group['menu_group_id']; ?>"><?php echo $menu_group['title']; ?></option>
                                            <?php } ?>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="config_footer_menu" class="col-sm-3 control-label"><?php echo $entry_footer_menu; ?></label>
                                    <div class="col-sm-4">
                                        <select name="config_footer_menu_id"  class="form-control">
                                            <?php foreach ($menu_groups as $menu_group) { ?>
                                            <?php if ($menu_group['menu_group_id'] == $config_footer_menu_id) { ?>
                                            <option value="<?php echo $menu_group['menu_group_id']; ?>" selected="selected"><?php echo $menu_group['title']; ?></option>
                                            <?php } else { ?>
                                            <option value="<?php echo $menu_group['menu_group_id']; ?>"><?php echo $menu_group['title']; ?></option>
                                            <?php } ?>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tab_image">
                                <div class="form-group">
                                    <label for="config_logo" class="col-sm-3 control-label"><?php echo $entry_logo; ?></label>
                                    <div class="col-sm-3">
                                        <div class="image"><img src="<?php echo $logo; ?>" alt="" id="thumb-logo" class="img-thumbnail"/>
                                            <input type="hidden" name="config_logo" value="<?php echo $config_logo; ?>" id="logo" />
                                            <br />
                                            <button type="button" onclick="image_upload('logo', 'thumb-logo');" class="btn btn-primary btn-xs"><?php echo $text_browse; ?></button>&nbsp;&nbsp;|&nbsp;&nbsp;<button type="button" class="btn btn-danger btn-xs" onclick="$('#thumb-logo').attr('src', '<?php echo $no_image; ?>'); $('#logo').attr('value', '');"><?php echo $text_clear; ?></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="config_icon" class="col-sm-3 control-label"><?php echo $entry_icon; ?></label>
                                    <div class="col-sm-3">
                                        <div class="image"><img src="<?php echo $icon; ?>" alt="" id="thumb-icon" class="img-thumbnail"/>
                                            <input type="hidden" name="config_icon" value="<?php echo $config_icon; ?>" id="icon" />
                                            <br />
                                            <button type="button" onclick="image_upload('icon', 'thumb-icon');" class="btn btn-primary btn-xs"><?php echo $text_browse; ?></button>&nbsp;&nbsp;|&nbsp;&nbsp;<button type="button" class="btn btn-danger btn-xs" onclick="$('#thumb-icon').attr('src', '<?php echo $no_image; ?>'); $('#icon').attr('value', '');"><?php echo $text_clear; ?></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tab_ftp">
                                <div class="form-group">
                                    <label for="config_ftp_host" class="col-sm-3 control-label"><?php echo $entry_ftp_host; ?></label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="config_ftp_host" placeholder="<?php echo $entry_ftp_host; ?>" name="config_ftp_host" value="<?php echo $config_ftp_host; ?>">
                                        <?php if ($error_ftp_host) { ?>
                                        <span class="error"><?php echo $error_ftp_host; ?></span>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="config_ftp_port" class="col-sm-3 control-label"><?php echo $entry_ftp_port; ?></label>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" id="config_ftp_port" placeholder="<?php echo $entry_ftp_port; ?>" name="config_ftp_port" value="<?php echo $config_ftp_port; ?>">
                                        <?php if ($error_ftp_port) { ?>
                                        <span class="error"><?php echo $error_ftp_port; ?></span>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="config_ftp_username" class="col-sm-3 control-label"><?php echo $entry_ftp_username; ?></label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="config_ftp_username" placeholder="<?php echo $entry_ftp_username; ?>" name="config_ftp_username" value="<?php echo $config_ftp_username; ?>">
                                        <?php if ($error_ftp_username) { ?>
                                        <span class="error"><?php echo $error_ftp_username; ?></span>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="config_ftp_password" class="col-sm-3 control-label"><?php echo $entry_ftp_password; ?></label>
                                    <div class="col-sm-4">
                                        <input type="password" class="form-control" id="config_ftp_password" placeholder="<?php echo $entry_ftp_password; ?>" name="config_ftp_password" value="<?php echo $config_ftp_password; ?>">
                                        <?php if ($error_ftp_password) { ?>
                                        <span class="error"><?php echo $error_ftp_password; ?></span>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="config_ftp_root" class="col-sm-3 control-label"><?php echo $entry_ftp_root; ?></label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="config_ftp_root" placeholder="" name="config_ftp_root" value="<?php echo $config_ftp_root; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="config_ftp_status" class="col-sm-3 control-label"><?php echo $entry_ftp_status; ?></label>
                                    <div class="col-sm-2">
                                        <?php if ($config_ftp_status) { ?>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="config_ftp_status" id="optionsRadios1" value="1" checked>
                                                <?php echo $text_yes; ?>
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="config_ftp_status" id="optionsRadios2" value="0">
                                                <?php echo $text_no; ?>
                                            </label>
                                        </div>
                                        <?php } else { ?>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="config_ftp_status" id="optionsRadios1" value="1">
                                                <?php echo $text_yes; ?>
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="config_ftp_status" id="optionsRadios2" value="0" checked>
                                                <?php echo $text_no; ?>
                                            </label>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tab_mail">
                                <div class="form-group">
                                    <label for="config_mail_protocol" class="col-sm-3 control-label"><?php echo $entry_mail_protocol; ?></label>
                                    <div class="col-sm-2">
                                        <select name="config_mail_protocol"  class="form-control">
                                            <?php if ($config_mail_protocol == 'mail') { ?>
                                            <option value="mail" selected="selected"><?php echo $text_mail; ?></option>
                                            <?php } else { ?>
                                            <option value="mail"><?php echo $text_mail; ?></option>
                                            <?php } ?>
                                            <?php if ($config_mail_protocol == 'smtp') { ?>
                                            <option value="smtp" selected="selected"><?php echo $text_smtp; ?></option>
                                            <?php } else { ?>
                                            <option value="smtp"><?php echo $text_smtp; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="config_mail_parameter" class="col-sm-3 control-label"><?php echo $entry_mail_parameter; ?></label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="config_mail_parameter" placeholder="" name="config_mail_parameter" value="<?php echo $config_mail_parameter; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="config_smtp_host" class="col-sm-3 control-label"><?php echo $entry_smtp_host; ?></label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="config_smtp_host" placeholder="" name="config_smtp_host" value="<?php echo $config_smtp_host; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="config_smtp_username" class="col-sm-3 control-label"><?php echo $entry_smtp_username; ?></label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="config_smtp_username" placeholder="" name="config_smtp_username" value="<?php echo $config_smtp_username; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="config_smtp_password" class="col-sm-3 control-label"><?php echo $entry_smtp_password; ?></label>
                                    <div class="col-sm-3">
                                        <input type="password" class="form-control" id="config_smtp_password" placeholder="" name="config_smtp_password" value="<?php echo $config_smtp_password; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="config_smtp_port" class="col-sm-3 control-label"><?php echo $entry_smtp_port; ?></label>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" id="config_smtp_port" placeholder="" name="config_smtp_port" value="<?php echo $config_smtp_port; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="config_smtp_timeout" class="col-sm-3 control-label"><?php echo $entry_smtp_timeout; ?></label>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" id="config_smtp_timeout" placeholder="" name="config_smtp_timeout" value="<?php echo $config_smtp_timeout; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="config_alert_mail" class="col-sm-3 control-label"><?php echo $entry_alert_mail; ?></label>
                                    <div class="col-sm-2">
                                        <?php if ($config_alert_mail) { ?>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="config_alert_mail" id="optionsRadios1" value="1" checked>
                                                <?php echo $text_yes; ?>
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="config_alert_mail" id="optionsRadios2" value="0">
                                                <?php echo $text_no; ?>
                                            </label>
                                        </div>
                                        <?php } else { ?>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="config_alert_mail" id="optionsRadios1" value="1">
                                                <?php echo $text_yes; ?>
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="config_alert_mail" id="optionsRadios2" value="0" checked>
                                                <?php echo $text_no; ?>
                                            </label>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="config_account_mail" class="col-sm-3 control-label"><?php echo $entry_account_mail; ?></label>
                                    <div class="col-sm-2">
                                        <?php if ($config_account_mail) { ?>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="config_account_mail" id="optionsRadios1" value="1" checked>
                                                <?php echo $text_yes; ?>
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="config_account_mail" id="optionsRadios2" value="0">
                                                <?php echo $text_no; ?>
                                            </label>
                                        </div>
                                        <?php } else { ?>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="config_account_mail" id="optionsRadios1" value="1">
                                                <?php echo $text_yes; ?>
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="config_account_mail" id="optionsRadios2" value="0" checked>
                                                <?php echo $text_no; ?>
                                            </label>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="config_alert_emails" class="col-sm-3 control-label"><?php echo $entry_alert_emails; ?></label>
                                    <div class="col-sm-5">
                                        <textarea class="form-control" id="config_alert_emails" placeholder="" rows="7" name="config_alert_emails"><?php echo $config_alert_emails; ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tab_server">
                                <div class="form-group">
                                    <label for="config_secure" class="col-sm-3 control-label"><?php echo $entry_secure; ?></label>
                                    <div class="col-sm-2">
                                        <?php if ($config_secure) { ?>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="config_secure" id="optionsRadios1" value="1" checked>
                                                <?php echo $text_yes; ?>
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="config_secure" id="optionsRadios2" value="0">
                                                <?php echo $text_no; ?>
                                            </label>
                                        </div>
                                        <?php } else { ?>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="config_secure" id="optionsRadios1" value="1">
                                                <?php echo $text_yes; ?>
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="config_secure" id="optionsRadios2" value="0" checked>
                                                <?php echo $text_no; ?>
                                            </label>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="config_shared" class="col-sm-3 control-label"><?php echo $entry_shared; ?></label>
                                    <div class="col-sm-2">
                                        <?php if ($config_shared) { ?>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="config_shared" id="optionsRadios1" value="1" checked>
                                                <?php echo $text_yes; ?>
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="config_shared" id="optionsRadios2" value="0">
                                                <?php echo $text_no; ?>
                                            </label>
                                        </div>
                                        <?php } else { ?>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="config_shared" id="optionsRadios1" value="1">
                                                <?php echo $text_yes; ?>
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="config_shared" id="optionsRadios2" value="0" checked>
                                                <?php echo $text_no; ?>
                                            </label>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="config_robots" class="col-sm-3 control-label"><?php echo $entry_robots; ?></label>
                                    <div class="col-sm-5">
                                        <textarea class="form-control" id="config_robots" placeholder="" rows="7" name="config_robots"><?php echo $config_robots; ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="config_seo_url" class="col-sm-3 control-label"><?php echo $entry_seo_url; ?></label>
                                    <div class="col-sm-2">
                                        <?php if ($config_seo_url) { ?>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="config_seo_url" id="optionsRadios1" value="1" checked>
                                                <?php echo $text_yes; ?>
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="config_seo_url" id="optionsRadios2" value="0">
                                                <?php echo $text_no; ?>
                                            </label>
                                        </div>
                                        <?php } else { ?>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="config_seo_url" id="optionsRadios1" value="1">
                                                <?php echo $text_yes; ?>
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="config_seo_url" id="optionsRadios2" value="0" checked>
                                                <?php echo $text_no; ?>
                                            </label>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="config_file_extension_allowed" class="col-sm-3 control-label"><?php echo $entry_file_extension_allowed; ?></label>
                                    <div class="col-sm-5">
                                        <textarea class="form-control" id="config_file_extension_allowed" placeholder="" rows="7" name="config_file_extension_allowed"><?php echo $config_file_extension_allowed; ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="config_file_mime_allowed" class="col-sm-3 control-label"><?php echo $entry_file_mime_allowed; ?></label>
                                    <div class="col-sm-5">
                                        <textarea class="form-control" id="config_file_mime_allowed" placeholder="" rows="7" name="config_file_mime_allowed"><?php echo $config_file_mime_allowed; ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="config_maintenance" class="col-sm-3 control-label"><?php echo $entry_maintenance; ?></label>
                                    <div class="col-sm-2">
                                        <?php if ($config_maintenance) { ?>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="config_maintenance" id="optionsRadios1" value="1" checked>
                                                <?php echo $text_yes; ?>
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="config_maintenance" id="optionsRadios2" value="0">
                                                <?php echo $text_no; ?>
                                            </label>
                                        </div>
                                        <?php } else { ?>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="config_maintenance" id="optionsRadios1" value="1">
                                                <?php echo $text_yes; ?>
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="config_maintenance" id="optionsRadios2" value="0" checked>
                                                <?php echo $text_no; ?>
                                            </label>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="config_password" class="col-sm-3 control-label"><?php echo $entry_password; ?></label>
                                    <div class="col-sm-2">
                                        <?php if ($config_password) { ?>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="config_password" id="optionsRadios1" value="1" checked>
                                                <?php echo $text_yes; ?>
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="config_password" id="optionsRadios2" value="0">
                                                <?php echo $text_no; ?>
                                            </label>
                                        </div>
                                        <?php } else { ?>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="config_password" id="optionsRadios1" value="1">
                                                <?php echo $text_yes; ?>
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="config_password" id="optionsRadios2" value="0" checked>
                                                <?php echo $text_no; ?>
                                            </label>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="config_encryption" class="col-sm-3 control-label"><?php echo $entry_encryption; ?></label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="config_encryption" placeholder="<?php //echo $entry_encryption; ?>" name="config_encryption" value="<?php echo $config_encryption; ?>">
                                        <?php if ($error_encryption) { ?>
                                        <span class="error"><?php echo $error_encryption; ?></span>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="config_compression" class="col-sm-3 control-label"><?php echo $entry_compression; ?></label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="config_compression" placeholder="<?php //echo $entry_compression; ?>" name="config_compression" value="<?php echo $config_compression; ?>">
                                    </div>
                                </div>class="img-thumbnail"
                                <div class="form-group">
                                    <label for="config_error_display" class="col-sm-3 control-label"><?php echo $entry_error_display; ?></label>
                                    <div class="col-sm-2">
                                        <?php if ($config_error_display) { ?>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="config_error_display" id="optionsRadios1" value="1" checked>
                                                <?php echo $text_yes; ?>
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="config_error_display" id="optionsRadios2" value="0">
                                                <?php echo $text_no; ?>
                                            </label>
                                        </div>
                                        <?php } else { ?>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="config_error_display" id="optionsRadios1" value="1">
                                                <?php echo $text_yes; ?>
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="config_error_display" id="optionsRadios2" value="0" checked>
                                                <?php echo $text_no; ?>
                                            </label>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="config_error_log" class="col-sm-3 control-label"><?php echo $entry_error_log; ?></label>
                                    <div class="col-sm-2">
                                        <?php if ($config_error_log) { ?>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="config_error_log" id="optionsRadios1" value="1" checked>
                                                <?php echo $text_yes; ?>
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="config_error_log" id="optionsRadios2" value="0">
                                                <?php echo $text_no; ?>
                                            </label>
                                        </div>
                                        <?php } else { ?>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="config_error_log" id="optionsRadios1" value="1">
                                                <?php echo $text_yes; ?>
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="config_error_log" id="optionsRadios2" value="0" checked>
                                                <?php echo $text_no; ?>
                                            </label>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="config_error_filename" class="col-sm-3 control-label"><?php echo $entry_error_filename; ?></label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="config_error_filename" placeholder="<?php //echo $entry_error_filename; ?>" name="config_error_filename" value="<?php echo $config_error_filename; ?>">
                                        <?php if ($error_error_filename) { ?>
                                        <span class="error"><?php echo $error_error_filename; ?></span>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="config_google_analytics" class="col-sm-3 control-label"><?php echo $entry_google_analytics; ?></label>
                                    <div class="col-sm-5">
                                        <textarea class="form-control" id="config_google_analytics" placeholder="" rows="7" name="config_google_analytics"><?php echo $config_google_analytics; ?></textarea>
                                    </div>
                                </div>
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
$('#template').load('index.php?route=setting/setting/template&token=<?php echo $token; ?>&template=' + encodeURIComponent($('select[name=\'config_template\']').attr('value')));
//--></script> 
<script type="text/javascript"><!--
$('select[name=\'config_country_id\']').bind('change', function() {

	$.ajax({
		url: 'index.php?route=setting/setting/country&token=<?php echo $token; ?>&country_id=' + this.value,
		dataType: 'json',
		beforeSend: function() {
			$('select[name=\'country_id\']').after('<span class="wait">&nbsp;<img src="view/image/loading.gif" alt="" /></span>');
		},		
		complete: function() {
			$('.wait').remove();
		},			
		success: function(json) {
			if (json['postcode_required'] == '1') {
				$('#postcode-required').show();
			} else {
				$('#postcode-required').hide();
			}
			
			html = '<option value=""><?php echo $text_select; ?></option>';
			
			if (json['zone'] != '') {
				for (i = 0; i < json['zone'].length; i++) {
        			html += '<option value="' + json['zone'][i]['zone_id'] + '"';
	    			
					if (json['zone'][i]['zone_id'] == '<?php echo $config_zone_id; ?>') {
	      				html += ' selected="selected"';
	    			}
	
	    			html += '>' + json['zone'][i]['name'] + '</option>';
				}
			} else {
				html += '<option value="0" selected="selected"><?php echo $text_none; ?></option>';
			}
			
			$('select[name=\'config_zone_id\']').html(html);
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});

$('select[name=\'config_country_id\']').trigger('change');
//--></script> 
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