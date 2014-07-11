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
 * @version     $Id: cc.php Jul 11, 2014 ahmet
 * @copyright   Copyright (c) 2014 EGC Services Ltd .
 * @license     http://www.egamingc.com/license/
 */
/**
 * Description of cc.php
 *
 * @author ahmet
 */

/*
PHP credit card number generator
Copyright (C) 2006 Graham King graham@darkcoding.net

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

$semitePrefixList[] = '59';

/*
'prefix' is the start of the CC number as a string, any number of digits.
'length' is the length of the CC number to generate. Typically 13 or 16
*/
function completed_number($prefix, $length) {

    $ccnumber = $prefix;

    # generate digits

    while ( strlen($ccnumber) < ($length - 1) ) {
        $ccnumber .= rand(0,9);
    }

    # Calculate sum

    $sum = 0;
    $pos = 0;

    $reversedCCnumber = strrev( $ccnumber );

    while ( $pos < $length - 1 ) {

        $odd = $reversedCCnumber[ $pos ] * 2;
        if ( $odd > 9 ) {
            $odd -= 9;
        }

        $sum += $odd;

        if ( $pos != ($length - 2) ) {

            $sum += $reversedCCnumber[ $pos +1 ];
        }
        $pos += 2;
    }

    # Calculate check digit

    $checkdigit = (( floor($sum/10) + 1) * 10 - $sum) % 10;
    $ccnumber .= $checkdigit;

    return $ccnumber;
}

function credit_card_number($prefixList, $length, $howMany) {

    for ($i = 0; $i < $howMany; $i++) {

        $ccnumber = $prefixList[ array_rand($prefixList) ];
        $result[] = completed_number($ccnumber, $length);
    }

    return $result;
}

function output($title, $numbers) {

    $result[] = "<div class='creditCardNumbers'>";
    $result[] = "<h3>$title</h3>";
    $result[] = implode('<br />', $numbers);
    $result[]= '</div>';

    return implode('<br />', $result);
}

#
# Main
#

echo "<div class='creditCardSet'>";
$semite = credit_card_number($semitePrefixList, 16, 1);
echo output("Semite", $semite);
echo "</div>";
?>