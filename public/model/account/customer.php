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
 * Description of customer Class
 *
 * @author ahmet
 */
class ModelAccountCustomer extends Model{
    
    public function addCustomer($data) {
        
        $this->db->query("INSERT INTO " . DB_PREFIX . "customer SET firstname = '".$this->db->escape($data['firstname'])."', lastname = '".$this->db->escape($data['lastname'])."',email = '" . $this->db->escape($data['email']) . "', salt = '" . $this->db->escape($salt = substr(md5(uniqid(rand(), true)), 0, 9)) . "', password = '" . $this->db->escape(sha1($salt . sha1($salt . sha1($this->encryption->decrypt($data['password']))))) . "',customer_group_id = '".(int) $data['customer_group_id']."',  date_added = NOW()");

        $customer_id = $this->db->getLastId();
       
        $this->db->query("INSERT INTO ".DB_PREFIX."customer_account SET account_number = '".$this->db->escape($data['account_number'])."',customer_id = '".(int) $customer_id."',iban = '".$this->db->escape($data['iban'])."',swift_bic = '".$this->db->escape($data['bic'])."' ,v_card_number = '".$this->db->escape($data['cc'])."', v_card_ccv = '".(int) $data['ccv']."', date_expire = '".$this->db->escape($data['expire_date'])."'");
        
    }
    
    public function getTotalCustomersByEmail($mail) {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "customer WHERE email = '" . $this->db->escape($mail) . "'");

        return $query->row['total'];
    }
}
