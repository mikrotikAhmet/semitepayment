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
 * Description of setting
 *
 * @author ahmet
 */
class ControllerSettingSetting extends Controller {

    private $error = array();

    public function index() {
        $this->language->load('setting/setting');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('setting/setting');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            $this->model_setting_setting->editSetting('config', $this->request->post);

            if ($this->config->get('config_currency_auto')) {
                $this->load->model('localisation/currency');

                $this->model_localisation_currency->updateCurrencies();
            }

            $this->session->data['success'] = $this->language->get('text_success');

            $this->redirect($this->url->link('setting/application', 'token=' . $this->session->data['token'], 'SSL'));
        }

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
        $this->data['text_mail'] = $this->language->get('text_mail');
        $this->data['text_smtp'] = $this->language->get('text_smtp');
        $this->data['text_api'] = $this->language->get('text_api');
        $this->data['text_transaction'] = $this->language->get('text_transaction');
        $this->data['text_transfer'] = $this->language->get('text_transfer');
        $this->data['text_affiliate'] = $this->language->get('text_affiliate');
        $this->data['text_verification'] = $this->language->get('text_verification');

        $this->data['entry_name'] = $this->language->get('entry_name');
        $this->data['entry_owner'] = $this->language->get('entry_owner');
        $this->data['entry_address'] = $this->language->get('entry_address');
        $this->data['entry_email'] = $this->language->get('entry_email');
        $this->data['entry_telephone'] = $this->language->get('entry_telephone');
        $this->data['entry_fax'] = $this->language->get('entry_fax');
        $this->data['entry_title'] = $this->language->get('entry_title');
        $this->data['entry_meta_description'] = $this->language->get('entry_meta_description');
        $this->data['entry_template'] = $this->language->get('entry_template');
        $this->data['entry_page'] = $this->language->get('entry_page');
        $this->data['entry_layout'] = $this->language->get('entry_layout');
        $this->data['entry_country'] = $this->language->get('entry_country');
        $this->data['entry_zone'] = $this->language->get('entry_zone');
        $this->data['entry_language'] = $this->language->get('entry_language');
        $this->data['entry_admin_language'] = $this->language->get('entry_admin_language');
        $this->data['entry_admin_limit'] = $this->language->get('entry_admin_limit');
        $this->data['entry_currency'] = $this->language->get('entry_currency');
        $this->data['entry_currency_auto'] = $this->language->get('entry_currency_auto');
        $this->data['entry_customer_online'] = $this->language->get('entry_customer_online');
        $this->data['entry_customer_group'] = $this->language->get('entry_customer_group');
        $this->data['entry_customer_group_display'] = $this->language->get('entry_customer_group_display');
        $this->data['entry_customer_price'] = $this->language->get('entry_customer_price');
        $this->data['entry_account'] = $this->language->get('entry_account');
        $this->data['entry_transaction_status'] = $this->language->get('entry_transaction_status');
        $this->data['entry_transaction_status_complete'] = $this->language->get('entry_transaction_status_complete');
        
        $this->data['entry_invoice_prefix'] = $this->language->get('entry_invoice_prefix');
        $this->data['entry_transfer_status'] = $this->language->get('entry_transfer_status');
        $this->data['entry_transfer_status_complete'] = $this->language->get('entry_transfer_status_complete');
        
        $this->data['entry_affiliate'] = $this->language->get('entry_affiliate');
        $this->data['entry_commission'] = $this->language->get('entry_commission');
        
        $this->data['entry_creditcard_status'] = $this->language->get('entry_creditcard_status');
        $this->data['entry_complete_creditcard_status'] = $this->language->get('entry_complete_creditcard_status');
        $this->data['entry_bankaccount_status'] = $this->language->get('entry_bankaccount_status');
        $this->data['entry_complete_bankaccount_status'] = $this->language->get('entry_complete_bankaccount_status');
        
