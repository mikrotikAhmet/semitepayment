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
    <form class="form-horizontal form-btransfered" role="form" id="form">
        <div class="panel panel-default">
            <div class="panel-heading"><h6 class="panel-title"><i class="icon-transmission"></i> <?php echo $heading_title?></h6></div>
            <div class="panel-body">
                <div class="tabbable page-tabs">
                    <div class="vtabs">
                        <a href="#tab-transfer_detail" id=""><?php echo $tab_transfer_detail?></a>
                        <a href="#tab-merchant_detail" id=""><?php echo $tab_merchant_detail?></a>
                        <a href="#tab-transfer_form" id=""><?php echo $tab_transfer_form?></a>
                        <a href="#tab-transfer_history" id=""><?php echo $tab_transfer_history?></a>
                    </div>
                    <div class="unit-form">
                        <div id="tab-transfer_detail" class="vtabs-content">
                            <div class="row">
                                <h2><?php echo $heading_transfer_detail?></h2>
                                <div class="col-md-6">
                                    <table class="table table-responsive table-hover col-md-5">
                                        <tr>
                                            <td class="col-md-3"><?php echo $entry_transfer_id?></td>
                                            <td>#<?php echo $transfer['transfer_id']?></td>
                                        </tr>
                                        <tr>
                                            <td class="col-md-3"><?php echo $entry_invoice_no?> </td>
                                            <td>
                                                <?php if ($transfer['invoice_no']) { ?>
                                                <?php echo $transfer['invoice_no']?>
                                                <?php } else { ?>
                                                <span id="invoice"><b>[ </b> <a id="invoice-generate"><?php echo $transfer['generate'] ?></a> <b> ]</span>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="col-md-3"><?php echo $entry_app_url?> </td>
                                            <td><?php echo $transfer['url']?></td>
                                        </tr>
                                        <tr>
                                            <td class="col-md-3"><?php echo $entry_customer?> </td>
                                            <td><?php echo $transfer['customer']?></td>
                                        </tr>
                                        <tr>
                                            <td class="col-md-3"><?php echo $entry_total?> </td>
                                            <td><?php echo $transfer['total']?></td>
                                        </tr>
                                        <tr>
                                            <td class="col-md-3"><?php echo $entry_status?> </td>
                                            <td><span id="transfer-status"><?php echo $transfer['status']?></span></td>
                                        </tr>
                                        <?php if ($transfer['comment']) { ?>
                                        <tr>
                                            <td class="col-md-3"><?php echo $entry_comment?> </td>
                                            <td><?php echo $transfer['comment']?></td>
                                        </tr>
                                        <?php } ?>
                                        <tr>
                                            <td class="col-md-3"><?php echo $entry_ip?> </td>
                                            <td><?php echo $transfer['ip']?></td>
                                        </tr>
                                        <tr>
                                            <td class="col-md-3"><?php echo $entry_agent?></td>
                                            <td><?php echo $transfer['user_agent']?></td>
                                        </tr>
                                        <tr>
                                            <td class="col-md-3"><?php echo $entry_accept_language?> </td>
                                            <td><?php echo $transfer['accept_language']?></td>
                                        </tr>
                                        <tr>
                                            <td class="col-md-3"><?php echo $entry_date_added?> </td>
                                            <td><?php echo $transfer['date_added']?></td>
                                        </tr>
                                    </table> 
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tab-merchant_detail" class="vtabs-content">
                        <div class="row">
                            <h2><?php echo $heading_merchant_detail?></h2>
                            <div class="col-md-6">
                                <table class="table table-responsive table-hover col-md-5">
                                    <tr>
                                        <td class="col-md-3"><?php echo $entry_customer?> </td>
                                        <td><?php echo $merchant['customer']?></td>
                                    </tr>
                                    <tr>
                                        <td class="col-md-3"><?php echo $entry_customer_group?></td>
                                        <td><?php echo $merchant['customer_group']?></td>
                                    </tr>
                                    <tr>
                                        <td class="col-md-3"><?php echo $entry_email?> </td>
                                        <td><?php echo $merchant['email']?></td>
                                    </tr>
                                    <tr>
                                        <td class="col-md-3"><?php echo $entry_telephone?></td>
                                        <td><?php echo $merchant['telephone']?></td>
                                    </tr>
                                    <tr>
                                        <td class="col-md-3"><?php echo $entry_date_register?> </td>
                                        <td><?php echo $merchant['date_added']?></td>
                                    </tr>
                                </table> 
                            </div>
                        </div>
                    </div>
                    <div id="tab-transfer_form" class="vtabs-content">
                        <h2><?php echo $heading_transfer_form?></h2>
                        <p><?php echo $heading_transfer_form_introduction?></p>
                        <div class='row'>
                            <div class='col-md-6'>
                                <table class="table table-responsive table-hover col-md-6">
                                    <tr>
                                        <td class="col-md-3"><?php echo $entry_account_holder?> </td>
                                        <td><?php echo $account['customer']?></td>
                                    </tr>
                                    <tr>
                                        <td class="col-md-3"><?php echo $entry_bank_name?> </td>
                                        <td><?php echo $account['bank_name']?></td>
                                    </tr>
                                    <tr>
                                        <td class="col-md-3"><?php echo $entry_iban?></td>
                                        <td><?php echo $account['iban']?></td>
                                    </tr>
                                    <tr>
                                        <td class="col-md-3"><?php echo $entry_swift?> </td>
                                        <td><?php echo $account['swift']?></td>
                                    </tr>
                                    <tr>
                                        <td class="col-md-3"><?php echo $entry_reference?> </td>
                                        <td>
                                            <?php if ($account['invoice_no']) { ?>
                                            <?php echo $account['invoice_no']?>
                                            <?php } else { ?>
                                            <span id='reference'>--</span>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="col-md-3"><?php echo $entry_amount?> </td>
                                        <td>
                                            <?php echo $account['total']?>
                                        </td>
                                    </tr>
                                </table> 
                            </div>
                        </div>
                    </div>
                    <div id="tab-transfer_history" class="vtabs-content">
                        <h2><?php echo $heading_transfer_history?></h2>
                        <div class='row'>
                            <div class='col-md-12'>
                                <div id="history"></div>
                            </div>
                            <br/>
                            <div class='col-md-6'>
                                <div class="panel-default">
                                    <div class="panel-heading"><h6 class="panel-title"><i class="icon-transmission"></i> Managing Transfer:</h6></div>
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <label for="personal_id" class="col-md-3 control-label"><?php echo $entry_status?></label>
                                            <div class="col-md-3">
                                                <select name='transfer_status_id' class="form-control">
                                                    <?php foreach ($transaction_statuses As $transaction_status) { ?>
                                                    <?php if ($transfer['transaction_status'] == $transaction_status['transaction_status_id']) { ?>
                                                    <option value="<?php echo $transaction_status['transaction_status_id']?>" selected="selected"><?php echo $transaction_status['name']?></option>
                                                    <?php } else { ?>
                                                    <option value="<?php echo $transaction_status['transaction_status_id']?>" ><?php echo $transaction_status['name']?></option>
                                                    <?php } ?>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="notify" class="col-md-3 control-label"><?php echo $entry_notify?></label>
                                            <div class="col-md-3">
                                                <label class="checkbox-inline checkbox-info">
                                                    <input type="checkbox" class="styled" name="notify" value="1">
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="comment" class="col-md-3 control-label"><?php echo $entry_comment?></label>
                                            <div class="col-md-9">
                                                <textarea name='comment' class="form-control" rows="10"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-actions text-right">
                                            <button type="button" id="button-history" class="btn btn-primary"><i class="icon-transmission"></i> <?php echo $button_modify?></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<script type="text/javascript"><!--
    $('.vtabs a').tabs();
//--></script>
<script type="text/javascript"><!--
$('#invoice-generate').bind('click', function() {
        $.ajax({
            url: 'index.php?route=account/transfer/createinvoiceno&token=<?php echo $token; ?>&transfer_id=<?php echo $transfer['transfer']; ?>',
                    dataType: 'json',
            beforeSend: function() {
                $('#invoice').after('<img src="view/image/loading.gif" class="loading" style="padding-left: 5px;" />');
            },
            complete: function() {
                $('.loading').remove();
            },
            success: function(json) {
                $('.success, .warning').remove();

                if (json['error']) {
                    $('#tab-transfer_detail').prepend('<div class="warning" style="display: none;">' + json['error'] + '</div>');

                    $('.warning').fadeIn('slow');
                }

                if (json.invoice_no) {
                    $('#invoice').fadeOut('slow', function() {
                        $('#invoice').html(json['invoice_no']);
                        $('#reference').html(json['invoice_no']);

                        $('#invoice').fadeIn('slow');
                        $('#reference').fadeIn('slow');
                    });
                }
            }
        });
    });
    
   

    $('#history').load('index.php?route=account/transfer/history&token=<?php echo $token; ?>&transfer_id=<?php echo $transfer['transfer']; ?>');
    
    $('#button-history').bind('click', function() {

	$.ajax({
		url: 'index.php?route=account/transfer/history&token=<?php echo $token; ?>&transfer_id=<?php echo $transfer['transfer']; ?>',
		type: 'post',
		dataType: 'html',
		data: 'transfer_status_id=' + encodeURIComponent($('select[name=\'transfer_status_id\']').val()) + '&notify=' + encodeURIComponent($('input[name=\'notify\']').attr('checked') ? 1 : 0) + '&append=' + encodeURIComponent($('input[name=\'append\']').attr('checked') ? 1 : 0) + '&comment=' + encodeURIComponent($('textarea[name=\'comment\']').val()),
		beforeSend: function() {
			$('.success, .warning').remove();
			$('#button-history').attr('disabled', true);
			$('#history').prepend('<div class="attention"><img src="view/image/loading.gif" alt="" /> <?php echo $text_wait; ?></div>');
		},
		complete: function() {
			$('#button-history').attr('disabled', false);
			$('.attention').remove();
		},
		success: function(html) {
			$('#history').html(html);
			
			$('textarea[name=\'comment\']').val('');
			
			$('#transfer-status').html($('select[name=\'transfer_status_id\'] option:selected').text());
		}
	});
});
//--></script>

<?php echo $footer?>