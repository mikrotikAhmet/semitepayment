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
 * Semite LLC layout Class
 * Date : Jun 14, 2014
 */

class ModelDesignLayout extends Model {
    
    public function addLayout($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "layout SET name = '" . $this->db->escape($data['name']) . "'");

		$layout_id = $this->db->getLastId();

		if (isset($data['layout_route'])) {
			foreach ($data['layout_route'] as $layout_route) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "layout_route SET layout_id = '" . (int)$layout_id . "', application_id = '" . (int)$layout_route['application_id'] . "', route = '" . $this->db->escape($layout_route['route']) . "'");
			}	
		}
	}

	public function editLayout($layout_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "layout SET name = '" . $this->db->escape($data['name']) . "' WHERE layout_id = '" . (int)$layout_id . "'");

		$this->db->query("DELETE FROM " . DB_PREFIX . "layout_route WHERE layout_id = '" . (int)$layout_id . "'");

		if (isset($data['layout_route'])) {
			foreach ($data['layout_route'] as $layout_route) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "layout_route SET layout_id = '" . (int)$layout_id . "', application_id = '" . (int)$layout_route['application_id'] . "', route = '" . $this->db->escape($layout_route['route']) . "'");
			}
		}
	}

	public function deleteLayout($layout_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "layout WHERE layout_id = '" . (int)$layout_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "layout_route WHERE layout_id = '" . (int)$layout_id . "'");
//		$this->db->query("DELETE FROM " . DB_PREFIX . "category_to_layout WHERE layout_id = '" . (int)$layout_id . "'");
//		$this->db->query("DELETE FROM " . DB_PREFIX . "product_to_layout WHERE layout_id = '" . (int)$layout_id . "'");
//		$this->db->query("DELETE FROM " . DB_PREFIX . "information_to_layout WHERE layout_id = '" . (int)$layout_id . "'");		
	}

	public function getLayout($layout_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "layout WHERE layout_id = '" . (int)$layout_id . "'");

		return $query->row;
	}

	public function getLayouts($data = array()) {
		$sql = "SELECT * FROM " . DB_PREFIX . "layout";

		$sort_data = array('name');	

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

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}		

		$query = $this->db->query($sql);

		return $query->rows;
	}

	public function getLayoutRoutes($layout_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "layout_route WHERE layout_id = '" . (int)$layout_id . "'");

		return $query->rows;
	}

	public function getTotalLayouts() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "layout");

		return $query->row['total'];
	}
}

