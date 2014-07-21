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
 * Semite LLC transaction Class
 * Date : Jul 1, 2014
 */

class ModelAccountTransaction extends Model {

    public function getTransactions($customer_id, $data = array()) {

        $sql = "SELECT * FROM `" . DB_PREFIX . "customer_transaction` WHERE customer_id = '" . (int) $customer_id . "'";

        $sort_data = array(
            'amount',
            'description',
            'date_added'
        );

        if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
            $sql .= " ORDER BY " . $data['sort'];
        } else {
            $sql .= " ORDER BY date_added";
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

    public function getTotalWithdrawAmount() {

        $query = $this->db->query("SELECT SUM(amount) AS total FROM `" . DB_PREFIX . "withdraw` WHERE status = '" . (int) $this->config->get('config_complete_transfer_status_id') . "'");

        if ($query->num_rows) {
            return $query->row['total'];
        } else {
            return 0;
        }
    }

    public function getTotalWithdrawAmountApproval() {

        $query = $this->db->query("SELECT SUM(amount) AS total FROM `" . DB_PREFIX . "withdraw` WHERE status = '" . (int) $this->config->get('config_transfer_status_id') . "'");

        if ($query->num_rows) {
            return $query->row['total'];
        } else {
            return 0;
        }
    }

    public function getTotalTransactions($customer_id) {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "customer_transaction` WHERE customer_id = '" . (int) $customer_id . "'");

        return $query->row['total'];
    }

    public function getTotalTransferRequest() {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "withdraw` WHERE status = '" . (int) $this->config->get('config_transfer_status_id') . "'");

        return $query->row['total'];
    }
    
    public function getTransfer($withdraw_id){
        
        $result = $this->db->query("SELECT * FROM ".DB_PREFIX."withdraw WHERE withdraw_id = '".(int) $withdraw_id."'");
        
        return $result->row;
    }

    public function getTransfers($data = array()) {

        $sql = "SELECT w.withdraw_id, CONCAT(w.firstname, ' ', w.lastname) AS customer, (SELECT ts.name FROM " . DB_PREFIX . "transaction_status ts WHERE ts.transaction_status_id = w.status AND ts.language_id = '" . (int) $this->config->get('config_language_id') . "') AS status, w.amount, w.currency_code, w.currency_value,w.date_added, w.date_proceed FROM `" . DB_PREFIX . "withdraw` w";

//        if (isset($data['filter_order_status_id']) && !is_null($data['filter_order_status_id'])) {
//            $sql .= " WHERE o.order_status_id = '" . (int) $data['filter_order_status_id'] . "'";
//        } else {
//            $sql .= " WHERE o.order_status_id > '0'";
//        }
//
//        if (!empty($data['filter_order_id'])) {
//            $sql .= " AND o.order_id = '" . (int) $data['filter_order_id'] . "'";
//        }
//
//        if (!empty($data['filter_customer'])) {
//            $sql .= " AND CONCAT(o.firstname, ' ', o.lastname) LIKE '%" . $this->db->escape($data['filter_customer']) . "%'";
//        }
//
//        if (!empty($data['filter_date_added'])) {
//            $sql .= " AND DATE(o.date_added) = DATE('" . $this->db->escape($data['filter_date_added']) . "')";
//        }
//
//        if (!empty($data['filter_date_modified'])) {
//            $sql .= " AND DATE(o.date_modified) = DATE('" . $this->db->escape($data['filter_date_modified']) . "')";
//        }
//
//        if (!empty($data['filter_total'])) {
//            $sql .= " AND o.total = '" . (float) $data['filter_total'] . "'";
//        }

        $sort_data = array(
            'w.withdraw_id',
            'customer',
            'status',
            'w.date_added',
            'w.date_proceed',
            'w.amount'
        );

        if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
            $sql .= " ORDER BY " . $data['sort'];
        } else {
            $sql .= " ORDER BY w.withdraw_id";
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

    public function getTotalAmountByCustomerId($customer_id) {
        $query = $this->db->query("SELECT SUM(amount) AS total FROM `" . DB_PREFIX . "customer_transaction` WHERE customer_id = '" . (int) $customer_id . "' GROUP BY customer_id");

        if ($query->num_rows) {
            return $query->row['total'];
        } else {
            return 0;
        }
    }

    public function getTotalAmount() {
        $query = $this->db->query("SELECT SUM(amount) AS total FROM `" . DB_PREFIX . "customer_transaction` WHERE status = '" . (int) $this->config->get('config_complete_transaction_status_id') . "'");

        if ($query->num_rows) {
            return $query->row['total'];
        } else {
            return 0;
        }
    }

    public function getTotalWithdrawHistoriesByTransactionStatusId($transaction_status_id) {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "withdraw WHERE status = '" . (int) $transaction_status_id . "'");

        return $query->row['total'];
    }
    
    public function createInvoiceNo($transfer_id) {
		$transfer_info = $this->getTransfer($transfer_id);

		if ($transfer_info && !$transfer_info['invoice_no']) {
			$query = $this->db->query("SELECT MAX(invoice_no) AS invoice_no FROM `" . DB_PREFIX . "withdraw` WHERE invoice_prefix = '" . $this->db->escape($transfer_info['invoice_prefix']) . "'");

			if ($query->row['invoice_no']) {
				$invoice_no = $query->row['invoice_no'] + 1;
			} else {
				$invoice_no = 1;
			}

			$this->db->query("UPDATE `" . DB_PREFIX . "withdraw` SET invoice_no = '" . (int)$invoice_no . "', invoice_prefix = '" . $this->db->escape($transfer_info['invoice_prefix']) . "' WHERE withdraw_id = '" . (int)$transfer_id . "'");

			return $transfer_info['invoice_prefix'] . $invoice_no;
		}
	}
        
        public function getTransferHistories($transfer_id, $start = 0, $limit = 10) {
		if ($start < 0) {
			$start = 0;
		}

		if ($limit < 1) {
			$limit = 10;
		}	

		$query = $this->db->query("SELECT wh.date_added, ts.name AS status, wh.comment, wh.notify FROM " . DB_PREFIX . "withdraw_history wh LEFT JOIN " . DB_PREFIX . "transaction_status ts ON wh.withdraw_status_id = ts.transaction_status_id WHERE wh.withdraw_id = '" . (int)$transfer_id . "'  ORDER BY wh.date_added ASC LIMIT " . (int)$start . "," . (int)$limit);

		return $query->rows;
	}
        
        public function getTotalTransferHistories($transfer_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "withdraw_history WHERE withdraw_id = '" . (int)$transfer_id . "'");

		return $query->row['total'];
	}	

	public function getTotalTransferHistoriesByOrderStatusId($withdraw_status_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "withdraw_history WHERE widthdraw_status_id = '" . (int)$withdraw_status_id . "'");

		return $query->row['total'];
	}

}
