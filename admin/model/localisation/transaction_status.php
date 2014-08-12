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

/**
 * Description of transaction_status Class
 *
 * @author ahmet
 */
class ModelLocalisationTransactionStatus extends Model {
	public function addTransactionStatus($data) {
		foreach ($data['transaction_status'] as $language_id => $value) {
			if (isset($transaction_status_id)) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "transaction_status SET transaction_status_id = '" . (int)$transaction_status_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "'");
			} else {
				$this->db->query("INSERT INTO " . DB_PREFIX . "transaction_status SET language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "'");

				$transaction_status_id = $this->db->getLastId();
			}
		}

		$this->cache->delete('transaction_status');
	}

	public function editTransactionStatus($transaction_status_id, $data) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "transaction_status WHERE transaction_status_id = '" . (int)$transaction_status_id . "'");

		foreach ($data['transaction_status'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "transaction_status SET transaction_status_id = '" . (int)$transaction_status_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "'");
		}

		$this->cache->delete('transaction_status');
	}

	public function deleteTransactionStatus($transaction_status_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "transaction_status WHERE transaction_status_id = '" . (int)$transaction_status_id . "'");

		$this->cache->delete('transaction_status');
	}

	public function getTransactionStatus($transaction_status_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "transaction_status WHERE transaction_status_id = '" . (int)$transaction_status_id . "' AND language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row;
	}

	public function getTransactionStatuses($data = array()) {
		if ($data) {
			$sql = "SELECT * FROM " . DB_PREFIX . "transaction_status WHERE language_id = '" . (int)$this->config->get('config_language_id') . "'";

			$sql .= " ORDER BY name";	

			if (isset($data['transaction']) && ($data['transaction'] == 'DESC')) {
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
		} else {
			$transaction_status_data = $this->cache->get('transaction_status.' . (int)$this->config->get('config_language_id'));

			if (!$transaction_status_data) {
				$query = $this->db->query("SELECT transaction_status_id, name FROM " . DB_PREFIX . "transaction_status WHERE language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY name");

				$transaction_status_data = $query->rows;

				$this->cache->set('transaction_status.' . (int)$this->config->get('config_language_id'), $transaction_status_data);
			}	

			return $transaction_status_data;				
		}
	}

	public function getTransactionStatusDescriptions($transaction_status_id) {
		$transaction_status_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "transaction_status WHERE transaction_status_id = '" . (int)$transaction_status_id . "'");

		foreach ($query->rows as $result) {
			$transaction_status_data[$result['language_id']] = array('name' => $result['name']);
		}

		return $transaction_status_data;
	}

	public function getTotalTransactionStatuses() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "transaction_status WHERE language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row['total'];
	}	
}
