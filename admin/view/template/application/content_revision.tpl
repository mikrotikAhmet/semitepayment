<div class="panel panel-default">
    <div class="panel-heading"><h6 class="panel-title"><i class="icon-table2"></i> <?php echo $heading_title?></h6></div>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th><?php echo $column_author?></th>
                    <th><?php echo $column_date?></th>
                    <th><?php echo $column_ip?></th>
                    <th><?php echo $column_message?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($revisions as $revision) { ?>
                <tr>
                    <td><?php echo $revision['author']?></td>
                    <td><?php echo $revision['date_modified']?></td>
                    <td><?php echo $revision['ip']?></td>
                    <td><?php echo $revision['message']?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
     <div class="table-footer">
            <?php echo $pagination; ?>
        </div>
</div>

<script type="text/javascript"><!--
$('#tab_revision .pagination a').bind('click', function() {
	$('#tab_revision').load(this.href);
        
	return false;
});	
    //--></script>