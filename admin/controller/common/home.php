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
 * Description of home
 *
 * @author ahmet
 */
class ControllerCommonHome extends Controller {

    public function index() {

        $this->language->load('common/home');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->data['heading_title'] = $this->language->get('heading_title');
        $this->data['heading_sub_title'] = sprintf($this->language->get('heading_sub_title'), $this->config->get('config_name'));
        
        $this->data['column_customer'] = $this->language->get('column_customer');
        $this->data['column_date_added'] = $this->language->get('column_date_added');
        $this->data['column_amount'] = $this->language->get('column_amount');
        $this->data['column_status'] = $this->language->get('column_status');
        $this->data['column_action'] = $this->language->get('column_action');
        
        $this->data['text_total_customer'] = $this->language->get('text_total_customer');
        $this->data['text_total_customer_approval'] = $this->language->get('text_total_customer_approval');
        $this->data['text_total_transfer'] = $this->language->get('text_total_transfer');
        $this->data['text_total_transfer_request'] = $this->language->get('text_total_transfer_request');
        $this->data['text_transfer_request'] = $this->language->get('text_transfer_request');
        $this->data['text_general_balance'] = $this->language->get('text_general_balance');
        $this->data['text_available_balance'] = $this->language->get('text_available_balance');
        $this->data['text_latest_transfer'] = $this->language->get('text_latest_transfer');

        // Check install directory exists
        if (is_dir(dirname(DIR_APPLICATION) . '/install')) {
            $this->data['error_install'] = $this->language->get('error_install');
        } else {
            $this->data['error_install'] = '';
        }

        // Check image directory is writable
        $file = DIR_IMAGE . 'test';

        $handle = fopen($file, 'a+');

        fwrite($handle, '');

        fclose($handle);

        if (!file_exists($file)) {
            $this->data['error_image'] = sprintf($this->language->get('error_image'), DIR_IMAGE);
        } else {
            $this->data['error_image'] = '';

            unlink($file);
        }

        // Check image cache directory is writable
        $file = DIR_IMAGE . 'cache/test';

        $handle = fopen($file, 'a+');

        fwrite($handle, '');

        fclose($handle);

        if (!file_exists($file)) {
            $this->data['error_image_cache'] = sprintf($this->language->get('error_image_cache'), DIR_IMAGE . 'cache/');
        } else {
            $this->data['error_image_cache'] = '';

            unlink($file);
        }

        // Check cache directory is writable
        $file = DIR_CACHE . 'test';

        $handle = fopen($file, 'a+');

        fwrite($handle, '');

        fclose($handle);

        if (!file_exists($file)) {
            $this->data['error_cache'] = sprintf($this->language->get('error_image_cache'), DIR_CACHE);
        } else {
            $this->data['error_cache'] = '';

            unlink($file);
        }

        // Check download directory is writable
        $file = DIR_DOWNLOAD . 'test';

        $handle = fopen($file, 'a+');

        fwrite($handle, '');

        fclose($handle);

        if (!file_exists($file)) {
            $this->data['error_download'] = sprintf($this->language->get('error_download'), DIR_DOWNLOAD);
        } else {
            $this->data['error_download'] = '';

            unlink($file);
        }

        // Check logs directory is writable
        $file = DIR_LOGS . 'test';

        $handle = fopen($file, 'a+');

        fwrite($handle, '');

        fclose($handle);

        if (!file_exists($file)) {
            $this->data['error_logs'] = sprintf($this->language->get('error_logs'), DIR_LOGS);
        } else {
            $this->data['error_logs'] = '';

            unlink($file);
        }

        $this->data['breadcrumbs'] = array();

        $this->data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => false
        );

        $this->data['token'] = $this->session->data['token'];
        
        $this->load->model('account/customer');
        
        $this->data['total_customer'] = $this->model_account_customer->getTotalCustomers();
        $this->data['total_customer_approval'] = $this->model_account_customer->getTotalCustomersAwaitingApproval();
        
        $this->load->model('account/transaction');
        
        $total_withdraw = $this->model_account_transaction->getTotalWithdrawAmount();
        $total_withdraw_approval = $this->model_account_transaction->getTotalWithdrawAmountApproval();
        
        $this->data['total_transfer_request'] = $this->model_account_transaction->getTotalTransferRequest();
        
        $general_balance = $this->model_account_transaction->getTotalAmount();
        
        $available_balance = $general_balance - (str_replace('-',"",$total_withdraw));
        
        $available = $total_withdraw - $available_balance;
        
        $this->data['total_withdraw'] = $this->currency->format((isset($total_withdraw) ? str_replace('-',"",$total_withdraw) : 0), $this->config->get('config_currency'));
        $this->data['total_withdraw_approval'] = $this->currency->format((isset($total_withdraw_approval) ? str_replace('-',"",$total_withdraw_approval) : 0), $this->config->get('config_currency'));
        
