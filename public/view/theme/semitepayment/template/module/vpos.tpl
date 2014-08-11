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
        <h3 id="details" style="cursor: pointer">Transaction Amount <span style="color: #4f4f4f">$19.99</span></h3>
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
    <div id="paymentform">
        <div class="vpos">
            <img src="public/view/theme/semitepayment/img/semite_logo.png"/>
            <input type="hidden" name="M_SK" value="<?php echo $merchant['M_SK']?>"/>
            <input type="hidden" name="M_PK" value="<?php echo $merchant['M_PK']?>"/>
            <input type="hidden" name="AMT" value="19.99"/>
            <input type="hidden" name="M_MODE" value="<?php echo strtolower($merchant['mode'])?>"/>
            <div class="form-group">
                <label for="cc" class="control-label"><?php echo $entry_cc_number; ?></label>
                <input type="text" name="cc_number" placeholder="Card Number" value="" class="form-control"/>
            </div>
            <div class="form-group">
                <div class="pull-left">
                    <label for="exp_date" class="control-label"><?php echo $entry_cc_expire_date; ?></label><br/>
                    <select name="cc_expire_date_month" class="form-control" style="width: 150px;display: inline"/>
                    <?php foreach ($months as $month) { ?>
                    <option value="<?php echo $month['value']; ?>"><?php echo $month['text']; ?></option>
                    <?php } ?>
                    </select> /
                    <select name="cc_expire_date_year" class="form-control" style="width: 150px;display: inline">
                        <?php foreach ($year_expire as $year) { ?>
                        <option value="<?php echo $year['value']; ?>"><?php echo $year['text']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="pull-right">
                    <label for="cvv" class="control-label"><?php echo $entry_cc_cvv2; ?></label>
                    <input type="text" name="cc_cvv2" placeholder="CVV" value="" class="form-control" style="width: 194px"/>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="form-group">
                <label for="card_holder_name" class="control-label"><?php echo $entry_cc_holder; ?></label>
                <input type="text" name="cc_holder" placeholder="Card Holder Name" value="" class="form-control"/>
            </div>
            <button type="button" class="btn btn-primary pay"><i class="glyphicon glyphicon-check"></i> Pay Now!</button>
        </div>
    </div>
</div>
<?php } ?>