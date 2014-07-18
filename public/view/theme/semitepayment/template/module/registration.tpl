<h3 class="h4">Apply for an Account</h3>
<form action="http://local.semitepayment.com/register" method="post" enctype="multipart/form-data" id="form" class="form" role="form">
    <div class="form-group">
        <label for="city" class="control-label">Full Name :</label>
        <div class="clearfix"></div>
        <div class="pull-left">
            <input type="text" name="firstname" placeholder="Firstname" value="" class="form-control"/>
            <?php if ($error_firstname) { ?>
        <span class="error"><?php echo $error_firstname; ?></span>
        <?php } ?>
        </div>
        <div class="pull-right">
            <input type="text" name="lastname" placeholder="Lastname" value="" class="form-control"/>
             <?php if ($error_lastname) { ?>
        <span class="error"><?php echo $error_lastname; ?></span>
        <?php } ?>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="form-group">
        <label for="exampleInputEmail1">E-Mail:</label>
        <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="E-Mail:">
        <?php if ($error_email) { ?>
        <span class="error"><?php echo $error_email; ?></span>
        <?php } ?>
        <?php if ($error_email_exist) { ?>
        <span class="error"><?php echo $error_email_exist; ?></span>
        <?php } ?>
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Password:</label>
        <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password:">
        <?php if ($error_password) { ?>
        <span class="error"><?php echo $error_password; ?></span>
        <?php } ?>
    </div>
    <button type="submit" class="btn btn-default">Continue</button>
</form>
<p class="block small">Already have an account ? <a href="http://lmerchant.semitepayment.com/">Log in</a>.</p>