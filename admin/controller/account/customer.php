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
 * Semite LLC customer Class
 * Date : Jul 1, 2014
 */

class ControllerAccountCustomer extends Controller {

    private $error = array();

    public function index() {
        $this->language->load('account/customer');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('account/customer');

        $this->getList();
    }

    public function insert() {
        $this->language->load('account/customer');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('account/customer');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {

            $this->load->helper('creditcard');

            $this->request->post['cc'] = formatCreditCard(generateVirtualCard());
            $this->request->post['ccv'] = formatCreditCard(generateVirtualCard(2, ''));
            $this->request->post['expire_date'] = date("Y-m-d", strtotime("+2 year"));
            $this->request->post['account_number'] = formatCreditCard(generateVirtualCard(5, '392'));
            $this->request->post['iban'] = 'SP9200604040' . $this->request->post['account_number'];
            $this->request->post['bic'] = 'SPCYPP';

            $this->model_account_customer->addCustomer($this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            $url = '';

            if (isset($this->request->get['filter_name'])) {
                $url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
            }

            if (isset($this->request->get['filter_email'])) {
                $url .= '&filter_email=' . urlencode(html_entity_decode($this->request->get['filter_email'], ENT_QUOTES, 'UTF-8'));
            }

            if (isset($this->request->get['filter_customer_group_id'])) {
                $url .= '&filter_customer_group_id=' . $this->request->get['filter_customer_group_id'];
            }

            if (isset($this->request->get['filter_status'])) {
                $url .= '&filter_status=' . $this->request->get['filter_status'];
            }

            if (isset($this->request->get['filter_approved'])) {
                $url .= '&filter_approved=' . $this->request->get['filter_approved'];
            }


            if (isset($this->request->get['filter_date_added'])) {
                $url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
            }

            if (isset($this->request->get['sort'])) {
                $url .= '&sort=' . $this->request->get['sort'];
            }

            if (isset($this->request->get['order'])) {
                $url .= '&order=' . $this->request->get['order'];
            }

            if (isset($this->request->get['page'])) {
                $url .= '&page=' . $this->request->get['page'];
            }

            $this->redirect($this->url->link('account/customer', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }

        $this->getForm();
    }

    public function update() {
        $this->language->load('account/customer');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('account/customer');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
            $this->model_account_customer->editCustomer($this->request->get['customer_id'], $this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            $url = '';

            if (isset($this->request->get['filter_name'])) {
                $url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
            }

            if (isset($this->request->get['filter_email'])) {
                $url .= '&filter_email=' . urlencode(html_entity_decode($this->request->get['filter_email'], ENT_QUOTES, 'UTF-8'));
            }

            if (isset($this->request->get['filter_customer_group_id'])) {
                $url .= '&filter_customer_group_id=' . $this->request->get['filter_customer_group_id'];
            }

            if (isset($this->request->get['filter_status'])) {
                $url .= '&filter_status=' . $this->request->get['filter_status'];
            }

            if (isset($this->request->get['filter_approved'])) {
                $url .= '&filter_approved=' . $this->request->get['filter_approved'];
            }


            if (isset($this->request->get['filter_date_added'])) {
                $url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
            }

            if (isset($this->request->get['sort'])) {
                $url .= '&sort=' . $this->request->get['sort'];
            }

            if (isset($this->request->get['order'])) {
                $url .= '&order=' . $this->request->get['order'];
            }

            if (isset($this->request->get['page'])) {
                $url .= '&page=' . $this->request->get['page'];
            }

            $this->redirect($this->url->link('account/customer', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }

        $this->getForm();
    }

    public function delete() {
        $this->language->load('account/customer');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('account/customer');

        if (isset($this->request->post['selected']) && $this->validateDelete()) {
            foreach ($this->request->post['selected'] as $customer_id) {
                $this->model_account_customer->deleteCustomer($customer_id);
            }

            $this->session->data['success'] = $this->language->get('text_success');

            $url = '';

            if (isset($this->request->get['filter_name'])) {
                $url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
            }

            if (isset($this->request->get['filter_email'])) {
                $url .= '&filter_email=' . urlencode(html_entity_decode($this->request->get['filter_email'], ENT_QUOTES, 'UTF-8'));
            }

            if (isset($this->request->get['filter_customer_group_id'])) {
                $url .= '&filter_customer_group_id=' . $this->request->get['filter_customer_group_id'];
            }

            if (isset($this->request->get['filter_status'])) {
                $url .= '&filter_status=' . $this->request->get['filter_status'];
            }

            if (isset($this->request->get['filter_approved'])) {
                $url .= '&filter_approved=' . $this->request->get['filter_approved'];
            }

            if (isset($this->request->get['filter_date_added'])) {
                $url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
            }

            if (isset($this->request->get['sort'])) {
                $url .= '&sort=' . $this->request->get['sort'];
            }

            if (isset($this->request->get['order'])) {
                $url .= '&order=' . $this->request->get['order'];
            }

            if (isset($this->request->get['page'])) {
                $url .= '&page=' . $this->request->get['page'];
            }

            $this->redirect($this->url->link('account/customer', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }

        $this->getList();
    }

    public function approve() {
        $this->language->load('account/customer');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('account/customer');

        if (!$this->user->hasPermission('modify', 'account/customer')) {
            $this->error['warning'] = $this->language->get('error_permission');
        } elseif (isset($this->request->post['selected'])) {
            $approved = 0;

            foreach ($this->request->post['selected'] as $customer_id) {
                $customer_info = $this->model_account_customer->getCustomer($customer_id);

                if ($customer_info && !$customer_info['approved']) {
                    $this->model_account_customer->approve($customer_id);

                    $approved++;
                }
            }

            $this->session->data['success'] = sprintf($this->language->get('text_approved'), $approved);

            $url = '';

            if (isset($this->request->get['filter_name'])) {
                $url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
            }

            if (isset($this->request->get['filter_email'])) {
                $url .= '&filter_email=' . urlencode(html_entity_decode($this->request->get['filter_email'], ENT_QUOTES, 'UTF-8'));
            }

            if (isset($this->request->get['filter_customer_group_id'])) {
                $url .= '&filter_customer_group_id=' . $this->request->get['filter_customer_group_id'];
            }

            if (isset($this->request->get['filter_status'])) {
                $url .= '&filter_status=' . $this->request->get['filter_status'];
            }

            if (isset($this->request->get['filter_approved'])) {
                $url .= '&filter_approved=' . $this->request->get['filter_approved'];
            }


            if (isset($this->request->get['filter_date_added'])) {
                $url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
            }

            if (isset($this->request->get['sort'])) {
                $url .= '&sort=' . $this->request->get['sort'];
            }

            if (isset($this->request->get['order'])) {
                $url .= '&order=' . $this->request->get['order'];
            }

            if (isset($this->request->get['page'])) {
                $url .= '&page=' . $this->request->get['page'];
            }

            $this->redirect($this->url->link('account/customer', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }

        $this->getList();
    }

    protected function getList() {
        if (isset($this->request->get['filter_name'])) {
            $filter_name = $this->request->get['filter_name'];
        } else {
            $filter_name = null;
        }

        if (isset($this->request->get['filter_email'])) {
            $filter_email = $this->request->get['filter_email'];
        } else {
            $filter_email = null;
        }

        if (isset($this->request->get['filter_customer_group_id'])) {
            $filter_customer_group_id = $this->request->get['filter_customer_group_id'];
        } else {
            $filter_customer_group_id = null;
        }

        if (isset($this->request->get['filter_status'])) {
            $filter_status = $this->request->get['filter_status'];
        } else {
            $filter_status = null;
        }

        if (isset($this->request->get['filter_approved'])) {
            $filter_approved = $this->request->get['filter_approved'];
        } else {
            $filter_approved = null;
        }

        if (isset($this->request->get['filter_ip'])) {
            $filter_ip = $this->request->get['filter_ip'];
        } else {
            $filter_ip = null;
        }

        if (isset($this->request->get['filter_date_added'])) {
            $filter_date_added = $this->request->get['filter_date_added'];
        } else {
            $filter_date_added = null;
        }

        if (isset($this->request->get['sort'])) {
            $sort = $this->request->get['sort'];
        } else {
            $sort = 'name';
        }

        if (isset($this->request->get['order'])) {
            $order = $this->request->get['order'];
        } else {
            $order = 'ASC';
        }

        if (isset($this->request->get['page'])) {
            $page = $this->request->get['page'];
        } else {
            $page = 1;
        }

        $url = '';

        if (isset($this->request->get['filter_name'])) {
            $url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_email'])) {
            $url .= '&filter_email=' . urlencode(html_entity_decode($this->request->get['filter_email'], ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_customer_group_id'])) {
            $url .= '&filter_customer_group_id=' . $this->request->get['filter_customer_group_id'];
        }

        if (isset($this->request->get['filter_status'])) {
            $url .= '&filter_status=' . $this->request->get['filter_status'];
        }

        if (isset($this->request->get['filter_approved'])) {
            $url .= '&filter_approved=' . $this->request->get['filter_approved'];
        }

        if (isset($this->request->get['filter_date_added'])) {
            $url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
        }

        if (isset($this->request->get['sort'])) {
            $url .= '&sort=' . $this->request->get['sort'];
        }

        if (isset($this->request->get['order'])) {
            $url .= '&order=' . $this->request->get['order'];
        }

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
            'href' => $this->url->link('account/customer', 'token=' . $this->session->data['token'] . $url, 'SSL'),
            'separator' => ' :: '
        );

        $this->data['approve'] = $this->url->link('account/customer/approve', 'token=' . $this->session->data['token'] . $url, 'SSL');
        $this->data['insert'] = $this->url->link('account/customer/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
        $this->data['delete'] = $this->url->link('account/customer/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');

        $this->data['customers'] = array();

        $data = array(
            'filter_name' => $filter_name,
            'filter_email' => $filter_email,
            'filter_customer_group_id' => $filter_customer_group_id,
            'filter_status' => $filter_status,
            'filter_approved' => $filter_approved,
            'filter_date_added' => $filter_date_added,
            'sort' => $sort,
            'order' => $order,
            'start' => ($page - 1) * $this->config->get('config_admin_limit'),
            'limit' => $this->config->get('config_admin_limit')
        );

        $customer_total = $this->model_account_customer->getTotalCustomers($data);

        $results = $this->model_account_customer->getCustomers($data);

        foreach ($results as $result) {
            $action = array();

            $action[] = array(
                'text' => $this->language->get('text_edit'),
                'href' => $this->url->link('account/customer/update', 'token=' . $this->session->data['token'] . '&customer_id=' . $result['customer_id'] . $url, 'SSL')
            );

            $this->data['customers'][] = array(
                'customer_id' => $result['customer_id'],
                'name' => $result['name'],
                'email' => $result['email'],
                'customer_group' => $result['customer_group'],
                'status' => ($result['status'] ? $this->language->get('text_enabled') : $this->language->get('text_disabled')),
                'approved' => ($result['approved'] ? $this->language->get('text_yes') : $this->language->get('text_no')),
                'date_added' => date($this->language->get('date_format_short'), strtotime($result['date_added'])),
                'selected' => isset($this->request->post['selected']) && in_array($result['customer_id'], $this->request->post['selected']),
                'action' => $action
            );
        }

        $this->data['heading_title'] = $this->language->get('heading_title');

        $this->data['text_enabled'] = $this->language->get('text_enabled');
        $this->data['text_disabled'] = $this->language->get('text_disabled');
        $this->data['text_yes'] = $this->language->get('text_yes');
        $this->data['text_no'] = $this->language->get('text_no');
        $this->data['text_select'] = $this->language->get('text_select');
        $this->data['text_default'] = $this->language->get('text_default');
        $this->data['text_no_results'] = $this->language->get('text_no_results');

        $this->data['column_name'] = $this->language->get('column_name');
        $this->data['column_email'] = $this->language->get('column_email');
        $this->data['column_customer_group'] = $this->language->get('column_customer_group');
        $this->data['column_status'] = $this->language->get('column_status');
        $this->data['column_approved'] = $this->language->get('column_approved');
        $this->data['column_date_added'] = $this->language->get('column_date_added');
        $this->data['column_action'] = $this->language->get('column_action');

        $this->data['button_approve'] = $this->language->get('button_approve');
        $this->data['button_insert'] = $this->language->get('button_insert');
        $this->data['button_delete'] = $this->language->get('button_delete');
        $this->data['button_filter'] = $this->language->get('button_filter');

        $this->data['token'] = $this->session->data['token'];

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

        $url = '';

        if (isset($this->request->get['filter_name'])) {
            $url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_email'])) {
            $url .= '&filter_email=' . urlencode(html_entity_decode($this->request->get['filter_email'], ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_customer_group_id'])) {
            $url .= '&filter_customer_group_id=' . $this->request->get['filter_customer_group_id'];
        }

        if (isset($this->request->get['filter_status'])) {
            $url .= '&filter_status=' . $this->request->get['filter_status'];
        }

        if (isset($this->request->get['filter_approved'])) {
            $url .= '&filter_approved=' . $this->request->get['filter_approved'];
        }


        if (isset($this->request->get['filter_date_added'])) {
            $url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
        }

        if ($order == 'ASC') {
            $url .= '&order=DESC';
        } else {
            $url .= '&order=ASC';
        }

        if (isset($this->request->get['page'])) {
            $url .= '&page=' . $this->request->get['page'];
        }

        $this->data['sort_name'] = $this->url->link('account/customer', 'token=' . $this->session->data['token'] . '&sort=name' . $url, 'SSL');
        $this->data['sort_email'] = $this->url->link('account/customer', 'token=' . $this->session->data['token'] . '&sort=c.email' . $url, 'SSL');
        $this->data['sort_customer_group'] = $this->url->link('account/customer', 'token=' . $this->session->data['token'] . '&sort=customer_group' . $url, 'SSL');
        $this->data['sort_status'] = $this->url->link('account/customer', 'token=' . $this->session->data['token'] . '&sort=c.status' . $url, 'SSL');
        $this->data['sort_approved'] = $this->url->link('account/customer', 'token=' . $this->session->data['token'] . '&sort=c.approved' . $url, 'SSL');
        $this->data['sort_date_added'] = $this->url->link('account/customer', 'token=' . $this->session->data['token'] . '&sort=c.date_added' . $url, 'SSL');

        $url = '';

        if (isset($this->request->get['filter_name'])) {
            $url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_email'])) {
            $url .= '&filter_email=' . urlencode(html_entity_decode($this->request->get['filter_email'], ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_customer_group_id'])) {
            $url .= '&filter_customer_group_id=' . $this->request->get['filter_customer_group_id'];
        }

        if (isset($this->request->get['filter_status'])) {
            $url .= '&filter_status=' . $this->request->get['filter_status'];
        }

        if (isset($this->request->get['filter_approved'])) {
            $url .= '&filter_approved=' . $this->request->get['filter_approved'];
        }


        if (isset($this->request->get['filter_date_added'])) {
            $url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
        }

        if (isset($this->request->get['sort'])) {
            $url .= '&sort=' . $this->request->get['sort'];
        }

        if (isset($this->request->get['order'])) {
            $url .= '&order=' . $this->request->get['order'];
        }

        $pagination = new Pagination();
        $pagination->total = $customer_total;
        $pagination->page = $page;
        $pagination->limit = $this->config->get('config_admin_limit');
        $pagination->text = $this->language->get('text_pagination');
        $pagination->url = $this->url->link('account/customer', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

        $this->data['pagination'] = $pagination->render();

        $this->data['filter_name'] = $filter_name;
        $this->data['filter_email'] = $filter_email;
        $this->data['filter_customer_group_id'] = $filter_customer_group_id;
        $this->data['filter_status'] = $filter_status;
        $this->data['filter_approved'] = $filter_approved;
        $this->data['filter_date_added'] = $filter_date_added;

        $this->load->model('account/customer_group');

        $this->data['customer_groups'] = $this->model_account_customer_group->getCustomerGroups();

        $this->data['sort'] = $sort;
        $this->data['order'] = $order;

        $this->template = 'account/customer_list.tpl';
        $this->children = array(
            'common/header',
            'common/footer'
        );

        $this->response->setOutput($this->render());
    }

    protected function getForm() {

        $this->data['heading_title'] = $this->language->get('heading_title');
        
        $this->data['title_bank'] = $this->language->get('title_bank');

        $this->data['text_information_bank'] = $this->language->get('text_information_bank');
        $this->data['text_enabled'] = $this->language->get('text_enabled');
        $this->data['text_disabled'] = $this->language->get('text_disabled');
        $this->data['text_select'] = $this->language->get('text_select');
        $this->data['text_none'] = $this->language->get('text_none');
        $this->data['text_wait'] = $this->language->get('text_wait');
        $this->data['text_no_results'] = $this->language->get('text_no_results');
        $this->data['text_add_ban_ip'] = $this->language->get('text_add_ban_ip');
        $this->data['text_remove_ban_ip'] = $this->language->get('text_remove_ban_ip');
        $this->data['text_bank_information'] = $this->language->get('text_bank_information');
        $this->data['text_card_information'] = $this->language->get('text_card_information');
        $this->data['text_account'] = $this->language->get('text_account');
        $this->data['text_iban'] = $this->language->get('text_iban');
        $this->data['text_swift'] = $this->language->get('text_swift');
        $this->data['text_holder'] = $this->language->get('text_holder');
        $this->data['text_card'] = $this->language->get('text_card');
        $this->data['text_cvv'] = $this->language->get('text_cvv');
        $this->data['text_expire'] = $this->language->get('text_expire');
        $this->data['text_no_bank'] = $this->language->get('text_no_bank');
        $this->data['text_no_card'] = $this->language->get('text_no_card');
        $this->data['text_no_transaction'] = $this->language->get('text_no_transaction');

        $this->data['column_ip'] = $this->language->get('column_ip');
        $this->data['column_total'] = $this->language->get('column_total');
        $this->data['column_date_added'] = $this->language->get('column_date_added');
        $this->data['column_action'] = $this->language->get('column_action');

        $this->data['entry_firstname'] = $this->language->get('entry_firstname');
        $this->data['entry_lastname'] = $this->language->get('entry_lastname');
        $this->data['entry_personal_id'] = $this->language->get('entry_personal_id');
        $this->data['entry_email'] = $this->language->get('entry_email');
        $this->data['entry_telephone'] = $this->language->get('entry_telephone');
        $this->data['entry_fax'] = $this->language->get('entry_fax');
        $this->data['entry_password'] = $this->language->get('entry_password');
        $this->data['entry_confirm'] = $this->language->get('entry_confirm');
        $this->data['entry_newsletter'] = $this->language->get('entry_newsletter');
        $this->data['entry_customer_group'] = $this->language->get('entry_customer_group');
        $this->data['entry_status'] = $this->language->get('entry_status');
        $this->data['entry_company'] = $this->language->get('entry_company');
        $this->data['entry_company_id'] = $this->language->get('entry_company_id');
        $this->data['entry_tax_id'] = $this->language->get('entry_tax_id');
        $this->data['entry_address_1'] = $this->language->get('entry_address_1');
        $this->data['entry_address_2'] = $this->language->get('entry_address_2');
        $this->data['entry_city'] = $this->language->get('entry_city');
        $this->data['entry_postcode'] = $this->language->get('entry_postcode');
        $this->data['entry_zone'] = $this->language->get('entry_zone');
        $this->data['entry_country'] = $this->language->get('entry_country');
        $this->data['entry_default'] = $this->language->get('entry_default');
        $this->data['entry_comment'] = $this->language->get('entry_comment');
        $this->data['entry_description'] = $this->language->get('entry_description');
        $this->data['entry_amount'] = $this->language->get('entry_amount');
        $this->data['entry_points'] = $this->language->get('entry_points');
        
        // Banking Form Variables
        
        $this->data['column_bank_name'] = $this->language->get('column_bank_name');
        $this->data['column_currency'] = $this->language->get('column_currency');
        $this->data['column_ahn'] = $this->language->get('column_ahn');
        $this->data['column_iban'] = $this->language->get('column_iban');
        $this->data['column_swift'] = $this->language->get('column_swift');
        $this->data['column_status'] = $this->language->get('column_status');
        
        $this->data['entry_currency'] = $this->language->get('entry_currency');
        $this->data['entry_bank'] = $this->language->get('entry_bank');
        $this->data['entry_holder_name'] = $this->language->get('entry_holder_name');
        $this->data['entry_iban'] = $this->language->get('entry_iban');
        $this->data['entry_bic'] = $this->language->get('entry_bic');
        
        // Credit Card Variables
        
        $this->data['column_card_holder'] = $this->language->get('column_card_holder');
        $this->data['column_type'] = $this->language->get('column_type');
        $this->data['column_number'] = $this->language->get('column_number');
        
        $this->data['entry_card_holder_name'] = $this->language->get('entry_card_holder_name');
        $this->data['entry_cc'] = $this->language->get('entry_cc');
        $this->data['entry_ccv'] = $this->language->get('entry_ccv');
        $this->data['entry_expd'] = $this->language->get('entry_expd');

        $this->data['button_save'] = $this->language->get('button_save');
        $this->data['button_cancel'] = $this->language->get('button_cancel');
        $this->data['button_add_address'] = $this->language->get('button_add_address');
        $this->data['button_add_bank'] = $this->language->get('button_add_bank');
        $this->data['button_add_card'] = $this->language->get('button_add_card');
        $this->data['button_add_history'] = $this->language->get('button_add_history');
        $this->data['button_add_transaction'] = $this->language->get('button_add_transaction');
        $this->data['button_remove'] = $this->language->get('button_remove');
        $this->data['button_add_new'] = $this->language->get('button_add_new');

        $this->data['tab_general'] = $this->language->get('tab_general');
        $this->data['tab_address'] = $this->language->get('tab_address');
        $this->data['tab_account'] = $this->language->get('tab_account');
        $this->data['tab_transaction'] = $this->language->get('tab_transaction');
        $this->data['tab_bank'] = $this->language->get('tab_bank');
        $this->data['tab_card'] = $this->language->get('tab_card');
        $this->data['tab_ip'] = $this->language->get('tab_ip');

        $this->data['token'] = $this->session->data['token'];

        if (isset($this->request->get['customer_id'])) {
            $this->data['customer_id'] = $this->request->get['customer_id'];
        } else {
            $this->data['customer_id'] = 0;
        }

        if (isset($this->error['warning'])) {
            $this->data['error_warning'] = $this->error['warning'];
        } else {
            $this->data['error_warning'] = '';
        }

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

        if (isset($this->error['telephone'])) {
            $this->data['error_telephone'] = $this->error['telephone'];
        } else {
            $this->data['error_telephone'] = '';
        }

        if (isset($this->error['password'])) {
            $this->data['error_password'] = $this->error['password'];
        } else {
            $this->data['error_password'] = '';
        }

        if (isset($this->error['confirm'])) {
            $this->data['error_confirm'] = $this->error['confirm'];
        } else {
            $this->data['error_confirm'] = '';
        }

        if (isset($this->error['address_firstname'])) {
            $this->data['error_address_firstname'] = $this->error['address_firstname'];
        } else {
            $this->data['error_address_firstname'] = '';
        }

        if (isset($this->error['address_lastname'])) {
            $this->data['error_address_lastname'] = $this->error['address_lastname'];
        } else {
            $this->data['error_address_lastname'] = '';
        }

        if (isset($this->error['address_company'])) {
            $this->data['error_address_company'] = $this->error['address_company'];
        } else {
            $this->data['error_address_company'] = '';
        }

        if (isset($this->error['address_company_id'])) {
            $this->data['error_address_company_id'] = $this->error['address_company_id'];
        } else {
            $this->data['error_address_company_id'] = '';
        }

        if (isset($this->error['address_tax_id'])) {
            $this->data['error_address_tax_id'] = $this->error['address_tax_id'];
        } else {
            $this->data['error_address_tax_id'] = '';
        }

        if (isset($this->error['address_address_1'])) {
            $this->data['error_address_address_1'] = $this->error['address_address_1'];
        } else {
            $this->data['error_address_address_1'] = '';
        }

        if (isset($this->error['address_city'])) {
            $this->data['error_address_city'] = $this->error['address_city'];
        } else {
            $this->data['error_address_city'] = '';
        }

        if (isset($this->error['address_postcode'])) {
            $this->data['error_address_postcode'] = $this->error['address_postcode'];
        } else {
            $this->data['error_address_postcode'] = '';
        }

        if (isset($this->error['address_country'])) {
            $this->data['error_address_country'] = $this->error['address_country'];
        } else {
            $this->data['error_address_country'] = '';
        }

        if (isset($this->error['address_zone'])) {
            $this->data['error_address_zone'] = $this->error['address_zone'];
        } else {
            $this->data['error_address_zone'] = '';
        }

        $url = '';

        if (isset($this->request->get['filter_name'])) {
            $url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_email'])) {
            $url .= '&filter_email=' . urlencode(html_entity_decode($this->request->get['filter_email'], ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_customer_group_id'])) {
            $url .= '&filter_customer_group_id=' . $this->request->get['filter_customer_group_id'];
        }

        if (isset($this->request->get['filter_status'])) {
            $url .= '&filter_status=' . $this->request->get['filter_status'];
        }

        if (isset($this->request->get['filter_approved'])) {
            $url .= '&filter_approved=' . $this->request->get['filter_approved'];
        }

        if (isset($this->request->get['filter_date_added'])) {
            $url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
        }

        if (isset($this->request->get['sort'])) {
            $url .= '&sort=' . $this->request->get['sort'];
        }

        if (isset($this->request->get['order'])) {
            $url .= '&order=' . $this->request->get['order'];
        }

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
            'href' => $this->url->link('account/customer', 'token=' . $this->session->data['token'] . $url, 'SSL'),
            'separator' => ' :: '
        );

        if (!isset($this->request->get['customer_id'])) {
            $this->data['action'] = $this->url->link('account/customer/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
        } else {
            $this->data['action'] = $this->url->link('account/customer/update', 'token=' . $this->session->data['token'] . '&customer_id=' . $this->request->get['customer_id'] . $url, 'SSL');
        }

        $this->data['cancel'] = $this->url->link('account/customer', 'token=' . $this->session->data['token'] . $url, 'SSL');

        if (isset($this->request->get['customer_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
            $customer_info = $this->model_account_customer->getCustomer($this->request->get['customer_id']);
        }


        if (isset($this->request->post['firstname'])) {
            $this->data['firstname'] = $this->request->post['firstname'];
        } elseif (!empty($customer_info)) {
            $this->data['firstname'] = $customer_info['firstname'];
        } else {
            $this->data['firstname'] = '';
        }

        if (isset($this->request->post['lastname'])) {
            $this->data['lastname'] = $this->request->post['lastname'];
        } elseif (!empty($customer_info)) {
            $this->data['lastname'] = $customer_info['lastname'];
        } else {
            $this->data['lastname'] = '';
        }

        if (isset($this->request->post['personal_id'])) {
            $this->data['personal_id'] = $this->request->post['personal_id'];
        } elseif (!empty($customer_info)) {
            $this->data['personal_id'] = $customer_info['personal_id'];
        } else {
            $this->data['personal_id'] = '';
        }

        if (isset($this->request->post['email'])) {
            $this->data['email'] = $this->request->post['email'];
        } elseif (!empty($customer_info)) {
            $this->data['email'] = $customer_info['email'];
        } else {
            $this->data['email'] = '';
        }

        if (isset($this->request->post['fax'])) {
            $this->data['fax'] = $this->request->post['fax'];
        } elseif (!empty($customer_info)) {
            $this->data['fax'] = $customer_info['fax'];
        } else {
            $this->data['fax'] = '';
        }

        if (isset($this->request->post['newsletter'])) {
            $this->data['newsletter'] = $this->request->post['newsletter'];
        } elseif (!empty($customer_info)) {
            $this->data['newsletter'] = $customer_info['newsletter'];
        } else {
            $this->data['newsletter'] = '';
        }

        $this->load->model('account/customer_group');

        if (!empty($customer_info)) {
            $this->data['customer_group'] = $this->model_account_customer_group->getCustomerGroup($customer_info['customer_group_id']);
            ;
        } else {
            $this->data['customer_group'] = false;
        }

        $this->data['customer_groups'] = $this->model_account_customer_group->getCustomerGroups();

        if (isset($this->request->post['customer_group_id'])) {
            $this->data['customer_group_id'] = $this->request->post['customer_group_id'];
        } elseif (!empty($customer_info)) {
            $this->data['customer_group_id'] = $customer_info['customer_group_id'];
        } else {
            $this->data['customer_group_id'] = $this->config->get('config_customer_group_id');
        }

        if (isset($this->request->post['status'])) {
            $this->data['status'] = $this->request->post['status'];
        } elseif (!empty($customer_info)) {
            $this->data['status'] = $customer_info['status'];
        } else {
            $this->data['status'] = 1;
        }

        if (isset($this->request->post['password'])) {
            $this->data['password'] = $this->request->post['password'];
        } else {
            $this->data['password'] = '';
        }

        if (isset($this->request->post['confirm'])) {
            $this->data['confirm'] = $this->request->post['confirm'];
        } else {
            $this->data['confirm'] = '';
        }

        $this->load->model('localisation/country');

        $this->data['countries'] = $this->model_localisation_country->getCountries();

        if (isset($this->request->post['address'])) {
            $this->data['addresses'] = $this->request->post['address'];
        } elseif (isset($this->request->get['customer_id'])) {
            $this->data['addresses'] = $this->model_account_customer->getAddresses($this->request->get['customer_id']);
        } else {
            $this->data['addresses'] = array();
        }



        if (isset($this->request->post['address_id'])) {
            $this->data['address_id'] = $this->request->post['address_id'];
        } elseif (!empty($customer_info)) {
            $this->data['address_id'] = $customer_info['address_id'];
        } else {
            $this->data['address_id'] = '';
        }

        $this->data['ips'] = array();

        if (!empty($customer_info)) {
            $results = $this->model_account_customer->getIpsByCustomerId($this->request->get['customer_id']);

            foreach ($results as $result) {
                $ban_ip_total = $this->model_account_customer->getTotalBanIpsByIp($result['ip']);

                $this->data['ips'][] = array(
                    'ip' => $result['ip'],
                    'total' => $this->model_account_customer->getTotalCustomersByIp($result['ip']),
                    'date_added' => date('d/m/y', strtotime($result['date_added'])),
                    'filter_ip' => $this->url->link('account/customer', 'token=' . $this->session->data['token'] . '&filter_ip=' . $result['ip'], 'SSL'),
                    'ban_ip' => $ban_ip_total
                );
            }
        }

        $this->load->model('account/transaction');
        
        $this->data['address_row'] = 0;

        if (!empty($customer_info)) {

            $this->data['address_row'] = $customer_info['address_id'];

            // Adding Bank
            $this->data['add_bank'] = $this->url->link('account/customer/addbank', 'token=' . $this->data['token'], '&customer_id=' . $this->request->get['customer_id'], 'SSL');

            // Adding Card
            $this->data['add_card'] = $this->url->link('account/customer/addcard', 'token=' . $this->data['token'], '&customer_id=' . $this->request->get['customer_id'], 'SSL');


            $this->data['customer_account'] = $this->model_account_customer->getCustomerAccount($this->request->get['customer_id']);
            
            $this->data['banks'] = array();
            
            $banks = $this->model_account_customer->getCustomerBanks($this->request->get['customer_id']);
            
            foreach ($banks as $bank){
                
                
                if ($bank['verified']){
                    $verified = '<span class="label label-success">Verified</span>';
                } else {
                    $verified = '<span class="label label-info">In progress</span>';
                }
                
                $this->data['banks'][] = array(
                    'bank_name'=>$bank['bank_name'],
                    'settlement_currency'=>$bank['settlement_currency'],
                    'account_holder'=>$bank['account_holder'],
                    'iban'=>$bank['iban'],
                    'swift'=>$bank['swift'],
                    'status'=>$verified,
                    'verified'=>$bank['verified']
                );
            }
            
            
            $this->data['cards'] = array();
            
            $cards = $this->model_account_customer->getCustomerCards($this->request->get['customer_id']);
            
            foreach ($cards as $card){
                
                
                if ($card['verified']){
                    $verified = '<span class="label label-success">Verified</span>';
                } else {
                    $verified = '<span class="label label-info">In progress</span>';
                }
                
                $this->data['cards'][] = array(
                    'card_holder'=>$card['card_holder'],
                    'type'=>$card['type'],
                    'cc_number'=>$card['cc_number'],
                    'ccv'=>$card['ccv'],
                    'date_expire'=>$card['date_expire'],
                    'status'=>$verified,
                    'verified'=>$card['verified']
                );
            }
            $this->data['transactions'] = $this->model_account_transaction->getTransactions($this->request->get['customer_id']);
        }
        
        $this->load->model('localisation/currency');
        
        $this->data['currencies'] = $this->model_localisation_currency->getCurrencies();

        $this->template = 'account/customer_form.tpl';
        $this->children = array(
            'common/header',
            'common/footer'
        );

        $this->response->setOutput($this->render());
    }

    protected function validateForm() {
        if (!$this->user->hasPermission('modify', 'account/customer')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        if ((utf8_strlen($this->request->post['firstname']) < 1) || (utf8_strlen($this->request->post['firstname']) > 32)) {
            $this->error['firstname'] = $this->language->get('error_firstname');
        }

        if ((utf8_strlen($this->request->post['lastname']) < 1) || (utf8_strlen($this->request->post['lastname']) > 32)) {
            $this->error['lastname'] = $this->language->get('error_lastname');
        }

        if ((utf8_strlen($this->request->post['email']) > 96) || !preg_match('/^[^\@]+@.*\.[a-z]{2,6}$/i', $this->request->post['email'])) {
            $this->error['email'] = $this->language->get('error_email');
        }

        $customer_info = $this->model_account_customer->getCustomerByEmail($this->request->post['email']);

        if (!isset($this->request->get['customer_id'])) {
            if ($customer_info) {
                $this->error['warning'] = $this->language->get('error_exists');
            }
        } else {
            if ($customer_info && ($this->request->get['customer_id'] != $customer_info['customer_id'])) {
                $this->error['warning'] = $this->language->get('error_exists');
            }
        }

        if ($this->request->post['password'] || (!isset($this->request->get['customer_id']))) {
            if ((utf8_strlen($this->request->post['password']) < 4) || (utf8_strlen($this->request->post['password']) > 20)) {
                $this->error['password'] = $this->language->get('error_password');
            }

            if ($this->request->post['password'] != $this->request->post['confirm']) {
                $this->error['confirm'] = $this->language->get('error_confirm');
            }
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
        if (!$this->user->hasPermission('modify', 'account/customer')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        if (!$this->error) {
            return true;
        } else {
            return false;
        }
    }

    public function login() {
        $json = array();

        if (isset($this->request->get['customer_id'])) {
            $customer_id = $this->request->get['customer_id'];
        } else {
            $customer_id = 0;
        }

        $this->load->model('account/customer');

        $customer_info = $this->model_account_customer->getCustomer($customer_id);

        if ($customer_info) {
            $this->redirect(HTTP_MERCHANT);
        } else {
            $this->language->load('error/not_found');

            $this->document->setTitle($this->language->get('heading_title'));

            $this->data['heading_title'] = $this->language->get('heading_title');

            $this->data['text_not_found'] = $this->language->get('text_not_found');

            $this->data['breadcrumbs'] = array();

            $this->data['breadcrumbs'][] = array(
                'text' => $this->language->get('text_home'),
                'href' => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
                'separator' => false
            );

            $this->data['breadcrumbs'][] = array(
                'text' => $this->language->get('heading_title'),
                'href' => $this->url->link('error/not_found', 'token=' . $this->session->data['token'], 'SSL'),
                'separator' => ' :: '
            );

            $this->template = 'error/not_found.tpl';
            $this->children = array(
                'common/header',
                'common/footer'
            );

            $this->response->setOutput($this->render());
        }
    }

    public function history() {
        $this->language->load('account/customer');

        $this->load->model('account/customer');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->user->hasPermission('modify', 'account/customer')) {
            $this->model_account_customer->addHistory($this->request->get['customer_id'], $this->request->post['comment']);

            $this->data['success'] = $this->language->get('text_success');
        } else {
            $this->data['success'] = '';
        }

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && !$this->user->hasPermission('modify', 'account/customer')) {
            $this->data['error_warning'] = $this->language->get('error_permission');
        } else {
            $this->data['error_warning'] = '';
        }

        $this->data['text_no_results'] = $this->language->get('text_no_results');

        $this->data['column_date_added'] = $this->language->get('column_date_added');
        $this->data['column_comment'] = $this->language->get('column_comment');

        if (isset($this->request->get['page'])) {
            $page = $this->request->get['page'];
        } else {
            $page = 1;
        }

        $this->data['histories'] = array();

        $results = $this->model_account_customer->getHistories($this->request->get['customer_id'], ($page - 1) * 10, 10);

        foreach ($results as $result) {
            $this->data['histories'][] = array(
                'comment' => $result['comment'],
                'date_added' => date($this->language->get('date_format_short'), strtotime($result['date_added']))
            );
        }

        $transaction_total = $this->model_account_customer->getTotalHistories($this->request->get['customer_id']);

        $pagination = new Pagination();
        $pagination->total = $transaction_total;
        $pagination->page = $page;
        $pagination->limit = 10;
        $pagination->text = $this->language->get('text_pagination');
        $pagination->url = $this->url->link('account/customer/history', 'token=' . $this->session->data['token'] . '&customer_id=' . $this->request->get['customer_id'] . '&page={page}', 'SSL');

        $this->data['pagination'] = $pagination->render();

        $this->template = 'account/customer_history.tpl';

        $this->response->setOutput($this->render());
    }

    public function transaction() {
        $this->language->load('account/customer');

        $this->load->model('account/customer');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->user->hasPermission('modify', 'account/customer')) {
            $this->model_account_customer->addTransaction($this->request->get['customer_id'], $this->request->post['description'], $this->request->post['amount']);

            $this->data['success'] = $this->language->get('text_success');
        } else {
            $this->data['success'] = '';
        }

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && !$this->user->hasPermission('modify', 'account/customer')) {
            $this->data['error_warning'] = $this->language->get('error_permission');
        } else {
            $this->data['error_warning'] = '';
        }

        $this->data['text_no_results'] = $this->language->get('text_no_results');
        $this->data['text_balance'] = $this->language->get('text_balance');

        $this->data['column_date_added'] = $this->language->get('column_date_added');
        $this->data['column_description'] = $this->language->get('column_description');
        $this->data['column_amount'] = $this->language->get('column_amount');

        if (isset($this->request->get['page'])) {
            $page = $this->request->get['page'];
        } else {
            $page = 1;
        }

        $this->data['transactions'] = array();

        $results = $this->model_account_customer->getTransactions($this->request->get['customer_id'], ($page - 1) * 10, 10);

        foreach ($results as $result) {
            $this->data['transactions'][] = array(
                'amount' => $this->currency->format($result['amount'], $this->config->get('config_currency')),
                'description' => $result['description'],
                'date_added' => date($this->language->get('date_format_short'), strtotime($result['date_added']))
            );
        }

        $this->data['balance'] = $this->currency->format($this->model_account_customer->getTransactionTotal($this->request->get['customer_id']), $this->config->get('config_currency'));

        $transaction_total = $this->model_account_customer->getTotalTransactions($this->request->get['customer_id']);

        $pagination = new Pagination();
        $pagination->total = $transaction_total;
        $pagination->page = $page;
        $pagination->limit = 10;
        $pagination->text = $this->language->get('text_pagination');
        $pagination->url = $this->url->link('account/customer/transaction', 'token=' . $this->session->data['token'] . '&customer_id=' . $this->request->get['customer_id'] . '&page={page}', 'SSL');

        $this->data['pagination'] = $pagination->render();

        $this->template = 'account/customer_transaction.tpl';

        $this->response->setOutput($this->render());
    }

    public function reward() {
        $this->language->load('account/customer');

        $this->load->model('account/customer');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->user->hasPermission('modify', 'account/customer')) {
            $this->model_account_customer->addReward($this->request->get['customer_id'], $this->request->post['description'], $this->request->post['points']);

            $this->data['success'] = $this->language->get('text_success');
        } else {
            $this->data['success'] = '';
        }

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && !$this->user->hasPermission('modify', 'account/customer')) {
            $this->data['error_warning'] = $this->language->get('error_permission');
        } else {
            $this->data['error_warning'] = '';
        }

        $this->data['text_no_results'] = $this->language->get('text_no_results');
        $this->data['text_balance'] = $this->language->get('text_balance');

        $this->data['column_date_added'] = $this->language->get('column_date_added');
        $this->data['column_description'] = $this->language->get('column_description');
        $this->data['column_points'] = $this->language->get('column_points');

        if (isset($this->request->get['page'])) {
            $page = $this->request->get['page'];
        } else {
            $page = 1;
        }

        $this->data['rewards'] = array();

        $results = $this->model_account_customer->getRewards($this->request->get['customer_id'], ($page - 1) * 10, 10);

        foreach ($results as $result) {
            $this->data['rewards'][] = array(
                'points' => $result['points'],
                'description' => $result['description'],
                'date_added' => date($this->language->get('date_format_short'), strtotime($result['date_added']))
            );
        }

        $this->data['balance'] = $this->model_account_customer->getRewardTotal($this->request->get['customer_id']);

        $reward_total = $this->model_account_customer->getTotalRewards($this->request->get['customer_id']);

        $pagination = new Pagination();
        $pagination->total = $reward_total;
        $pagination->page = $page;
        $pagination->limit = 10;
        $pagination->text = $this->language->get('text_pagination');
        $pagination->url = $this->url->link('account/customer/reward', 'token=' . $this->session->data['token'] . '&customer_id=' . $this->request->get['customer_id'] . '&page={page}', 'SSL');

        $this->data['pagination'] = $pagination->render();

        $this->template = 'account/customer_reward.tpl';

        $this->response->setOutput($this->render());
    }

    public function addBanIP() {
        $this->language->load('account/customer');

        $json = array();

        if (isset($this->request->post['ip'])) {
            if (!$this->user->hasPermission('modify', 'account/customer')) {
                $json['error'] = $this->language->get('error_permission');
            } else {
                $this->load->model('account/customer');

                $this->model_account_customer->addBanIP($this->request->post['ip']);

                $json['success'] = $this->language->get('text_success');
            }
        }

        $this->response->setOutput(json_encode($json));
    }

    public function removeBanIP() {
        $this->language->load('account/customer');

        $json = array();

        if (isset($this->request->post['ip'])) {
            if (!$this->user->hasPermission('modify', 'account/customer')) {
                $json['error'] = $this->language->get('error_permission');
            } else {
                $this->load->model('account/customer');

                $this->model_account_customer->removeBanIP($this->request->post['ip']);

                $json['success'] = $this->language->get('text_success');
            }
        }

        $this->response->setOutput(json_encode($json));
    }

    public function autocomplete() {
        $json = array();

        if (isset($this->request->get['filter_name'])) {
            $this->load->model('account/customer');

            $data = array(
                'filter_name' => $this->request->get['filter_name'],
                'start' => 0,
                'limit' => 20
            );

            $results = $this->model_account_customer->getCustomers($data);

            foreach ($results as $result) {
                $json[] = array(
                    'customer_id' => $result['customer_id'],
                    'customer_group_id' => $result['customer_group_id'],
                    'name' => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8')),
                    'customer_group' => $result['customer_group'],
                    'firstname' => $result['firstname'],
                    'lastname' => $result['lastname'],
                    'email' => $result['email'],
                    'telephone' => $result['telephone'],
                    'fax' => $result['fax'],
                    'address' => $this->model_account_customer->getAddresses($result['customer_id'])
                );
            }
        }

        $sort_order = array();

        foreach ($json as $key => $value) {
            $sort_order[$key] = $value['name'];
        }

        array_multisort($sort_order, SORT_ASC, $json);

        $this->response->setOutput(json_encode($json));
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

    public function address() {
        $json = array();

        if (!empty($this->request->get['address_id'])) {
            $this->load->model('account/customer');

            $json = $this->model_account_customer->getAddress($this->request->get['address_id']);
        }

        $this->response->setOutput(json_encode($json));
    }

    public function addbank() {

        $this->language->load('account/customer');

        $this->data['entry_currency'] = $this->language->get('entry_currency');
        $this->data['entry_bank'] = $this->language->get('entry_bank');
        $this->data['entry_holder_name'] = $this->language->get('entry_holder_name');
        $this->data['entry_iban'] = $this->language->get('entry_iban');
        $this->data['entry_bic'] = $this->language->get('entry_bic');

        $this->load->model('localisation/currency');

        $this->data['currencies'] = $this->model_localisation_currency->getCurrencies();


        $this->template = 'account/add_bank.tpl';

        $this->response->setOutput($this->render());
    }

    public function addcard() {


        $this->language->load('account/customer');


        $this->data['entry_card_holder_name'] = $this->language->get('entry_card_holder_name');
        $this->data['entry_cc'] = $this->language->get('entry_cc');
        $this->data['entry_ccv'] = $this->language->get('entry_ccv');
        $this->data['entry_expd'] = $this->language->get('entry_expd');

        $this->data['token'] = $this->session->data['token'];

        $this->template = 'account/add_card.tpl';

        $this->response->setOutput($this->render());
    }

    public function cardcheck() {

        $json = array();

        if ($this->request->server['REQUEST_METHOD'] == 'GET') {

            $this->creditcard->Validate($this->request->get['cardnum']);

            $card_info = $this->creditcard->GetCardInfo();

            $json[] = array(
                'card_validation' => $card_info['status'],
                'card_type' => $card_info['type'],
                'card'=>$card_info['substring']
            );
        }

        $this->response->setOutput(json_encode($json));
    }

}

