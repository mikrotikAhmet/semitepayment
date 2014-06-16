<footer class="section-block">
  <div class="container text-center">
    <a class="footer-link " href="/team">Team</a>
    <a class="footer-link " href="/media" data-no-instant>Media</a>
    <a class="footer-link" href="https://support.bitpay.com/">Support</a>
    
    <a class="footer-link " href="/legal">Legal</a>
    <a class="footer-link " href="/developers">Developers</a>
    <a class="footer-link " href="/pricing">Pricing</a>
    <a class="footer-link" href="http://blog.bitpay.com/" data-no-instant>Blog</a>
    <a class="footer-link" href="/start" data-no-instant>Sign Up</a>
  <div>
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
<script src="public/view/theme/semitepayment/js/instantclick.js" data-no-instant></script>
<script data-no-instant>InstantClick.init();</script>
<script>new WOW().init();</script>
</body>
</html>