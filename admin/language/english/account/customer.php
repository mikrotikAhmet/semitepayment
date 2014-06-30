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
 * @version     $Id: customer.php Jul 1, 2014 ahmet
 * @copyright   Copyright (c) 2014 Semite LLC .
 * @license     http://www.semitepayment.com/license/
 */
/**
 * Description of customer.php
 *
 * @author ahmet
 */

// Heading
$_['heading_title']         = 'Customer';
$_['title_bank'] = 'Enter you banking information.';

// Text
$_['text_information_bank'] = 'To manage your money, you have to specify at least 1(one) bank information.';
$_['text_success']          = 'Success: You have modified customers!';
$_['text_default']          = 'Default';
$_['text_approved']         = 'You have approved %s accounts!';
$_['text_wait']             = 'Please Wait!';
$_['text_balance']          = 'Balance:';
$_['text_add_ban_ip']       = 'Add Ban IP';
$_['text_remove_ban_ip']    = 'Remove Ban IP';
$_['text_bank_information']          = 'Virtual Bank Information:';
$_['text_card_information']          = 'Virtual Card Information:';
$_['text_account']          = '<b>Account Number :</b>';
$_['text_iban']          = '<b>IBAN :</b>';
$_['text_swift']          = '<b>Swift BIC :</b>';
$_['text_holder']          = '<b>Card Holder :</b>';
$_['text_card']          = '<b>V-Card Number :</b>';
$_['text_cvv']          = '<b>CVV :</b>';
$_['text_expire']          = '<b>Expire Date :</b>';
$_['text_no_bank']          = '<h5>No Bank</h5><p>You do not have any Bank Information yet. <a data-toggle="modal" role="button" href="#createBank">Create one here.</a> or just click on <b>Add New</b> button below.</p>';
$_['text_no_card']          = '<h5>No Card</h5><p>You do not have any Card Information yet. <a data-toggle="modal" role="button" href="#createCard">Create one here.</a> or just click on <b>Add New</b> button below.</p>';
$_['text_no_transaction']          = '<h5>No Transaction</h5><p>You do not have any Transaction Information yet.</p>';

// Column
$_['column_name']           = 'Customer Name';
$_['column_email']          = 'E-Mail';
$_['column_customer_group'] = 'Customer Group';
$_['column_status']         = 'Status'; 
$_['column_login']          = 'Login into Store';
$_['column_approved']       = 'Approved';
$_['column_date_added']     = 'Date Added';
$_['column_comment']        = 'Comment';
$_['column_description']    = 'Description';
$_['column_amount']         = 'Amount';
$_['column_points']         = 'Points';
$_['column_ip']             = 'IP';
$_['column_total']          = 'Total Accounts';
$_['column_action']         = 'Action';

$_['column_bank_name']         = 'Bank Name';
$_['column_currency']         = 'Settlement Currency';
$_['column_ahn']         = 'Account Holder Name';
$_['column_iban']         = 'IBAN';
$_['column_swift']         = 'SWFIT';
$_['column_status']         = 'Status';

$_['column_card_holder']         = 'Crad Holder Name';
$_['column_type']         = 'Card Type';
$_['column_number']         = 'Card #';

// Entry
$_['entry_firstname']       = 'First Name:';
$_['entry_lastname']        = 'Last Name:';
$_['entry_personal_id']      = 'Your Personal Number:<br /><span class="help">Valid ID or Passport Number.</span>';
$_['entry_email']           = 'E-Mail:';
$_['entry_telephone']       = 'Telephone:';
$_['entry_fax']             = 'Fax:';
$_['entry_newsletter']      = 'Newsletter:';
$_['entry_customer_group']  = 'Customer Group:';
$_['entry_status']          = 'Status:';
$_['entry_password']        = 'Password:';
$_['entry_confirm']         = 'Confirm:';
$_['entry_company']         = 'Company:';
$_['entry_company_id']      = 'Company ID:';
$_['entry_tax_id']          = 'Tax ID:';
$_['entry_address_1']       = 'Address:';
$_['entry_address_2']       = 'Bulding No:';
$_['entry_city']            = 'City:';
$_['entry_postcode']        = 'Postcode:';
$_['entry_country']         = 'Country:';
$_['entry_zone']            = 'Region / State:';
$_['entry_default']         = 'Default Address:';
$_['entry_comment']         = 'Comment:';
$_['entry_description']     = 'Description:';
$_['entry_amount']          = 'Amount:';
$_['entry_points']          = 'Points:<br /><span class="help">Use minus to remove points</span>';
$_['entry_currency']           = 'Settlement Curreny :';
$_['entry_bank']           = 'Bank Name:';
$_['entry_holder_name']           = 'Account Holder Name:';
$_['entry_iban']           = 'IBAN:';
$_['entry_bic']           = 'Swift Code (BIC):';
$_['entry_cc']           = 'Credit Card Number:';
$_['entry_card_holder_name']           = 'Card Holder Name:';
$_['entry_ccv']           = 'CCV:';
$_['entry_expd']           = 'Expire Date:';

// Error
$_['error_warning']         = 'Warning: Please check the form carefully for errors!';
$_['error_permission']      = 'Warning: You do not have permission to modify customers!';
$_['error_exists']          = 'Warning: E-Mail Address is already registered!';
$_['error_firstname']       = 'First Name must be between 1 and 32 characters!';
$_['error_lastname']        = 'Last Name must be between 1 and 32 characters!';
$_['error_email']           = 'E-Mail Address does not appear to be valid!';
$_['error_telephone']       = 'Telephone must be between 3 and 32 characters!';
$_['error_password']        = 'Password must be between 4 and 20 characters!';
$_['error_confirm']         = 'Password and password confirmation do not match!';
$_['error_company_id']      = 'Company ID required!';
$_['error_tax_id']          = 'Tax ID required!';
$_['error_vat']             = 'VAT number is invalid!';
$_['error_address_1']       = 'Address 1 must be between 3 and 128 characters!';
$_['error_city']            = 'City must be between 2 and 128 characters!';
$_['error_postcode']        = 'Postcode must be between 2 and 10 characters for this country!';
$_['error_country']         = 'Please select a country!';
$_['error_zone']            = 'Please select a region / state!';
