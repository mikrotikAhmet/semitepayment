<?php if (is_array($merchant)) { ?>
<div id="overlay-inAbox" class="overlay">
    <div class="toolbar" style="display:none"><a class="close" href="javascript::void()"><span>x</span> close</a></div>
    <div class="wrapper">
    </div>
</div>
<div class="">
    <h3 class="h4"><i><b style="color:#4f4f4f"><?php echo $merchant['statement']['business_name']?></b></i></h3>
    <?php if (!$merchant['approved']) { ?>
    <p>This transaction will be in <b>TEST Mode</b>. Your V-Card will not be charged by <b>Semite Payment System</b></p>
    <?php } ?>
    <div class="vpos_detail">
        <h3>Transaction Amount <span style="color: #4f4f4f">$19.99</span></h3>
        <a href="javascript::void()" id="details">Transaction Details</a>
        <div class="details-control" style="display: none">
            <h2>Your Transaction Summary</h2>
            <table class="table table-striped table-responsive">
                <thead>
                    <th>Descriptions</th>
                    <th>Amount</th>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            Transaction #947014<br/>
                            Transaction Type : Payment<br/>
                        </td>
                        <td>$19.99</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td><b>Transaction Total</b></td>
                        <td><b>$19.99</b></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <form id="paymentform">
    <div class="vpos">
        <input type="hidden" name="M_SK" value="<?php echo $merchant['M_SK']?>"/>
        <input type="hidden" name="M_PK" value="<?php echo $merchant['M_PK']?>"/>
        <input type="hidden" name="M_MODE" value="<?php echo strtolower($merchant['mode'])?>"/>
        <div class="form-group">
            <label for="cc" class="control-label">Card Number :</label>
            <input type="text" name="cc" placeholder="Card Number" value="" class="form-control"/>
        </div>
        <div class="form-group">
        <div class="pull-left">
            <label for="exp_date" class="control-label">Expiry Date :</label>
            <input type="text" name="expiry" placeholder="MM/YY" value="" class="form-control" style="width: 150px"/>
        </div>
        <div class="pull-right">
            <label for="cvv" class="control-label">CVV :</label>
            <input type="text" name="cvv" placeholder="CVV" value="" class="form-control" style="width: 150px"/>
        </div>
        </div>
        <div class="clearfix"></div>
        <div class="form-group">
            <label for="card_holder_name" class="control-label">Card Holder Name :</label>
            <input type="text" name="ccholder" placeholder="Card Holder Name" value="" class="form-control"/>
        </div>
        <button type="button" class="btn btn-primary pay"><i class="glyphicon glyphicon-check"></i> Pay Now!</button>
    </div>
        </form>
</div>
<?php } ?>