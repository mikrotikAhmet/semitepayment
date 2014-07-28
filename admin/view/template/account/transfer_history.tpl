<?php if ($error) { ?>
<div class="warning"><?php echo $error; ?></div>
<?php } ?>
<?php if ($success) { ?>
<div class="success"><?php echo $success; ?></div>
<?php } ?>
<table class="table table-responsive table-hover col-md-6">
    <tr>
        <th class="left"><b><?php echo $column_transfer_id; ?></b></th>
        <th class="left"><b><?php echo $column_date_added; ?></b></th>
        <th class="left"><b><?php echo $column_comment; ?></b></th>
        <th class="left"><b><?php echo $column_status; ?></b></th>
        <th class="left"><b><?php echo $column_notify; ?></b></th>
    </tr>
    <tbody>
        <?php if ($histories) { ?>
        <?php foreach ($histories as $history) { ?>
        <tr>
            <td class="left"><?php echo $history['transfer_id']; ?></td>
            <td class="left"><?php echo $history['date_added']; ?></td>
            <td class="left"><?php echo $history['comment']; ?></td>
            <td class="left"><?php echo $history['status']; ?></td>
            <td class="left"><?php echo $history['notify']; ?></td>
        </tr>
        <?php } ?>
        <?php } else { ?>
        <tr>
            <td class="center" colspan="4"><?php echo $text_no_results; ?></td>
        </tr>
        <?php } ?>
    </tbody>
    <div class="table-footer">
            <?php echo $pagination; ?>
        </div>
</table> 

<script type="text/javascript"><!--
 $('#history .pagination a').bind('click', function() {
	$('#history').load(this.href);
	
	return false;
    });	
    //--></script>