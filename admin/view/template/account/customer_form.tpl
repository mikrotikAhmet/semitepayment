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
            <div class="panel-heading"><h6 class="panel-title"><i class="icon-users2"></i> <?php echo $heading_title?></h6></div>
            <div class="panel-body">
                <div class="tabbable page-tabs">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_general" data-toggle="tab"><?php echo $tab_general; ?></a></li>
                        <li class=""><a href="#tab_address" data-toggle="tab"><?php echo $tab_address; ?></a></li>
                        <?php if ($customer_id) { ?>
                        <li class=""><a href="#tab_account" data-toggle="tab"><?php echo $tab_account; ?></a></li>
                        <li class=""><a href="#tab_bank" data-toggle="tab"><?php echo $tab_bank; ?></a></li>
                        <li class=""><a href="#tab_card" data-toggle="tab"><?php echo $tab_card; ?></a></li>
                        <li class=""><a href="#tab_transaction" data-toggle="tab"><?php echo $tab_transaction; ?></a></li>
                        <?php } ?>
                        <li class=""><a href="#tab_ip" data-toggle="tab"><?php echo $tab_ip; ?></a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active fade in" id="tab_general">
                            <div class="form-group">
                                <label for="firstname" class="col-sm-2 control-label"><span class="required">*</span> <?php echo $entry_firstname; ?></label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" name="firstname" value="<?php echo $firstname; ?>" />
                                    <?php if ($error_firstname) { ?>
                                    <span class="error"><?php echo $error_firstname; ?></span>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="lastname" class="col-sm-2 control-label"><span class="required">*</span> <?php echo $entry_lastname; ?></label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" name="lastname" value="<?php echo $lastname; ?>" />
                                    <?php if ($error_lastname) { ?>
                                    <span class="error"><?php echo $error_lastname; ?></span>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="personal_id" class="col-sm-2 control-label"><?php echo $entry_personal_id; ?></label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" name="personal_id" value="<?php echo $personal_id; ?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-sm-2 control-label"><span class="required">*</span> <?php echo $entry_email; ?></label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="email" value="<?php echo $email; ?>" />
                                    <?php if ($error_email) { ?>
                                    <span class="error"><?php echo $error_email; ?></span>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password" class="col-sm-2 control-label"><span class="required">*</span> <?php echo $entry_password; ?></label>
                                <div class="col-sm-3">
                                    <input type="password" class="form-control" name="password" value="<?php echo $password; ?>" />
                                    <?php if ($error_password) { ?>
                                    <span class="error"><?php echo $error_password; ?></span>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="confirm" class="col-sm-2 control-label"><span class="required">*</span> <?php echo $entry_confirm; ?></label>
                                <div class="col-sm-3">
                                    <input type="password" class="form-control" name="confirm" value="<?php echo $confirm; ?>" />
                                    <?php if ($error_confirm) { ?>
                                    <span class="error"><?php echo $error_confirm; ?></span>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="newsletter" class="col-sm-2 control-label"><?php echo $entry_newsletter; ?></label>
                                <div class="col-sm-2">
                                    <select name="newsletter" class="form-control">
                                        <?php if ($newsletter) { ?>
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

                        </div>
                        <div class="tab-pane fade" id="tab_address">
                        <div class="form-group">
                            <label for="customer_group_id" class="col-sm-2 control-label"><?php echo $entry_customer_group?></label>
                            <div class="col-sm-3">
                                <select name="customer_group_id" class="form-control">
                                    <?php foreach ($customer_groups as $customer_group) { ?>
                                    <?php if ($customer_group['customer_group_id'] == $customer_group_id) { ?>
                                    <option value="<?php echo $customer_group['customer_group_id']?>" selected="selected"><?php echo $customer_group['name']?></option>
                                    <?php } else { ?>
                                    <option value="<?php echo $customer_group['customer_group_id']?>"><?php echo $customer_group['name']?></option>
                                    <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <input type="hidden" name="address[<?php echo $address_row; ?>][address_id]" value="<?php echo (isset($addresses[$address_row]['address_id']) ? $addresses[$address_row]['address_id'] :null); ?>" />
                        <div class="form-group" id="legal">
                        <label for="legal" class="col-sm-2 control-label"><span id="legal_required" class="required">*</span> <?php echo $entry_company?></label>
                        <div class="col-sm-3">
                            <input type="text" name="address[<?php echo $address_row; ?>][company]" value="<?php echo (isset($addresses[$address_row]['company']) ? $addresses[$address_row]['company'] : null); ?>" class="form-control"/><br/>
                             <?php if (isset($error_address_company[$address_row])) { ?>
                            <span class="error"><?php echo $error_address_company[$address_row]; ?></span>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="form-group" id="company-id-display">
                        <label for="company_id" class="col-sm-2 control-label"><span id="company-id-required" class="required">*</span> <?php echo $entry_company_id?></label>
                        <div class="col-sm-3">
                            <input type="text" name="address[<?php echo $address_row; ?>][company_id]" value="<?php echo (isset($addresses[$address_row]['company_id']) ? $addresses[$address_row]['company_id'] : null); ?>" class="form-control"/><br/>
                            <?php if (isset($error_address_company_id[$address_row])) { ?>
                            <span class="error"><?php echo $error_address_company_id[$address_row]; ?></span>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="form-group" id="tax-id-display">
                        <label for="tax_id" class="col-sm-2 control-label"><span id="tax-id-required" class="required">*</span> <?php echo $entry_tax_id?></label>
                        <div class="col-sm-3">
                            <input type="text" name="address[<?php echo $address_row; ?>][tax_id]" value="<?php echo (isset($addresses[$address_row]['tax_id']) ? $addresses[$address_row]['tax_id'] : null); ?>" class="form-control"/><br/>
                            <?php if (isset($error_address_tax_id[$address_row])) { ?>
                            <span class="error"><?php echo $error_address_tax_id[$address_row]; ?></span>
                            <?php } ?>
                        </div>
                    </div>
                        <div class="form-group">
                            <label for="address_firstname" class="col-sm-2 control-label"><span class="required">*</span> <?php echo $entry_firstname; ?></label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" name="address[<?php echo $address_row; ?>][firstname]" value="<?php echo (isset($addresses[$address_row]['firstname']) ? $addresses[$address_row]['firstname'] : null); ?>" />
                                    <?php if (isset($error_address_firstname[$address_row])) { ?>
                                    <span class="error"><?php echo $error_address_firstname[$address_row]; ?></span>
                                    <?php } ?>
                                </div>
                        </div>
                        <div class="form-group">
                            <label for="address_lastname" class="col-sm-2 control-label"><span class="required">*</span> <?php echo $entry_lastname; ?></label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" name="address[<?php echo $address_row; ?>][lastname]" value="<?php echo (isset($addresses[$address_row]['lastname']) ? $addresses[$address_row]['lastname'] : null); ?>" />
                                    <?php if (isset($error_address_lastname[$address_row])) { ?>
                                    <span class="error"><?php echo $error_address_lastname[$address_row]; ?></span>
                                    <?php } ?>
                                </div>
                        </div>
                        <div class="form-group">
                        <label for="address_1" class="col-sm-2 control-label"><?php echo $entry_address_1?></label>
                        <div class="col-sm-4">
                            <input type="text" name="address[<?php echo $address_row; ?>][address_1]" value="<?php echo (isset($addresses[$address_row]['address_1']) ? $addresses[$address_row]['address_1'] : null); ?>" class="form-control"/>
                                <?php if (isset($error_address_address_1[$address_row])) { ?>
                                <span class="error"><?php echo $error_address_address_1[$address_row]; ?></span>
                                <?php } ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="address_2" class="col-sm-2 control-label"></label>
                        <div class="col-sm-4">
                            <input type="text" name="address[<?php echo $address_row; ?>][address_2]" placeholder="<?php echo $entry_address_2?>" value="<?php echo (isset($addresses[$address_row]['address_2']) ? $addresses[$address_row]['address_2'] : null); ?>" class="form-control"/>
                        </div>
                    </div>
                        <div class="form-group">
                        <label for="city" class="col-sm-2 control-label"></label>
                        <div class="col-sm-2">
                            <input type="text" name="address[<?php echo $address_row; ?>][city]" placeholder="<?php echo $entry_city?>" value="<?php echo (isset($addresses[$address_row]['city']) ? $addresses[$address_row]['city'] : null); ?>" class="form-control"/>
                            <?php if (isset($error_address_city[$address_row])) { ?>
                            <span class="error"><?php echo $error_address_city[$address_row]; ?></span>
                            <?php } ?>
                        </div>
                        <div class="col-sm-2" id="postcode-required">
                            <input type="text" name="address[<?php echo $address_row; ?>][postcode]" placeholder="<?php echo $entry_postcode?>" value="<?php echo (isset($addresses[$address_row]['postcode']) ? $addresses[$address_row]['postcode'] : null); ?>" class="form-control"/>
                        </div>
                    </div>
                        <div class="form-group">
                        <label for="country_id" class="col-sm-2 control-label"><?php echo $entry_country?></label>
                        <div class="col-sm-4">
                            <select name="address[<?php echo $address_row; ?>][country_id]" onchange="country(this, '<?php echo $address_row; ?>', '<?php echo (isset($addresses[$address_row]['zone_id']) ? $addresses[$address_row]['zone_id'] : null); ?>');" class="form-control">
                                <option value=""><?php echo $text_select?></option>
                                <?php foreach ($countries as $country) { ?>
                                <?php if ($country['country_id'] == $addresses[$address_row]['country_id']) { ?>
                                <option value="<?php echo $country['country_id']?>" selected="selected"><?php echo $country['name']?></option>
                                <?php } else { ?>
                                <option value="<?php echo $country['country_id']?>"><?php echo $country['name']?></option>
                                <?php } ?>
                                <?php } ?>
                            </select>
                            <?php if (isset($error_address_country[$address_row])) { ?>
                            <span class="error"><?php echo $error_address_country[$address_row]; ?></span>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="zone_id" class="col-sm-2 control-label"><?php echo $entry_zone?></label>
                        <div class="col-sm-4">
                            <select name="address[<?php echo $address_row; ?>][zone_id]" class="form-control">
                            </select>
                            <?php if (isset($error_address_zone[$address_row])) { ?>
                            <span class="error"><?php echo $error_address_zone[$address_row]; ?></span>
                            <?php } ?>
                        </div>
                    </div>
                    </div>
                        <div class="tab-pane fade" id="tab_account">
                        <h2><?php echo $text_bank_information?></h2>
                        <table class="list table table-bordered table-hover">
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="visible">
                                            <div class="title col-sm-4">
                                                <?php echo $text_account?>
                                            </div>
                                            <div class="shown col-sm-6"><?php echo $customer_account['account_number']?></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="visible">
                                            <div class="title col-sm-4">
                                                <?php echo $text_iban?>
                                            </div>
                                            <div class="shown col-sm-6"><?php echo $customer_account['iban']?></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="visible">
                                            <div class="title col-sm-4">
                                                <?php echo $text_swift?>
                                            </div>
                                            <div class="shown col-sm-6"><?php echo $customer_account['swift_bic']?></div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <br/>
                        <h2><?php echo $text_card_information?></h2>
                        <table class="list table table-bordered table-hover">
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="visible">
                                            <div class="title col-sm-4">
                                                 <?php echo $text_holder?>
                                            </div>
                                            <div class="shown col-sm-6"><?php echo strtoupper($firstname.' '.$lastname); ?></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="visible">
                                            <div class="title col-sm-4">
                                                 <?php echo $text_card?>
                                            </div>
                                            <div class="shown col-sm-6"><?php echo $customer_account['v_card_number']?></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="visible">
                                            <div class="title col-sm-4">
                                                 <?php echo $text_cvv?>
                                            </div>
                                            <div class="shown col-sm-6"><?php echo $customer_account['v_card_ccv']?></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="visible">
                                            <div class="title col-sm-4">
                                                 <?php echo $text_expire?>
                                            </div>
                                            <div class="shown col-sm-6"><?php echo $customer_account['date_expire']?></div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                        <div class="tab-pane fade" id="tab_bank">
                        <?php if (!$banks) { ?>
                                <div class="callout callout-danger fade in bank">
                                   <?php echo $text_no_bank?>
                                </div>
                        <?php } ?>
                        <table class="table table-hover" id="bank">
                            <thead>
                                <th><?php echo $column_bank_name?></th>
                                <th><?php echo $column_currency?></th>
                                <th><?php echo $column_ahn?></th>
                                <th><?php echo $column_iban?></th>
                                <th><?php echo $column_swift?></th>
                                <th><?php echo $column_status?></th>
                                <th width="5%"></th>
                            </thead>
                            <?php $bank_row = 0; ?>
                            <?php foreach ($banks as $bank) { ?>
                            <tbody id="bank-row<?php echo $bank_row; ?>">
                                <tr>
                                    <td><input type="hidden" name="bank[<?php echo $bank_row?>][bank_name]" value="<?php echo $bank['bank_name']?>"/><?php echo $bank['bank_name']?></td>
                                    <td><input type="hidden" name="bank[<?php echo $bank_row?>][settlement_currency]" value="<?php echo $bank['settlement_currency']?>"/><?php echo $bank['settlement_currency']?></td>
                                    <td><input type="hidden" name="bank[<?php echo $bank_row?>][account_holder_name]" value="<?php echo $bank['account_holder']?>"/><?php echo $bank['account_holder']?></td>
                                    <td><input type="hidden" name="bank[<?php echo $bank_row?>][iban]" value="<?php echo $bank['iban']?>"/><?php echo $bank['iban']?></td>
                                    <td><input type="hidden" name="bank[<?php echo $bank_row?>][swift]" value="<?php echo $bank['swift']?>"/><?php echo $bank['swift']?></td>
                                    <td><input type="hidden" name="bank[<?php echo $bank_row?>][verified]" value="<?php echo $bank['verified']?>"/><?php echo $bank['status']?></td>
                                    <td class="left"><a onclick="$('#bank-row<?php echo $bank_row; ?>').remove();" class="btn btn-danger btn-sm"><?php echo $button_remove; ?></a></td>
                                </tr>
                            </tbody>
                            <?php $bank_row++; ?>
                            <?php } ?>
                            <tfoot>
                            <tr>
                                <td colspan="6"></td>
                                <td class="left">
                                    <a data-toggle="modal" role="button" href="#createBank" class="btn btn-primary btn-sm"><?php echo $button_add_new?></a>
                                </td>
                            </tr>
                        </tfoot>
                        </table>
                        </div>
                        <div class="tab-pane fade" id="tab_card">
                            <?php if (!$cards) { ?>
                        <div class="callout callout-danger fade in card">
                            <?php echo $text_no_card?>
                         </div>
                            <?php } ?>
                            <table class="table table-hover" id="card">
                            <thead>
                                <th><?php echo $column_card_holder?></th>
                                <th><?php echo $column_type?></th>
                                <th><?php echo $column_number?></th>
                                <th><?php echo $column_status?></th>
                                <th width="5%"></th>
                            </thead>
                            <?php $card_row = 0; ?>
                            <?php foreach ($cards as $card) { ?>
                            <tbody id="card-row<?php echo $card_row; ?>">
                                <tr>
                                    <td><input type="hidden" name="card[<?php echo $card_row?>][card_holder]" value="<?php echo $card['card_holder']?>"/><?php echo $card['card_holder']?></td>
                                    <td><input type="hidden" name="card[<?php echo $card_row?>][type]" value="<?php echo $card['type']?>"/><?php echo $card['type']?></td>
                                    <td><input type="hidden" name="card[<?php echo $card_row?>][cc_number]" value="<?php echo $card['cc_number']?>"/><?php echo $card['cc_number']?></td>
                                    <td><input type="hidden" name="card[<?php echo $card_row?>][verified]" value="<?php echo $card['verified']?>"/><?php echo $card['status']?></td>
                                    <td><input type="hidden" name="card[<?php echo $card_row?>][ccv]" value="<?php echo $card['ccv']?>"/></td>
                                    <td><input type="hidden" name="card[<?php echo $card_row?>][date_expire]" value="<?php echo $card['date_expire']?>"/></td>
                                    <td class="left"><a onclick="$('#card-row<?php echo $card_row; ?>').remove();" class="btn btn-danger btn-sm"><?php echo $button_remove; ?></a></td>
                                </tr>
                            </tbody>
                            <?php $card_row++; ?>
                            <?php } ?>
                            <tfoot>
                            <tr>
                                <td colspan="6"></td>
                                <td class="left">
                                    <a data-toggle="modal" role="button" href="#createCard" class="btn btn-primary btn-sm"><?php echo $button_add_new?></a>
                                </td>
                            </tr>
                        </tfoot>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="tab_transaction">
                        <?php if (!$transactions) { ?>
                        <div class="callout callout-danger fade in">
                                   <?php echo $text_no_transaction?>
                                </div>
                        <?php } ?>
                        <table class="list table table-bordered table-hover">
                        <thead>
                            <th><?php echo $column_transaction_id?></th>
                            <th><?php echo $column_date?></th>
                            <th><?php echo $column_ttype?></th>
                            <th><?php echo $column_description?></th>
                            <th><?php echo $column_status?></th>
                        </thead>
                        <tbody>
                            <?php foreach ($transactions as $transaction) { ?>
                            <tr>
                                <td><?php echo $transaction['transaction_id']?></td>
                                <td><?php echo $transaction['date_added']?></td>
                                <?php if ($transaction['type'] == 'Deposit') { ?>
                                <td><i class="glyphicon glyphicon-share-alt"></i> <?php echo $transaction['type']?></td>
                                <?php } ?>
                                <td><?php echo $transaction['description']?></td>
                                <td><i class="glyphicon glyphicon-ok"></i> Processed</td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    </div>
                    <div class="tab-pane fade" id="tab_ip">
                        <table class="list table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <td class="left"><?php echo $column_ip; ?></td>
                                    <td class="right"><?php echo $column_total; ?></td>
                                    <td class="left"><?php echo $column_date_added; ?></td>
                                    <td class="right"><?php echo $column_action; ?></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($ips) { ?>
                                <?php foreach ($ips as $ip) { ?>
                                <tr>
                                    <td class="left"><a href="http://www.geoiptool.com/en/?IP=<?php echo $ip['ip']; ?>" target="_blank"><?php echo $ip['ip']; ?></a></td>
                                    <td class="right"><a href="<?php echo $ip['filter_ip']; ?>" target="_blank"><?php echo $ip['total']; ?></a></td>
                                    <td class="left"><?php echo $ip['date_added']; ?></td>
                                    <td class="right"><?php if ($ip['ban_ip']) { ?>
                                        <b>[</b> <a id="<?php echo str_replace('.', '-', $ip['ip']); ?>" onclick="removeBanIP('<?php echo $ip['ip']; ?>');"><?php echo $text_remove_ban_ip; ?></a> <b>]</b>
                                        <?php } else { ?>
                                        <b>[</b> <a id="<?php echo str_replace('.', '-', $ip['ip']); ?>" onclick="addBanIP('<?php echo $ip['ip']; ?>');"><?php echo $text_add_ban_ip; ?></a> <b>]</b>
                                        <?php } ?></td>
                                </tr>
                                <?php } ?>
                                <?php } else { ?>
                                <tr>
                                    <td class="center" colspan="4"><?php echo $text_no_results; ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
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
<!-- Form modal -->
<div id="createBank" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><i class="icon-paragraph-justify2"></i> Modal with form</h4>
            </div>
            <!-- Form inside modal -->
            <form role="form" id="bank-form">
    
                <div class="modal-body with-padding">
                    <div class="block-inner text-danger">
                        <h6 class="heading-hr"><?php echo $title_bank?> <small class="display-block"><?php echo $text_information_bank?></small></h6>
                    </div>
                    <div class="form-group">
                    <label><?php echo $entry_bank?></label>
                    <input type="text" class="form-control" name="bank_name" value="" />
                    </div>
                    <div class="form-group">
                    <label><?php echo $entry_currency?></label>
                    <select name="settlement_currency" class="form-control">
                        <?php foreach ($currencies as $currency) { ?>
                        <option value="<?php echo $currency['code']?>"><?php echo $currency['code']?></option>
                        <?php } ?>
                    </select>
                    </div>
                    <div class="form-group">
                    <label><?php echo $entry_holder_name?></label>
                    <input type="text" class="form-control" name="account_holder_name" value="" />
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <label><?php echo $entry_iban?></label>
                                <input type="text" placeholder="" name="iban" class="form-control">
                                <span class="help-block"></span>
                            </div>
                                    
                            <div class="col-sm-6">
                                <label><?php echo $entry_bic?></label>
                                <input type="text" placeholder=""  name="swift" class="form-control">
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                </div>
            
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal"><?php echo $button_cancel?></button>
                    <button type="button"  onclick="addBank();" data-dismiss="modal" class="btn btn-primary">Submit form</button>
                </div>
            
            </form>
        </div>
    </div>
</div>
<!-- /form modal -->
<!-- Form modal -->
<div id="createCard" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><i class="icon-paragraph-justify2"></i> Modal with form</h4>
            </div>
            <!-- Form inside modal -->
            <form role="form" id="card-form">
    
                <div class="modal-body with-padding">
                    <div class="block-inner text-danger">
                        <h6 class="heading-hr"><?php echo $title_bank?> <small class="display-block"><?php echo $text_information_bank?></small></h6>
                    </div>
                    <div class="form-group">
                    <label><?php echo $entry_card_holder_name?></label>
                    <input type="text" class="form-control" name="card_holder_name" value="" />
                    </div>
                    <div class="form-group">
                    <label><?php echo $entry_cc?></label>
                    <input type="creditcard" class="form-control" name="cc" value="" />
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <label><?php echo $entry_ccv?></label>
                                <input type="text" class="form-control" name="ccv" value="" />
                                <span class="help-block"></span>
                            </div>
                                    
                            <div class="col-sm-6">
                                <label><?php echo $entry_expd?></label>
                                <input type="text" class="form-control" name="expd" value="" />
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                </div>
            
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal"><?php echo $button_cancel?></button>
                    <button type="button"  onclick="addCard();" data-dismiss="modal" class="btn btn-primary">Submit form</button>
                </div>
            
            </form>
        </div>
    </div>
</div>
<!-- /form modal -->
<script type="text/javascript"><!--
    
    $('select[name=\'customer_group_id\']').bind('change', function() {
	var customer_group = [];
	
<?php foreach ($customer_groups as $customer_group) { ?>
	customer_group[<?php echo $customer_group['customer_group_id']; ?>] = [];
    	customer_group[<?php echo $customer_group['customer_group_id']; ?>]['legal'] = '<?php echo $customer_group['legal']; ?>';
        customer_group[<?php echo $customer_group['customer_group_id']; ?>]['legal_required'] = '<?php echo $customer_group['legal_required']; ?>';
	customer_group[<?php echo $customer_group['customer_group_id']; ?>]['company_id_display'] = '<?php echo $customer_group['company_id_display']; ?>';
	customer_group[<?php echo $customer_group['customer_group_id']; ?>]['company_id_required'] = '<?php echo $customer_group['company_id_required']; ?>';
	customer_group[<?php echo $customer_group['customer_group_id']; ?>]['tax_id_display'] = '<?php echo $customer_group['tax_id_display']; ?>';
	customer_group[<?php echo $customer_group['customer_group_id']; ?>]['tax_id_required'] = '<?php echo $customer_group['tax_id_required']; ?>';
<?php } ?>	

	if (customer_group[this.value]) {
    
                if (customer_group[this.value]['legal'] == '1') {
			$('#legal').show();
		} else {
			$('#legal').hide();
		}
                
                if (customer_group[this.value]['legal_required'] == '1') {
			$('#legal_required').show();
		} else {
			$('#legal_required').hide();
		}
                
		if (customer_group[this.value]['company_id_display'] == '1') {
			$('#company-id-display').show();
		} else {
			$('#company-id-display').hide();
		}
		
		if (customer_group[this.value]['company_id_required'] == '1') {
			$('#company-id-required').show();
		} else {
			$('#company-id-required').hide();
		}
		
		if (customer_group[this.value]['tax_id_display'] == '1') {
			$('#tax-id-display').show();
		} else {
			$('#tax-id-display').hide();
		}
		
		if (customer_group[this.value]['tax_id_required'] == '1') {
			$('#tax-id-required').show();
		} else {
			$('#tax-id-required').hide();
		}	
	}
});

$('select[name=\'customer_group_id\']').trigger('change');
//--></script> 
<script type="text/javascript"><!--
$(document).ready(function() {
	$('.birth').datepicker({
            changeMonth: true,
            changeYear: true,
            showButtonPanel: true,
            yearRange: "-100:+0",
            dateFormat: 'yy-mm-dd'
    });
});
//--></script> 
<script type="text/javascript"><!--
function country(element, index, zone_id) {
  if (element.value != '') {
		$.ajax({
			url: 'index.php?route=account/customer/country&token=<?php echo $token; ?>&country_id=' + element.value,
			dataType: 'json',
			beforeSend: function() {
				$('select[name=\'address[' + index + '][country_id]\']').after('<span class="wait">&nbsp;<img src="view/image/loading.gif" alt="" /></span>');
			},
			complete: function() {
				$('.wait').remove();
			},			
			success: function(json) {
				if (json['postcode_required'] == '1') {
					$('#postcode-required' + index).show();
				} else {
					$('#postcode-required' + index).hide();
				}
				
				html = '<option value=""><?php echo $text_select; ?></option>';
				
				if (json['zone'] != '') {
					for (i = 0; i < json['zone'].length; i++) {
						html += '<option value="' + json['zone'][i]['zone_id'] + '"';
						
						if (json['zone'][i]['zone_id'] == zone_id) {
							html += ' selected="selected"';
						}
		
						html += '>' + json['zone'][i]['name'] + '</option>';
					}
				} else {
					html += '<option value="0"><?php echo $text_none; ?></option>';
				}
				
				$('select[name=\'address[' + index + '][zone_id]\']').html(html);
			},
			error: function(xhr, ajaxOptions, thrownError) {
				alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
			}
		});
	}
}

$('select[name$=\'[country_id]\']').trigger('change');
//--></script> 
<script type="text/javascript"><!--
function addBanIP(ip) {
	var id = ip.replace(/\./g, '-');
	
	$.ajax({
		url: 'index.php?route=account/customer/addbanip&token=<?php echo $token; ?>',
		type: 'post',
		dataType: 'json',
		data: 'ip=' + encodeURIComponent(ip),
		beforeSend: function() {
			$('.alert-success, .alert-danger').remove();
			
			$('.box').before('<div class="attention"><img src="view/image/loading.gif" alt="" /> <?php echo $text_wait; ?></div>');		
		},
		complete: function() {
			
		},			
		success: function(json) {
			$('.attention').remove();
			
			if (json['error']) {
				 $('.box').before('<div class="alert alert-danger" style="display: none;">' + json['error'] + '</div>');
				
				$('.alert-danger').fadeIn('slow');
			}
						
			if (json['success']) {
                $('.box').before('<div class="alert alert-success" style="display: none;">' + json['success'] + '</div>');
				
				$('.alert-success').fadeIn('slow');
				
				$('#' + id).replaceWith('<a id="' + id + '" onclick="removeBanIP(\'' + ip + '\');"><?php echo $text_remove_ban_ip; ?></a>');
			}
		}
	});	
}

function removeBanIP(ip) {
	var id = ip.replace(/\./g, '-');
	
	$.ajax({
		url: 'index.php?route=account/customer/removebanip&token=<?php echo $token; ?>',
		type: 'post',
		dataType: 'json',
		data: 'ip=' + encodeURIComponent(ip),
		beforeSend: function() {
			$('.alert-success, .alert-danger').remove();
			
			$('.box').before('<div class="attention"><img src="view/image/loading.gif" alt="" /> <?php echo $text_wait; ?></div>');					
		},	
		success: function(json) {
			$('.attention').remove();
			
			if (json['error']) {
				 $('.box').before('<div class="alert alert-danger" style="display: none;">' + json['error'] + '</div>');
				
				$('.alert-danger').fadeIn('slow');
			}
			
			if (json['success']) {
				 $('.box').before('<div class="alert alert-success" style="display: none;">' + json['success'] + '</div>');
				
				$('.alert-success').fadeIn('slow');
				
				$('#' + id).replaceWith('<a id="' + id + '" onclick="addBanIP(\'' + ip + '\');"><?php echo $text_add_ban_ip; ?></a>');
			}
		}
	});	
};
//--></script>
<script type="text/javascript"><!--
var bank_row = <?php echo ($bank_row ? $bank_row : 0) ?>;

function addBank(){
    var data = $('#bank-form').serializeArray();
    
        html  = '<tbody id="bank-row' + bank_row + '">';
	html += '  <tr>';
	html += '    <td class="left"><input type="hidden" name="bank['+bank_row+'][bank_name]" value="'+data[0].value+'"/>'+data[0].value+'</td>';
        html += '    <td class="left"><input type="hidden" name="bank['+bank_row+'][settlement_currency]" value="'+data[1].value+'"/>'+data[1].value+'</td>';
	html += '    <td class="left"><input type="hidden" name="bank['+bank_row+'][account_holder_name]" value="'+data[2].value+'"/>'+data[2].value+'</td>';
        html += '    <td class="left"><input type="hidden" name="bank['+bank_row+'][iban]" value="'+data[3].value+'"/>'+data[3].value+'</td>';
        html += '    <td class="left"><input type="hidden" name="bank['+bank_row+'][swift]" value="'+data[4].value+'"/>'+data[4].value+'</td>';
	html += '    <td class="left"><a onclick="$(\'#bank-row' + bank_row + '\').remove();" class="btn btn-danger btn-sm"><?php echo $button_remove; ?></a></td>';
	html += '  </tr>';
	html += '</tbody>';
	
	$('#bank > tfoot').before(html);
        
        $('#bank-form').each(function(){
            this.reset();
        });
        
        $('.callout .bank').hide();
	
	bank_row++;
}

var card_row = <?php echo ($card_row ? $card_row : 0) ?>;

function addCard(){

    var data = $('#card-form').serializeArray();
    
    $.ajax({
        url: 'index.php?route=account/customer/cardcheck&token=<?php echo $token; ?>',
        dataType: 'json',
        type : 'GET',
        data : 'cardnum='+$('input[name=\'cc\']').val(),
        success : function (json){
            alert(json[0].card_validation);
            
            if (json[0].card_validation == 'valid'){
                    alert('This is just a test.\n\n Real time Credit Card Validation will be\n\n implemented after Acquiring System integrated.');
                    
                    html  = '<tbody id="card-row' + card_row + '">';
                    html += '  <tr>';
                    html += '    <td class="left"><input type="hidden" name="card['+card_row+'][card_holder]" value="'+data[0].value+'"/>'+data[0].value+'</td>';
                    html += '    <td class="left"><input type="hidden" name="card['+card_row+'][type]" value="'+json[0].card_type+'"/>'+json[0].card_type+'</td>';
                    html += '    <td class="left"><input type="hidden" name="card['+card_row+'][cc_number]" value="'+json[0].card+'"/>'+data[1].value+'</td>';
                    html += '    <td class="left"><input type="hidden" name="card['+card_row+'][ccv]" value="'+data[2].value+'"/></td>';
                    html += '    <td class="left"><input type="hidden" name="card['+card_row+'][date_expire]" value="'+data[3].value+'"/></td>';
                    html += '    <td class="left"><a onclick="$(\'#card-row' + card_row + '\').remove();" class="btn btn-danger btn-sm"><?php echo $button_remove; ?></a></td>';
                    html += '  </tr>';
                    html += '</tbody>';

                    $('#card > tfoot').before(html);

                    $('#card-form').each(function(){
                        this.reset();
                    });

                    $('.callout .card').hide();

                    card_row++;
        
                } else {
                
                alert('Invalid Card Data!');
                }
            },
        error : function(){
            alert('Error!');
            }
    });
}
//--></script>
<?php echo $footer?>