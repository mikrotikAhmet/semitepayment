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
 * Semite LLC menu Class
 * Date : Jun 17, 2014
 */

class ControllerDesignMenu extends Controller {

    private $error = array();

    public function index() {
        $this->language->load('design/menu');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('design/menu');

        $this->getList();
    }

    public function insert() {
        $this->language->load('design/menu');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('design/menu');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
            $this->model_design_menu->addMenu($this->request->post);

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

            $this->redirect($this->url->link('design/menu', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }

        $this->getForm();
    }

    public function update() {
        $this->language->load('design/menu');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('design/menu');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {

            $this->model_design_menu->editMenu($this->request->get['menu_id'], $this->request->post);

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

            $this->redirect($this->url->link('design/menu', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }

        $this->getForm();
    }

    public function delete() {
        $this->language->load('design/menu');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('design/menu');

        if (isset($this->request->post['selected']) && $this->validateDelete()) {
            foreach ($this->request->post['selected'] as $menu_id) {
                $this->model_design_menu->deleteMenu($menu_id);
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
            $this->redirect($this->url->link('design/menu', 'token=' . $this->session->data['token'] . $url, 'SSL'));
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
            'href' => $this->url->link('design/menu', 'token=' . $this->session->data['token'] . $url, 'SSL'),
            'separator' => ' :: '
        );

        $this->data['insert'] = $this->url->link('design/menu/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
        $this->data['delete'] = $this->url->link('design/menu/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');

        $this->data['menus'] = array();

        $data = array(
            'sort' => $sort,
            'order' => $order,
            'start' => ($page - 1) * $this->config->get('config_admin_limit'),
            'limit' => $this->config->get('config_admin_limit')
        );

        $menu_total = $this->model_design_menu->getTotalMenus();

        $results = $this->model_design_menu->getMenus($data);

        foreach ($results as $result) {
            $action = array();

            $action[] = array(
                'text' => $this->language->get('text_edit'),
                'href' => $this->url->link('design/menu/update', 'token=' . $this->session->data['token'] . '&menu_id=' . $result['menu_id'] . $url, 'SSL')
            );

            $this->data['menus'][] = array(
                'menu_id' => $result['menu_id'],
                'title' => $result['title'],
                'selected' => isset($this->request->post['selected']) && in_array($result['menu_id'], $this->request->post['selected']),
                'action' => $action
            );
        }

        $this->data['heading_title'] = $this->language->get('heading_title');

        $this->data['text_no_results'] = $this->language->get('text_no_results');

        $this->data['column_title'] = $this->language->get('column_title');
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

        $this->data['sort_title'] = $this->url->link('design/menu', 'token=' . $this->session->data['token'] . '&sort=md.title' . $url, 'SSL');

        $url = '';

        if (isset($this->request->get['sort'])) {
            $url .= '&sort=' . $this->request->get['sort'];
        }

        if (isset($this->request->get['order'])) {
            $url .= '&order=' . $this->request->get['order'];
        }

        $pagination = new Pagination();
        $pagination->total = $menu_total;
        $pagination->page = $page;
        $pagination->limit = $this->config->get('config_admin_limit');
        $pagination->text = $this->language->get('text_pagination');
        $pagination->url = $this->url->link('design/menu', 'token=' . $this->session->data['token'] . $url . '&menu={menu}', 'SSL');

        $this->data['pagination'] = $pagination->render();

        $this->data['sort'] = $sort;
        $this->data['order'] = $order;

        $this->template = 'design/menu_list.tpl';
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
        $this->data['text_disabled'] = $this->language->get('text_disabled');
        $this->data['text_select'] = $this->language->get('text_select');
        $this->data['text_left'] = $this->language->get('text_left');
        $this->data['text_right'] = $this->language->get('text_right');
        $this->data['text_data_link'] = $this->language->get('text_data_link');

        $this->data['entry_title'] = $this->language->get('entry_title');
        $this->data['entry_link'] = $this->language->get('entry_link');
        $this->data['entry_external_link'] = $this->language->get('entry_external_link');
        $this->data['entry_position'] = $this->language->get('entry_position');
        $this->data['entry_bottom'] = $this->language->get('entry_bottom');
        $this->data['entry_status'] = $this->language->get('entry_status');
        $this->data['entry_sort_order'] = $this->language->get('entry_sort_order');

        $this->data['tab_general'] = $this->language->get('tab_general');
        $this->data['tab_data'] = $this->language->get('tab_data');

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
            'href' => $this->url->link('design/menu', 'token=' . $this->session->data['token'] . $url, 'SSL'),
            'separator' => ' :: '
        );

        if (!isset($this->request->get['menu_id'])) {
            $this->data['action'] = $this->url->link('design/menu/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
        } else {
            $this->data['action'] = $this->url->link('design/menu/update', 'token=' . $this->session->data['token'] . '&menu_id=' . $this->request->get['menu_id'] . $url, 'SSL');
        }

        if (isset($this->request->get['menu_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
            $menu_info = $this->model_design_menu->getMenu($this->request->get['menu_id']);
        }

        $this->data['cancel'] = $this->url->link('design/menu', 'token=' . $this->session->data['token'] . $url, 'SSL');

        $this->data['token'] = $this->session->data['token'];

        $this->load->model('localisation/language');

        $this->data['languages'] = $this->model_localisation_language->getLanguages();

        if (isset($this->request->post['menu_description'])) {
            $this->data['menu_description'] = $this->request->post['menu_description'];
        } elseif (isset($this->request->get['menu_id'])) {
            $this->data['menu_description'] = $this->model_design_menu->getMenuDescriptions($this->request->get['menu_id']);
        } else {
            $this->data['menu_description'] = array();
        }
        
        if (isset($this->request->post['page_link'])) {
            $this->data['page_link'] = $this->request->post['page_link'];
        } elseif (!empty($menu_info)) {
            $this->data['page_link'] = str_replace("page_id=", "", $menu_info['page_link']);
        } else {
            $this->data['page_link'] = '';
        }
        
        if (isset($this->request->post['external_link'])) {
            $this->data['external_link'] = $this->request->post['external_link'];
        } elseif (!empty($menu_info)) {
            $this->data['external_link'] = $menu_info['external_link'];
        } else {
            $this->data['external_link'] = '';
        }
        
        $this->load->model('design/page');
        
        $this->data['pages'] = $this->model_design_page->getPages();
        
        if (isset($this->request->post['position'])) {
            $this->data['position'] = $this->request->post['position'];
        } elseif (!empty($menu_info)) {
            $this->data['position'] = $menu_info['position'];
        } else {
            $this->data['position'] = '';
        }
        
        if (isset($this->request->post['bottom'])) {
            $this->data['bottom'] = $this->request->post['bottom'];
        } elseif (!empty($menu_info)) {
            $this->data['bottom'] = $menu_info['bottom'];
        } else {
            $this->data['bottom'] = 0;
        }

        if (isset($this->request->post['status'])) {
            $this->data['status'] = $this->request->post['status'];
        } elseif (!empty($menu_info)) {
            $this->data['status'] = $menu_info['status'];
        } else {
            $this->data['status'] = 1;
        }

        if (isset($this->request->post['sort_order'])) {
            $this->data['sort_order'] = $this->request->post['sort_order'];
        } elseif (!empty($menu_info)) {
            $this->data['sort_order'] = $menu_info['sort_order'];
        } else {
            $this->data['sort_order'] = 0;
        }

        $this->template = 'design/menu_form.tpl';
        $this->children = array(
            'common/header',
            'common/footer'
        );

        $this->response->setOutput($this->render());
    }

    protected function validateForm() {
        if (!$this->user->hasPermission('modify', 'design/menu')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        foreach ($this->request->post['menu_description'] as $language_id => $value) {
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
        if (!$this->user->hasPermission('modify', 'design/menu')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        if (!$this->error) {
            return true;
        } else {
            return false;
        }
    }

}

