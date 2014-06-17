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
 * Semite LLC page Class
 * Date : Jun 16, 2014
 */

class ControllerDesignPage extends Controller {

    public $page_info = array();

    public function index() {

        $this->page_info = $this->page->getPage();
        
        if ($this->page_info) {

            if ($this->page->getDescription()) {
                $this->document->setDescription($this->page->getDescription());
            } else {
               $this->document->setDescription($this->config->get('config_meta_description'));
            }
            
            $this->document->setKeywords($this->page->getKeyword());

            $this->document->setTitle($this->config->get('config_title') . $this->language->get('text_separator') . $this->page->getPageTitle());
            
            $this->data['heading_title'] = $this->config->get('config_title');

            if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/design/page.tpl')) {
                $this->template = $this->config->get('config_template') . '/template/design/page.tpl';
            } else {
                $this->template = 'default/template/design/page.tpl';
            }
        } else {

            error_log('ajajajaj');
//            throw new Exception('Page Not Found');
            exit(1);
        }

        $this->children = array(
            'common/footer',
            'common/header'
        );

        $this->response->setOutput($this->render());
    }

}

