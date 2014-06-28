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
 * Semite LLC module Class
 * Date : Jun 22, 2014
 */

class ControllerExtensionModule extends Controller {

    public function index() {
        $this->language->load('extension/module');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->data['breadcrumbs'] = array();

        $this->data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => false
        );

        $this->data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' :: '
        );

        $this->data['heading_title'] = $this->language->get('heading_title');

        $this->data['text_no_results'] = $this->language->get('text_no_results');
        $this->data['text_confirm'] = $this->language->get('text_confirm');


        if (isset($this->session->data['success'])) {
            $this->data['success'] = $this->session->data['success'];

            unset($this->session->data['success']);
        } else {
            $this->data['success'] = '';
        }

        if (isset($this->session->data['error'])) {
            $this->data['error'] = $this->session->data['error'];

            unset($this->session->data['error']);
        } else {
            $this->data['error'] = '';
        }

        $this->load->model('setting/extension');

        $extensions = $this->model_setting_extension->getInstalled('module');

        foreach ($extensions as $key => $value) {
            if (!file_exists(DIR_APPLICATION . 'controller/module/' . $value . '.php')) {
                $this->model_setting_extension->uninstall('module', $value);

                unset($extensions[$key]);
            }
        }

        $this->data['extensions'] = array();

        $files = glob(DIR_APPLICATION . 'controller/module/*.php');

        if ($files) {
            foreach ($files as $file) {
                $extension = basename($file, '.php');

                $this->language->load('module/' . $extension);

                $action = array();

                if (!in_array($extension, $extensions)) {
                    $action[] = array(
                        'text' => $this->language->get('text_install'),
                        'href' => $this->url->link('extension/module/install', 'token=' . $this->session->data['token'] . '&extension=' . $extension, 'SSL'),
                        'class' => 'btn-primary'
                    );
                } else {
                    $action[] = array(
                        'text' => $this->language->get('text_uninstall'),
                        'href' => $this->url->link('extension/module/uninstall', 'token=' . $this->session->data['token'] . '&extension=' . $extension, 'SSL'),
                        'class' => 'btn-danger'
                    );
                }

                $this->data['extensions'][] = array(
                    'name' => $this->language->get('heading_title'),
                    'description' => $this->language->get('module_description'),
                    'action' => $action
                );
            }
        }

        $this->template = 'extension/module.tpl';
        $this->children = array(
            'common/header',
            'common/footer'
        );

        $this->response->setOutput($this->render());
    }

    public function install() {
        $this->language->load('extension/module');

        if (!$this->user->hasPermission('modify', 'extension/module')) {
            $this->session->data['error'] = $this->language->get('error_permission');

            $this->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
        } else {
            $this->load->model('setting/extension');

            $this->model_setting_extension->install('module', $this->request->get['extension']);

            $this->load->model('user/user_group');

            $this->model_user_user_group->addPermission($this->user->getId(), 'access', 'module/' . $this->request->get['extension']);
            $this->model_user_user_group->addPermission($this->user->getId(), 'modify', 'module/' . $this->request->get['extension']);

            require_once(DIR_APPLICATION . 'controller/module/' . $this->request->get['extension'] . '.php');

            $class = 'ControllerModule' . str_replace('_', '', $this->request->get['extension']);
            $class = new $class($this->registry);

            if (method_exists($class, 'install')) {
                $class->install();
            }

            $this->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
        }
    }

    public function uninstall() {
        $this->language->load('extension/module');

        if (!$this->user->hasPermission('modify', 'extension/module')) {
            $this->session->data['error'] = $this->language->get('error_permission');

            $this->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
        } else {
            $this->load->model('setting/extension');
            $this->load->model('setting/setting');

            $this->model_setting_extension->uninstall('module', $this->request->get['extension']);

            $this->model_setting_setting->deleteSetting($this->request->get['extension']);

            require_once(DIR_APPLICATION . 'controller/module/' . $this->request->get['extension'] . '.php');

            $class = 'ControllerModule' . str_replace('_', '', $this->request->get['extension']);
            $class = new $class($this->registry);

            if (method_exists($class, 'uninstall')) {
                $class->uninstall();
            }

            $this->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
        }
    }

}

