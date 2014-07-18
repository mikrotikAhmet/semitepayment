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
            <div class="panel-heading"><h6 class="panel-title"><i class="icon-cube"></i> <?php echo $heading_title?></h6></div>
            <div class="panel-body">
                <div class="tabbable page-tabs">
                    <div class="vtabs">
                        <a href="#tab-unit1" id="">Transfer Details</a>
                        <a href="#tab-unit2" id="">Merchant Details</a>
                        <a href="#tab-unit3" id="">Transfer Form</a>
                        <a href="#tab-unit4" id="">Transfer History</a>
                    </div>
                    <div class="unit-form">
                        <div id="tab-unit1" class="vtabs-content">
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
                                    <td>[ <?php echo $transfer['generate']?> ]</td>
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
                    <div id="tab-unit2" class="vtabs-content">
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
                                    <td>Individual / Sole Proprietorship</td>
                                </tr>
                                <tr>
                                    <td class="col-md-3">E-Mail: </td>
                                    <td>islekhakan@test.com</td>
                                </tr>
                                <tr>
                                    <td class="col-md-3">Telephone: </td>
                                    <td>589647123</td>
                                </tr>
                                <tr>
                                    <td class="col-md-3">Date Registered: </td>
                                    <td>11/07/2014</td>
                                </tr>
                            </table> 
                                </div>
                            </div>
                    </div>
                    <div id="tab-unit3" class="vtabs-content">
                        Hello Tab 3
                    </div>
                    <div id="tab-unit4" class="vtabs-content">
                        Hello Tab 4
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
<?php echo $footer?>