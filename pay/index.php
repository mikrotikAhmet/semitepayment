<?php

/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2011, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * @package     EGC Services Ltd
 * @version     $Id: index.php Jul 11, 2014 ahmet
 * @copyright   Copyright (c) 2014 EGC Services Ltd .
 * @license     http://www.egamingc.com/license/
 */
/**
 * Description of index.php
 *
 * @author ahmet
 */

if(isset($_POST['submit'])){
    require_once 'cc.php';

    $result = CallAPI('GET', 'http://lapi.semitepayment.com/v1/_requestAPI?route=semite/users/getUsers');
    
    $output = json_decode($result);

    echo '<pre>';
    print_r($output);
    echo '</pre>';
}
?>


<!DOCTYPE HTML>
<html lang="en-GB">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />

        <title>Semite Payment</title>

        <link rel="stylesheet" href="style.css">

        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
        <script type="text/javascript" src="jquery.creditCardValidator.js"></script>
        <script type="text/javascript" src="demo.js"></script>
    </head>
    <body>
        <div id="container">
            <div class="demo">

                <div class="numbers">
                    <p>Try some of these numbers:</p>

                    <ul class="list">
                        <li>4000000000000002</li>
                        <li>4026000000000002</li>
                        <li>501800000009</li>
                        <li>5100000000000008</li>
                        <li>6011000000000004</li>
                    </ul>
                </div>

                <form id="form" method="POST" action="<?php $_SERVER['PHP_SELF']?>">
                    <h2>Payment details</h2>
                    <ul>
                        <li>
                            <ul class="cards">
                                <li class="visa">Visa</li>
                                <li class="visa_electron">Visa Electron</li>
                                <li class="mastercard">MasterCard</li>
                                <li class="maestro">Maestro</li>
                                <li class="discover">Discover</li>
                            </ul>
                        </li>

                        <li>
                            <label for="card_number">Card number</label>
                            <input type="text" name="card_number" id="card_number">
                        </li>
                        <li class="vertical">
                            <ul>
                                <li>
                                    <label for="expiry_date">Expiry date <small>mm/yy</small></label>
                                    <input type="text" name="expiry_date" id="expiry_date" maxlength="5">
                                </li>

                                <li>
                                    <label for="cvv">CVV</label>
                                    <input type="text" name="cvv" id="cvv" maxlength="3">
                                </li>
                            </ul>
                        </li>

                        <li class="vertical maestro">
                            <ul>
                                <li>
                                    <label for="issue_date">Issue date <small>mm/yy</small></label>
                                    <input type="text" name="issue_date" id="issue_date" maxlength="5">
                                </li>

                                <li>
                                    <span class="or">or</span>
                                    <label for="issue_number">Issue number</label>
                                    <input type="text" name="issue_number" id="issue_number" maxlength="2">
                                </li>
                            </ul>
                        </li>

                        <li>
                            <label for="name_on_card">Name on card</label>
                            <input type="text" name="name_on_card" id="name_on_card">
                        </li>
                    </ul>
                    <input type="submit" name="submit">
                </form>
            </div>
    </body>
</html>


