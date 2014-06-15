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
 * Semite LLC content Class
 * Date : Jun 14, 2014
 */

class ModelApplicationContent extends Model{
    public function addContent($data) {
        $this->db->query("INSERT INTO " . DB_PREFIX . "content SET author = '" . (int) $this->user->getId() . "' ,status = '" . (int) $data['status'] . "', date_added = NOW(), date_modified = NOW(), `type` = '" . (int) $data['type'] . "', comment = '" . (isset($data['comment']) ? (int) $data['comment'] : 0) . "', revision = '" . (isset($data['revision']) ? (int) $data['revision'] : 0) . "'");

        $content_id = $this->db->getLastId();
        
        if (isset($data['image'])) {
            $this->db->query("UPDATE " . DB_PREFIX . "content SET image = '" . $this->db->escape(html_entity_decode($data['image'], ENT_QUOTES, 'UTF-8')) . "' WHERE content_id = '" . (int) $content_id . "'");
        }

        foreach ($data['content_description'] as $language_id => $value) {
            $this->db->query("INSERT INTO " . DB_PREFIX . "content_description SET content_id = '" . (int) $content_id . "', language_id = '" . (int) $language_id . "', title = '" . $this->db->escape($value['title']) . "', description = '" . $this->db->escape($value['description']) . "'");
        }

        if ($data['keyword']) {
            $this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'content_id=" . (int) $content_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
        }

        $this->cache->delete('content');
    }

    public function editContent($content_id, $data) {
        $this->db->query("UPDATE " . DB_PREFIX . "content SET  status = '" . (int) $data['status'] . "',date_modified = NOW(), `type` = '" . (int) $data['type'] . "', comment = '" . (isset($data['comment']) ? (int) $data['comment'] : 0) . "', link = '" . (isset($data['link']) ? (int) $data['link'] : 0) . "'  WHERE content_id = '" . (int) $content_id . "'");

        if (isset($data['image'])) {
            $this->db->query("UPDATE " . DB_PREFIX . "content SET image = '" . $this->db->escape(html_entity_decode($data['image'], ENT_QUOTES, 'UTF-8')) . "' WHERE content_id = '" . (int) $content_id . "'");
        }
        
        $this->db->query("DELETE FROM " . DB_PREFIX . "content_description WHERE content_id = '" . (int) $content_id . "'");

        foreach ($data['content_description'] as $language_id => $value) {
            $this->db->query("INSERT INTO " . DB_PREFIX . "content_description SET content_id = '" . (int) $content_id . "', language_id = '" . (int) $language_id . "', title = '" . $this->db->escape($value['title']) . "', description = '" . $this->db->escape($value['description']) . "'");
        }

        $this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'content_id=" . (int) $content_id . "'");

        if ($data['keyword']) {
            $this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'content_id=" . (int) $content_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
        }

        if (isset($data['revision'])) {
            $this->db->query("DELETE FROM `" . DB_PREFIX . "content_revision` WHERE (UNIX_TIMESTAMP(`revision_date`) + 3600) < UNIX_TIMESTAMP(NOW())");

            $this->db->query("REPLACE INTO `" . DB_PREFIX . "content_revision` SET `ip` = '" . $this->db->escape($_SERVER['REMOTE_ADDR']) . "', `author` = '" . (int) $this->user->getId() . "', `content_id` = '" . (int) $content_id . "',revision_date = NOW(), message = '" . $this->db->escape($data['revision_log']) . "'");
        }

        $this->cache->delete('content');
    }

    public function deleteContent($content_id) {
        $this->db->query("DELETE FROM " . DB_PREFIX . "content WHERE content_id = '" . (int) $content_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "content_description WHERE content_id = '" . (int) $content_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "content_revision WHERE content_id = '" . (int) $content_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'content_id=" . (int) $content_id . "'");

        $this->cache->delete('content');
    }

    public function getContent($content_id) {
        $query = $this->db->query("SELECT DISTINCT *, (SELECT keyword FROM " . DB_PREFIX . "url_alias WHERE query = 'content_id=" . (int) $content_id . "') AS keyword FROM " . DB_PREFIX . "content WHERE content_id = '" . (int) $content_id . "'");

        return $query->row;
    }

    public function getContents($data = array()) {
        if ($data) {
            $sql = "SELECT * FROM " . DB_PREFIX . "content c LEFT JOIN " . DB_PREFIX . "content_description cd ON (c.content_id = cd.content_id) WHERE cd.language_id = '" . (int) $this->config->get('config_language_id') . "'";

            $sort_data = array(
                'cd.title',
            );

            if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
                $sql .= " ORDER BY " . $data['sort'];
            } else {
                $sql .= " ORDER BY cd.title";
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
        } else {
            $content_data = $this->cache->get('content.' . (int) $this->config->get('config_language_id'));

            if (!$content_data) {
                $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "content c LEFT JOIN " . DB_PREFIX . "content_description cd ON (c.content_id = cd.content_id) WHERE cd.language_id = '" . (int) $this->config->get('config_language_id') . "' ORDER BY cd.title");

                $content_data = $query->rows;

                $this->cache->set('content.' . (int) $this->config->get('config_language_id'), $content_data);
            }

            return $content_data;
        }
    }

    public function getContentDescriptions($content_id) {
        $content_description_data = array();

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "content_description WHERE content_id = '" . (int) $content_id . "'");

        foreach ($query->rows as $result) {
            $content_description_data[$result['language_id']] = array(
                'title' => $result['title'],
                'description' => $result['description']
            );
        }

        return $content_description_data;
    }

    public function getTotalContents() {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "content");

        return $query->row['total'];
    }

    public function getContentRevisions($content_id, $start = 0, $limit = 10) {
        if ($start < 0) {
            $start = 0;
        }

        if ($limit < 1) {
            $limit = 10;
        }

        $query = $this->db->query("SELECT *  FROM " . DB_PREFIX . "content_revision WHERE content_id = '" . (int) $content_id . "' ORDER BY revision_date DESC LIMIT " . (int) $start . "," . (int) $limit);

        return $query->rows;
    }

    public function getTotalContentRevisions($content_id) {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "content_revision WHERE content_id = '" . (int) $content_id . "'");

        return $query->row['total'];
    }

    public function getTotalContentsByContentTypeId($content_type_id) {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "content WHERE `type` = '" . (int) $content_type_id . "'");

        return $query->row['total'];
    }
}

