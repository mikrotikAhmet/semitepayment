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
 * @version     $Id: transaction_status.php Jul 8, 2014 ahmet
 * @copyright   Copyright (c) 2014 EGC Services Ltd .
 * @license     http://www.egamingc.com/license/
 */
/**
 * Description of transaction_status.php
 *
 * @author ahmet
 */

// Heading
$_['heading_title']    = 'Transaction Status';

// Text
$_['text_success']     = 'Success: You have modified transaction statuses!';

// Column
$_['column_name']      = 'Transaction Status Name';
$_['column_action']    = 'Action';

// Entry
$_['entry_name']       = 'Transaction Status Name:';

// Error
$_['error_permission'] = 'Warning: You do not have permission to modify transaction statues!';
$_['error_name']       = 'Transaction Status Name must be between 3 and 32 characters!';
$_['error_default']    = 'Warning: This transaction status cannot be deleted as it is currently assigned as the default application transaction status!';
$_['error_application']      = 'Warning: This transaction status cannot be deleted as it is currently assigned to %s applications!';
$_['error_transaction']      = 'Warning: This transaction status cannot be deleted as it is currently assigned to %s transactions!';