        $this->data['entry_mail_template'] = $this->language->get('entry_mail_template');
        $this->data['entry_logo'] = $this->language->get('entry_logo');
        $this->data['entry_icon'] = $this->language->get('entry_icon');
        $this->data['entry_ftp_host'] = $this->language->get('entry_ftp_host');
        $this->data['entry_ftp_port'] = $this->language->get('entry_ftp_port');
        $this->data['entry_ftp_username'] = $this->language->get('entry_ftp_username');
        $this->data['entry_ftp_password'] = $this->language->get('entry_ftp_password');
        $this->data['entry_ftp_root'] = $this->language->get('entry_ftp_root');
        $this->data['entry_ftp_status'] = $this->language->get('entry_ftp_status');
        $this->data['entry_mail_protocol'] = $this->language->get('entry_mail_protocol');
        $this->data['entry_mail_parameter'] = $this->language->get('entry_mail_parameter');
        $this->data['entry_smtp_host'] = $this->language->get('entry_smtp_host');
        $this->data['entry_smtp_username'] = $this->language->get('entry_smtp_username');
        $this->data['entry_smtp_password'] = $this->language->get('entry_smtp_password');
        $this->data['entry_smtp_port'] = $this->language->get('entry_smtp_port');
        $this->data['entry_smtp_timeout'] = $this->language->get('entry_smtp_timeout');
        $this->data['entry_alert_mail'] = $this->language->get('entry_alert_mail');
        $this->data['entry_account_mail'] = $this->language->get('entry_account_mail');
        $this->data['entry_alert_emails'] = $this->language->get('entry_alert_emails');
        $this->data['entry_secure'] = $this->language->get('entry_secure');
        $this->data['entry_shared'] = $this->language->get('entry_shared');
        $this->data['entry_robots'] = $this->language->get('entry_robots');
        $this->data['entry_file_extension_allowed'] = $this->language->get('entry_file_extension_allowed');
        $this->data['entry_file_mime_allowed'] = $this->language->get('entry_file_mime_allowed');
        $this->data['entry_maintenance'] = $this->language->get('entry_maintenance');
        $this->data['entry_password'] = $this->language->get('entry_password');
        $this->data['entry_encryption'] = $this->language->get('entry_encryption');
        $this->data['entry_seo_url'] = $this->language->get('entry_seo_url');
        $this->data['entry_compression'] = $this->language->get('entry_compression');
        $this->data['entry_error_display'] = $this->language->get('entry_error_display');
        $this->data['entry_error_log'] = $this->language->get('entry_error_log');
        $this->data['entry_error_filename'] = $this->language->get('entry_error_filename');
        $this->data['entry_google_analytics'] = $this->language->get('entry_google_analytics');
        $this->data['entry_test_publickey_api_prefix'] = $this->language->get('entry_test_publickey_api_prefix');
        $this->data['entry_test_secretkey_api_prefix'] = $this->language->get('entry_test_secretkey_api_prefix');
        $this->data['entry_live_publickey_api_prefix'] = $this->language->get('entry_live_publickey_api_prefix');
        $this->data['entry_live_secretkey_api_prefix'] = $this->language->get('entry_live_secretkey_api_prefix');

        $this->data['button_save'] = $this->language->get('button_save');
        $this->data['button_cancel'] = $this->language->get('button_cancel');

        $this->data['tab_general'] = $this->language->get('tab_general');
        $this->data['tab_application'] = $this->language->get('tab_application');
        $this->data['tab_local'] = $this->language->get('tab_local');
        $this->data['tab_option'] = $this->language->get('tab_option');
        $this->data['tab_image'] = $this->language->get('tab_image');
        $this->data['tab_ftp'] = $this->language->get('tab_ftp');
        $this->data['tab_mail'] = $this->language->get('tab_mail');
        $this->data['tab_server'] = $this->language->get('tab_server');

