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
            <li><a href="#">Home</a></li>
            <li class="active"><?php echo $heading_title?></li>
        </ul>
    </div>
    <!-- /breadcrumb line -->
    <div class="block">
        <ul class="statistics">
            <li>
                <div class="statistics-info">
                    <a href="<?php echo $customer_approved?>" title="" class="bg-success"><i class="icon-user-plus"></i></a>
                    <strong><?php echo $total_customer?></strong>
                </div>
                <div class="progress progress-micro">
                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                        <span class="sr-only">60% Complete</span>
                    </div>
                </div>
                <span><?php echo $text_total_customer?></span>
            </li>
            <li>
                <div class="statistics-info">
                    <a href="<?php echo $customer_waiting?>" title="" class="bg-warning"><i class="icon-thumbs-up3"></i></a>
                    <strong><?php echo $total_customer_approval?></strong>
                </div>
                <div class="progress progress-micro">
                    <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                        <span class="sr-only">60% Complete</span>
                    </div>
                </div>
                <span><?php echo $text_total_customer_approval?></span>
            </li>
            <li>
                <div class="statistics-info">
                    <a href="#" title="" class="bg-info"><i class="icon-home"></i></a>
                    <strong><?php echo $total_withdraw?></strong>
                </div>
                <div class="progress progress-micro">
                    <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                        <span class="sr-only">60% Complete</span>
                    </div>
                </div>
                <span><?php echo $text_total_transfer?></span>
            </li>
            <li>
                <div class="statistics-info">
                    <a href="#" title="" class="bg-danger"><i class="icon-home"></i></a>
                    <strong><?php echo $total_withdraw_approval?></strong>
                </div>
                <div class="progress progress-micro">
                    <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                        <span class="sr-only">60% Complete</span>
                    </div>
                </div>
                <span><?php echo $text_total_transfer_request?></span>
            </li>
            <li>
                <div class="statistics-info">
                    <a href="#" title="" class="bg-primary"><i class="icon-tag2"></i></a>
                    <strong><?php echo $total_transfer_request?></strong>
                </div>
                <div class="progress progress-micro">
                    <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                        <span class="sr-only">60% Complete</span>
                    </div>
                </div>
                <span><?php echo $text_transfer_request?></span>
            </li>
            <li>
                <div class="statistics-info">
                    <a href="#" title="" class="bg-danger"><i class="icon-coin"></i></a>
                    <strong><?php echo $general_balance?></strong>
                </div>
                <div class="progress progress-micro">
                    <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="93" aria-valuemin="0" aria-valuemax="100" style="width: 93%;">
                        <span class="sr-only">93% Complete</span>
                    </div>
                </div>
                <span><?php echo $text_general_balance?></span>
            </li>
        </ul>
    </div>
    
</div>
<!-- /form components -->
<?php echo $footer?>