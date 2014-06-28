<?php

/*
 * Copyright (C) 2014 ahmet
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */


if (!defined('DIR_APPLICATION'))
    exit('No direct script access allowed');

/**
 * Description of application
 *
 * @author ahmet
 */
class ControllerSettingApplication extends Controller {

    private $error = array();

    public function index() {
        $this->language->load('setting/application');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('setting/application');

        $this->getList();
    }

    public function insert() {
        $this->language->load('setting/application');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('setting/application');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
            $application_id = $this->model_setting_application->addApplication($this->request->post);

            $this->load->model('setting/setting');

            $this->model_setting_setting->editSetting('config', $this->request->post, $application_id);

            $this->session->data['success'] = $this->language->get('text_success');

            $this->redirect($this->url->link('setting/application', 'token=' . $this->session->data['token'], 'SSL'));
        }

        $this->getForm();
    }

    public function update() {
        $this->language->load('setting/application');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('setting/application');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
            $this->model_setting_application->editApplication($this->request->get['application_id'], $this->request->post);

            $this->load->model('setting/setting');

            $this->model_setting_setting->editSetting('config', $this->request->post, $this->request->get['application_id']);

            $this->session->data['success'] = $this->language->get('text_success');

            $this->redirect($this->url->link('setting/application', 'token=' . $this->session->data['token'] . '&application_id=' . $this->request->get['application_id'], 'SSL'));
        }

        $this->getForm();
    }

    public function delete() {
        $this->language->load('setting/application');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('setting/application');

        $this->load->model('setting/setting');

        if (isset($this->request->post['selected']) && $this->validateDelete()) {
            foreach ($this->request->post['selected'] as $application_id) {
                $this->model_setting_application->deleteApplication($application_id);

                $this->model_setting_setting->deleteSetting('config', $application_id);
            }

            $this->session->data['success'] = $this->language->get('text_success');

            $this->redirect($this->url->link('setting/application', 'token=' . $this->session->data['token'], 'SSL'));
        }

        $this->getList();
    }

    protected function getList() {
        $url = '';

        if (isset($this->request->get['page'])) {
            $url .= '&page=' . $this->request->get['page'];
        }

        $this->data['breadcrumbs'] = array();

        $this->data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => false
        );

        $this->data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('setting/application', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' :: '
        );

        $this->data['insert'] = $this->url->link('setting/application/insert', 'token=' . $this->session->data['token'], 'SSL');
        $this->data['delete'] = $this->url->link('setting/application/delete', 'token=' . $this->session->data['token'], 'SSL');

        $this->data['applications'] = array();

        $action = array();

        $action[] = array(
            'text' => $this->language->get('text_edit'),
            'href' => $this->url->link('setting/setting', 'token=' . $this->session->data['token'], 'SSL')
        );

        $this->data['applications'][] = array(
            'application_id' => 0,
            'name' => $this->config->get('config_name') . $this->language->get('text_default'),
            'url' => HTTP_PUBLIC,
            'selected' => isset($this->request->post['selected']) && in_array(0, $this->request->post['selected']),
            'action' => $action
        );

        $application_total = $this->model_setting_application->getTotalApplications();

        $results = $this->model_setting_application->getApplications();

        foreach ($results as $result) {
            $action = array();

            $action[] = array(
                'text' => $this->language->get('text_edit'),
                'href' => $this->url->link('setting/application/update', 'token=' . $this->session->data['token'] . '&application_id=' . $result['application_id'], 'SSL')
            );

            $this->data['applications'][] = array(
                'application_id' => $result['application_id'],
                'name' => $result['name'],
                'url' => $result['url'],
                'selected' => isset($this->request->post['selected']) && in_array($result['application_id'], $this->request->post['selected']),
                'action' => $action
            );
        }

        $this->data['heading_title'] = $this->language->get('heading_title');

        $this->data['text_no_results'] = $this->language->get('text_no_results');

        $this->data['column_name'] = $this->language->get('column_name');
        $this->data['column_url'] = $this->language->get('column_url');
        $this->data['column_action'] = $this->language->get('column_action');

        $this->data['button_insert'] = $this->language->get('button_insert');
        $this->data['button_delete'] = $this->language->get('button_delete');

        if (isset($this->error['warning'])) {
            $this->data['error_warning'] = $this->error['warning'];
        } else {
            $this->data['error_warning'] = '';
        }

        if (isset($this->session->data['success'])) {
            $this->data['success'] = $this->session->data['success'];

            unset($this->session->data['success']);
        } else {
            $this->data['success'] = '';
        }

        $this->template = 'setting/application_list.tpl';
        $this->children = array(
            'common/header',
            'common/footer'
        );

        $this->response->setOutput($this->render());
    }

    public function getForm() {
        $this->data['heading_title'] = $this->language->get('heading_title');

        $this->data['text_select'] = $this->language->get('text_select');
        $this->data['text_none'] = $this->language->get('text_none');
        $this->data['text_yes'] = $this->language->get('text_yes');
        $this->data['text_no'] = $this->language->get('text_no');
        $this->data['text_items'] = $this->language->get('text_items');
        $this->data['text_account'] = $this->language->get('text_account');
        $this->data['text_image_manager'] = $this->language->get('text_image_manager');
        $this->data['text_browse'] = $this->language->get('text_browse');
        $this->data['text_clear'] = $this->language->get('text_clear');

        $this->data['entry_url'] = $this->language->get('entry_url');
        $this->data['entry_ssl'] = $this->language->get('entry_ssl');
        $this->data['entry_name'] = $this->language->get('entry_name');
        $this->data['entry_owner'] = $this->language->get('entry_owner');
        $this->data['entry_address'] = $this->language->get('entry_address');
        $this->data['entry_email'] = $this->language->get('entry_email');
        $this->data['entry_telephone'] = $this->language->get('entry_telephone');
        $this->data['entry_fax'] = $this->language->get('entry_fax');
        $this->data['entry_title'] = $this->language->get('entry_title');
        $this->data['entry_meta_description'] = $this->language->get('entry_meta_description');
        $this->data['entry_page'] = $this->language->get('entry_page');
        $this->data['entry_template'] = $this->language->get('entry_template');
        $this->data['entry_country'] = $this->language->get('entry_country');
        $this->data['entry_zone'] = $this->language->get('entry_zone');
        $this->data['entry_language'] = $this->language->get('entry_language');
        $this->data['entry_currency'] = $this->language->get('entry_currency');
        $this->data['entry_customer_group'] = $this->language->get('entry_customer_group');
        $this->data['entry_customer_group_display'] = $this->language->get('entry_customer_group_display');
        $this->data['entry_customer_price'] = $this->language->get('entry_customer_price');
        $this->data['entry_account'] = $this->language->get('entry_account');
        $this->data['entry_logo'] = $this->language->get('entry_logo');
        $this->data['entry_icon'] = $this->language->get('entry_icon');
        $this->data['entry_secure'] = $this->language->get('entry_secure');

        $this->data['button_save'] = $this->language->get('button_save');
        $this->data['button_cancel'] = $this->language->get('button_cancel');

        $this->data['tab_general'] = $this->language->get('tab_general');
        $this->data['tab_application'] = $this->language->get('tab_application');
        $this->data['tab_local'] = $this->language->get('tab_local');
        $this->data['tab_option'] = $this->language->get('tab_option');
        $this->data['tab_image'] = $this->language->get('tab_image');
        $this->data['tab_server'] = $this->language->get('tab_server');


        if (isset($this->error['warning'])) {
            $this->data['error_warning'] = $this->error['warning'];
        } else {
            $this->data['error_warning'] = '';
        }

        if (isset($this->error['url'])) {
            $this->data['error_url'] = $this->error['url'];
        } else {
            $this->data['error_url'] = '';
        }

        if (isset($this->error['name'])) {
            $this->data['error_name'] = $this->error['name'];
        } else {
            $this->data['error_name'] = '';
        }

        if (isset($this->error['owner'])) {
            $this->data['error_owner'] = $this->error['owner'];
        } else {
            $this->data['error_owner'] = '';
        }

        if (isset($this->error['address'])) {
            $this->data['error_address'] = $this->error['address'];
        } else {
            $this->data['error_address'] = '';
        }

        if (isset($this->error['email'])) {
            $this->data['error_email'] = $this->error['email'];
        } else {
            $this->data['error_email'] = '';
        }

        if (isset($this->error['telephone'])) {
            $this->data['error_telephone'] = $this->error['telephone'];
        } else {
            $this->data['error_telephone'] = '';
        }

        if (isset($this->error['title'])) {
            $this->data['error_title'] = $this->error['title'];
        } else {
            $this->data['error_title'] = '';
        }

        if (isset($this->error['customer_group_display'])) {
            $this->data['error_customer_group_display'] = $this->error['customer_group_display'];
        } else {
            $this->data['error_customer_group_display'] = '';
        }


        $this->data['breadcrumbs'] = array();

        $this->data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => false
        );

        $this->data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('setting/application', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' :: '
        );

        if (isset($this->session->data['success'])) {
            $this->data['success'] = $this->session->data['success'];

            unset($this->session->data['success']);
        } else {
            $this->data['success'] = '';
        }

        if (!isset($this->request->get['application_id'])) {
            $this->data['action'] = $this->url->link('setting/application/insert', 'token=' . $this->session->data['token'], 'SSL');
        } else {
            $this->data['action'] = $this->url->link('setting/application/update', 'token=' . $this->session->data['token'] . '&application_id=' . $this->request->get['application_id'], 'SSL');
        }

        $this->data['cancel'] = $this->url->link('setting/application', 'token=' . $this->session->data['token'], 'SSL');

        if (isset($this->request->get['application_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
            $this->load->model('setting/setting');

            $application_info = $this->model_setting_setting->getSetting('config', $this->request->get['application_id']);
        }

        $this->data['token'] = $this->session->data['token'];

        if (isset($this->request->post['config_url'])) {
            $this->data['config_url'] = $this->request->post['config_url'];
        } elseif (isset($application_info['config_url'])) {
            $this->data['config_url'] = $application_info['config_url'];
        } else {
            $this->data['config_url'] = '';
        }

        if (isset($this->request->post['config_ssl'])) {
            $this->data['config_ssl'] = $this->request->post['config_ssl'];
        } elseif (isset($application_info['config_ssl'])) {
            $this->data['config_ssl'] = $application_info['config_ssl'];
        } else {
            $this->data['config_ssl'] = '';
        }

        if (isset($this->request->post['config_name'])) {
            $this->data['config_name'] = $this->request->post['config_name'];
        } elseif (isset($application_info['config_name'])) {
            $this->data['config_name'] = $application_info['config_name'];
        } else {
            $this->data['config_name'] = '';
        }

        if (isset($this->request->post['config_owner'])) {
            $this->data['config_owner'] = $this->request->post['config_owner'];
        } elseif (isset($application_info['config_owner'])) {
            $this->data['config_owner'] = $application_info['config_owner'];
        } else {
            $this->data['config_owner'] = '';
        }

        if (isset($this->request->post['config_address'])) {
            $this->data['config_address'] = $this->request->post['config_address'];
        } elseif (isset($application_info['config_address'])) {
            $this->data['config_address'] = $application_info['config_address'];
        } else {
            $this->data['config_address'] = '';
        }

        if (isset($this->request->post['config_email'])) {
            $this->data['config_email'] = $this->request->post['config_email'];
        } elseif (isset($application_info['config_email'])) {
            $this->data['config_email'] = $application_info['config_email'];
        } else {
            $this->data['config_email'] = '';
        }

        if (isset($this->request->post['config_telephone'])) {
            $this->data['config_telephone'] = $this->request->post['config_telephone'];
        } elseif (isset($application_info['config_telephone'])) {
            $this->data['config_telephone'] = $application_info['config_telephone'];
        } else {
            $this->data['config_telephone'] = '';
        }

        if (isset($this->request->post['config_fax'])) {
            $this->data['config_fax'] = $this->request->post['config_fax'];
        } elseif (isset($application_info['config_fax'])) {
            $this->data['config_fax'] = $application_info['config_fax'];
        } else {
            $this->data['config_fax'] = '';
        }

        if (isset($this->request->post['config_title'])) {
            $this->data['config_title'] = $this->request->post['config_title'];
        } elseif (isset($application_info['config_title'])) {
            $this->data['config_title'] = $application_info['config_title'];
        } else {
            $this->data['config_title'] = '';
        }

        if (isset($this->request->post['config_meta_description'])) {
            $this->data['config_meta_description'] = $this->request->post['config_meta_description'];
        } elseif (isset($application_info['config_meta_description'])) {
            $this->data['config_meta_description'] = $application_info['config_meta_description'];
        } else {
            $this->data['config_meta_description'] = '';
        }

        if (isset($this->request->post['config_layout_id'])) {
            $this->data['config_layout_id'] = $this->request->post['config_layout_id'];
        } elseif (isset($application_info['config_layout_id'])) {
            $this->data['config_layout_id'] = $application_info['config_layout_id'];
        } else {
            $this->data['config_layout_id'] = '';
        }

        $this->load->model('design/layout');

        $this->data['layouts'] = $this->model_design_layout->getLayouts();
        
        if (isset($this->request->post['config_page_id'])) {
            $this->data['config_page_id'] = $this->request->post['config_page_id'];
        } else {
            $this->data['config_page_id'] = $this->config->get('config_page_id');
        }

        $this->load->model('design/page');

        $this->data['pages'] = $this->model_design_page->getPages();

        if (isset($this->request->post['config_template'])) {
            $this->data['config_template'] = $this->request->post['config_template'];
        } elseif (isset($application_info['config_template'])) {
            $this->data['config_template'] = $application_info['config_template'];
        } else {
            $this->data['config_template'] = '';
        }

        $this->data['templates'] = array();

        $directories = glob(DIR_PUBLIC . 'view/theme/*', GLOB_ONLYDIR);

        foreach ($directories as $directory) {
            $this->data['templates'][] = basename($directory);
        }

        if (isset($this->request->post['config_country_id'])) {
            $this->data['config_country_id'] = $this->request->post['config_country_id'];
        } elseif (isset($application_info['config_country_id'])) {
            $this->data['config_country_id'] = $application_info['config_country_id'];
        } else {
            $this->data['config_country_id'] = $this->config->get('config_country_id');
        }

        $this->load->model('localisation/country');

        $this->data['countries'] = $this->model_localisation_country->getCountries();

        if (isset($this->request->post['config_zone_id'])) {
            $this->data['config_zone_id'] = $this->request->post['config_zone_id'];
        } elseif (isset($application_info['config_zone_id'])) {
            $this->data['config_zone_id'] = $application_info['config_zone_id'];
        } else {
            $this->data['config_zone_id'] = $this->config->get('config_zone_id');
        }

        if (isset($this->request->post['config_language'])) {
            $this->data['config_language'] = $this->request->post['config_language'];
        } elseif (isset($application_info['config_language'])) {
            $this->data['config_language'] = $application_info['config_language'];
        } else {
            $this->data['config_language'] = $this->config->get('config_language');
        }

        $this->load->model('localisation/language');

        $this->data['languages'] = $this->model_localisation_language->getLanguages();

        if (isset($this->request->post['config_currency'])) {
            $this->data['config_currency'] = $this->request->post['config_currency'];
        } elseif (isset($application_info['config_currency'])) {
            $this->data['config_currency'] = $application_info['config_currency'];
        } else {
            $this->data['config_currency'] = $this->config->get('config_currency');
        }

        $this->load->model('localisation/currency');

        $this->data['currencies'] = $this->model_localisation_currency->getCurrencies();


        if (isset($this->request->post['config_customer_group_id'])) {
            $this->data['config_customer_group_id'] = $this->request->post['config_customer_group_id'];
        } elseif (isset($application_info['config_customer_group_id'])) {
            $this->data['config_customer_group_id'] = $application_info['config_customer_group_id'];
        } else {
            $this->data['config_customer_group_id'] = '';
        }

        $this->load->model('account/customer_group');

        $this->data['customer_groups'] = $this->model_account_customer_group->getCustomerGroups();

        if (isset($this->request->post['config_customer_group_display'])) {
            $this->data['config_customer_group_display'] = $this->request->post['config_customer_group_display'];
        } elseif (isset($application_info['config_customer_group_display'])) {
            $this->data['config_customer_group_display'] = $application_info['config_customer_group_display'];
        } else {
            $this->data['config_customer_group_display'] = array();
        }

        if (isset($this->request->post['config_customer_price'])) {
            $this->data['config_customer_price'] = $this->request->post['config_customer_price'];
        } elseif (isset($application_info['config_customer_price'])) {
            $this->data['config_customer_price'] = $application_info['config_customer_price'];
        } else {
            $this->data['config_customer_price'] = '';
        }

        if (isset($this->request->post['config_account_id'])) {
            $this->data['config_account_id'] = $this->request->post['config_account_id'];
        } elseif (isset($application_info['config_account_id'])) {
            $this->data['config_account_id'] = $application_info['config_account_id'];
        } else {
            $this->data['config_account_id'] = '';
        }

        $this->load->model('application/content');

        $this->data['contents'] = $this->model_application_content->getContents();


        $this->load->model('tool/image');

        if (isset($this->request->post['config_logo'])) {
            $this->data['config_logo'] = $this->request->post['config_logo'];
        } elseif (isset($application_info['config_logo'])) {
            $this->data['config_logo'] = $application_info['config_logo'];
        } else {
            $this->data['config_logo'] = '';
        }

        if (isset($application_info['config_logo']) && file_exists(DIR_IMAGE . $application_info['config_logo']) && is_file(DIR_IMAGE . $application_info['config_logo'])) {
            $this->data['logo'] = $this->model_tool_image->resize($application_info['config_logo'], 100, 100);
        } else {
            $this->data['logo'] = $this->model_tool_image->resize('no_image.jpg', 100, 100);
        }

        if (isset($this->request->post['config_icon'])) {
            $this->data['config_icon'] = $this->request->post['config_icon'];
        } elseif (isset($application_info['config_icon'])) {
            $this->data['config_icon'] = $application_info['config_icon'];
        } else {
            $this->data['config_icon'] = '';
        }

        if (isset($application_info['config_icon']) && file_exists(DIR_IMAGE . $application_info['config_icon']) && is_file(DIR_IMAGE . $application_info['config_icon'])) {
            $this->data['icon'] = $this->model_tool_image->resize($application_info['config_icon'], 100, 100);
        } else {
            $this->data['icon'] = $this->model_tool_image->resize('no_image.jpg', 100, 100);
        }

        $this->data['no_image'] = $this->model_tool_image->resize('no_image.jpg', 100, 100);


        if (isset($this->request->post['config_secure'])) {
            $this->data['config_secure'] = $this->request->post['config_secure'];
        } elseif (isset($application_info['config_secure'])) {
            $this->data['config_secure'] = $application_info['config_secure'];
        } else {
            $this->data['config_secure'] = '';
        }


        $this->template = 'setting/application_form.tpl';
        $this->children = array(
            'common/header',
            'common/footer'
        );

        $this->response->setOutput($this->render());
    }

    protected function validateForm() {
        if (!$this->user->hasPermission('modify', 'setting/application')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        if (!$this->request->post['config_url']) {
            $this->error['url'] = $this->language->get('error_url');
        }

        if (!$this->request->post['config_name']) {
            $this->error['name'] = $this->language->get('error_name');
        }

        if ((utf8_strlen($this->request->post['config_owner']) < 3) || (utf8_strlen($this->request->post['config_owner']) > 64)) {
            $this->error['owner'] = $this->language->get('error_owner');
        }

        if ((utf8_strlen($this->request->post['config_address']) < 3) || (utf8_strlen($this->request->post['config_address']) > 256)) {
            $this->error['address'] = $this->language->get('error_address');
        }

        if ((utf8_strlen($this->request->post['config_email']) > 96) || !preg_match('/^[^\@]+@.*\.[a-z]{2,6}$/i', $this->request->post['config_email'])) {
            $this->error['email'] = $this->language->get('error_email');
        }

        if ((utf8_strlen($this->request->post['config_telephone']) < 3) || (utf8_strlen($this->request->post['config_telephone']) > 32)) {
            $this->error['telephone'] = $this->language->get('error_telephone');
        }

        if (!$this->request->post['config_title']) {
            $this->error['title'] = $this->language->get('error_title');
        }

        if (!empty($this->request->post['config_customer_group_display']) && !in_array($this->request->post['config_customer_group_id'], $this->request->post['config_customer_group_display'])) {
            $this->error['customer_group_display'] = $this->language->get('error_customer_group_display');
        }

        if ($this->error && !isset($this->error['warning'])) {
            $this->error['warning'] = $this->language->get('error_warning');
        }

        if (!$this->error) {
            return true;
        } else {
            return false;
        }
    }

    protected function validateDelete() {
        if (!$this->user->hasPermission('modify', 'setting/application')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

//        $this->load->model('account/order');
//
//        foreach ($this->request->post['selected'] as $application_id) {
//            if (!$application_id) {
//                $this->error['warning'] = $this->language->get('error_default');
//            }
//
//            $application_total = $this->model_account_order->getTotalOrdersByApplicationId($application_id);
//
//            if ($application_total) {
//                $this->error['warning'] = sprintf($this->language->get('error_application'), $application_total);
//            }
//        }

        if (!$this->error) {
            return true;
        } else {
            return false;
        }
    }

    public function template() {
        if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) {
            $server = HTTPS_PUBLIC;
        } else {
            $server = HTTP_PUBLIC;
        }

        if (file_exists(DIR_IMAGE . 'templates/' . basename($this->request->get['template']) . '.png')) {
            $image = $server . 'image/templates/' . basename($this->request->get['template']) . '.png';
        } else {
            $image = $server . 'image/no_image.jpg';
        }

        $this->response->setOutput('<img src="' . $image . '" alt="" title="" style="border: 1px solid #EEEEEE;" />');
    }

    public function country() {
        $json = array();

        $this->load->model('localisation/country');

        $country_info = $this->model_localisation_country->getCountry($this->request->get['country_id']);

        if ($country_info) {
            $this->load->model('localisation/zone');

            $json = array(
                'country_id' => $country_info['country_id'],
                'name' => $country_info['name'],
                'iso_code_2' => $country_info['iso_code_2'],
                'iso_code_3' => $country_info['iso_code_3'],
                'address_format' => $country_info['address_format'],
                'postcode_required' => $country_info['postcode_required'],
                'zone' => $this->model_localisation_zone->getZonesByCountryId($this->request->get['country_id']),
                'status' => $country_info['status']
            );
        }

        $this->response->setOutput(json_encode($json));
    }

} 