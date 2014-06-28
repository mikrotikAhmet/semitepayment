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
 * @version     $Id: customer_group.php Jul 1, 2014 ahmet
 * @copyright   Copyright (c) 2014 Semite LLC .
 * @license     http://www.semitepayment.com/license/
 */
/**
 * Description of customer_group.php
 *
 * @author ahmet
 */
// Heading
$_['heading_title']             = 'Customer Group';

// Text
$_['text_success']              = 'Success: You have modified customer groups!';

// Column
$_['column_name']               = 'Customer Group Name';
$_['column_sort_order']         = 'Sort Order';
$_['column_action']             = 'Action';

// Entry
$_['entry_name']                = 'Customer Group Name:';
$_['entry_description']         = 'Description:';
$_['entry_approval']            = 'Approve New Customers:<br /><span class="help">Customers must be approved by and administrator before they can login.</span>';
$_['entry_legal']            = 'Display Comp. Legal Name:<br /><span class="help">Display a company Legal Name. field.</span>';
$_['entry_legal_required'] = 'Comp. Legal Name Required:<br /><span class="help">Select which customer groups must enter their Comp. Legal Name.</span>';
$_['entry_company_id_display']  = 'Display Company No.:<br /><span class="help">Display a company no. field.</span>';
$_['entry_company_id_required'] = 'Company No. Required:<br /><span class="help">Select which customer groups must enter their company no. for billing addresses before checkout.</span>';
$_['entry_tax_id_display']      = 'Display Tax ID.:<br /><span class="help">Display a Tax ID. field for billing addresses.</span>';
$_['entry_tax_id_required']     = 'Tax ID Required:<br /><span class="help">Select which customer groups must enter their Tax ID for billing addresses before checkout.</span>';
$_['entry_sort_order']          = 'Sort Order:';

// Error
$_['error_permission']          = 'Warning: You do not have permission to modify customer groups!';
$_['error_name']                = 'Customer Group Name must be between 3 and 32 characters!';
$_['error_default']             = 'Warning: This customer group cannot be deleted as it is currently assigned as the default application customer group!';
$_['error_store']               = 'Warning: This customer group cannot be deleted as it is currently assigned to %s applications!';
$_['error_customer']            = 'Warning: This customer group cannot be deleted as it is currently assigned to %s customers!';

