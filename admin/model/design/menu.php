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
 * Semite LLC menu Class
 * Date : Jun 17, 2014
 */

class ModelDesignMenu extends Model {

    public function addMenu($data) {
        $this->db->query("INSERT INTO " . DB_PREFIX . "menu SET status = '" . (isset($data['status']) ? (int) $data['status'] : 0) . "', sort_order = '" . (isset($data['sort_order']) ? (int) $data['sort_order'] : 0) . "', position = '".$this->db->escape($data['position'])."', page_link = '".$this->db->escape($data['page_link'])."'");

        $menu_id = $this->db->getLastId();

        foreach ($data['menu_description'] as $language_id => $value) {
            $this->db->query("INSERT INTO " . DB_PREFIX . "menu_description SET menu_id = '" . (int) $menu_id . "', language_id = '" . (int) $language_id . "', title = '" . $this->db->escape($value['title']) . "'");
        }

  }

    public function editMenu($menu_id, $data) {
        $this->db->query("UPDATE " . DB_PREFIX . "menu SET status = '" . (isset($data['status']) ? (int) $data['status'] : 0) . "', sort_order = '" . (isset($data['sort_order']) ? (int) $data['sort_order'] : 0) . "',position = '".$this->db->escape($data['position'])."',page_link = '".$this->db->escape($data['page_link'])."' WHERE menu_id = '" . (int) $menu_id . "'");

        $this->db->query("DELETE FROM " . DB_PREFIX . "menu_description WHERE menu_id = '" . (int) $menu_id . "'");

        foreach ($data['menu_description'] as $language_id => $value) {
            $this->db->query("INSERT INTO " . DB_PREFIX . "menu_description SET menu_id = '" . (int) $menu_id . "', language_id = '" . (int) $language_id . "', title = '" . $this->db->escape($value['title']) . "'");
        }

  }

    public function getMenu($menu_id) {
        $query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "menu WHERE menu_id = '" . (int) $menu_id . "'");

        return $query->row;
    }

    public function getMenus($data = array()) {
        $sql = "SELECT * FROM " . DB_PREFIX . "menu m LEFT JOIN " . DB_PREFIX . "menu_description md ON(m.menu_id = md.menu_id) WHERE md.language_id = '" . (int) $this->config->get('config_language_id') . "'";

        $sort_data = array('md.title');

        if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
            $sql .= " ORDER BY " . $data['sort'];
        } else {
            $sql .= " ORDER BY md.title";
        }

        if (isset($data['order']) && ($data['order'] == 'DESC')) {
            $sql .= " DESC";
        } else {
            $sql .= " ASC";
        }

        if (isset($data['start']) || isset($data['limit'])) {
            if ($data['start'] < 0) {
                $data['start'] = 0;
            }

            if ($data['limit'] < 1) {
                $data['limit'] = 20;
            }

            $sql .= " LIMIT " . (int) $data['start'] . "," . (int) $data['limit'];
        }

        $query = $this->db->query($sql);

        return $query->rows;
    }

    public function deleteMenu($menu_id) {
        $this->db->query("DELETE FROM " . DB_PREFIX . "menu WHERE menu_id = '" . (int) $menu_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "menu_description WHERE menu_id = '" . (int) $menu_id . "'");
    }

    public function getMenuDescriptions($menu_id) {
        $menu_description_data = array();

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "menu_description WHERE menu_id = '" . (int) $menu_id . "'");

        foreach ($query->rows as $result) {
            $menu_description_data[$result['language_id']] = array(
                'title' => $result['title'],
            );
        }

        return $menu_description_data;
    }

    public function getTotalMenus() {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "menu");

        return $query->row['total'];
    }

}