        if (isset($this->error['warning'])) {
            $this->data['error_warning'] = $this->error['warning'];
        } else {
            $this->data['error_warning'] = '';
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

        if (isset($this->error['ftp_host'])) {
            $this->data['error_ftp_host'] = $this->error['ftp_host'];
        } else {
            $this->data['error_ftp_host'] = '';
        }

        if (isset($this->error['ftp_port'])) {
            $this->data['error_ftp_port'] = $this->error['ftp_port'];
        } else {
            $this->data['error_ftp_port'] = '';
        }

        if (isset($this->error['ftp_username'])) {
            $this->data['error_ftp_username'] = $this->error['ftp_username'];
        } else {
            $this->data['error_ftp_username'] = '';
        }

        if (isset($this->error['ftp_password'])) {
            $this->data['error_ftp_password'] = $this->error['ftp_password'];
        } else {
            $this->data['error_ftp_password'] = '';
        }

        if (isset($this->error['error_filename'])) {
            $this->data['error_error_filename'] = $this->error['error_filename'];
        } else {
            $this->data['error_error_filename'] = '';
        }

        if (isset($this->error['admin_limit'])) {
            $this->data['error_admin_limit'] = $this->error['admin_limit'];
        } else {
            $this->data['error_admin_limit'] = '';
        }

        if (isset($this->error['encryption'])) {
            $this->data['error_encryption'] = $this->error['encryption'];
        } else {
            $this->data['error_encryption'] = '';
        }

        $this->data['breadcrumbs'] = array();

        $this->data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => false
        );

        $this->data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('setting/setting', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' :: '
        );

        if (isset($this->session->data['success'])) {
            $this->data['success'] = $this->session->data['success'];

            unset($this->session->data['success']);
        } else {
            $this->data['success'] = '';
        }

        $this->data['action'] = $this->url->link('setting/setting', 'token=' . $this->session->data['token'], 'SSL');

        $this->data['cancel'] = $this->url->link('setting/application', 'token=' . $this->session->data['token'], 'SSL');

        $this->data['token'] = $this->session->data['token'];

        if (isset($this->request->post['config_name'])) {
            $this->data['config_name'] = $this->request->post['config_name'];
        } else {
            $this->data['config_name'] = $this->config->get('config_name');
        }

        if (isset($this->request->post['config_owner'])) {
            $this->data['config_owner'] = $this->request->post['config_owner'];
        } else {
            $this->data['config_owner'] = $this->config->get('config_owner');
        }

        if (isset($this->request->post['config_address'])) {
            $this->data['config_address'] = $this->request->post['config_address'];
        } else {
            $this->data['config_address'] = $this->config->get('config_address');
        }

        if (isset($this->request->post['config_email'])) {
            $this->data['config_email'] = $this->request->post['config_email'];
        } else {
            $this->data['config_email'] = $this->config->get('config_email');
        }

        if (isset($this->request->post['config_telephone'])) {
            $this->data['config_telephone'] = $this->request->post['config_telephone'];
        } else {
            $this->data['config_telephone'] = $this->config->get('config_telephone');
        }

        if (isset($this->request->post['config_fax'])) {
            $this->data['config_fax'] = $this->request->post['config_fax'];
        } else {
            $this->data['config_fax'] = $this->config->get('config_fax');
        }

        if (isset($this->request->post['config_title'])) {
            $this->data['config_title'] = $this->request->post['config_title'];
        } else {
            $this->data['config_title'] = $this->config->get('config_title');
        }

        if (isset($this->request->post['config_meta_description'])) {
            $this->data['config_meta_description'] = $this->request->post['config_meta_description'];
        } else {
            $this->data['config_meta_description'] = $this->config->get('config_meta_description');
        }
        
        if (isset($this->request->post['config_layout_id'])) {
            $this->data['config_layout_id'] = $this->request->post['config_layout_id'];
        } else {
            $this->data['config_layout_id'] = $this->config->get('config_layout_id');
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
        } else {
            $this->data['config_template'] = $this->config->get('config_template');
        }

