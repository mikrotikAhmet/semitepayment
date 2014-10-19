<?php

if (!defined('DIR_APPLICATION'))
    exit('No direct script access allowed');

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
 * Description of payment Class
 *
 * @author ahmet
 */
class ModelAccountPayment extends Model{
    
    public function makeTransaction($data,$description = '', $amount = ''){
        
        $customer_id = $this->getCustomerByCardNumber($data['from_account']);
        
        $digits = 7;
        $transaction_id = rand(pow(10, $digits-1), pow(10, $digits)-1);
        
        $this->db->query("INSERT INTO " . DB_PREFIX . "customer_transaction SET customer_id = '" . (int) $customer_id . "', transaction_id = '" . (int) $transaction_id . "', description = '" . $this->db->escape($description) . "', amount = '-" . (float) $amount . "',status = '".(int) $this->config->get('config_complete_transaction_status_id')."', date_added = NOW()");
        
        $this->db->query("INSERT INTO " . DB_PREFIX . "customer_transaction SET customer_id = '" . (int) $data['to_account'] . "', transaction_id = '" . (int) $transaction_id . "', description = 'Recieve Payment', amount = '" . (float) $amount . "', status = '".(int) $this->config->get('config_complete_transaction_status_id')."',date_added = NOW()");
    }
    
    public function getCustomerByAccountNumber($account_number){
        
        $query = $this->db->query("SELECT (customer_id) AS customer FROM ".DB_PREFIX."customer_account WHERE account_number = '". $this->db->escape($account_number)."'");
        
        return $query->row['customer'];
    }
    
    public function getCustomerByCardNumber($cc){
        
        $query = $this->db->query("SELECT (customer_id) AS customer FROM ".DB_PREFIX."customer_account WHERE v_card_number = '".  FormatCreditCard($cc)."'");
        
        return $query->row['customer'];
    }
}
