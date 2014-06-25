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
 * Semite LLC loader Class
 * Date : Jun 14, 2014
 */

final class Loader {

    protected $registry;

    public function __construct($registry) {
        $this->registry = $registry;
    }

    public function __get($key) {
        return $this->registry->get($key);
    }

    public function __set($key, $value) {
        $this->registry->set($key, $value);
    }

    public function library($library) {
        $file = DIR_SYSTEM . 'library/' . $library . '.php';

        if (file_exists($file)) {
            include_once($file);
        } else {
            trigger_error('Error: Could not load library ' . $library . '!');
            exit();
        }
    }
    
    public function helper($helper) {
        $file = DIR_SYSTEM . 'helper/' . $helper . '.php';

        if (file_exists($file)) {
            include_once($file);
        } else {
            trigger_error('Error: Could not load helper ' . $helper . '!');
            exit();
        }
    }

    public function model($model) {
        $file = DIR_APPLICATION . 'model/' . $model . '.php';
        $class = 'Model' . preg_replace('/[^a-zA-Z0-9]/', '', $model);

        if (file_exists($file)) {
            include_once($file);

            $this->registry->set('model_' . str_replace('/', '_', $model), new $class($this->registry));
        } else {
            trigger_error('Error: Could not load model ' . $model . '!');
            exit();
        }
    }

    public function database($driver, $hostname, $username, $password, $database) {
        $file = DIR_SYSTEM . 'database/' . $driver . '.php';
        $class = 'Database' . preg_replace('/[^a-zA-Z0-9]/', '', $driver);

        if (file_exists($file)) {
            include_once($file);

            $this->registry->set(str_replace('/', '_', $driver), new $class($hostname, $username, $password, $database));
        } else {
            trigger_error('Error: Could not load database ' . $driver . '!');
            exit();
        }
    }

    public function config($config) {
        $this->config->load($config);
    }

    public function language($language) {
        return $this->language->load($language);
    }

}

