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

    public function addPage($data) {
        $this->db->query("INSERT INTO " . DB_PREFIX . "page SET status = '" . (isset($data['status']) ? (int) $data['status'] : 0) . "',protected = '" . (isset($data['protected']) ? (int) $data['protected'] : 0) . "',`ssl` = '" . (isset($data['ssl']) ? (int) $data['ssl'] : 0) . "',show_header = '" . (isset($data['show_header']) ? (int) $data['show_header'] : 0) . "',show_title = '" . (isset($data['show_title']) ? (int) $data['show_title'] : 0) . "',show_sub_title = '" . (isset($data['show_sub_title']) ? (int) $data['show_sub_title'] : 0) . "',show_breadcrumb = '" . (isset($data['show_breadcrumb']) ? (int) $data['show_breadcrumb'] : 0) . "',date_added = NOW(), date_modified = NOW()");

        $page_id = $this->db->getLastId();

        if (isset($data['image'])) {
            $this->db->query("UPDATE " . DB_PREFIX . "page SET image = '" . $this->db->escape(html_entity_decode($data['image'], ENT_QUOTES, 'UTF-8')) . "' WHERE page_id = '" . (int) $page_id . "'");
        }

        foreach ($data['page_description'] as $language_id => $value) {
            $this->db->query("INSERT INTO " . DB_PREFIX . "page_description SET page_id = '" . (int) $page_id . "', language_id = '" . (int) $language_id . "', title = '" . $this->db->escape($value['title']) . "',sub_title = '" . $this->db->escape($value['sub_title']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "',meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "'");
        }

        // Set which layout to use with this category
        if (isset($data['page_layout'])) {
            foreach ($data['page_layout'] as $layout) {
                if ($layout) {
                    $this->db->query("INSERT INTO " . DB_PREFIX . "page_to_layout SET page_id = '" . (int) $page_id . "', layout_id = '" . (int) $layout . "'");
                }
            }
        }

        if ($data['keyword']) {
            $this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'page_id=" . (int) $page_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
        }
        
        if (isset($data['page_application'])) {
                foreach ($data['page_application'] as $application_id) {
                        $this->db->query("INSERT INTO " . DB_PREFIX . "page_to_application SET page_id = '" . (int)$page_id . "', application_id = '" . (int)$application_id . "'");
                }
        }
        
        if (isset($data['page_block'])) {
            foreach ($data['page_block'] as $block) {
                if ($block) {
                    $this->db->query("INSERT INTO " . DB_PREFIX . "page_to_block SET page_id = '" . (int) $page_id . "', block_id = '" . (int) $block['block_id'] . "'");
                }
            }
        }
    }

    public function editPage($page_id, $data) {
        $this->db->query("UPDATE " . DB_PREFIX . "page SET status = '" . (isset($data['status']) ? (int) $data['status'] : 0) . "',protected = '" . (isset($data['protected']) ? (int) $data['protected'] : 0) . "',`ssl` = '" . (isset($data['ssl']) ? (int) $data['ssl'] : 0) . "',show_header = '" . (isset($data['show_header']) ? (int) $data['show_header'] : 0) . "',show_title = '" . (isset($data['show_title']) ? (int) $data['show_title'] : 0) . "',show_sub_title = '" . (isset($data['show_sub_title']) ? (int) $data['show_sub_title'] : 0) . "',show_breadcrumb = '" . (isset($data['show_breadcrumb']) ? (int) $data['show_breadcrumb'] : 0) . "', date_modified = NOW() WHERE page_id = '" . (int) $page_id . "'");

        if (isset($data['image'])) {
            $this->db->query("UPDATE " . DB_PREFIX . "page SET image = '" . $this->db->escape(html_entity_decode($data['image'], ENT_QUOTES, 'UTF-8')) . "' WHERE page_id = '" . (int) $page_id . "'");
        }

        $this->db->query("DELETE FROM " . DB_PREFIX . "page_description WHERE page_id = '" . (int) $page_id . "'");

        foreach ($data['page_description'] as $language_id => $value) {
            $this->db->query("INSERT INTO " . DB_PREFIX . "page_description SET page_id = '" . (int) $page_id . "', language_id = '" . (int) $language_id . "', title = '" . $this->db->escape($value['title']) . "',sub_title = '" . $this->db->escape($value['sub_title']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "',meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "'");
        }

        $this->db->query("DELETE FROM " . DB_PREFIX . "page_to_layout WHERE page_id = '" . (int) $page_id . "'");

        // Set which layout to use with this page
        if (isset($data['page_layout'])) {
            foreach ($data['page_layout'] as $layout) {
                if ($layout) {
                    $this->db->query("INSERT INTO " . DB_PREFIX . "page_to_layout SET page_id = '" . (int) $page_id . "', layout_id = '" . (int) $layout . "'");
                }
            }
        }

        $this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'page_id=" . (int) $page_id . "'");

        if ($data['keyword']) {
            $this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'page_id=" . (int) $page_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
        }
        
                $this->db->query("DELETE FROM " . DB_PREFIX . "page_to_application WHERE page_id = '" . (int)$page_id . "'");

        if (isset($data['page_application'])) {
                foreach ($data['page_application'] as $application_id) {
                        $this->db->query("INSERT INTO " . DB_PREFIX . "page_to_application SET page_id = '" . (int)$page_id . "', application_id = '" . (int)$application_id . "'");
                }
        }
        
        $this->db->query("DELETE FROM " . DB_PREFIX . "page_to_block WHERE page_id = '" . (int) $page_id . "'");
        
        if (isset($data['page_block'])) {
            foreach ($data['page_block'] as $block) {
                if ($block) {
                    $this->db->query("INSERT INTO " . DB_PREFIX . "page_to_block SET page_id = '" . (int) $page_id . "', block_id = '" . (int) $block['block_id'] . "'");
                }
            }
        }
    }

    public function getPage($page_id) {

        $query = $this->db->query("SELECT DISTINCT *, (SELECT keyword FROM " . DB_PREFIX . "url_alias WHERE query = 'page_id=" . (int) $page_id . "') AS keyword FROM " . DB_PREFIX . "page WHERE page_id = '" . (int) $page_id . "'");

        return $query->row;
    }

    public function getPages($data = array()) {
        $sql = "SELECT * FROM " . DB_PREFIX . "page p LEFT JOIN " . DB_PREFIX . "page_description pd ON(p.page_id = pd.page_id) WHERE pd.language_id = '" . (int) $this->config->get('config_language_id') . "'";

        $sort_data = array('pd.title');

        if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
            $sql .= " ORDER BY " . $data['sort'];
        } else {
            $sql .= " ORDER BY pd.title";
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

    public function deletePage($page_id) {
        $this->db->query("DELETE FROM " . DB_PREFIX . "page WHERE page_id = '" . (int) $page_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "page_description WHERE page_id = '" . (int) $page_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "page_to_layout WHERE page_id = '" . (int) $page_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "page_to_block WHERE page_id = '" . (int) $page_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "page_to_application WHERE page_id = '" . (int) $page_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'page_id=" . (int) $page_id . "'");
    }

    public function getPageDescriptions($page_id) {
        $page_description_data = array();

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "page_description WHERE page_id = '" . (int) $page_id . "'");

        foreach ($query->rows as $result) {
            $page_description_data[$result['language_id']] = array(
                'title' => $result['title'],
                'sub_title' => $result['sub_title'],
                'meta_description' => $result['meta_description'],
                'meta_keyword' => $result['meta_keyword']
            );
        }

        return $page_description_data;
    }

    public function getPageApplications($page_id) {
        $page_application_data = array();

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "page_to_application WHERE page_id = '" . (int) $page_id . "'");

        foreach ($query->rows as $result) {
            $page_application_data[] = $result['application_id'];
        }

        return $page_application_data;
    }

    public function getPageLayouts($page_id) {

        $page_layout_data = array();

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "page_to_layout WHERE page_id = '" . (int) $page_id . "'");

        foreach ($query->rows as $result) {
            $page_layout_data[] = $result['layout_id'];
        }

        return $page_layout_data;
    }
    
    public function getPageBlocks($page_id) {

        $page_block_data = array();

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "page_to_block WHERE page_id = '" . (int) $page_id . "'");

        foreach ($query->rows as $result) {
            $page_block_data[] = $result['block_id'];
        }

        return $page_block_data;
    }

    public function getTotalPagesByLayoutId($layout_id) {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "page_to_layout WHERE layout_id = '" . (int) $layout_id . "'");

        return $query->row['total'];
    }
    
    public function getTotalPagesByBlockId($block_id) {
        
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "page_to_block WHERE block_id = '" . (int) $block_id . "'");

        return $query->row['total'];
    }

    public function getTotalPages() {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "page");

        return $query->row['total'];
    }

}

