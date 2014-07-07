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

    
    public function getTransactions($customer_id,$data = array()) {
        
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
    
    public function getTotalWithdrawAmount(){
        
        $query = $this->db->query("SELECT SUM(amount) AS total FROM `" . DB_PREFIX . "withdraw` WHERE status = '1'");

        if ($query->num_rows) {
            return $query->row['total'];
        } else {
            return 0;
        }
    }
    
    public function getTotalWithdrawAmountApproval(){
        
        $query = $this->db->query("SELECT SUM(amount) AS total FROM `" . DB_PREFIX . "withdraw` WHERE status = '0'");

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
        $query = $this->db->query("SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "withdraw` WHERE status = '0'");

        return $query->row['total'];
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
        $query = $this->db->query("SELECT SUM(amount) AS total FROM `" . DB_PREFIX . "customer_transaction` WHERE status = '1'");

        if ($query->num_rows) {
            return $query->row['total'];
        } else {
            return 0;
        }
    }

}

