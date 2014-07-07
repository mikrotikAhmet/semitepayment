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
 * Description of mail Class
 *
 * @author ahmet
 */
class ControllerDesignMail extends Controller{
    
    private $error = array();
    
    public function index() {
        $this->language->load('design/mail');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('design/mail');

        $this->getList();
    }
    
    public function insert() {
        $this->language->load('design/mail');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('design/mail');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
            $this->model_design_mail->addMailTemplate($this->request->post);

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

            $this->redirect($this->url->link('design/mail', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }

        $this->getForm();
    }

    public function update() {
        $this->language->load('design/mail');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('design/mail');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {

            $this->model_design_mail->editMailTemplate($this->request->get['mail_id'], $this->request->post);

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

            $this->redirect($this->url->link('design/mail', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }

        $this->getForm();
    }

    public function delete() {
        $this->language->load('design/mail');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('design/mail');

        if (isset($this->request->post['selected']) && $this->validateDelete()) {
            foreach ($this->request->post['selected'] as $mail_id) {
                $this->model_design_mail->deleteMailTemplate($mail_id);
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
            $this->redirect($this->url->link('design/mail', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }

        $this->getList();
    }
    
    
    protected function getList() {
        if (isset($this->request->get['sort'])) {
            $sort = $this->request->get['sort'];
        } else {
            $sort = 'md.title';
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
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => false
        );

        $this->data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('design/mail', 'token=' . $this->session->data['token'] . $url, 'SSL'),
            'separator' => ' :: '
        );

        $this->data['insert'] = $this->url->link('design/mail/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
        $this->data['delete'] = $this->url->link('design/mail/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');

        $this->data['mail_templates'] = array();

        $data = array(
            'sort' => $sort,
            'order' => $order,
            'start' => ($page - 1) * $this->config->get('config_admin_limit'),
            'limit' => $this->config->get('config_admin_limit')
        );

        $mail_total = $this->model_design_mail->getTotalMailTemplates();

        $results = $this->model_design_mail->getMailTemplates($data);

        foreach ($results as $result) {
            $action = array();

            $action[] = array(
                'text' => $this->language->get('text_edit'),
                'href' => $this->url->link('design/mail/update', 'token=' . $this->session->data['token'] . '&page_id=' . $result['page_id'] . $url, 'SSL')
            );

            $this->data['mail_templates'][] = array(
                'mail_template_id' => $result['mail_template_id'],
                'title' => $result['title'].($result['mail_template_id'] == $this->config->get('config_mail_id') ? $this->language->get('text_default') : ''),
                'status' => ($result['status'] ? '<span class="label label-success">' . $this->language->get('text_enabled') . '</span>' : '<span class="label label-danger">' . $this->language->get('text_disabled') . '</span>'),
                'selected' => isset($this->request->post['selected']) && in_array($result['mail_template_id'], $this->request->post['selected']),
                'action' => $action
            );
        }

        $this->data['heading_title'] = $this->language->get('heading_title');

        $this->data['text_no_results'] = $this->language->get('text_no_results');

        $this->data['column_title'] = $this->language->get('column_title');
        $this->data['column_status'] = $this->language->get('column_status');
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

        $this->data['sort_title'] = $this->url->link('design/mail', 'token=' . $this->session->data['token'] . '&sort=md.title' . $url, 'SSL');

        $url = '';

        if (isset($this->request->get['sort'])) {
            $url .= '&sort=' . $this->request->get['sort'];
        }

        if (isset($this->request->get['order'])) {
            $url .= '&order=' . $this->request->get['order'];
        }

        $pagination = new Pagination();
        $pagination->total = $mail_total;
        $pagination->page = $page;
        $pagination->limit = $this->config->get('config_admin_limit');
        $pagination->text = $this->language->get('text_pagination');
        $pagination->url = $this->url->link('design/mail', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

        $this->data['pagination'] = $pagination->render();

        $this->data['sort'] = $sort;
        $this->data['order'] = $order;

        $this->template = 'design/mail_list.tpl';
        $this->children = array(
            'common/header',
            'common/footer'
        );

        $this->response->setOutput($this->render());
    }
    
    protected function getForm() {
        $this->data['heading_title'] = $this->language->get('heading_title');

        $this->data['text_enabled'] = $this->language->get('text_enabled');
        $this->data['text_default'] = $this->language->get('text_default');
        $this->data['text_disabled'] = $this->language->get('text_disabled');

        $this->data['entry_title'] = $this->language->get('entry_title');
        $this->data['entry_template'] = $this->language->get('entry_template');
        $this->data['entry_status'] = $this->language->get('entry_status');
        
        $this->data['button_save'] = $this->language->get('button_save');
        $this->data['button_cancel'] = $this->language->get('button_cancel');

        if (isset($this->error['warning'])) {
            $this->data['error_warning'] = $this->error['warning'];
        } else {
            $this->data['error_warning'] = '';
        }

        if (isset($this->error['title'])) {
            $this->data['error_title'] = $this->error['title'];
        } else {
            $this->data['error_title'] = array();
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
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => false
        );

        $this->data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('design/mail', 'token=' . $this->session->data['token'] . $url, 'SSL'),
            'separator' => ' :: '
        );

        if (!isset($this->request->get['page_id'])) {
            $this->data['action'] = $this->url->link('design/mail/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
        } else {
            $this->data['action'] = $this->url->link('design/mail/update', 'token=' . $this->session->data['token'] . '&mail_template_id=' . $this->request->get['mail_template_id'] . $url, 'SSL');
        }

        if (isset($this->request->get['mail_template_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
            $page_info = $this->model_design_mail->getMailTemplate($this->request->get['mail_template_id']);
        }

        $this->data['cancel'] = $this->url->link('design/mail', 'token=' . $this->session->data['token'] . $url, 'SSL');

        $this->data['token'] = $this->session->data['token'];

        $this->load->model('localisation/language');

        $this->data['languages'] = $this->model_localisation_language->getLanguages();

        if (isset($this->request->post['mail_description'])) {
            $this->data['mail_description'] = $this->request->post['mail_description'];
        } elseif (isset($this->request->get['page_id'])) {
            $this->data['mail_description'] = $this->model_design_mail->getMailTemplateDescriptions($this->request->get['mail_template_id']);
        } else {
            $this->data['mail_description'] = array();
        }

         if (isset($this->request->post['status'])) {
            $this->data['status'] = $this->request->post['status'];
        } elseif (!empty($page_info)) {
            $this->data['status'] = $page_info['status'];
        } else {
            $this->data['status'] = 0;
        }
        
        $this->template = 'design/mail_form.tpl';
        $this->children = array(
            'common/header',
            'common/footer'
        );

        $this->response->setOutput($this->render());
    }
    
    protected function validateForm() {
        if (!$this->user->hasPermission('modify', 'design/mail')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        foreach ($this->request->post['mail_description'] as $language_id => $value) {
            if ((utf8_strlen($value['title']) < 3) || (utf8_strlen($value['title']) > 64)) {
                $this->error['title'][$language_id] = $this->language->get('error_title');
            }
        }

        if (!$this->error) {
            return true;
        } else {
            return false;
        }
    }

    protected function validateDelete() {
        if (!$this->user->hasPermission('modify', 'design/mail')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }
        
        foreach ($this->request->post['selected'] as $mail_id) {
            if ($this->config->get('config_mail_id') == $mail_id) {
                $this->error['warning'] = $this->language->get('error_default');
            }
        }

        if (!$this->error) {
            return true;
        } else {
            return false;
        }
    }
}
