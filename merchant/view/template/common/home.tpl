<?php echo $header?>
<div id="alertMsg" class="alert-container">
    <div id="alertMsgTextContainer" class="alert-message">
        <div id="alertClose"><a class="close" style="padding-right: 5px; color: #B94A48">&times;</a></div>
        <div style="padding-right: 20px; padding-left: 5px;"><span id="alertMsgText"></span></div>
    </div>
    <div id="alertTab" class="alert-tab" style="position: relative; top: -1px">
        <img id="alertExcl" class="excl" style="cursor: pointer;  z-index: 1100;" src="/img/exclamation32.png" />
    </div>
</div>

<!-- Modals
================================================== -->

<div id="modal-logout" class="modal hide" style="height: 200px">
    <div class="modal-header">
        Logout?
    </div>
    <div class="modal-body">
        Do you want to Logout of BitPay?
        <br><br><br>
        <span width=50%><a href="javascript:bp.logout();" class="btn btn-danger btn-large" /><i class="icon-off icon-white"></i> Logout</a></span>
        <span width=50%><a href="#" class="btn btn-large" data-dismiss="modal" style="text-decoration: none; font-weight: normal; opacity: 1; filter: alpha(opacity = 100); float: center" >Close</a></span>
    </div>
</div>
<div id="modal-ajax" class="modal hide" style="width: 200px; background: #F8F4F0;">
    <div class="modal-header"></div>
    <div class="modal-body">
        <br><br><br>
        <img src="/img/ajax-loader2.gif" style="padding-bottom: 5px">
        <h2>Updating...</h2>
    </div>
</div>

<!-- generic modal used any time a modal is needed-->
<div id="modal"></div>

<!-- Primary Page Layout
================================================== -->
<div class="container" style="margin: auto;">
    <div id="topMenu" class="row header">
        <div class="container header">
            <div style="padding: 5px" >
                <div class="columns logo">

                    <a href="/home">

                        <img src="/img/logo.png" border="0" style="width: 100px; margin-top: 5px; margin-left: 5px" class="visible-phone">
                        <img src="/img/logo_x2.png" border="0" style="width: 130px; margin-top: 15px;" class="hidden-phone"></a>
                </div>
                <div class="columns tagline">
                    <ul class="new-menu hidden-phone" style="text-align: center">
                        <li><a href="/home">Dashboard</a></li>

                        <li><a href="/developers">Developers</a></li>

                        <li><a href="/bitcoin-payment-gateway-api">API</a></li>
                        <li><a href="/merchant-help">Support</a></li>
                    </ul>
                </div>
                <div class="columns login" style="text-align:right;">

                    <span class="hidden-phone" style="color: #fff;">ahmet.gudenoglu@gmail.com <br></span><a href="#modal-logout" data-toggle="modal" class="btn" style="margin-top: 5px; margin-right: 10px;"><i class="icon-off icon-white"></i> Logout</a>
                    <a class="btn btn-primary do" style="margin-top: 5px" href="/home" style="width: auto"><i class="icon-th icon-white"></i> Dashboard</a>



                </div>
                <br clear=all>
            </div>
        </div>
    </div> <!--(topMenu)-->
    <div class="row middle" style="margin: 0px; text-align: left; background-color: #FFF; box-shadow: 0 0 1px #ddd; border-radius: 4px;">
        <div class="middle" style="vertical-align: top; margin: 0 auto;">

            <br>
            <div class="sixteen columns">





                <div class="columns double-left">

                    <div id="alert"></div>

                    <div id="message"></div>

                    <h1>Dashboard</h1>


                    <div class="alert">
                        <p style="margin-bottom: 0px;">You are currently enabled for up to <b>$100/day</b>. Would you like to <a href="/merchant-compliance">raise your daily limit</a>?</p>
                    </div>


                    <div class="well typical">
                        <table class="table table-condensed" style="width: 100%; margin-bottom: 0px">
                            <thead style="font-size: 0.9em">
                                <tr>
                                    <td colspan=2 style="text-align: center">
                                        No Activity Yet
                                    </td>
                                    <td style="text-align: center"><b>&nbsp;</b></td>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>

                    <h2 style="margin-top: 15px">Daily Sales Trend</h2>

                    <div class="well" style="background: #FFF; margin-top: 0px">
                        <div id="salesChart" class="gchart" data-chart-data="BTC" style="width: 100%; height: auto; margin: 0px; padding: 0px"></div>
                        <div style="position: relative; overflow: hidden;">
                            <div style="position: relative; float: left; left: 50%;">
                                <div class="btn-group" data-toggle="buttons-radio" style="position: relative; float: left; left: -50%;">

                                </div>
                            </div>
                        </div>
                    </div>

                    <br>
                </div>
                <div class="columns single-right">
                    <h2>My Information</h2>
                    <div class="well" style="margin-top: 0px">
                        <table style="width: 100%; margin: auto">
                            <tr>
                                <td class="icon" style="width: 33%">
                                    <a href="/my-account"><i class="icon-user dashboard-icon"></i><br>My Account</a><br>
                                </td>
                                <td class="icon" style="width: 33%">
                                    <a href="/account-summary"><i class="icon-list dashboard-icon"></i><br>Account Ledger</a><br>
                                </td>
                                <td class="icon" style="width: 33%">
                                    <a href="/change-plan"><i class="icon-calendar dashboard-icon"></i><br>Plan</a><br>
                                </td>
                            </tr>

                        </table>
                    </div>

                    <div class="alert"><p style="margin-bottom: 0px;">You are on the Starter Plan. Would you like to <a href="/change-plan">upgrade your plan</a>?</p></div>


                    <h2>My Payment Tools</h2>
                    <div class="well" style="margin-top: 0px">
                        <table style="width: 100%; margin: auto">
                            <tr>
                                <td class="icon" style="width: 33%" >
                                    <a href="/catalog-item-list"><i class="icon-shopping-cart dashboard-icon"></i><br>My Catalog Items</a>
                                </td>
                                <td class="icon" style="width: 33%" >
                                    <a href="/client-billing"><i class="icon-file-text dashboard-icon"></i><br>My Bills</a>
                                </td>
                                <td class="icon" style="width: 33%">
                                    <a href="/m/612561/checkout" target="_new"><i class="icon-btc dashboard-icon"></i><br>Checkout Now</a>
                                </td>

                            </tr>
                            <tr>
                                <td class="icon" style="width: 33%">
                                    <a href="/bitcoin-for-retail"><i class="icon-group dashboard-icon"></i><br>In-Person<br>Payment Tools</a>
                                </td>
                                <td class="icon" style="width: 33%">
                                    <a href="/bitcoin-for-ecommerce"><i class="icon-laptop dashboard-icon"></i><br>Internet<br>Payment Tools</a>
                                </td>
                                <td class="icon" style="width: 33%">
                                    <a href="/merchant-help"><i class="icon-question-sign dashboard-icon"></i><br>Help Center</a>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>




            </div>
            <br clear=all>



        </div>
    </div>
</div>
<?php echo $footer?>