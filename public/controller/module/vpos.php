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
                
        $this->language->load('module/vpos');

        $this->data['text_credit_card'] = $this->language->get('text_credit_card');
        $this->data['text_start_date'] = $this->language->get('text_start_date');
        $this->data['text_issue'] = $this->language->get('text_issue');
        $this->data['text_wait'] = $this->language->get('text_wait');

        $this->data['entry_cc_holder'] = $this->language->get('entry_cc_holder');
        $this->data['entry_cc_type'] = $this->language->get('entry_cc_type');
        $this->data['entry_cc_number'] = $this->language->get('entry_cc_number');
        $this->data['entry_cc_start_date'] = $this->language->get('entry_cc_start_date');
        $this->data['entry_cc_expire_date'] = $this->language->get('entry_cc_expire_date');
        $this->data['entry_cc_cvv2'] = $this->language->get('entry_cc_cvv2');
        $this->data['entry_cc_issue'] = $this->language->get('entry_cc_issue');
        
        $this->data['months'] = array();

        for ($i = 1; $i <= 12; $i++) {
                $this->data['months'][] = array(
                        'text'  => strftime('%B', mktime(0, 0, 0, $i, 1, 2000)), 
                        'value' => sprintf('%02d', $i)
                );
        }

        $today = getdate();

        $this->data['year_expire'] = array();

        for ($i = $today['year']; $i < $today['year'] + 11; $i++) {
                $this->data['year_expire'][] = array(
                        'text'  => strftime('%Y', mktime(0, 0, 0, 1, 1, $i)),
                        'value' => strftime('%Y', mktime(0, 0, 0, 1, 1, $i)) 
                );
        }
        
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
            
            $this->data['action'] = $this->url->link('module/vpos','key='.$merchant_key['key'],'SSL');
            
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
    
    public function pay(){
        
        $json = array();
        
        $merchant_key = $this->request->get;
        
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
            
            $this->load->model('account/customer');
            
            $customer_info = $this->model_account_customer->getCustomerByKey($merchant_key['key']);
             
             $this->load->helper('creditcard');
             
             $request = $this->request->post;
                 
             $res = CallAPI('POST', 'http://lapi.semitepayment.com/v1/payment/pay',$request);
             
             $output = json_decode($res);
             
             if ($output->stat == 'OK' && isset($output->customer_id)){
                 
                 $AMT = $request['AMT'];
                 $CVV = $request['cc_cvv2'];
                 $EXPM = $request['cc_expire_date_month'];
                 $EXPY = $request['cc_expire_date_year'];
                 
                 $expiry_date = explode('-', $output->date_expire);
                 
                 $ac_exp_month = $expiry_date[1];
                 $ac_exp_year = $expiry_date[0];
                 
                 if ($AMT > $output->balance){
                     $json['stat'] = 'Insufficient Balance.';
                 } elseif ($CVV != $output->v_card_ccv){
                     $json['stat'] = 'Card Security Code (CVV2) Error';
                 } elseif ($EXPM != $ac_exp_month || $EXPY != $ac_exp_year) {
                     $json['stat'] = 'Expire Date Error';
                 } else {
                     
                     $this->load->model('account/payment');
                     
                     $transaction_data = array(
                         'from_account'=>$request['cc_number'],
                         'to_account'=>  $customer_info['customer_id'],
                         'amount'=> $AMT
                     );
                     
                     $transaction = $this->model_account_payment->makeTransaction($transaction_data,'Payment',$AMT);
                     
                     $json['stat'] = $output->stat;
                 }
             } else {
                $json['stat'] = $output->stat;
             }
             
             $this->response->setOutput(json_encode($json));
         } else {
             $json['stat'] = 'Bad Request';
             $this->response->setOutput(json_encode($json));
         }
    }
    
     protected function validateForm() {

         if (empty($this->request->post['cc_number'])){
             $this->error['error'] = 'Error';
         }
         
         if (empty($this->request->post['cc_cvv2'])){
             $this->error['error'] = 'Error';
         }
         
         if (empty($this->request->post['cc_expire_date_month'])){
             $this->error['error'] = 'Error';
         }
         
         if (empty($this->request->post['cc_expire_date_year'])){
             $this->error['error'] = 'Error';
         }
         
        if (!$this->error) {
            return true;
        } else {
            return false;
        }
    }
}
