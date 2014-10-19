<?php

/**
 * @package     Limolabs
 * @version     $Id: setting May 29, 2014 ahmet
 * @copyright   Copyright (c) 2014 LimoLabs LLC .
 * @license     http://www.limolabs.com/license/
 */
/**
 * Description of setting
 *
 * @author ahmet
 */
// Heading
$_['heading_title']                = 'Settings';

// Text
$_['text_success']                 = 'Success: You have modified settings!';
$_['text_items']                   = 'Items';
$_['text_account']                 = 'Account';
$_['text_mail']                    = 'Mail';
$_['text_smtp']                    = 'SMTP';
$_['text_api']                    = 'API';
$_['text_transaction']                    = 'Transactions';
$_['text_transfer']                    = 'Asset Transfers ( Withdraw )';
$_['text_affiliate']                    = 'Affiliates';
$_['text_verification']                    = 'Verifications';

// Entry
$_['entry_name']                   = 'Application Name:';
$_['entry_owner']                  = 'Application Owner:';
$_['entry_address']                = 'Address:';
$_['entry_email']                  = 'E-Mail:';
$_['entry_telephone']              = 'Telephone:';
$_['entry_fax']                    = 'Fax:';
$_['entry_title']                  = 'Title:';
$_['entry_meta_description']       = 'Meta Tag Description:';
$_['entry_template']               = 'Template:';
$_['entry_page']               = 'Page:';
$_['entry_layout']               = 'Layouts:';
$_['entry_country']                = 'Country:';
$_['entry_zone']                   = 'Region / State:';
$_['entry_language']               = 'Language:';
$_['entry_admin_language']         = 'Administration Language:';
$_['entry_currency']               = 'Currency:<br /><span class="help">Change the default currency. Clear your browser cache to see the change and reset your existing cookie.</span>';
$_['entry_currency_auto']          = 'Auto Update Currency:<br /><span class="help">Set your store to automatically update currencies daily.</span>';
$_['entry_admin_limit']   	       = 'Default Items Per Page (Admin):<br /><span class="help">Determines how many admin items are shown per page (orders, customers, etc)</span>';
$_['entry_customer_online']        = 'Customers Online:<br /><span class="help">Track customers online via the customer reports section.</span>';
$_['entry_customer_group']         = 'Customer Group:<br /><span class="help">Default customer group.</span>';
$_['entry_customer_group_display'] = 'Customer Groups:<br /><span class="help">Display customer groups that new customers can select to use such as wholesale and business when signing up.</span>';
$_['entry_customer_price']         = 'Login Display Prices:<br /><span class="help">Only show prices when a customer is logged in.</span>';
$_['entry_account']                = 'Account Terms:<br /><span class="help">Forces people to agree to terms before an account can be created.</span>';
$_['entry_mail_template']                = 'Welcome Mail:<br /><span class="help">Default Welcome Mail Template for new customer(s).</span>';

$_['entry_auto_capture'] = 'Enable Auto Capture:<br/><span class="help">Enables or Disables the auto capture Credit Card transactions.</span>';
$_['entry_transaction_status'] = 'Transaction Status:<br/><span class="help">Set the default transaction status when an transaction is processed.</span>';
$_['entry_transaction_status_complete'] = 'Completed Transaction Status:<br /><span class="help">Set the transaction status the customers transaction must be approved by the Aquirer Bank to add the amount into customers Account Balance.</span>';
$_['entry_transfer_comission']             = 'Money Transfer Commission (%):<br /><span class="help">The default money transfer commission percentage.</span>';


$_['entry_invoice_prefix']         = 'Invoice Prefix:<br /><span class="help">Set the invoice prefix (e.g. INV-2011-00). Invoice ID\'s will start at 1 for each unique prefix</span>';
$_['entry_transfer_status'] = 'Transfer Status:<br/><span class="help">Set the default transfer (WITHDRAW) status when an transfer is processed and/or requested.</span>';
$_['entry_transfer_status_complete'] = 'Completed Transfer Status:<br /><span class="help">Set the transfer status when the requested transfer amount has been processed by the system.</span>';

$_['entry_affiliate']              = 'Affiliate Terms:<br /><span class="help">Forces people to agree to terms before an affiliate account can be created.</span>';
$_['entry_commission']             = 'Affiliate Commission (%):<br /><span class="help">The default affiliate commission percentage.</span>';


$_['entry_creditcard_status']              = 'Credit Card Verification:<br /><span class="help">Set default verification status for Credit Cards.</span>';
$_['entry_complete_creditcard_status']              = 'Comleted Credit Card Verification:<br /><span class="help">Set the verification status when the Customer Cards informations are approved.</span>';
$_['entry_bankaccount_status']             = 'Bank Account Verification:<br /><span class="help">Set default verification status for Bank Accounts.</span>';
$_['entry_complete_bankaccount_status']             = 'Complete Bank Account Verification:<br /><span class="help">Set the verification status when the Customer Bank informations are approved.</span>';

