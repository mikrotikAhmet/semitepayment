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
        
        if (isset($data['customer_group_id']) && is_array($this->config->get('config_customer_group_display')) && in_array($data['customer_group_id'], $this->config->get('config_customer_group_display'))) {
                $customer_group_id = $data['customer_group_id'];
        } else {
                $customer_group_id = $this->config->get('config_customer_group_id');
        }

        $this->load->model('account/customer_group');

        $customer_group_info = $this->model_account_customer_group->getCustomerGroup($customer_group_id);

        
        $this->db->query("INSERT INTO " . DB_PREFIX . "customer SET firstname = '".$this->db->escape($data['firstname'])."', lastname = '".$this->db->escape($data['lastname'])."',email = '" . $this->db->escape($data['email']) . "', salt = '" . $this->db->escape($salt = substr(md5(uniqid(rand(), true)), 0, 9)) . "', password = '" . $this->db->escape(sha1($salt . sha1($salt . sha1($this->encryption->decrypt($data['password']))))) . "',customer_group_id = '".(int) $data['customer_group_id']."',  date_added = NOW()");

        $customer_id = $this->db->getLastId();
       
        $this->db->query("INSERT INTO ".DB_PREFIX."customer_account SET account_number = '".$this->db->escape($data['account_number'])."',customer_id = '".(int) $customer_id."',iban = '".$this->db->escape($data['iban'])."',swift_bic = '".$this->db->escape($data['bic'])."' ,v_card_number = '".$this->db->escape($data['cc'])."', v_card_ccv = '".(int) $data['ccv']."', date_expire = '".$this->db->escape($data['expire_date'])."'");
        
        $this->language->load('mail/customer');

		$subject = sprintf($this->language->get('text_subject'), $this->config->get('config_name'));

		$message = sprintf($this->language->get('text_welcome'), $this->config->get('config_name')) . "\n\n";

		if (!$customer_group_info['approval']) {
			$message .= $this->language->get('text_login') . "\n";
		} else {
			$message .= $this->language->get('text_approval') . "\n";
		}

		$message .= HTTP_MERCHANT . "\n\n";
		$message .= $this->language->get('text_services') . "\n\n";
		$message .= $this->language->get('text_thanks') . "\n";
		$message .= $this->config->get('config_name');

		$mail = new Mail();
		$mail->protocol = $this->config->get('config_mail_protocol');
		$mail->parameter = $this->config->get('config_mail_parameter');
		$mail->hostname = $this->config->get('config_smtp_host');
		$mail->username = $this->config->get('config_smtp_username');
		$mail->password = $this->config->get('config_smtp_password');
		$mail->port = $this->config->get('config_smtp_port');
		$mail->timeout = $this->config->get('config_smtp_timeout');				
		$mail->setTo($data['email']);
		$mail->setFrom($this->config->get('config_email'));
		$mail->setSender($this->config->get('config_name'));
		$mail->setSubject(html_entity_decode($subject, ENT_QUOTES, 'UTF-8'));
		$mail->setText(html_entity_decode($message, ENT_QUOTES, 'UTF-8'));
		$mail->send();
    }
    
    public function getTotalCustomersByEmail($mail) {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "customer WHERE email = '" . $this->db->escape($mail) . "'");

        return $query->row['total'];
    }
    
    public function getCustomerByKey($key){
        
        $customer_data = array();
        
        $sql = "SELECT * FROM ".DB_PREFIX."customer c LEFT JOIN ".DB_PREFIX."customer_account ca ON(c.customer_id = ca.customer_id)";
        
        $sql .=" WHERE test_secret_key = '".$this->db->escape($key)."' OR";
        $sql .=" test_public_key = '".$this->db->escape($key)."' OR";
        $sql .=" live_secret_key = '".$this->db->escape($key)."' OR";
        $sql .=" live_public_key = '".$this->db->escape($key)."' LIMIT 1";
        
        $result = $this->db->query($sql);
        
        if ($result) {
            $customer_data = array(
                'customer_id'=>$result->row['customer_id'],
                'statement'=>$this->getCustomerStatementByCustomerId($result->row['customer_id']),
                'M_PK'=>$key,
                'type'=>  $this->getKeyType($key),
                'mode'=> $this->getTransactionMode($key),
                'approved'=>$result->row['approved'],
                'M_SK'=>$this->getSecretKeyByPublicKey($key)

            );
        }
        
        return $customer_data;
    }
    
    public function getCustomerStatementByCustomerId($customer_id){
        
        $result = $this->db->query("SELECT * FROM ".DB_PREFIX."customer_statement WHERE customer_id = '".(int) $customer_id."'");
        
        return $result->row;
    }
    
    protected function getKeyType($key){
        
        $trim_key = explode("_", $key);
        $type = "";
        
        switch ($trim_key[0]){
            case "pk":
                $type = 'Public Key';
                break;
            case "sk":
                $type = 'Secret Key';
                break;
        }
        
        return $type;
    }
    
    protected function getTransactionMode($key){
        
        $trim_key = explode("_", $key);
        
        return ucfirst($trim_key[1]);
    }
    
    protected function getSecretKeyByPublicKey($key){
        
        $trim_key = explode("_", $key);
        
        $result = $this->db->query("SELECT * FROM ".DB_PREFIX."customer_account WHERE ".$trim_key[1]."_public_key = '".$this->db->escape($key)."'");
        
        if ($result->row){
            return $result->row[$trim_key[1]."_secret_key"];
        } else {
            return false;
        }
    }
}
