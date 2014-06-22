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
 * Semite LLC extension Class
 * Date : Jun 22, 2014
 */

class ModelSettingExtension extends Model {

    public function getInstalled($type) {
        $extension_data = array();

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "extension WHERE `type` = '" . $this->db->escape($type) . "'");

        foreach ($query->rows as $result) {
            $extension_data[] = $result['code'];
        }

        return $extension_data;
    }

    public function install($type, $code) {
        $this->db->query("INSERT INTO " . DB_PREFIX . "extension SET `type` = '" . $this->db->escape($type) . "', `code` = '" . $this->db->escape($code) . "'");
    }

    public function uninstall($type, $code) {
        $this->db->query("DELETE FROM " . DB_PREFIX . "extension WHERE `type` = '" . $this->db->escape($type) . "' AND `code` = '" . $this->db->escape($code) . "'");
    }

    public function sql($sql) {
        $query = '';

        foreach ($lines as $line) {
            if ($line && (substr($line, 0, 2) != '--') && (substr($line, 0, 1) != '#')) {
                $query .= $line;

                if (preg_match('/;\s*$/', $line)) {
                    $query = str_replace("DROP TABLE IF EXISTS `engine4_", "DROP TABLE IF EXISTS `" . $data['db_prefix'], $query);
                    $query = str_replace("CREATE TABLE `engine4_", "CREATE TABLE `" . $data['db_prefix'], $query);
                    $query = str_replace("INSERT INTO `engine4_", "INSERT INTO `" . $data['db_prefix'], $query);

                    $result = mysql_query($query, $connection);

                    if (!$result) {
                        die(mysql_error());
                    }

                    $query = '';
                }
            }
        }
    }

}


