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
 * Date : Jun 23, 2014
 */

class ControllerCommonModule extends Controller{
    
    protected function index() {
        
        $module = $this->getChild('module/registration');
        
        if ($module) {
                $this->data['module'] = $module;
        }
        
        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/module.tpl')) {
                $this->template = $this->config->get('config_template') . '/template/common/module.tpl';
        } else {
                $this->template = 'default/template/common/module.tpl';
        }

        $this->render();
    }
}