        $this->data['templates'] = array();

        $directories = glob(DIR_PUBLIC . 'view/theme/*', GLOB_ONLYDIR);

        foreach ($directories as $directory) {
            $this->data['templates'][] = basename($directory);
        }

        if (isset($this->request->post['config_country_id'])) {
            $this->data['config_country_id'] = $this->request->post['config_country_id'];
        } else {
            $this->data['config_country_id'] = $this->config->get('config_country_id');
        }

        $this->load->model('localisation/country');

        $this->data['countries'] = $this->model_localisation_country->getCountries();

        if (isset($this->request->post['config_zone_id'])) {
            $this->data['config_zone_id'] = $this->request->post['config_zone_id'];
        } else {
            $this->data['config_zone_id'] = $this->config->get('config_zone_id');
        }

        $this->load->model('localisation/language');

        $this->data['languages'] = $this->model_localisation_language->getLanguages();

        if (isset($this->request->post['config_language'])) {
            $this->data['config_language'] = $this->request->post['config_language'];
        } else {
            $this->data['config_language'] = $this->config->get('config_language');
        }

        if (isset($this->request->post['config_admin_language'])) {
            $this->data['config_admin_language'] = $this->request->post['config_admin_language'];
        } else {
            $this->data['config_admin_language'] = $this->config->get('config_admin_language');
        }

        if (isset($this->request->post['config_admin_limit'])) {
            $this->data['config_admin_limit'] = $this->request->post['config_admin_limit'];
        } else {
            $this->data['config_admin_limit'] = $this->config->get('config_admin_limit');
        }

        if (isset($this->request->post['config_currency'])) {
            $this->data['config_currency'] = $this->request->post['config_currency'];
        } else {
            $this->data['config_currency'] = $this->config->get('config_currency');
        }

        if (isset($this->request->post['config_currency_auto'])) {
            $this->data['config_currency_auto'] = $this->request->post['config_currency_auto'];
        } else {
            $this->data['config_currency_auto'] = $this->config->get('config_currency_auto');
        }

        $this->load->model('localisation/currency');

        $this->data['currencies'] = $this->model_localisation_currency->getCurrencies();

        if (isset($this->request->post['config_admin_limit'])) {
            $this->data['config_admin_limit'] = $this->request->post['config_admin_limit'];
        } else {
            $this->data['config_admin_limit'] = $this->config->get('config_admin_limit');
        }

        if (isset($this->request->post['config_customer_online'])) {
            $this->data['config_customer_online'] = $this->request->post['config_customer_online'];
        } else {
            $this->data['config_customer_online'] = $this->config->get('config_customer_online');
        }

        if (isset($this->request->post['config_customer_group_id'])) {
            $this->data['config_customer_group_id'] = $this->request->post['config_customer_group_id'];
        } else {
            $this->data['config_customer_group_id'] = $this->config->get('config_customer_group_id');
        }

        $this->load->model('account/customer_group');

        $this->data['customer_groups'] = $this->model_account_customer_group->getCustomerGroups();

        if (isset($this->request->post['config_customer_group_display'])) {
            $this->data['config_customer_group_display'] = $this->request->post['config_customer_group_display'];
        } elseif ($this->config->get('config_customer_group_display')) {
            $this->data['config_customer_group_display'] = $this->config->get('config_customer_group_display');
        } else {
            $this->data['config_customer_group_display'] = array();
        }

        if (isset($this->request->post['config_customer_price'])) {
            $this->data['config_customer_price'] = $this->request->post['config_customer_price'];
        } else {
            $this->data['config_customer_price'] = $this->config->get('config_customer_price');
        }

        if (isset($this->request->post['config_account_id'])) {
            $this->data['config_account_id'] = $this->request->post['config_account_id'];
        } else {
            $this->data['config_account_id'] = $this->config->get('config_account_id');
        }
        
