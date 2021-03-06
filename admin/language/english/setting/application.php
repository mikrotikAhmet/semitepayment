<?php

/**
 * @package     Limolabs
 * @version     $Id: application May 29, 2014 ahmet
 * @copyright   Copyright (c) 2014 LimoLabs LLC .
 * @license     http://www.limolabs.com/license/
 */
/**
 * Description of application
 *
 * @author ahmet
 */

// Heading
$_['heading_title']                = 'Settings';

// Text
$_['text_success']                 = 'Success: You have modified settings!';
$_['text_items']                   = 'Items';
$_['text_tax']                     = 'Taxes';
$_['text_account']                 = 'Account';
$_['text_checkout']                = 'Checkout';
$_['text_stock']                   = 'Stock';
$_['text_shipping']                = 'Shipping Address';
$_['text_payment']                 = 'Payment Address';

// Column
$_['column_name']                  = 'Application Name';
$_['column_url']	               = 'Application URL';
$_['column_action']                = 'Action';

// Entry
$_['entry_url']                    = 'Application URL:<br /><span class="help">Include the full URL to your application. Make sure to add \'/\' at the end. Example: http://www.yourdomain.com/path/<br /><br />Don\'t use directories to create a new application. You should always point another domain or sub domain to your hosting.</span>';
$_['entry_ssl']                    = 'SSL URL:<br /><span class="help">SSL URL to your application. Make sure to add \'/\' at the end. Example: http://www.yourdomain.com/path/<br /><br />Don\'t use directories to create a new application. You should always point another domain or sub domain to your hosting.</span>';
$_['entry_name']                   = 'Application Name:';
$_['entry_owner']                  = 'Application Owner:';
$_['entry_address']                = 'Address:';
$_['entry_email']                  = 'E-Mail:';
$_['entry_telephone']              = 'Telephone:';
$_['entry_fax']                    = 'Fax:';
$_['entry_title']                  = 'Title:';
$_['entry_meta_description']       = 'Meta Tag Description:';
$_['entry_layout']                 = 'Default Layout:';
$_['entry_page']               = 'Page:';
$_['entry_template']               = 'Template:';
$_['entry_country']                = 'Country:';
$_['entry_zone']                   = 'Region / State:';
$_['entry_language']               = 'Language:';
$_['entry_currency']               = 'Currency:';
$_['entry_catalog_limit'] 	       = 'Default Items Per Page (Catalog):<br /><span class="help">Determines how many catalog items are shown per page (products, categories, etc)</span>';
$_['entry_tax']                    = 'Display Prices With Tax:';
$_['entry_tax_default']            = 'Use Application Tax Address:<br /><span class="help">Use the application address to calculate taxes if no one is logged in. You can choose to use the application address for the customers shipping or payment address.</span>';
$_['entry_tax_customer']           = 'Use Customer Tax Address:<br /><span class="help">Use the customers default address when they login to calculate taxes. You can choose to use the default address for the customers shipping or payment address.</span>';
$_['entry_customer_group']         = 'Customer Group:<br /><span class="help">Default customer group.</span>';
$_['entry_customer_group_display'] = 'Customer Groups:<br /><span class="help">Display customer groups that new customers can select to use such as wholesale and business when signing up.</span>';
$_['entry_customer_price']         = 'Login Display Prices:<br /><span class="help">Only show prices when a customer is logged in.</span>';
$_['entry_account']                = 'Account Terms:<br /><span class="help">Forces people to agree to terms before an account can be created.</span>';
$_['entry_cart_weight']            = 'Display Weight on Cart Page:';
$_['entry_guest_checkout']         = 'Guest Checkout:<br /><span class="help">Allow customers to checkout without creating an account. This will not be available when a downloadable product is in the shopping cart.</span>';
$_['entry_checkout']               = 'Checkout Terms:<br /><span class="help">Forces people to agree to terms before an a customer can checkout.</span>';
$_['entry_order_status']           = 'Order Status:<br /><span class="help">Set the default order status when an order is processed.</span>';
$_['entry_stock_display']          = 'Display Stock:<br /><span class="help">Display stock quantity on the product page.</span>';
$_['entry_stock_checkout']         = 'Stock Checkout:<br /><span class="help">Allow customers to still checkout if the products they are ordering are not in stock.</span>';
$_['entry_logo']                   = 'Application Logo:';
$_['entry_icon']                   = 'Icon:<br /><span class="help">The icon should be a PNG that is 16px x 16px.</span>';
$_['entry_image_category']         = 'Category Image Size:';
$_['entry_image_thumb']            = 'Product Image Thumb Size:';
$_['entry_image_popup']            = 'Product Image Popup Size:';
$_['entry_image_product']          = 'Product Image List Size:';
$_['entry_image_additional']       = 'Additional Product Image Size:';
$_['entry_image_related']          = 'Related Product Image Size:';
$_['entry_image_compare']          = 'Compare Image Size:';
$_['entry_image_wishlist']         = 'Wish List Image Size:';
$_['entry_image_cart']             = 'Cart Image Size:';
$_['entry_secure']                 = 'Use SSL:<br /><span class="help">To use SSL check with your host if a SSL certificate is installed.</span>';

// Error
$_['error_warning']                = 'Warning: Please check the form carefully for errors!';
$_['error_permission']             = 'Warning: You do not have permission to modify applications!';
$_['error_name']                   = 'Application Name must be between 3 and 32 characters!';
$_['error_owner']                  = 'Application Owner must be between 3 and 64 characters!';
$_['error_address']                = 'Application Address must be between 10 and 256 characters!';
$_['error_email']                  = 'E-Mail Address does not appear to be valid!';
$_['error_telephone']              = 'Telephone must be between 3 and 32 characters!';
$_['error_url']                    = 'Application URL required!';
$_['error_title']                  = 'Title must be between 3 and 32 characters!';
$_['error_limit']       	       = 'Limit required!';
$_['error_customer_group_display'] = 'You must include the default customer group if you are going to use this feature!';
$_['error_image_thumb']            = 'Product Image Thumb Size dimensions required!';
$_['error_image_popup']            = 'Product Image Popup Size dimensions required!';
$_['error_image_product']          = 'Product List Size dimensions required!';
$_['error_image_category']         = 'Category List Size dimensions required!';
$_['error_image_additional']       = 'Additional Product Image Size dimensions required!';
$_['error_image_related']          = 'Related Product Image Size dimensions required!';
$_['error_image_compare']          = 'Compare Image Size dimensions required!';
$_['error_image_wishlist']         = 'Wish List Image Size dimensions required!';
$_['error_image_cart']             = 'Cart Image Size dimensions required!';
$_['error_default']                = 'Warning: You can not delete your default application!';
$_['error_application']                  = 'Warning: This Application cannot be deleted as it is currently assigned to %s orders!';
