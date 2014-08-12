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
 * @package     Semite LLC
 * @version     $Id: creditcard.php Jun 28, 2014 ahmet
 * @copyright   Copyright (c) 2014 Semite LLC .
 * @license     http://www.semitepayment.com/license/
 */
/**
 * Description of creditcard.php
 *
 * @author ahmet
 */

function completed_number($prefix, $length) {

    $ccnumber = $prefix;

# generate digits

    while (strlen($ccnumber) < ($length - 1)) {
        $ccnumber .= rand(0, 9);
    }

# Calculate sum

    $sum = 0;
    $pos = 0;

    $reversedCCnumber = strrev($ccnumber);

    while ($pos < $length - 1) {

        $odd = $reversedCCnumber[$pos] * 2;
        if ($odd > 9) {
            $odd -= 9;
        }

        $sum += $odd;

        if ($pos != ($length - 2)) {

            $sum += $reversedCCnumber[$pos + 1];
        }
        $pos += 2;
    }

# Calculate check digit

    $checkdigit = (( floor($sum / 10) + 1) * 10 - $sum) % 10;
    $ccnumber .= $checkdigit;

    return $ccnumber;
}

function credit_card_number($prefixList, $length, $howMany) {

    if ($howMany > 1){
        for ($i = 0; $i < $howMany; $i++) {

            $ccnumber = $prefixList[array_rand($prefixList)];
            $result[] = completed_number($ccnumber, $length);
        }
    } else {
        $ccnumber = $prefixList[array_rand($prefixList)];
        $result = completed_number($ccnumber, $length);
    }

    return $result;
}

function output($title, $numbers) {

    $result[] = "<div class='creditCardNumbers'>";
    $result[] = "<h3>$title</h3>";
    $result[] = implode('<br />', $numbers);
    $result[] = '</div>';

    return implode('<br />', $result);
}

function generateVirtualCard() {

    $semitePrefixList[] = '59';
    
    $semite = credit_card_number($semitePrefixList, 16, 1);
    
    return $semite;
}

function MaskCreditCard($cc) {
// Get the cc Length
    $cc_length = strlen($cc);
// Replace all characters of credit card except the last four and dashes
    for ($i = 0; $i < $cc_length - 4; $i++) {
        if ($cc[$i] == '-') {
            continue;
        }
        $cc[$i] = 'X';
    }
// Return the masked Credit Card #
    return $cc;
}

/**
 * Add dashes to a credit card number.
 * @param int|string $cc The credit card number to format with dashes.
 * @return string The credit card with dashes.
 */
function FormatCreditCard($cc) {
// Clean out extra data that might be in the cc
    $cc = str_replace(array('-', ' '), '', $cc);
// Get the CC Length
    $cc_length = strlen($cc);
// Initialize the new credit card to contian the last four digits
    $newCreditCard = substr($cc, -4);
// Walk backwards through the credit card number and add a dash after every fourth digit
    for ($i = $cc_length - 5; $i >= 0; $i--) {
// If on the fourth character add a dash
        if ((($i + 1) - $cc_length) % 4 == 0) {
            $newCreditCard = '-' . $newCreditCard;
        }
// Add the current character to the new credit card
        $newCreditCard = $cc[$i] . $newCreditCard;
    }
// Return the formatted credit card number
    return $newCreditCard;
}

function CallAPI($method, $url, $data = false)
{
    $curl = curl_init();

    switch ($method)
    {
        case "POST":
            curl_setopt($curl, CURLOPT_POST, count($data));

            if ($data)
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            break;
        case "PUT":
            curl_setopt($curl, CURLOPT_PUT, 1);
            break;
        default:
            if ($data)
                $url = sprintf("%s?%s", $url, http_build_query($data));
    }

    // Optional Authentication:
//    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
//    curl_setopt($curl, CURLOPT_USERPWD, "username:password");

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    return curl_exec($curl);
}