        $this->load->model('application/content');

        $this->data['contents'] = $this->model_application_content->getContents();
        
        if (isset($this->request->post['config_mail_template_id'])) {
            $this->data['config_mail_template_id'] = $this->request->post['config_mail_template_id'];
        } else {
            $this->data['config_mail_template_id'] = $this->config->get('config_mail_template_id');
        }
        
        $this->load->model('design/mail');

        $this->data['mail_templates'] = $this->model_design_mail->getMailTemplates();
        
        if (isset($this->request->post['config_invoice_prefix'])) {
            $this->data['config_invoice_prefix'] = $this->request->post['config_invoice_prefix'];
        } else {
            $this->data['config_invoice_prefix'] = $this->config->get('config_invoice_prefix');
        }
        
        if (isset($this->request->post['config_transaction_status_id'])) {
            $this->data['config_transaction_status_id'] = $this->request->post['config_transaction_status_id'];
        } else {
            $this->data['config_transaction_status_id'] = $this->config->get('config_transaction_status_id');
        }
        
        if (isset($this->request->post['config_complete_transaction_status_id'])) {
            $this->data['config_complete_transaction_status_id'] = $this->request->post['config_complete_transaction_status_id'];
        } else {
            $this->data['config_complete_transaction_status_id'] = $this->config->get('config_complete_transaction_status_id');
        }
        
        if (isset($this->request->post['config_transfer_status_id'])) {
            $this->data['config_transfer_status_id'] = $this->request->post['config_transfer_status_id'];
        } else {
            $this->data['config_transfer_status_id'] = $this->config->get('config_transfer_status_id');
        }
        
        if (isset($this->request->post['config_complete_transfer_status_id'])) {
            $this->data['config_complete_transfer_status_id'] = $this->request->post['config_complete_transfer_status_id'];
        } else {
            $this->data['config_complete_transfer_status_id'] = $this->config->get('config_complete_transfer_status_id');
        }
        
        $this->load->model('localisation/transaction_status');
        
        $this->data['transaction_statuses'] = $this->model_localisation_transaction_status->getTransactionStatuses();
        
        if (isset($this->request->post['config_affiliate_id'])) {
            $this->data['config_affiliate_id'] = $this->request->post['config_affiliate_id'];
        } else {
            $this->data['config_affiliate_id'] = $this->config->get('config_affiliate_id');
        }
        
        if (isset($this->request->post['config_commission'])) {
            $this->data['config_commission'] = $this->request->post['config_commission'];
        } else {
            $this->data['config_commission'] = $this->config->get('config_commission');
        }
        
        if (isset($this->request->post['config_creditcard_status_id'])) {
            $this->data['config_creditcard_status_id'] = $this->request->post['config_creditcard_status_id'];
        } else {
            $this->data['config_creditcard_status_id'] = $this->config->get('config_creditcard_status_id');
        }
        
        if (isset($this->request->post['config_complete_creditcard_status_id'])) {
            $this->data['config_complete_creditcard_status_id'] = $this->request->post['config_complete_creditcard_status_id'];
        } else {
            $this->data['config_complete_creditcard_status_id'] = $this->config->get('config_complete_creditcard_status_id');
        }
        
        if (isset($this->request->post['config_bankaccount_status_id'])) {
            $this->data['config_bankaccount_status_id'] = $this->request->post['config_bankaccount_status_id'];
        } else {
            $this->data['config_bankaccount_status_id'] = $this->config->get('config_bankaccount_status_id');
        }
        
        if (isset($this->request->post['config_complete_bankaccount_status_id'])) {
            $this->data['config_complete_bankaccount_status_id'] = $this->request->post['config_complete_bankaccount_status_id'];
        } else {
            $this->data['config_complete_bankaccount_status_id'] = $this->config->get('config_complete_bankaccount_status_id');
        }
        
