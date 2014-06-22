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
 * Description of header
 *
 * @author ahmet
 */
class ControllerCommonHeader extends Controller{
    
    protected function index() {

        $this->data['title'] = $this->document->getTitle();

        if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) {
            $this->data['base'] = HTTPS_SERVER;
        } else {
            $this->data['base'] = HTTP_SERVER;
        }

        $this->data['description'] = $this->document->getDescription();
        $this->data['keywords'] = $this->document->getKeywords();
        $this->data['links'] = $this->document->getLinks();
        $this->data['styles'] = $this->document->getStyles();
        $this->data['scripts'] = $this->document->getScripts();
        $this->data['lang'] = $this->language->get('code');
        $this->data['direction'] = $this->language->get('direction');

        $this->language->load('common/header');

        $this->data['heading_title'] = $this->language->get('heading_title');
        $this->data['application_owner'] = $this->config->get('config_name');
        $this->data['text_profile'] = $this->language->get('text_profile');
        $this->data['text_dashboard'] = $this->language->get('text_dashboard');
        //Application Menu
            $this->data['text_application'] = $this->config->get('config_name');
            $this->data['text_content'] = $this->language->get('text_content');
            $this->data['text_content_type'] = $this->language->get('text_content_type');
            $this->data['text_pages'] = $this->language->get('text_pages');
            $this->data['text_block'] = $this->language->get('text_block');
            $this->data['text_menu'] = $this->language->get('text_menu');
        // Extension Menu
            $this->data['text_extension'] = $this->language->get('text_extension');
            $this->data['text_module'] = $this->language->get('text_module');
        //System Menu
            $this->data['text_system'] = $this->language->get('text_system');
            $this->data['text_setting'] = $this->language->get('text_setting');
            $this->data['text_design'] = $this->language->get('text_design');
            $this->data['text_layout'] = $this->language->get('text_layout');
            $this->data['text_page'] = $this->language->get('text_page');
            $this->data['text_add_new'] = $this->language->get('text_add_new');
            $this->data['text_users'] = $this->language->get('text_users');
            $this->data['text_user'] = $this->language->get('text_user');
            $this->data['text_user_group'] = $this->language->get('text_user_group');
            $this->data['text_localisations'] = $this->language->get('text_localisations');
            $this->data['text_language'] = $this->language->get('text_language');
            $this->data['text_currency'] = $this->language->get('text_currency');
            $this->data['text_country'] = $this->language->get('text_country');
            $this->data['text_zone'] = $this->language->get('text_zone');
            $this->data['text_tool'] = $this->language->get('text_tool');
            $this->data['text_error_log'] = $this->language->get('text_error_log');
            $this->data['text_backup'] = $this->language->get('text_backup');
        // Report Menu
            $this->data['text_report'] = $this->language->get('text_report');
        // Help Menu
            $this->data['text_help'] = $this->language->get('text_help');
            $this->data['text_semitepayment'] = $this->language->get('text_semitepayment');
            $this->data['text_documentation'] = $this->language->get('text_documentation');
            $this->data['text_support'] = $this->language->get('text_support');
        $this->data['text_logout'] = $this->language->get('text_logout');
        $this->data['text_front'] = sprintf($this->language->get('text_front'),$this->config->get('config_name'));
        

        if (!$this->user->isLogged() || !isset($this->request->get['token']) || !isset($this->session->data['token']) || ($this->request->get['token'] != $this->session->data['token'])) {
            $this->data['logged'] = false;

            $this->data['home'] = $this->url->link('common/login', '', 'SSL');
        } else {
            $this->data['logged'] = sprintf($this->language->get('text_logged'), $this->user->getUserName());
            $this->data['avatar'] = $this->user->getAvatar();
            $this->data['fullname'] = $this->user->getFullName();

            $this->data['home'] = $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL');
            // Application Menu
                $this->data['content'] = $this->url->link('application/content', 'token=' . $this->session->data['token'], 'SSL');
                $this->data['content_type'] = $this->url->link('application/content_type', 'token=' . $this->session->data['token'], 'SSL');
            // Extension Menu
                $this->data['module'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');
            // System Menu
                $this->data['setting'] = $this->url->link('setting/application', 'token=' . $this->session->data['token'], 'SSL');
                $this->data['layout'] = $this->url->link('design/layout', 'token=' . $this->session->data['token'], 'SSL');
                $this->data['page'] = $this->url->link('design/page', 'token=' . $this->session->data['token'], 'SSL');
                $this->data['block'] = $this->url->link('design/block', 'token=' . $this->session->data['token'], 'SSL');
                $this->data['menu'] = $this->url->link('design/menu', 'token=' . $this->session->data['token'], 'SSL');
                $this->data['new_page'] = $this->url->link('design/page/insert', 'token=' . $this->session->data['token'], 'SSL');
                $this->data['user'] = $this->url->link('user/user', 'token=' . $this->session->data['token'], 'SSL');
                $this->data['user_group'] = $this->url->link('user/user_permission', 'token=' . $this->session->data['token'], 'SSL');
                $this->data['language'] = $this->url->link('localisation/language', 'token=' . $this->session->data['token'], 'SSL');
                $this->data['currency'] = $this->url->link('localisation/currency', 'token=' . $this->session->data['token'], 'SSL');
                $this->data['country'] = $this->url->link('localisation/country', 'token=' . $this->session->data['token'], 'SSL');
                $this->data['zone'] = $this->url->link('localisation/zone', 'token=' . $this->session->data['token'], 'SSL');
                $this->data['error_log'] = $this->url->link('tool/error_log', 'token=' . $this->session->data['token'], 'SSL');
                $this->data['backup'] = $this->url->link('tool/backup', 'token=' . $this->session->data['token'], 'SSL');
                
                $this->data['profile'] = $this->url->link('user/user/update','token='.$this->session->data['token'].'&user_id='.$this->user->getId(),'SSL');
            // Report Menu
            // Help Menu
                $this->data['semitepayment'] = HTTPS_PUBLIC;
                $this->data['documentation'] = HTTP_DOCUMENTATION;
                $this->data['support'] = HTTP_SUPPORT;
            $this->data['front'] = HTTP_PUBLIC;
            $this->data['logout'] = $this->url->link('common/logout', 'token=' . $this->session->data['token'], 'SSL');
        }


        $this->template = 'common/header.tpl';

        $this->render();
    }

}
