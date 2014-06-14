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
 * Semite LLC content_type Class
 * Date : Jun 14, 2014
 */

class ModelApplicationContentType extends Model {

    public function addContentType($data) {
        $this->db->query("INSERT INTO " . DB_PREFIX . "content_type SET name = '" . $this->db->escape($data['name']) . "'");

        $content_type_id = $this->db->getLastId();

        if (isset($data['content_field'])) {
            foreach ($data['content_field'] as $content_field) {
                $this->db->query("INSERT INTO " . DB_PREFIX . "content_type_field SET content_type_id = '" . (int) $content_type_id . "', field = '" . $this->db->escape($content_field['field']) . "', status = '" . (isset($content_field['status']) ? (int) $content_field['status'] : 0) . "'");
            }
        }
    }

    public function editContentType($content_type_id, $data) {
        $this->db->query("UPDATE " . DB_PREFIX . "content_type SET name = '" . $this->db->escape($data['name']) . "'  WHERE content_type_id = '" . (int) $content_type_id . "'");

        $this->db->query("DELETE FROM " . DB_PREFIX . "content_type_field WHERE content_type_id = '" . (int) $content_type_id . "'");

        if (isset($data['content_field'])) {
            foreach ($data['content_field'] as $content_field) {
                $this->db->query("INSERT INTO " . DB_PREFIX . "content_type_field SET content_type_id = '" . (int) $content_type_id . "', field = '" . $this->db->escape($content_field['field']) . "', status = '" . (isset($content_field['status']) ? (int) $content_field['status'] : 0). "'");
            }
        }
    }

    public function deleteContentType($content_type_id) {
        $this->db->query("DELETE FROM " . DB_PREFIX . "content_type WHERE content_type_id = '" . (int) $content_type_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "content_type_field WHERE content_type_id = '" . (int) $content_type_id . "'");
    }

    public function getContentType($content_type_id) {
        $query = $this->db->query("SELECT DISTINCT *  FROM " . DB_PREFIX . "content_type WHERE content_type_id = '" . (int) $content_type_id . "'");

        return $query->row;
    }

    public function getContentTypes($data = array()) {
        $sql = "SELECT * FROM " . DB_PREFIX . "content_type";

        if (!empty($data['filter_name'])) {
            $sql .= " WHERE name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
        }

        $sort_data = array(
            'name',
        );

        if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
            $sql .= " ORDER BY " . $data['sort'];
        } else {
            $sql .= " ORDER BY name";
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

    public function getContentTypeFields($content_type_id) {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "content_type_field WHERE content_type_id = '" . (int) $content_type_id . "'");

        return $query->rows;
    }

    public function getTotalContentTypes() {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "content_type");

        return $query->row['total'];
    }

}

