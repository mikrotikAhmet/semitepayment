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
 * Description of application
 *
 * @author ahmet
 */
class ModelSettingApplication extends Model {
	public function addApplication($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "application SET name = '" . $this->db->escape($data['config_name']) . "', `url` = '" . $this->db->escape($data['config_url']) . "', `ssl` = '" . $this->db->escape($data['config_ssl']) . "'");

		$this->cache->delete('application');

		return $this->db->getLastId();
	}

	public function editApplication($application_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "application SET name = '" . $this->db->escape($data['config_name']) . "', `url` = '" . $this->db->escape($data['config_url']) . "', `ssl` = '" . $this->db->escape($data['config_ssl']) . "' WHERE application_id = '" . (int)$application_id . "'");

		$this->cache->delete('application');
	}

	public function deleteApplication($application_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "application WHERE application_id = '" . (int)$application_id . "'");

		$this->cache->delete('application');
	}

	public function getApplication($application_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "application WHERE application_id = '" . (int)$application_id . "'");

		return $query->row;
	}

	public function getApplications($data = array()) {
		$application_data = $this->cache->get('application');

		if (!$application_data) {
			$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "application ORDER BY url");

			$application_data = $query->rows;

			$this->cache->set('application', $application_data);
		}

		return $application_data;
	}

	public function getTotalApplications() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "application");

		return $query->row['total'];
	}	

	public function getTotalApplicationsByLayoutId($layout_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "setting WHERE `key` = 'config_layout_id' AND `value` = '" . (int)$layout_id . "' AND application_id != '0'");

		return $query->row['total'];		
	}
        
        public function getTotalApplicationsByPageId($page_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "setting WHERE `key` = 'config_page_id' AND `value` = '" . (int)$page_id . "' AND application_id != '0'");

		return $query->row['total'];		
	}

	public function getTotalApplicationsByLanguage($language) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "setting WHERE `key` = 'config_language' AND `value` = '" . $this->db->escape($language) . "' AND application_id != '0'");

		return $query->row['total'];		
	}

	public function getTotalApplicationsByCurrency($currency) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "setting WHERE `key` = 'config_currency' AND `value` = '" . $this->db->escape($currency) . "' AND application_id != '0'");

		return $query->row['total'];		
	}

	public function getTotalApplicationsByCountryId($country_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "setting WHERE `key` = 'config_country_id' AND `value` = '" . (int)$country_id . "' AND application_id != '0'");

		return $query->row['total'];		
	}

	public function getTotalApplicationsByZoneId($zone_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "setting WHERE `key` = 'config_zone_id' AND `value` = '" . (int)$zone_id . "' AND application_id != '0'");

		return $query->row['total'];		
	}

	public function getTotalApplicationsByCustomerGroupId($customer_group_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "setting WHERE `key` = 'config_customer_group_id' AND `value` = '" . (int)$customer_group_id . "' AND application_id != '0'");

		return $query->row['total'];		
	}	
}