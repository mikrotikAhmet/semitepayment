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
    <!-- Info Blocks -->
    <ul class="info-blocks">
        <li class="bg-primary">
            <div class="top-info">
                <a href="#">Add new post</a>
                <small>post management</small>
            </div>
            <a href="#"><i class="icon-pencil"></i></a>
            <span class="bottom-info bg-danger">12 drafts in progress</span>
        </li>
        <li class="bg-success">
            <div class="top-info">
                <a href="#">Site parameters</a>
                <small>layout settings</small>
            </div>
            <a href="#"><i class="icon-cogs"></i></a>
            <span class="bottom-info bg-primary">No updates</span>
        </li>
        <li class="bg-danger">
            <div class="top-info">
                <a href="#">Site statistics</a>
                <small>visits, users, orders stats</small>
            </div>
            <a href="#"><i class="icon-stats2"></i></a>
            <span class="bottom-info bg-primary">3 new updates</span>
        </li>
        <li class="bg-info">
            <div class="top-info">
                <a href="#">My messages</a>
                <small>messages history</small>
            </div>
            <a href="#"><i class="icon-bubbles3"></i></a>
            <span class="bottom-info bg-primary">24 new messages</span>
        </li>
        <li class="bg-warning">
            <div class="top-info">
                <a href="#">Orders history</a>
                <small>purchases statistics</small>
            </div>
            <a href="#"><i class="icon-cart2"></i></a>
            <span class="bottom-info bg-primary">17 new orders</span>
        </li>
        <li class="bg-primary">
            <div class="top-info">
                <a href="#">Invoices stats</a>
                <small>invoices archive</small>
            </div>
            <a href="#"><i class="icon-coin"></i></a>
            <span class="bottom-info bg-danger">9 new invoices</span>
        </li>
    </ul>
    <!-- /info blocks -->
</div>
<!-- /form components -->
<?php echo $footer?>