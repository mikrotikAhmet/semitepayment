<?php

if (!defined('DIR_APPLICATION'))
    exit('No direct script access allowed');

/**
 * CodeIgniter
 *
 * An open source design development framework for PHP 5.1.6 or newer
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
 * Semite LLC page Class
 * Date : Jun 16, 2014
 */

class ControllerDesignPage extends Controller {

    private $error = array();

    public function index() {
        $this->language->load('design/page');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('design/page');

        $this->getList();
    }

    public function insert() {
        $this->language->load('design/page');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('design/page');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
            $this->model_design_page->addPage($this->request->post);

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

            $this->redirect($this->url->link('design/page', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }

        $this->getForm();
    }

    public function update() {
        $this->language->load('design/page');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('design/page');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {

            $this->model_design_page->editPage($this->request->get['page_id'], $this->request->post);

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

            $this->redirect($this->url->link('design/page', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }

        $this->getForm();
    }

    public function delete() {
        $this->language->load('design/page');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('design/page');

        if (isset($this->request->post['selected']) && $this->validateDelete()) {
            foreach ($this->request->post['selected'] as $page_id) {
                $this->model_design_page->deletePage($page_id);
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

            $this->redirect($this->url->link('design/page', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }

        $this->getList();
    }

    protected function getList() {
        if (isset($this->request->get['sort'])) {
            $sort = $this->request->get['sort'];
        } else {
            $sort = 'pd.title';
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
            'href' => $this->url->link('design/page', 'token=' . $this->session->data['token'] . $url, 'SSL'),
            'separator' => ' :: '
        );

        $this->data['insert'] = $this->url->link('design/page/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
        $this->data['delete'] = $this->url->link('design/page/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');

        $this->data['pages'] = array();

        $data = array(
            'sort' => $sort,
            'order' => $order,
            'start' => ($page - 1) * $this->config->get('config_admin_limit'),
            'limit' => $this->config->get('config_admin_limit')
        );

        $page_total = $this->model_design_page->getTotalPages();

        $results = $this->model_design_page->getPages($data);

        foreach ($results as $result) {
            $action = array();

            $action[] = array(
                'text' => $this->language->get('text_edit'),
                'href' => $this->url->link('design/page/update', 'token=' . $this->session->data['token'] . '&page_id=' . $result['page_id'] . $url, 'SSL')
            );

            $this->data['pages'][] = array(
                'page_id' => $result['page_id'],
                'title' => $result['title'].($result['page_id'] == $this->config->get('config_page_id') ? $this->language->get('text_default') : ''),
                'status' => ($result['status'] ? '<span class="label label-success">' . $this->language->get('text_enabled') . '</span>' : '<span class="label label-danger">' . $this->language->get('text_disabled') . '</span>'),
                'protected'=> ($result['protected'] ? '<span class="btn btn-danger btn-icon btn-xs tip" title="" data-original-title="'.$this->language->get('text_protected').'"><i class="icon-lock2"></i> '.$this->language->get('text_protected').'</span>' : '<span class="btn btn-success btn-icon btn-xs tip" title="" data-original-title="'.$this->language->get('text_unprotected').'"><i class="icon-unlocked"></i> '.$this->language->get('text_unprotected').'</span>'),
                'selected' => isset($this->request->post['selected']) && in_array($result['page_id'], $this->request->post['selected']),
                'action' => $action
            );
        }

        $this->data['heading_title'] = $this->language->get('heading_title');

        $this->data['text_no_results'] = $this->language->get('text_no_results');

        $this->data['column_title'] = $this->language->get('column_title');
        $this->data['column_status'] = $this->language->get('column_status');
        $this->data['column_protected'] = $this->language->get('column_protected');
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

        $this->data['sort_title'] = $this->url->link('design/page', 'token=' . $this->session->data['token'] . '&sort=pd.title' . $url, 'SSL');

        $url = '';

        if (isset($this->request->get['sort'])) {
            $url .= '&sort=' . $this->request->get['sort'];
        }

        if (isset($this->request->get['order'])) {
            $url .= '&order=' . $this->request->get['order'];
        }

        $pagination = new Pagination();
        $pagination->total = $page_total;
        $pagination->page = $page;
        $pagination->limit = $this->config->get('config_admin_limit');
        $pagination->text = $this->language->get('text_pagination');
        $pagination->url = $this->url->link('design/page', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

        $this->data['pagination'] = $pagination->render();

        $this->data['sort'] = $sort;
        $this->data['order'] = $order;

        $this->template = 'design/page_list.tpl';
        $this->children = array(
            'common/header',
            'common/footer'
        );

        $this->response->setOutput($this->render());
    }

    protected function getForm() {
        $this->data['heading_title'] = $this->language->get('heading_title');

        $this->document->addScript('view/javascript/jquery/tabs.js');

        $this->data['text_enabled'] = $this->language->get('text_enabled');
        $this->data['text_default'] = $this->language->get('text_default');
        $this->data['text_disabled'] = $this->language->get('text_disabled');
        $this->data['text_select'] = $this->language->get('text_select');
        $this->data['text_image_manager'] = $this->language->get('text_image_manager');
        $this->data['text_browse'] = $this->language->get('text_browse');
        $this->data['text_clear'] = $this->language->get('text_clear');

        $this->data['entry_title'] = $this->language->get('entry_title');
        $this->data['entry_sub_title'] = $this->language->get('entry_sub_title');
        $this->data['entry_meta_description'] = $this->language->get('entry_meta_description');
        $this->data['entry_meta_keyword'] = $this->language->get('entry_meta_keyword');
        $this->data['entry_layout'] = $this->language->get('entry_layout');
        $this->data['entry_image'] = $this->language->get('entry_image');
        $this->data['entry_application'] = $this->language->get('entry_application');
        $this->data['entry_description'] = $this->language->get('entry_description');
        $this->data['entry_keyword'] = $this->language->get('entry_keyword');
        $this->data['entry_permalink'] = $this->language->get('entry_permalink');
        $this->data['entry_show_title'] = $this->language->get('entry_show_title');
        $this->data['entry_show_sub_title'] = $this->language->get('entry_show_sub_title');
        $this->data['entry_show_breadcrumb'] = $this->language->get('entry_show_breadcrumb');
        $this->data['entry_protected'] = $this->language->get('entry_protected');
        $this->data['entry_ssl'] = $this->language->get('entry_ssl');
        $this->data['entry_status'] = $this->language->get('entry_status');
        
        $this->data['permalink'] = HTTPS_PUBLIC;

        $this->data['tab_general'] = $this->language->get('tab_general');
        $this->data['tab_data'] = $this->language->get('tab_data');
        $this->data['tab_links'] = $this->language->get('tab_links');

        $this->data['button_save'] = $this->language->get('button_save');
        $this->data['button_cancel'] = $this->language->get('button_cancel');
        $this->data['button_add_block'] = $this->language->get('button_add_block');
        $this->data['button_remove'] = $this->language->get('button_remove');

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
            'href' => $this->url->link('design/page', 'token=' . $this->session->data['token'] . $url, 'SSL'),
            'separator' => ' :: '
        );

        if (!isset($this->request->get['page_id'])) {
            $this->data['action'] = $this->url->link('design/page/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
        } else {
            $this->data['action'] = $this->url->link('design/page/update', 'token=' . $this->session->data['token'] . '&page_id=' . $this->request->get['page_id'] . $url, 'SSL');
        }

        if (isset($this->request->get['page_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
            $page_info = $this->model_design_page->getPage($this->request->get['page_id']);
        }

        $this->data['cancel'] = $this->url->link('design/page', 'token=' . $this->session->data['token'] . $url, 'SSL');

        $this->data['token'] = $this->session->data['token'];

        $this->load->model('localisation/language');

        $this->data['languages'] = $this->model_localisation_language->getLanguages();

        if (isset($this->request->post['page_description'])) {
            $this->data['page_description'] = $this->request->post['page_description'];
        } elseif (isset($this->request->get['page_id'])) {
            $this->data['page_description'] = $this->model_design_page->getPageDescriptions($this->request->get['page_id']);
        } else {
            $this->data['page_description'] = array();
        }

        if (isset($this->request->post['image'])) {
            $this->data['image'] = $this->request->post['image'];
        } elseif (!empty($page_info)) {
            $this->data['image'] = $page_info['image'];
        } else {
            $this->data['image'] = '';
        }

        $this->load->model('tool/image');

        if (isset($this->request->post['image']) && file_exists(DIR_IMAGE . $this->request->post['image'])) {
            $this->data['thumb'] = $this->model_tool_image->resize($this->request->post['image'], 100, 100);
        } elseif (!empty($page_info) && $page_info['image'] && file_exists(DIR_IMAGE . $page_info['image'])) {
            $this->data['thumb'] = $this->model_tool_image->resize($page_info['image'], 100, 100);
        } else {
            $this->data['thumb'] = $this->model_tool_image->resize('no_image.jpg', 100, 100);
        }

        $this->data['no_image'] = $this->model_tool_image->resize('no_image.jpg', 100, 100);

        if (isset($this->request->post['show_title'])) {
            $this->data['show_title'] = $this->request->post['show_title'];
        } elseif (!empty($page_info)) {
            $this->data['show_title'] = $page_info['show_title'];
        } else {
            $this->data['show_title'] = 0;
        }
        
        if (isset($this->request->post['show_sub_title'])) {
            $this->data['show_sub_title'] = $this->request->post['show_sub_title'];
        } elseif (!empty($page_info)) {
            $this->data['show_sub_title'] = $page_info['show_sub_title'];
        } else {
            $this->data['show_sub_title'] = 0;
        }

        if (isset($this->request->post['show_breadcrumb'])) {
            $this->data['show_breadcrumb'] = $this->request->post['show_breadcrumb'];
        } elseif (!empty($page_info)) {
            $this->data['show_breadcrumb'] = $page_info['show_breadcrumb'];
        } else {
            $this->data['show_breadcrumb'] = 0;
        }
        
         if (isset($this->request->post['protected'])) {
            $this->data['protected'] = $this->request->post['protected'];
        } elseif (!empty($page_info)) {
            $this->data['protected'] = $page_info['protected'];
        } else {
            $this->data['protected'] = 0;
        }
        
         if (isset($this->request->post['ssl'])) {
            $this->data['ssl'] = $this->request->post['ssl'];
        } elseif (!empty($page_info)) {
            $this->data['ssl'] = $page_info['ssl'];
        } else {
            $this->data['ssl'] = 0;
        }
        
         if (isset($this->request->post['status'])) {
            $this->data['status'] = $this->request->post['status'];
        } elseif (!empty($page_info)) {
            $this->data['status'] = $page_info['status'];
        } else {
            $this->data['status'] = 0;
        }
        
        if (isset($this->request->post['keyword'])) {
            $this->data['keyword'] = $this->request->post['keyword'];
        } elseif (!empty($page_info)) {
            $this->data['keyword'] = $page_info['keyword'];
        } else {
            $this->data['keyword'] = '';
        }

        if (isset($this->request->post['page_layout'])) {
            $this->data['page_layout'] = $this->request->post['page_layout'];
        } elseif (isset($this->request->get['page_id'])) {
            $this->data['page_layout'] = $this->model_design_page->getPageLayouts($this->request->get['page_id']);
        } else {
            $this->data['page_layout'] = array();
        }

        $this->load->model('design/layout');

        $this->data['layouts'] = $this->model_design_layout->getLayouts();
        
        $this->load->model('setting/application');

        $this->data['applications'] = $this->model_setting_application->getApplications();

        if (isset($this->request->post['page_application'])) {
            $this->data['page_application'] = $this->request->post['page_application'];
        } elseif (isset($this->request->get['page_id'])) {
            $this->data['page_application'] = $this->model_design_page->getPageApplications($this->request->get['page_id']);
        } else {
            $this->data['page_application'] = array(0);
        }


        $this->template = 'design/page_form.tpl';
        $this->children = array(
            'common/header',
            'common/footer'
        );

        $this->response->setOutput($this->render());
    }

    protected function validateForm() {
        if (!$this->user->hasPermission('modify', 'design/page')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        foreach ($this->request->post['page_description'] as $language_id => $value) {
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
        if (!$this->user->hasPermission('modify', 'design/page')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }
        
        $this->load->model('setting/application');
        
        foreach ($this->request->post['selected'] as $page_id) {
            if ($this->config->get('config_page_id') == $page_id) {
                $this->error['warning'] = $this->language->get('error_default');
            }
            
            $application_total = $this->model_setting_application->getTotalApplicationsByPageId($page_id);

            if ($application_total) {
                $this->error['warning'] = sprintf($this->language->get('error_application'), $application_total);
            }
        }

        if (!$this->error) {
            return true;
        } else {
            return false;
        }
    }

}

