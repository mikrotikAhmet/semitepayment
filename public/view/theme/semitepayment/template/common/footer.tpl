<footer class="section-block">
  <div class="container text-center">
            <?php foreach ($footer_menus as $footer_menu) { ?>
    <a class="footer-link " href="<?php echo $footer_menu['href']?>"><?php echo $footer_menu['title']?></a>
    <?php } ?>
  </div>
</footer>
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="public/view/theme/semitepayment/js/bootstrap.min.js"></script>
<?php foreach ($scripts as $script) { ?>
<script type="text/javascript" src="<?php echo $script; ?>"></script>
<?php } ?>
<script src="public/view/theme/semitepayment/js/public.js" data-no-instant></script>
<script src="public/view/theme/semitepayment/js/semite.js" data-no-instant></script>
<script src="public/view/theme/semitepayment/js/instantclick.js" data-no-instant></script>
<script data-no-instant>InstantClick.init();</script>
<script>new WOW().init();</script>
</body>
</html>