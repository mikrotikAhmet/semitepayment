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
 * Semite LLC action Class
 * Date : Jun 14, 2014
 */

final class Action {

    protected $file;
    protected $class;
    protected $method;
    protected $args = array();

    public function __construct($route, $args = array()) {
        $path = '';

        $parts = explode('/', str_replace('../', '', (string) $route));

        foreach ($parts as $part) {
            $path .= $part;

            if (is_dir(DIR_APPLICATION . 'controller/' . $path)) {
                $path .= '/';

                array_shift($parts);

                continue;
            }

            if (is_file(DIR_APPLICATION . 'controller/' . str_replace(array('../', '..\\', '..'), '', $path) . '.php')) {
                $this->file = DIR_APPLICATION . 'controller/' . str_replace(array('../', '..\\', '..'), '', $path) . '.php';

                $this->class = 'Controller' . preg_replace('/[^a-zA-Z0-9]/', '', $path);

                array_shift($parts);

                break;
            }
        }

        if ($args) {
            $this->args = $args;
        }

        $method = array_shift($parts);

        if ($method) {
            $this->method = $method;
        } else {
            $this->method = 'index';
        }
    }

    public function getFile() {
        return $this->file;
    }

    public function getClass() {
        return $this->class;
    }

    public function getMethod() {
        return $this->method;
    }

    public function getArgs() {
        return $this->args;
    }

}

