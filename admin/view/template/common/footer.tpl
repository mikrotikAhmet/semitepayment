<div class="page-content">
<!-- Footer -->
<div class="footer clearfix">
    <div class="pull-left"><?php echo $text_footer?></div>
</div>
<!-- /page content -->
</div>
<!-- /content -->
<script type="text/javascript">
    //-----------------------------------------
    // Confirm Actions (delete, uninstall)
    //-----------------------------------------
    $(document).ready(function() {
        var setside = '<?php echo $setside?>';
        
        //Sidebar Toggle
        $('a.sidebar-toggle').bind('click',function(){
                    removeCookie("sTR");
        });
        // Confirm Delete
        $('#form').submit(function() {
            if ($(this).attr('action').indexOf('delete', 1) != -1) {
                if (!confirm('<?php echo $text_confirm; ?>')) {
                    return false;
                }
            }
        });
        // Confirm Uninstall
        $('a').click(function() {
            if ($(this).attr('href') != null && $(this).attr('href').indexOf('uninstall', 1) != -1) {
                if (!confirm('<?php echo $text_confirm; ?>')) {
                    return false;
                }
            }
        });
    });
</script>
</body>
</html>