        if (isset($this->request->post['config_test_secretkey_api_prefix'])) {
            $this->data['config_test_secretkey_api_prefix'] = $this->request->post['config_test_secretkey_api_prefix'];
        } else {
            $this->data['config_test_secretkey_api_prefix'] = $this->config->get('config_test_secretkey_api_prefix');
        }
        
        if (isset($this->request->post['config_test_publickey_api_prefix'])) {
            $this->data['config_test_publickey_api_prefix'] = $this->request->post['config_test_publickey_api_prefix'];
        } else {
            $this->data['config_test_publickey_api_prefix'] = $this->config->get('config_test_publickey_api_prefix');
        }
        
        
         if (isset($this->request->post['config_live_secretkey_api_prefix'])) {
            $this->data['config_live_secretkey_api_prefix'] = $this->request->post['config_live_secretkey_api_prefix'];
        } else {
            $this->data['config_live_secretkey_api_prefix'] = $this->config->get('config_live_secretkey_api_prefix');
        }
        
        if (isset($this->request->post['config_live_publickey_api_prefix'])) {
            $this->data['config_live_publickey_api_prefix'] = $this->request->post['config_live_publickey_api_prefix'];
        } else {
            $this->data['config_live_publickey_api_prefix'] = $this->config->get('config_live_publickey_api_prefix');
        }

        $this->load->model('tool/image');

        if (isset($this->request->post['config_logo'])) {
            $this->data['config_logo'] = $this->request->post['config_logo'];
        } else {
            $this->data['config_logo'] = $this->config->get('config_logo');
        }

        if ($this->config->get('config_logo') && file_exists(DIR_IMAGE . $this->config->get('config_logo')) && is_file(DIR_IMAGE . $this->config->get('config_logo'))) {
            $this->data['logo'] = $this->model_tool_image->resize($this->config->get('config_logo'), 100, 100);
        } else {
            $this->data['logo'] = $this->model_tool_image->resize('no_image.jpg', 100, 100);
        }

        if (isset($this->request->post['config_icon'])) {
            $this->data['config_icon'] = $this->request->post['config_icon'];
        } else {
            $this->data['config_icon'] = $this->config->get('config_icon');
        }

        if ($this->config->get('config_icon') && file_exists(DIR_IMAGE . $this->config->get('config_icon')) && is_file(DIR_IMAGE . $this->config->get('config_icon'))) {
            $this->data['icon'] = $this->model_tool_image->resize($this->config->get('config_icon'), 100, 100);
        } else {
            $this->data['icon'] = $this->model_tool_image->resize('no_image.jpg', 100, 100);
        }

        $this->data['no_image'] = $this->model_tool_image->resize('no_image.jpg', 100, 100);

        if (isset($this->request->post['config_ftp_host'])) {
            $this->data['config_ftp_host'] = $this->request->post['config_ftp_host'];
        } elseif ($this->config->get('config_ftp_host')) {
            $this->data['config_ftp_host'] = $this->config->get('config_ftp_host');
        } else {
            $this->data['config_ftp_host'] = str_replace('www.', '', $this->request->server['HTTP_HOST']);
        }

        if (isset($this->request->post['config_ftp_port'])) {
            $this->data['config_ftp_port'] = $this->request->post['config_ftp_port'];
        } elseif ($this->config->get('config_ftp_port')) {
            $this->data['config_ftp_port'] = $this->config->get('config_ftp_port');
        } else {
            $this->data['config_ftp_port'] = 21;
        }

        if (isset($this->request->post['config_ftp_username'])) {
            $this->data['config_ftp_username'] = $this->request->post['config_ftp_username'];
        } else {
            $this->data['config_ftp_username'] = $this->config->get('config_ftp_username');
        }

        if (isset($this->request->post['config_ftp_password'])) {
            $this->data['config_ftp_password'] = $this->request->post['config_ftp_password'];
        } else {
            $this->data['config_ftp_password'] = $this->config->get('config_ftp_password');
        }

