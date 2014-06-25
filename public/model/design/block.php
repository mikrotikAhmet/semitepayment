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
 * Semite LLC block Class
 * Date : Jun 18, 2014
 */

class ModelDesignBlock extends Model{
    
    public function getBlock($block_id) {
        
        $query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "block b LEFT JOIN ".DB_PREFIX."block_description bd ON(b.block_id = bd.block_id) WHERE b.block_id = '" . (int) $block_id . "'");

        return $query->row;
    }
    
    public function getBlockUnits($block_id) {
        
        $query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "block_unit WHERE block_id = '" . (int) $block_id . "' ORDER BY sort_order ASC");

        return $query->rows;
    }
}

