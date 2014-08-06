<?php if (is_array($merchant)) { ?>
<div class="">
    <h3 class="h4"><i><b style="color:#4f4f4f"><?php echo $merchant['statement']['business_name']?></b></i></h3>
    <?php if (!$merchant['approved']) { ?>
    <p>This transaction will be in <b>TEST Mode</b>. Your V-Card will not be charged by <b>Semite Payment System</b></p>
    <?php } ?>
    <div class="vpos_detail">
        Amout to Pay : <span>$127.50</span><br/>
        Pay to       : <span><?php echo $merchant['statement']['business_name']?></span><br/>
        <a href="#">More Details</a>
    </div>
    <div class="vpos">
        <input type="hidden" name="M_SK" value="<?php echo $merchant['M_SK']?>"/>
        <input type="hidden" name="M_MODE" value="<?php echo strtolower($merchant['mode'])?>"/>
        <div class="form-group">
            <label for="cc" class="control-label">Card Number :</label>
            <input type="text" name="cc" placeholder="Card Number" value="" class="form-control"/>
        </div>
        <div class="form-group">
        <div class="pull-left">
            <label for="exp_date" class="control-label">Expiry Date :</label>
            <input type="text" name="firstname" placeholder="MM/YY" value="" class="form-control" style="width: 150px"/>
        </div>
        <div class="pull-right">
            <label for="cvv" class="control-label">CVV :</label>
            <input type="text" name="lastname" placeholder="CVV" value="" class="form-control" style="width: 150px"/>
        </div>
        </div>
        <div class="clearfix"></div>
        <div class="form-group">
            <label for="card_holder_name" class="control-label">Card Holder Name :</label>
            <input type="text" name="cc" placeholder="Card Holder Name" value="" class="form-control"/>
        </div>
        <button class="btn btn-primary"><i class="glyphicon glyphicon-check"></i> Pay Now!</button>
    </div>
</div>
<?php } ?>