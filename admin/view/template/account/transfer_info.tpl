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
    <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form" class="form-horizontal form-bordered" role="form" id="form">
        <div class="panel panel-default">
            <div class="panel-heading"><h6 class="panel-title"><i class="icon-transmission"></i> <?php echo $heading_title?></h6></div>
            <div class="panel-body">
                <div class="tabbable page-tabs">
                    <div class="vtabs">
                        <a href="#tab-transfer_detail" id="">Transfer Details</a>
                        <a href="#tab-merchant_detail" id="">Merchant Details</a>
                        <a href="#tab-transfer_form" id="">Transfer Form</a>
                        <a href="#tab-transfer_history" id="">Transfer History</a>
                    </div>
                    <div class="unit-form">
                        <div id="tab-transfer_detail" class="vtabs-content">
                            <div class="row">
                                <h2>Transfer Details</h2>
                                <div class="col-md-6">
                                    <table class="table table-responsive table-hover col-md-5">
                                        <tr>
                                            <td class="col-md-3">Order Id :</td>
                                            <td>#<?php echo $transfer['transfer_id']?></td>
                                        </tr>
                                        <tr>
                                            <td class="col-md-3">Invoice No.: </td>
                                            <td>
                                                <?php if ($transfer['invoice_no']) { ?>
                                                <?php echo $transfer['invoice_no']?>
                                                <?php } else { ?>
                                                <span id="invoice"><b>[ </b> <a id="invoice-generate"><?php echo $transfer['generate'] ?></a> <b> ]</span>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="col-md-3">Store Url: </td>
                                            <td><?php echo $transfer['url']?></td>
                                        </tr>
                                        <tr>
                                            <td class="col-md-3">Customer: </td>
                                            <td><?php echo $transfer['customer']?></td>
                                        </tr>
                                        <tr>
                                            <td class="col-md-3">Total: </td>
                                            <td><?php echo $transfer['total']?></td>
                                        </tr>
                                        <tr>
                                            <td class="col-md-3">Transfer Status: </td>
                                            <td><?php echo $transfer['status']?></td>
                                        </tr>
                                        <tr>
                                            <td class="col-md-3">Comment: </td>
                                            <td><?php echo $transfer['comment']?></td>
                                        </tr>
                                        <tr>
                                            <td class="col-md-3">IP Address: </td>
                                            <td><?php echo $transfer['ip']?></td>
                                        </tr>
                                        <tr>
                                            <td class="col-md-3">User Agent: </td>
                                            <td><?php echo $transfer['user_agent']?></td>
                                        </tr>
                                        <tr>
                                            <td class="col-md-3">Accept Language: </td>
                                            <td><?php echo $transfer['accept_language']?></td>
                                        </tr>
                                        <tr>
                                            <td class="col-md-3">Date Added: </td>
                                            <td><?php echo $transfer['date_added']?></td>
                                        </tr>
                                    </table> 
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tab-merchant_detail" class="vtabs-content">
                        <div class="row">
                            <h2>Merchant Details</h2>
                            <div class="col-md-6">
                                <table class="table table-responsive table-hover col-md-5">
                                    <tr>
                                        <td class="col-md-3">Customer: </td>
                                        <td><?php echo $merchant['customer']?></td>
                                    </tr>
                                    <tr>
                                        <td class="col-md-3">Customer Group: </td>
                                        <td><?php echo $merchant['customer_group']?></td>
                                    </tr>
                                    <tr>
                                        <td class="col-md-3">E-Mail: </td>
                                        <td><?php echo $merchant['email']?></td>
                                    </tr>
                                    <tr>
                                        <td class="col-md-3">Telephone: </td>
                                        <td><?php echo $merchant['telephone']?></td>
                                    </tr>
                                    <tr>
                                        <td class="col-md-3">Date Registered: </td>
                                        <td><?php echo $merchant['date_added']?></td>
                                    </tr>
                                </table> 
                            </div>
                        </div>
                    </div>
                    <div id="tab-transfer_form" class="vtabs-content">
                        <h2>Transfer Order</h2>
                        <p>Please include the following information on all wire transfers to your bank account:</p>
                        <div class='row'>
                            <div class='col-md-6'>
                                <table class="table table-responsive table-hover col-md-6">
                                    <tr>
                                        <td class="col-md-3">Account Holder: </td>
                                        <td><?php echo $account['customer']?></td>
                                    </tr>
                                    <tr>
                                        <td class="col-md-3">Bank Name: </td>
                                        <td><?php echo $account['bank_name']?></td>
                                    </tr>
                                    <tr>
                                        <td class="col-md-3">IBAN: </td>
                                        <td><?php echo $account['iban']?></td>
                                    </tr>
                                    <tr>
                                        <td class="col-md-3">SWIFT / BIC: </td>
                                        <td><?php echo $account['swift']?></td>
                                    </tr>
                                    <tr>
                                        <td class="col-md-3">REFERENCE :<br/><span class='help'>[EX : INVOICE NUMBER]</span> </td>
                                        <td>
                                            <?php if ($account['invoice_no']) { ?>
                                            <?php echo $account['invoice_no']?>
                                            <?php } else { ?>
                                            <span id='reference'>--</span>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="col-md-3">Amount & Currency: </td>
                                        <td>
                                            <?php echo $account['total']?>
                                        </td>
                                    </tr>
                                </table> 
                            </div>
                            <div class='col-md-6'>

                            </div>
                        </div>
                    </div>
                    <div id="tab-transfer_history" class="vtabs-content">
                        <h2>Transfer History</h2>
                        <div class='row'>
                            <div class='col-md-6'>
                                <div class="panel-default">
                                    <div class="panel-heading"><h6 class="panel-title"><i class="icon-transmission"></i> Managing Transfer:</h6></div>
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <label for="personal_id" class="col-md-3 control-label">Transfer Status :</label>
                                            <div class="col-md-3">
                                                
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="personal_id" class="col-md-3 control-label">Notify Customer :</label>
                                            <div class="col-md-3">
                                                
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="personal_id" class="col-md-3 control-label">Comment :</label>
                                            <div class="col-md-3">
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class='col-md-6'>
                                <table class="table table-responsive table-hover col-md-6">
                                    <tr>
                                        <td class="col-md-3">Account Holder: </td>
                                        <td><?php echo $account['customer']?></td>
                                    </tr>
                                    <tr>
                                        <td class="col-md-3">Bank Name: </td>
                                        <td><?php echo $account['bank_name']?></td>
                                    </tr>
                                    <tr>
                                        <td class="col-md-3">IBAN: </td>
                                        <td><?php echo $account['iban']?></td>
                                    </tr>
                                    <tr>
                                        <td class="col-md-3">SWIFT / BIC: </td>
                                        <td><?php echo $account['swift']?></td>
                                    </tr>
                                    <tr>
                                        <td class="col-md-3">REFERENCE :<br/><span class='help'>[EX : INVOICE NUMBER]</span> </td>
                                        <td>
                                            <?php if ($account['invoice_no']) { ?>
                                            <?php echo $account['invoice_no']?>
                                            <?php } else { ?>
                                            <span id='reference'>--</span>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="col-md-3">Amount & Currency: </td>
                                        <td>
                                            <?php echo $account['total']?>
                                        </td>
                                    </tr>
                                </table> 
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
//--></script>
<?php echo $footer?>