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

        if (isset($data['withdraw']) && ($data['withdraw'] == 'DESC')) {
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

        $query = $this->db->query("SELECT SUM(amount) AS total FROM `" . DB_PREFIX . "withdraw` WHERE status <> '" . (int) $this->config->get('config_complete_transfer_status_id') . "'");

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
        $query = $this->db->query("SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "withdraw` WHERE status <> '" . (int) $this->config->get('config_complete_transfer_status_id') . "'");

        return $query->row['total'];
    }
    
    public function getTransfer($withdraw_id){
        
        $result = $this->db->query("SELECT * FROM ".DB_PREFIX."withdraw WHERE withdraw_id = '".(int) $withdraw_id."'");
        
        return $result->row;
    }

    public function getTransfers($data = array()) {

        $sql = "SELECT w.withdraw_id, CONCAT(w.firstname, ' ', w.lastname) AS customer, (SELECT ts.name FROM " . DB_PREFIX . "transaction_status ts WHERE ts.transaction_status_id = w.status AND ts.language_id = '" . (int) $this->config->get('config_language_id') . "') AS status, w.amount, w.currency_code, w.currency_value,w.date_added, w.date_proceed FROM `" . DB_PREFIX . "withdraw` w";

//        if (isset($data['filter_withdraw_status_id']) && !is_null($data['filter_withdraw_status_id'])) {
//            $sql .= " WHERE o.withdraw_status_id = '" . (int) $data['filter_withdraw_status_id'] . "'";
//        } else {
//            $sql .= " WHERE o.withdraw_status_id > '0'";
//        }
//
//        if (!empty($data['filter_withdraw_id'])) {
//            $sql .= " AND o.withdraw_id = '" . (int) $data['filter_withdraw_id'] . "'";
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

        if (isset($data['withdraw']) && ($data['withdraw'] == 'DESC')) {
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
        
        public function addTransferHistory($transfer_id, $data) {
		
                $this->db->query("UPDATE `" . DB_PREFIX . "withdraw` SET status = '" . (int)$data['transfer_status_id'] . "', date_proceed = NOW() WHERE withdraw_id = '" . (int)$transfer_id . "'");
                
                $this->db->query("UPDATE `" . DB_PREFIX . "customer_transaction` SET status = '" . (int)$data['transfer_status_id'] . "', date_modified = NOW() WHERE transaction_id = '" . (int)$transfer_id . "'");

		$this->db->query("INSERT INTO " . DB_PREFIX . "withdraw_history SET withdraw_id = '" . (int)$transfer_id . "', withdraw_status_id = '" . (int)$data['transfer_status_id'] . "', notify = '" . (isset($data['notify']) ? (int)$data['notify'] : 0) . "', comment = '" . $this->db->escape(strip_tags($data['comment'])) . "', date_added = NOW()");

		$withdraw_info = $this->getTransfer($transfer_id);

		if ($data['notify']) {
			
//                        $language = new Language($withdraw_info['language_directory']);
//			$language->load($withdraw_info['language_filename']);
//			$language->load('mail/withdraw');
//
//			$subject = sprintf($language->get('text_subject'), $withdraw_info['store_name'], $transfer_id);
//
//			$message  = $language->get('text_withdraw') . ' ' . $transfer_id . "\n";
//			$message .= $language->get('text_date_added') . ' ' . date($language->get('date_format_short'), strtotime($withdraw_info['date_added'])) . "\n\n";
//
//			$withdraw_status_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "withdraw_status WHERE withdraw_status_id = '" . (int)$data['withdraw_status_id'] . "' AND language_id = '" . (int)$withdraw_info['language_id'] . "'");
//
//			if ($withdraw_status_query->num_rows) {
//				$message .= $language->get('text_withdraw_status') . "\n";
//				$message .= $withdraw_status_query->row['name'] . "\n\n";
//			}
//
//			if ($withdraw_info['customer_id']) {
//				$message .= $language->get('text_link') . "\n";
//				$message .= html_entity_decode($withdraw_info['store_url'] . 'index.php?route=account/withdraw/info&withdraw_id=' . $transfer_id, ENT_QUOTES, 'UTF-8') . "\n\n";
//			}
//
//			if ($data['comment']) {
//				$message .= $language->get('text_comment') . "\n\n";
//				$message .= strip_tags(html_entity_decode($data['comment'], ENT_QUOTES, 'UTF-8')) . "\n\n";
//			}
//
//			$message .= $language->get('text_footer');
//
			$mail = new Mail();
			$mail->protocol = $this->config->get('config_mail_protocol');
			$mail->parameter = $this->config->get('config_mail_parameter');
			$mail->hostname = $this->config->get('config_smtp_host');
			$mail->username = $this->config->get('config_smtp_username');
			$mail->password = $this->config->get('config_smtp_password');
			$mail->port = $this->config->get('config_smtp_port');
			$mail->timeout = $this->config->get('config_smtp_timeout');
			$mail->setTo('ahmet.gudenoglu@gmail.com');
			$mail->setFrom('no-reply@semitepayment.com');
			$mail->setSender('Semite Payment');
			$mail->setSubject(html_entity_decode('Fund Transfer', ENT_QUOTES, 'UTF-8'));
			$mail->setText(html_entity_decode('You are rich ha!', ENT_QUOTES, 'UTF-8'));
			$mail->send();
		}
		
	}

	public function getOrderHistories($transfer_id, $start = 0, $limit = 10) {
		if ($start < 0) {
			$start = 0;
		}

		if ($limit < 1) {
			$limit = 10;
		}	

		$query = $this->db->query("SELECT oh.date_added, os.name AS status, oh.comment, oh.notify FROM " . DB_PREFIX . "withdraw_history oh LEFT JOIN " . DB_PREFIX . "withdraw_status os ON oh.withdraw_status_id = os.withdraw_status_id WHERE oh.withdraw_id = '" . (int)$transfer_id . "' AND os.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY oh.date_added ASC LIMIT " . (int)$start . "," . (int)$limit);

		return $query->rows;
	}

}
