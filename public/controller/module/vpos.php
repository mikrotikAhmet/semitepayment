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
 * Description of vpos Class
 *
 * @author ahmet
 */
class ControllerModuleVpos extends Controller{
    
    private $error = array();
    
    public function index() {
        
        $merchant_key = $this->request->get;
        $customer_info = array();
        
        if (isset($merchant_key['key'])){
            
            $this->load->model('account/customer');
            
            $customer_info = $this->model_account_customer->getCustomerByKey($merchant_key['key']);
            
            if($customer_info){
            
                if (!$customer_info['approved'] && $customer_info['mode'] == 'Live'){

                    throw new Exception('Live Mode Error');
                }

                 if ($customer_info['type'] == 'Secret Key'){

                    throw new Exception('Illegal Key Definition');
                }
            }
            
            $this->data['merchant'] = $customer_info;
            
            if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/vpos.tpl')) {
                $this->template = $this->config->get('config_template') . '/template/module/vpos.tpl';
            } else {
                $this->template = 'default/template/module/vpos.tpl';
            }

            $this->render();
        } else {
            
            $this->response->addHeader($this->request->server['SERVER_PROTOCOL'] . '/1.1 404 Not Found');

             if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/error/vpos_error.tpl')) {
                $this->template = $this->config->get('config_template') . '/template/error/vpos_error.tpl';
            } else {
                $this->template = 'default/template/error/vpos_error.tpl';
            }

            $this->render();
        }
    }
    
     protected function validateForm() {


        if (!$this->error) {
            return true;
        } else {
            return false;
        }
    }
}
