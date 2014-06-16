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
 * Semite LLC content Class
 * Date : Jun 14, 2014
 */

class ControllerApplicationContent extends Controller {

    private $error = array();

    public function index() {
        $this->language->load('application/content');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('application/content');

        $this->getList();
    }

    public function insert() {
        $this->language->load('application/content');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('application/content');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
            $this->model_application_content->addContent($this->request->post);

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

            $this->redirect($this->url->link('application/content', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }

        $this->getForm();
    }

    public function update() {
        $this->language->load('application/content');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('application/content');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
            $this->model_application_content->editContent($this->request->get['content_id'], $this->request->post);

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

            $this->redirect($this->url->link('application/content', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }

        $this->getForm();
    }

    public function delete() {
        $this->language->load('application/content');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('application/content');

        if (isset($this->request->post['selected']) && $this->validateDelete()) {
            foreach ($this->request->post['selected'] as $content_id) {
                $this->model_application_content->deleteContent($content_id);
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

            $this->redirect($this->url->link('application/content', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }

        $this->getList();
    }
    
    public function revision() {
        
        $this->language->load('application/revision');

        $this->getRevision();
    }

    protected function getList() {
        if (isset($this->request->get['sort'])) {
            $sort = $this->request->get['sort'];
        } else {
            $sort = 'cd.title';
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
            'href' => $this->url->link('application/content', 'token=' . $this->session->data['token'] . $url, 'SSL'),
            'separator' => ' :: '
        );

        $this->data['insert'] = $this->url->link('application/content/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
        $this->data['delete'] = $this->url->link('application/content/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');

        $this->data['contents'] = array();

        $data = array(
            'sort' => $sort,
            'order' => $order,
            'start' => ($page - 1) * $this->config->get('config_admin_limit'),
            'limit' => $this->config->get('config_admin_limit')
        );

        $content_total = $this->model_application_content->getTotalContents();

        $results = $this->model_application_content->getContents($data);

        $this->load->model('user/user');
        $this->load->model('application/content_type');

        foreach ($results as $result) {
            $action = array();

            $action[] = array(
                'text' => $this->language->get('text_edit'),
                'href' => $this->url->link('application/content/update', 'token=' . $this->session->data['token'] . '&content_id=' . $result['content_id'] . $url, 'SSL')
            );

            $author_info = $this->model_user_user->getUser($result['author']);
            $type_info = $this->model_application_content_type->getContentType($result['type']);

            if (!empty($author_info['firstname'])) {

                $author = $author_info['firstname'] . ' ' . $author_info['lastname'];
            } else {
                $author = $author_info['username'];
            }

            $this->data['contents'][] = array(
                'content_id' => $result['content_id'],
                'title' => $result['title'],
                'type' => $type_info['name'],
                'author' => $author,
                'status' => ($result['status'] ? '<span class="label label-success">' . $this->language->get('text_published') . '</span>' : '<span class="label label-danger">' . $this->language->get('text_unpublished') . '</span>'),
                'date_modified' => date($this->language->get('date_format_short'), strtotime($result['date_modified'])),
                'selected' => isset($this->request->post['selected']) && in_array($result['content_id'], $this->request->post['selected']),
                'action' => $action
            );
        }

        $this->data['heading_title'] = $this->language->get('heading_title');

        $this->data['text_no_results'] = $this->language->get('text_no_results');

        $this->data['column_title'] = $this->language->get('column_title');
        $this->data['column_type'] = $this->language->get('column_type');
        $this->data['column_author'] = $this->language->get('column_author');
        $this->data['column_status'] = $this->language->get('column_status');
        $this->data['column_date_modified'] = $this->language->get('column_date_modified');
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

        $this->data['sort_title'] = $this->url->link('application/content', 'token=' . $this->session->data['token'] . '&sort=cd.title' . $url, 'SSL');
        $this->data['sort_type'] = $this->url->link('application/content', 'token=' . $this->session->data['token'] . '&sort=c.type' . $url, 'SSL');
        $this->data['sort_status'] = $this->url->link('application/content', 'token=' . $this->session->data['token'] . '&sort=c.status' . $url, 'SSL');
        $this->data['sort_date_modified'] = $this->url->link('application/content', 'token=' . $this->session->data['token'] . '&sort=c.date_modified' . $url, 'SSL');

        $url = '';

        if (isset($this->request->get['sort'])) {
            $url .= '&sort=' . $this->request->get['sort'];
        }

        if (isset($this->request->get['order'])) {
            $url .= '&order=' . $this->request->get['order'];
        }

        $pagination = new Pagination();
        $pagination->total = $content_total;
        $pagination->page = $page;
        $pagination->limit = $this->config->get('config_admin_limit');
        $pagination->text = $this->language->get('text_pagination');
        $pagination->url = $this->url->link('application/content', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

        $this->data['pagination'] = $pagination->render();

        $this->data['sort'] = $sort;
        $this->data['order'] = $order;

        $this->template = 'application/content_list.tpl';
        $this->children = array(
            'common/header',
            'common/footer'
        );

        $this->response->setOutput($this->render());
    }

    protected function getForm() {
        
        $this->data['heading_title'] = $this->language->get('heading_title');

        $this->document->addScript('view/javascript/jquery/tabs.js');

        $this->data['text_default'] = $this->language->get('text_default');
        $this->data['text_enabled'] = $this->language->get('text_enabled');
        $this->data['text_disabled'] = $this->language->get('text_disabled');
        $this->data['text_general'] = $this->language->get('text_general');
        $this->data['text_select'] = $this->language->get('text_select');
        $this->data['text_image_manager'] = $this->language->get('text_image_manager');
        $this->data['text_browse'] = $this->language->get('text_browse');
        $this->data['text_clear'] = $this->language->get('text_clear');
        $this->data['text_no_revision'] = $this->language->get('text_no_revision');
        $this->data['text_revision_howto'] = $this->language->get('text_revision_howto');

        $this->data['entry_title'] = $this->language->get('entry_title');
        $this->data['entry_description'] = $this->language->get('entry_description');
        $this->data['entry_image'] = $this->language->get('entry_image');
        $this->data['entry_type'] = $this->language->get('entry_type');
        $this->data['entry_keyword'] = $this->language->get('entry_keyword');
        $this->data['entry_status'] = $this->language->get('entry_status');
        $this->data['entry_review'] = $this->language->get('entry_review');
        $this->data['entry_revision'] = $this->language->get('entry_revision');
        $this->data['entry_revision_log'] = $this->language->get('entry_revision_log');
        $this->data['entry_application'] = $this->language->get('entry_application');

        $this->data['tab_general'] = $this->language->get('tab_general');
        $this->data['tab_data'] = $this->language->get('tab_data');
        $this->data['tab_links'] = $this->language->get('tab_links');
        $this->data['tab_revision'] = $this->language->get('tab_revision');

        $this->data['date'] = date($this->language->get('date_format_short'), strtotime(date("Y-m-d H:i:s")));

        $this->data['button_save'] = $this->language->get('button_save');
        $this->data['button_cancel'] = $this->language->get('button_cancel');
        $this->data['button_view_revision'] = $this->language->get('button_view_revision');

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

        if (isset($this->error['description'])) {
            $this->data['error_description'] = $this->error['description'];
        } else {
            $this->data['error_description'] = array();
        }

        if (isset($this->error['type'])) {
            $this->data['error_type'] = $this->error['type'];
        } else {
            $this->data['error_type'] = '';
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
            'href' => $this->url->link('application/content', 'token=' . $this->session->data['token'] . $url, 'SSL'),
            'separator' => ' :: '
        );

        if (!isset($this->request->get['content_id'])) {
            $this->data['action'] = $this->url->link('application/content/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
        } else {
            $this->data['action'] = $this->url->link('application/content/update', 'token=' . $this->session->data['token'] . '&content_id=' . $this->request->get['content_id'] . $url, 'SSL');
        }

        $this->data['cancel'] = $this->url->link('application/content', 'token=' . $this->session->data['token'] . $url, 'SSL');

        if (isset($this->request->get['content_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
            $content_info = $this->model_application_content->getContent($this->request->get['content_id']);
            $this->data['content_id'] = $content_info['content_id'];
        }

        $this->data['token'] = $this->session->data['token'];

        $this->load->model('localisation/language');

        $this->data['languages'] = $this->model_localisation_language->getLanguages();

        if (isset($this->request->post['content_description'])) {
            $this->data['content_description'] = $this->request->post['content_description'];
        } elseif (isset($this->request->get['content_id'])) {
            $this->data['content_description'] = $this->model_application_content->getContentDescriptions($this->request->get['content_id']);
        } else {
            $this->data['content_description'] = array();
        }

        if (isset($this->request->post['image'])) {
            $this->data['image'] = $this->request->post['image'];
        } elseif (!empty($content_info)) {
            $this->data['image'] = $content_info['image'];
        } else {
            $this->data['image'] = '';
        }

        $this->load->model('tool/image');

        if (isset($this->request->post['image']) && file_exists(DIR_IMAGE . $this->request->post['image'])) {
            $this->data['thumb'] = $this->model_tool_image->resize($this->request->post['image'], 100, 100);
        } elseif (!empty($content_info) && $content_info['image'] && file_exists(DIR_IMAGE . $content_info['image'])) {
            $this->data['thumb'] = $this->model_tool_image->resize($content_info['image'], 100, 100);
        } else {
            $this->data['thumb'] = $this->model_tool_image->resize('no_image.jpg', 100, 100);
        }

        $this->data['no_image'] = $this->model_tool_image->resize('no_image.jpg', 100, 100);

        $this->load->model('application/content_type');

        $this->data['types'] = $this->model_application_content_type->getContentTypes();

        if (isset($this->request->post['type'])) {
            $this->data['type'] = $this->request->post['type'];
        } elseif (!empty($content_info)) {
            $this->data['type'] = $content_info['type'];
        } else {
            $this->data['type'] = '';
        }

        if (isset($this->request->post['keyword'])) {
            $this->data['keyword'] = $this->request->post['keyword'];
        } elseif (!empty($content_info)) {
            $this->data['keyword'] = $content_info['keyword'];
        } else {
            $this->data['keyword'] = '';
        }

        if (isset($this->request->post['status'])) {
            $this->data['status'] = $this->request->post['status'];
        } elseif (!empty($content_info)) {
            $this->data['status'] = $content_info['status'];
        } else {
            $this->data['status'] = 1;
        }

        if (isset($this->request->post['revision'])) {
            $this->data['revision'] = $this->request->post['revision'];
        } elseif (!empty($content_info)) {
            $this->data['revision'] = $content_info['revision'];
        } else {
            $this->data['revision'] = 0;
        }
        
        if (isset($this->request->post['revision_log'])) {
            $this->data['revision_log'] = $this->request->post['revision_log'];
        } else {
            $this->data['revision_log'] = "";
        }

        if (isset($this->request->post['comment'])) {
            $this->data['comment'] = $this->request->post['comment'];
        } elseif (!empty($content_info)) {
            $this->data['comment'] = $content_info['comment'];
        } else {
            $this->data['comment'] = 0;
        }

        if (!empty($content_info)) {
            $this->data['has_revision'] = $this->model_application_content->getTotalContentRevisions($content_info['content_id']);
        } else {
            $this->data['has_revision'] = 0;
        }
        
        $this->load->model('setting/application');

        $this->data['applications'] = $this->model_setting_application->getApplications();

        if (isset($this->request->post['content_application'])) {
                $this->data['content_application'] = $this->request->post['content_application'];
        } elseif (isset($this->request->get['content_id'])) {
                $this->data['content_application'] = $this->model_application_content->getContentApplications($this->request->get['content_id']);
        } else {
                $this->data['content_application'] = array(0);
        }
        
        $this->template = 'application/content_form.tpl';
        $this->children = array(
            'common/header',
            'common/footer'
        );

        $this->response->setOutput($this->render());
    }

    protected function validateForm() {
        if (!$this->user->hasPermission('modify', 'application/content')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        foreach ($this->request->post['content_description'] as $language_id => $value) {
            if ((utf8_strlen($value['title']) < 3) || (utf8_strlen($value['title']) > 255)) {
                $this->error['title'][$language_id] = $this->language->get('error_title');
            }

            if (utf8_strlen($value['description']) < 3) {
                $this->error['description'][$language_id] = $this->language->get('error_description');
            }
        }

        if (empty($this->request->post['type'])) {
            $this->error['type'] = $this->language->get('error_type');
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
        if (!$this->user->hasPermission('modify', 'application/content')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        if (!$this->error) {
            return true;
        } else {
            return false;
        }
    }

    protected function getRevision() {

        $this->load->model('application/content');
        
        $this->data['heading_title'] = $this->language->get('heading_title');
        
        $this->data['column_author'] = $this->language->get('column_author');
        $this->data['column_date'] = $this->language->get('column_date');
        $this->data['column_ip'] = $this->language->get('column_ip');
        $this->data['column_message'] = $this->language->get('column_message');
        
        if (isset($this->request->get['page'])) {
            
            $page = $this->request->get['page'];
        } else {
            $page = 1;
        }

        $this->data['revisions'] = array();

        $total_revisions = $this->model_application_content->getTotalContentRevisions($this->request->get['content_id']);

        $results = $this->model_application_content->getContentRevisions($this->request->get['content_id'], ($page - 1) * 10, 10);

        $this->load->model('user/user');

        foreach ($results as $result) {

            $author_info = $this->model_user_user->getUser($result['author']);

            if (!empty($author_info['firstname'])) {

                $author = $author_info['firstname'] . ' ' . $author_info['lastname'];
            } else {
                $author = $author_info['username'];
            }

            $this->data['revisions'][] = array(
                'author' => $author,
                'date_modified' => date($this->language->get('date_format_short'), strtotime($result['revision_date'])),
                'ip' => $result['ip'],
                'message' => (!empty($result['message']) ? $result['message'] : $this->language->get('text_no_message'))
            );
        }

        $pagination = new Pagination();
        $pagination->total = $total_revisions;
        $pagination->page = $page;
        $pagination->limit = 10;
        $pagination->text = $this->language->get('text_pagination');
        $pagination->url = $this->url->link('application/content/revision', 'token=' . $this->session->data['token'] . '&content_id=' . $this->request->get['content_id'] . '&page={page}', 'SSL');

        $this->data['pagination'] = $pagination->render();

        $this->template = 'application/content_revision.tpl';
        
        $this->response->setOutput($this->render());
    }

}