        if (isset($this->request->post['config_ftp_root'])) {
            $this->data['config_ftp_root'] = $this->request->post['config_ftp_root'];
        } else {
            $this->data['config_ftp_root'] = $this->config->get('config_ftp_root');
        }

        if (isset($this->request->post['config_ftp_status'])) {
            $this->data['config_ftp_status'] = $this->request->post['config_ftp_status'];
        } else {
            $this->data['config_ftp_status'] = $this->config->get('config_ftp_status');
        }

        if (isset($this->request->post['config_mail_protocol'])) {
            $this->data['config_mail_protocol'] = $this->request->post['config_mail_protocol'];
        } else {
            $this->data['config_mail_protocol'] = $this->config->get('config_mail_protocol');
        }

        if (isset($this->request->post['config_mail_parameter'])) {
            $this->data['config_mail_parameter'] = $this->request->post['config_mail_parameter'];
        } else {
            $this->data['config_mail_parameter'] = $this->config->get('config_mail_parameter');
        }

        if (isset($this->request->post['config_smtp_host'])) {
            $this->data['config_smtp_host'] = $this->request->post['config_smtp_host'];
        } else {
            $this->data['config_smtp_host'] = $this->config->get('config_smtp_host');
        }

        if (isset($this->request->post['config_smtp_username'])) {
            $this->data['config_smtp_username'] = $this->request->post['config_smtp_username'];
        } else {
            $this->data['config_smtp_username'] = $this->config->get('config_smtp_username');
        }

        if (isset($this->request->post['config_smtp_password'])) {
            $this->data['config_smtp_password'] = $this->request->post['config_smtp_password'];
        } else {
            $this->data['config_smtp_password'] = $this->config->get('config_smtp_password');
        }

        if (isset($this->request->post['config_smtp_port'])) {
            $this->data['config_smtp_port'] = $this->request->post['config_smtp_port'];
        } elseif ($this->config->get('config_smtp_port')) {
            $this->data['config_smtp_port'] = $this->config->get('config_smtp_port');
        } else {
            $this->data['config_smtp_port'] = 25;
        }

        if (isset($this->request->post['config_smtp_timeout'])) {
            $this->data['config_smtp_timeout'] = $this->request->post['config_smtp_timeout'];
        } elseif ($this->config->get('config_smtp_timeout')) {
            $this->data['config_smtp_timeout'] = $this->config->get('config_smtp_timeout');
        } else {
            $this->data['config_smtp_timeout'] = 5;
        }

        if (isset($this->request->post['config_alert_mail'])) {
            $this->data['config_alert_mail'] = $this->request->post['config_alert_mail'];
        } else {
            $this->data['config_alert_mail'] = $this->config->get('config_alert_mail');
        }

        if (isset($this->request->post['config_account_mail'])) {
            $this->data['config_account_mail'] = $this->request->post['config_account_mail'];
        } else {
            $this->data['config_account_mail'] = $this->config->get('config_account_mail');
        }

        if (isset($this->request->post['config_alert_emails'])) {
            $this->data['config_alert_emails'] = $this->request->post['config_alert_emails'];
        } else {
            $this->data['config_alert_emails'] = $this->config->get('config_alert_emails');
        }

        if (isset($this->request->post['config_secure'])) {
            $this->data['config_secure'] = $this->request->post['config_secure'];
        } else {
            $this->data['config_secure'] = $this->config->get('config_secure');
        }

        if (isset($this->request->post['config_shared'])) {
            $this->data['config_shared'] = $this->request->post['config_shared'];
        } else {
            $this->data['config_shared'] = $this->config->get('config_shared');
        }

        if (isset($this->request->post['config_robots'])) {
            $this->data['config_robots'] = $this->request->post['config_robots'];
        } else {
            $this->data['config_robots'] = $this->config->get('config_robots');
        }

