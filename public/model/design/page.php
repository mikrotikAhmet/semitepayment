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
 * Semite LLC page Class
 * Date : Jun 16, 2014
 */

class ModelDesignPage extends Model {

    public function getPage($page_id) {
        $query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "page p LEFT JOIN " . DB_PREFIX . "page_description pd ON (p.page_id = pd.page_id) LEFT JOIN " . DB_PREFIX . "page_to_application p2a ON (p.page_id = p2a.page_id) WHERE p.page_id = '" . (int) $page_id . "' AND pd.language_id = '" . (int) $this->config->get('config_language_id') . "' AND p2a.application_id = '" . (int) $this->config->get('config_application_id') . "' AND p.status = '1'");

        return $query->row;
    }
    
    public function getPageLayoutId($page_id) {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "page_to_layout WHERE page_id = '" . (int) $page_id . "' AND application_id = '" . (int) $this->config->get('config_application_id') . "'");

        if ($query->num_rows) {
            return $query->row['layout_id'];
        } else {
            return false;
        }
    }

}

