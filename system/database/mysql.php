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
 * Semite LLC mysql Class
 * Date : Jun 14, 2014
 */

final class DBMySQL {

    private $link;

    public function __construct($hostname, $username, $password, $database) {
        if (!$this->link = mysql_connect($hostname, $username, $password)) {
            trigger_error('Error: Could not make a database link using ' . $username . '@' . $hostname);
        }

        if (!mysql_select_db($database, $this->link)) {
            trigger_error('Error: Could not connect to database ' . $database);
        }

        mysql_query("SET NAMES 'utf8'", $this->link);
        mysql_query("SET CHARACTER SET utf8", $this->link);
        mysql_query("SET CHARACTER_SET_CONNECTION=utf8", $this->link);
        mysql_query("SET SQL_MODE = ''", $this->link);
    }

    public function query($sql) {
        $resource = mysql_query($sql, $this->link);

        if ($resource) {
            if (is_resource($resource)) {
                $i = 0;

                $data = array();

                while ($result = mysql_fetch_assoc($resource)) {
                    $data[$i] = $result;

                    $i++;
                }

                mysql_free_result($resource);

                $query = new stdClass();
                $query->row = isset($data[0]) ? $data[0] : array();
                $query->rows = $data;
                $query->num_rows = $i;

                unset($data);

                return $query;
            } else {
                return true;
            }
        } else {
            trigger_error('Error: ' . mysql_error($this->link) . '<br />Error No: ' . mysql_errno($this->link) . '<br />' . $sql);
            exit();
        }
    }

    public function escape($value) {
        return mysql_real_escape_string($value, $this->link);
    }

    public function countAffected() {
        return mysql_affected_rows($this->link);
    }

    public function getLastId() {
        return mysql_insert_id($this->link);
    }

    public function __destruct() {
        mysql_close($this->link);
    }

}

