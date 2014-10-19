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
    
    
    public function index(){
        
        $this->language->load('module/vpos');

        $this->document->setTitle($this->language->get('heading_title'));
        
        $this->load->model('setting/setting');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
                $this->model_setting_setting->editSetting('vpos', $this->request->post);		

                $this->session->data['success'] = $this->language->get('text_success');

                $this->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
        }
        
        $this->data['heading_title'] = $this->language->get('heading_title');
        
        $this->data['text_enabled'] = $this->language->get('text_enabled');
        $this->data['text_disabled'] = $this->language->get('text_disabled');
        
        $this->data['entry_company'] = $this->language->get('entry_company');
        $this->data['entry_company_owner'] = $this->language->get('entry_company_owner');
        $this->data['entry_company_code'] = $this->language->get('entry_company_code');
        $this->data['entry_terminal'] = $this->language->get('entry_terminal');
        $this->data['entry_organization'] = $this->language->get('entry_organization');
        $this->data['entry_merchant_id'] = $this->language->get('entry_merchant_id');
        $this->data['entry_merchant_key'] = $this->language->get('entry_merchant_key');
        $this->data['entry_3dsecure'] = $this->language->get('entry_3dsecure');
        $this->data['entry_status'] = $this->language->get('entry_status');

        $this->data['button_save'] = $this->language->get('button_save');
        $this->data['button_cancel'] = $this->language->get('button_cancel');
        
        if (isset($this->error['warning'])) {
                $this->data['error_warning'] = $this->error['warning'];
        } else {
                $this->data['error_warning'] = '';
        }
        
        $this->data['breadcrumbs'] = array();

        $this->data['breadcrumbs'][] = array(
                'text'      => $this->language->get('text_home'),
                'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
                'separator' => false
        );

        $this->data['breadcrumbs'][] = array(
                'text'      => $this->language->get('text_module'),
                'href'      => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'),
                'separator' => ' :: '
        );

        $this->data['breadcrumbs'][] = array(
                'text'      => $this->language->get('heading_title'),
                'href'      => $this->url->link('module/vpos', 'token=' . $this->session->data['token'], 'SSL'),
                'separator' => ' :: '
        );

        $this->data['action'] = $this->url->link('module/vpos', 'token=' . $this->session->data['token'], 'SSL');

        $this->data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

        $this->data['module'] = $this->config->get('vpos_module');       
       
        $this->template = 'module/vpos.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);

		$this->response->setOutput($this->render());
    }
    
    protected function validate() {
		if (!$this->user->hasPermission('modify', 'module/vpos')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if (!$this->error) {
			return true;
		} else {
			return false;
		}	
	}
}