$_['entry_logo']                   = 'Store Logo:';
$_['entry_icon']                   = 'Icon:<br /><span class="help">The icon should be a PNG that is 16px x 16px.</span>';
$_['entry_featured_image']         = 'Featured Image (W/H):';
$_['entry_ftp_host']               = 'FTP Host:';
$_['entry_ftp_port']               = 'FTP Port:';
$_['entry_ftp_username']           = 'FTP Username:';
$_['entry_ftp_password']           = 'FTP Password:';
$_['entry_ftp_root']               = 'FTP Root:<br/><span class="help">The directory your opencart installation is stored in normally \'public_html/\'.</span>';
$_['entry_ftp_status']             = 'Enable FTP:';
$_['entry_mail_protocol']          = 'Mail Protocol:<br/><span class="help">Only choose \'Mail\' unless your host has disabled the php mail function.</span>';
$_['entry_mail_parameter']         = 'Mail Parameters:<br/><span class="help">When using \'Mail\', additional mail parameters can be added here (e.g. "-femail@storeaddress.com").</span>';
$_['entry_smtp_host']              = 'SMTP Host:';
$_['entry_smtp_username']          = 'SMTP Username:';
$_['entry_smtp_password']          = 'SMTP Password:';
$_['entry_smtp_port']              = 'SMTP Port:';
$_['entry_smtp_timeout']           = 'SMTP Timeout:';
$_['entry_account_mail']           = 'New Account Alert Mail:<br /><span class="help">Send a email to the store owner when a new account is registered.</span>';
$_['entry_alert_mail']             = 'New Order Alert Mail:<br /><span class="help">Send a email to the store owner when a new order is created.</span>';
$_['entry_alert_emails']           = 'Additional Alert E-Mails:<br /><span class="help">Any additional emails you want to receive the alert email, in addition to the main store email. (comma separated)</span>';
$_['entry_secure']                 = 'Use SSL:<br /><span class="help">To use SSL check with your host if a SSL certificate is installed and added the SSL URL to the catalog and admin config files.</span>';
$_['entry_shared']                 = 'Use Shared Sessions:<br /><span class="help">Try to share the session cookie between stores so the cart can be passed between different domains.</span>';
$_['entry_robots']                 = 'Robots:<br /><span class="help">A list of web crawler user agents that shared sessions will not be used with. Use separate lines for each user agent.</span>';
$_['entry_seo_url']                = 'Use SEO URL\'s:<br /><span class="help">To use SEO URL\'s apache module mod-rewrite must be installed and you need to rename the htaccess.txt to .htaccess.</span>';
$_['entry_file_extension_allowed'] = 'Allowed File Extensions:<br /><span class="help">Add which file extensions are allowed to be uploaded. Use a new line for each value.</span>';
$_['entry_file_mime_allowed']      = 'Allowed File Mime Types:<br /><span class="help">Add which file mime types are allowed to be uploaded. Use a new line for each value.</span>';
$_['entry_maintenance']            = 'Maintenance Mode:<br /><span class="help">Prevents customers from browsing your store. They will instead see a maintenance message. If logged in as admin, you will see the store as normal.</span>';
$_['entry_password']               = 'Allow Forgotten Password:<br /><span class="help">Allow forgotten password to be used for the admin. This will be disabled automatically if the system detects a hack attempt.</span>';
$_['entry_encryption']             = 'Encryption Key:<br /><span class="help">Please provide a secret key that will be used to encrypt private information when processing orders.</span>';
$_['entry_compression']            = 'Output Compression Level:<br /><span class="help">GZIP for more efficient transfer to requesting clients. Compression level must be between 0 - 9</span>';
$_['entry_error_display']          = 'Display Errors:';
$_['entry_error_log']              = 'Log Errors:';
$_['entry_error_filename']         = 'Error Log Filename:';
$_['entry_google_analytics']       = 'Google Analytics Code:<br /><span class="help">Login to your <a href="http://www.google.com/analytics/" target="_blank"><u>Google Analytics</u></a> account and after creating your web site profile copy and paste the analytics code into this field.</span>';
$_['entry_test_publickey_api_prefix'] = 'API Test Public Key Prefix';
$_['entry_test_secretkey_api_prefix'] = 'API Test Secret Key Prefix';
$_['entry_live_publickey_api_prefix'] = 'API Live Public Key Prefix';
$_['entry_live_secretkey_api_prefix'] = 'API Live Secret Key Prefix';
$_['entry_success']                = 'Success Page:<br /><span class="help">Default Success Page for new customer(s) registration.</span>';


// Error
$_['error_warning']                = 'Warning: Please check the form carefully for errors!';
$_['error_permission']             = 'Warning: You do not have permission to modify settings!';
$_['error_name']                   = 'Application Name must be between 3 and 32 characters!';
$_['error_owner']                  = 'Application Owner must be between 3 and 64 characters!';
$_['error_address']                = 'Application Address must be between 10 and 256 characters!';
$_['error_email']                  = 'E-Mail Address does not appear to be valid!';
$_['error_telephone']              = 'Telephone must be between 3 and 32 characters!';
$_['error_title']                  = 'Title must be between 3 and 32 characters!';
$_['error_limit']       	       = 'Limit required!';
$_['error_ftp_host']               = 'FTP Host required!';
$_['error_ftp_port']               = 'FTP Port required!';
$_['error_ftp_username']           = 'FTP Username required!';
$_['error_ftp_password']           = 'FTP Password required!';
$_['error_error_filename']         = 'Error Log Filename required!';
$_['error_encryption']             = 'Encryption must be between 3 and 32 characters!';
