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
                                Hello Tab
                            </div>
                            <div id="tab-unit2" class="vtabs-content">
                                Hello Tab 2
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