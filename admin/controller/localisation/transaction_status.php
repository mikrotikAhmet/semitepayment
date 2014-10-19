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
 * Description of transaction_status Class
 *
 * @author ahmet
 */
class ControllerLocalisationTransactionStatus extends Controller { 
	private $error = array();

	public function index() {
		$this->language->load('localisation/transaction_status');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('localisation/transaction_status');

		$this->getList();
	}

	public function insert() {
		$this->language->load('localisation/transaction_status');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('localisation/transaction_status');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_localisation_transaction_status->addTransactionStatus($this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->redirect($this->url->link('localisation/transaction_status', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function update() {
		$this->language->load('localisation/transaction_status');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('localisation/transaction_status');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_localisation_transaction_status->editTransactionStatus($this->request->get['transaction_status_id'], $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->redirect($this->url->link('localisation/transaction_status', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function delete() {
		$this->language->load('localisation/transaction_status');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('localisation/transaction_status');

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $transaction_status_id) {
				$this->model_localisation_transaction_status->deleteTransactionStatus($transaction_status_id);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->redirect($this->url->link('localisation/transaction_status', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getList();
	}

	protected function getList() {
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
			'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => false
		);

		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('localisation/transaction_status', 'token=' . $this->session->data['token'] . $url, 'SSL'),
			'separator' => ' :: '
		);

		$this->data['insert'] = $this->url->link('localisation/transaction_status/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$this->data['delete'] = $this->url->link('localisation/transaction_status/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');	

		$this->data['transaction_statuses'] = array();

		$data = array(
			'sort'  => $sort,
			'order' => $order,
			'start' => ($page - 1) * $this->config->get('config_admin_limit'),
			'limit' => $this->config->get('config_admin_limit')
		);

		$transaction_status_total = $this->model_localisation_transaction_status->getTotalTransactionStatuses();

		$results = $this->model_localisation_transaction_status->getTransactionStatuses($data);

		foreach ($results as $result) {
			$action = array();

			$action[] = array(
				'text' => $this->language->get('text_edit'),
				'href' => $this->url->link('localisation/transaction_status/update', 'token=' . $this->session->data['token'] . '&transaction_status_id=' . $result['transaction_status_id'] . $url, 'SSL')
			);

			$this->data['transaction_statuses'][] = array(
				'transaction_status_id' => $result['transaction_status_id'],
				'name'            => $result['name'] . (($result['transaction_status_id'] == $this->config->get('config_transaction_status_id')) ? $this->language->get('text_default') : null),
				'selected'        => isset($this->request->post['selected']) && in_array($result['transaction_status_id'], $this->request->post['selected']),
				'action'          => $action
			);
		}	

		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_no_results'] = $this->language->get('text_no_results');

		$this->data['column_name'] = $this->language->get('column_name');
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

		$url = '';

		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$this->data['sort_name'] = $this->url->link('localisation/transaction_status', 'token=' . $this->session->data['token'] . '&sort=name' . $url, 'SSL');

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$pagination = new Pagination();
		$pagination->total = $transaction_status_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_admin_limit');
		$pagination->text = $this->language->get('text_pagination');
		$pagination->url = $this->url->link('localisation/transaction_status', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

		$this->data['pagination'] = $pagination->render();

		$this->data['sort'] = $sort;
		$this->data['order'] = $order;

		$this->template = 'localisation/transaction_status_list.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);

		$this->response->setOutput($this->render());
	}

	protected function getForm() {
		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['entry_name'] = $this->language->get('entry_name');

		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');

		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

		if (isset($this->error['name'])) {
			$this->data['error_name'] = $this->error['name'];
		} else {
			$this->data['error_name'] = array();
		}

		$url = '';

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
			'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => false
		);

		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('localisation/transaction_status', 'token=' . $this->session->data['token'] . $url, 'SSL'),
			'separator' => ' :: '
		);

		if (!isset($this->request->get['transaction_status_id'])) {
			$this->data['action'] = $this->url->link('localisation/transaction_status/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {
			$this->data['action'] = $this->url->link('localisation/transaction_status/update', 'token=' . $this->session->data['token'] . '&transaction_status_id=' . $this->request->get['transaction_status_id'] . $url, 'SSL');
		}

		$this->data['cancel'] = $this->url->link('localisation/transaction_status', 'token=' . $this->session->data['token'] . $url, 'SSL');

		$this->load->model('localisation/language');

		$this->data['languages'] = $this->model_localisation_language->getLanguages();

		if (isset($this->request->post['transaction_status'])) {
			$this->data['transaction_status'] = $this->request->post['transaction_status'];
		} elseif (isset($this->request->get['transaction_status_id'])) {
			$this->data['transaction_status'] = $this->model_localisation_transaction_status->getTransactionStatusDescriptions($this->request->get['transaction_status_id']);
		} else {
			$this->data['transaction_status'] = array();
		}

		$this->template = 'localisation/transaction_status_form.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);

		$this->response->setOutput($this->render());	
	}

	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'localisation/transaction_status')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		foreach ($this->request->post['transaction_status'] as $language_id => $value) {
			if ((utf8_strlen($value['name']) < 3) || (utf8_strlen($value['name']) > 32)) {
				$this->error['name'][$language_id] = $this->language->get('error_name');
			}
		}

		if (!$this->error) {
			return true;
		} else {
			return false;
		}
	}

	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'localisation/transaction_status')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		$this->load->model('setting/application');
		$this->load->model('account/transaction');

		foreach ($this->request->post['selected'] as $transaction_status_id) {
			if ($this->config->get('config_transaction_status_id') == $transaction_status_id) {
				$this->error['warning'] = $this->language->get('error_default');
			}  

			$application_total = $this->model_setting_application->getTotalApplicationsByTransactionStatusId($transaction_status_id);

			if ($application_total) {
				$this->error['warning'] = sprintf($this->language->get('error_application'), $application_total);
			}

			$transactiontotal = $this->model_account_transaction->getTotalWithdrawHistoriesByTransactionStatusId($transaction_status_id);

			if ($transactiontotal) {
				$this->error['warning'] = sprintf($this->language->get('error_transaction'), $transactiontotal);
			}  
		}

		if (!$this->error) { 
			return true;
		} else {
			return false;
		}
	}
}
