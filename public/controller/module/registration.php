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

/*
 * Semite LLC registration Class
 * Date : Jun 23, 2014
 */

class ControllerModuleRegistration extends Controller {

    private $error = array();

    public function index() {

        $this->language->load('module/registration');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {

            $this->load->helper('creditcard');

            $data = array(
                'email' => $this->request->post['email'],
                'password' => $this->encryption->encrypt($this->request->post['password']),
                'firstname'=>$this->request->post['firstname'],
                'lastname'=>$this->request->post['lastname'],
                'cc' => formatCreditCard(generateVirtualCard()),
                'ccv' => formatCreditCard(generateVirtualCard(2, '')),
                'expire_date' => date("Y-m-d", strtotime("+2 year")),
                'account_number' => formatCreditCard(generateVirtualCard(5, '392')),
                'iban' => 'SP9200604040' . formatCreditCard(generateVirtualCard(5, '392')),
                'bic' => 'SPCYPP',
                'customer_group_id' => $this->config->get('config_customer_group_id')
            );
            $this->model_account_customer->addCustomer($data);

            $this->redirect($this->url->link('module/login', 'token=' . $this->session->data['token'], 'SSL'));
        } else {

            if (isset($this->error['firstname'])) {
                $this->data['error_firstname'] = $this->error['firstname'];
            } else {
                $this->data['error_firstname'] = '';
            }

            if (isset($this->error['lastname'])) {
                $this->data['error_lastname'] = $this->error['lastname'];
            } else {
                $this->data['error_lastname'] = '';
            }

            if (isset($this->error['email'])) {
                $this->data['error_email'] = $this->error['email'];
            } else {
                $this->data['error_email'] = '';
            }

            if (isset($this->error['password'])) {
                $this->data['error_password'] = $this->error['password'];
            } else {
                $this->data['error_password'] = '';
            }

            if (isset($this->error['email_exist'])) {
                $this->data['error_email_exist'] = $this->error['email_exist'];
            } else {
                $this->data['error_email_exist'] = '';
            }
        }

        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/registration.tpl')) {
            $this->template = $this->config->get('config_template') . '/template/module/registration.tpl';
        } else {
            $this->template = 'default/template/module/registration.tpl';
        }

        $this->render();
    }

    protected function validateForm() {

        $this->load->model('account/customer');

        if ((utf8_strlen($this->request->post['firstname']) < 1) || (utf8_strlen($this->request->post['firstname']) > 32)) {
            $this->error['firstname'] = $this->language->get('error_firstname');
        }

        if ((utf8_strlen($this->request->post['lastname']) < 1) || (utf8_strlen($this->request->post['lastname']) > 32)) {
            $this->error['lastname'] = $this->language->get('error_lastname');
        }

        $total_customer = $this->model_account_customer->getTotalCustomersByEmail($this->request->post['email']);

        if ($total_customer) {
            $this->error['email_exist'] = $this->language->get('error_email_exist');
        }

        if ((utf8_strlen($this->request->post['email']) < 3) || (utf8_strlen($this->request->post['email']) > 96) || !preg_match('/^[^\@]+@.*\.[a-z]{2,6}$/i', $this->request->post['email'])) {
            $this->error['email'] = $this->language->get('error_email');
        }

        if ((utf8_strlen($this->request->post['password']) < 6) || (utf8_strlen($this->request->post['password']) > 16)) {
            $this->error['password'] = $this->language->get('error_password');
        }

        if (!$this->error) {
            return true;
        } else {
            return false;
        }
    }

}