        if (isset($this->request->post['config_seo_url'])) {
            $this->data['config_seo_url'] = $this->request->post['config_seo_url'];
        } else {
            $this->data['config_seo_url'] = $this->config->get('config_seo_url');
        }

        if (isset($this->request->post['config_file_extension_allowed'])) {
            $this->data['config_file_extension_allowed'] = $this->request->post['config_file_extension_allowed'];
        } else {
            $this->data['config_file_extension_allowed'] = $this->config->get('config_file_extension_allowed');
        }

        if (isset($this->request->post['config_file_mime_allowed'])) {
            $this->data['config_file_mime_allowed'] = $this->request->post['config_file_mime_allowed'];
        } else {
            $this->data['config_file_mime_allowed'] = $this->config->get('config_file_mime_allowed');
        }

        if (isset($this->request->post['config_maintenance'])) {
            $this->data['config_maintenance'] = $this->request->post['config_maintenance'];
        } else {
            $this->data['config_maintenance'] = $this->config->get('config_maintenance');
        }

        if (isset($this->request->post['config_password'])) {
            $this->data['config_password'] = $this->request->post['config_password'];
        } else {
            $this->data['config_password'] = $this->config->get('config_password');
        }

        if (isset($this->request->post['config_encryption'])) {
            $this->data['config_encryption'] = $this->request->post['config_encryption'];
        } else {
            $this->data['config_encryption'] = $this->config->get('config_encryption');
        }

        if (isset($this->request->post['config_compression'])) {
            $this->data['config_compression'] = $this->request->post['config_compression'];
        } else {
            $this->data['config_compression'] = $this->config->get('config_compression');
        }

        if (isset($this->request->post['config_error_display'])) {
            $this->data['config_error_display'] = $this->request->post['config_error_display'];
        } else {
            $this->data['config_error_display'] = $this->config->get('config_error_display');
        }

        if (isset($this->request->post['config_error_log'])) {
            $this->data['config_error_log'] = $this->request->post['config_error_log'];
        } else {
            $this->data['config_error_log'] = $this->config->get('config_error_log');
        }

        if (isset($this->request->post['config_error_filename'])) {
            $this->data['config_error_filename'] = $this->request->post['config_error_filename'];
        } else {
            $this->data['config_error_filename'] = $this->config->get('config_error_filename');
        }

        if (isset($this->request->post['config_google_analytics'])) {
            $this->data['config_google_analytics'] = $this->request->post['config_google_analytics'];
        } else {
            $this->data['config_google_analytics'] = $this->config->get('config_google_analytics');
        }

        $this->template = 'setting/setting.tpl';
        $this->children = array(
            'common/header',
            'common/footer'
        );

        $this->response->setOutput($this->render());
    }

    protected function validate() {
        if (!$this->user->hasPermission('modify', 'setting/setting')) {
            $this->error['warning'] = $this->language->get('error_permission');
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

        if ($this->request->post['config_ftp_status']) {
            if (!$this->request->post['config_ftp_host']) {
                $this->error['ftp_host'] = $this->language->get('error_ftp_host');
            }

            if (!$this->request->post['config_ftp_port']) {
                $this->error['ftp_port'] = $this->language->get('error_ftp_port');
            }

            if (!$this->request->post['config_ftp_username']) {
                $this->error['ftp_username'] = $this->language->get('error_ftp_username');
            }

            if (!$this->request->post['config_ftp_password']) {
                $this->error['ftp_password'] = $this->language->get('error_ftp_password');
            }
        }

        if (!$this->request->post['config_error_filename']) {
            $this->error['error_filename'] = $this->language->get('error_error_filename');
        }

        if (!$this->request->post['config_admin_limit']) {
            $this->error['admin_limit'] = $this->language->get('error_limit');
        }

        if ((utf8_strlen($this->request->post['config_encryption']) < 3) || (utf8_strlen($this->request->post['config_encryption']) > 32)) {
            $this->error['encryption'] = $this->language->get('error_encryption');
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

}