        $this->data['general_balance'] = $this->currency->format((isset($general_balance) ? str_replace('-',"",$general_balance) : 0), $this->config->get('config_currency'));
        $this->data['available_balance'] = $this->currency->format((isset($available) ? $available : 0), $this->config->get('config_currency'));
        
        $this->data['customer_approved'] = $this->url->link('account/customer','token='.$this->session->data['token'].'&filter_approved=1','SSL');
        $this->data['customer_waiting'] = $this->url->link('account/customer','token='.$this->session->data['token'].'&filter_approved=0','SSL');

        
        $data = array(
                'sort'  => 'w.date_added',
                'order' => 'DESC',
                'start' => 0,
                'limit' => 10
        );
        
        $this->data['latest_transfers'] = array();
        
        $transfers = $this->model_account_transaction->getTransfers($data);
        
        foreach ($transfers as $transfer){
            
            $action = array();

            $action[] = array(
                    'text' => $this->language->get('text_view'),
                    'href' => $this->url->link('account/transfer/info', 'token=' . $this->session->data['token'] . '&withdraw_id=' . $transfer['withdraw_id'], 'SSL')
            );
            
            $this->data['latest_transfers'][] = array(
                'withdraw_id'=>$transfer['withdraw_id'],
                'customer'=>$transfer['customer'],
                'date_added'=>date($this->language->get('date_format_short'), strtotime($transfer['date_added'])),
                'amount'=>$this->currency->format($transfer['amount'], $transfer['currency_code'], $transfer['currency_value']),
                'status'=>$transfer['status'],
                'action'=>$action
            );
        }
        
        if ($this->config->get('config_currency_auto')) {
            $this->load->model('localisation/currency');

            $this->model_localisation_currency->updateCurrencies();
        }
        
        // Remove This Later
        $mail = new Mail();
            $mail->protocol = $this->config->get('config_mail_protocol');
            $mail->parameter = $this->config->get('config_mail_parameter');
            $mail->hostname = $this->config->get('config_smtp_host');
            $mail->username = $this->config->get('config_smtp_username');
            $mail->password = $this->config->get('config_smtp_password');
            $mail->port = $this->config->get('config_smtp_port');
            $mail->timeout = $this->config->get('config_smtp_timeout');
            $mail->setTo('ahmet.gudenoglu@semitepayment.com');
            $mail->setFrom($this->config->get('config_email'));
            $mail->setSender($this->config->get('config_name'));
            $mail->setSubject(html_entity_decode(sprintf('Your account approved by %s', $this->config->get('config_name')), ENT_QUOTES, 'UTF-8'));
            $mail->setText(html_entity_decode('Good Luck', ENT_QUOTES, 'UTF-8'));
            $mail->send();

        $this->template = 'common/home.tpl';
        $this->children = array(
            'common/header',
            'common/footer'
        );

        $this->response->setOutput($this->render());
    }

    public function login() {
        $route = '';

        if (isset($this->request->get['route'])) {
            $part = explode('/', $this->request->get['route']);

            if (isset($part[0])) {
                $route .= $part[0];
            }

            if (isset($part[1])) {
                $route .= '/' . $part[1];
            }
        }

        $ignore = array(
            'common/login',
            'common/forgotten',
            'common/reset'
        );

        if (!$this->user->isLogged() && !in_array($route, $ignore)) {
            return $this->forward('common/login');
        }

        if (isset($this->request->get['route'])) {
            $ignore = array(
                'common/login',
                'common/logout',
                'common/forgotten',
                'common/reset',
                'error/not_found',
                'error/permission'
            );

            $config_ignore = array();

            if ($this->config->get('config_token_ignore')) {
                $config_ignore = unserialize($this->config->get('config_token_ignore'));
            }

            $ignore = array_merge($ignore, $config_ignore);

            if (!in_array($route, $ignore) && (!isset($this->request->get['token']) || !isset($this->session->data['token']) || ($this->request->get['token'] != $this->session->data['token']))) {
                return $this->forward('common/login');
            }
        } else {
            if (!isset($this->request->get['token']) || !isset($this->session->data['token']) || ($this->request->get['token'] != $this->session->data['token'])) {
                return $this->forward('common/login');
            }
        }
    }

    public function permission() {
        if (isset($this->request->get['route'])) {
            $route = '';

            $part = explode('/', $this->request->get['route']);

            if (isset($part[0])) {
                $route .= $part[0];
            }

            if (isset($part[1])) {
                $route .= '/' . $part[1];
            }

            $ignore = array(
                'common/home',
                'common/login',
                'common/logout',
                'common/forgotten',
                'common/reset',
                'error/not_found',
                'error/permission'
            );

            if (!in_array($route, $ignore) && !$this->user->hasPermission('access', $route)) {
                return $this->forward('error/permission');
            }
        }
    }

}
