<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


if (!defined('DIR_APPLICATION'))
    exit('No direct script access allowed');

/**
 * Description of block
 *
 * @author ahmet
 */
class ModelDesignBlock extends Model {

    public function addBlock($data) {
        $this->db->query("INSERT INTO " . DB_PREFIX . "block SET `class` = '" . $this->db->escape($data['class']) . "',additional_classes = '" . $this->db->escape($data['additional_classes']) . "',show_image = '" . (isset($data['show_image']) ? (int) $data['show_image'] : 0) . "',show_title = '" . (isset($data['show_title']) ? (int) $data['show_title'] : 0) . "',show_sub_title = '" . (isset($data['show_sub_title']) ? (int) $data['show_sub_title'] : 0) . "',date_added = NOW() , date_modified = NOW()");

        $block_id = $this->db->getLastId();

        if (isset($data['image'])) {
            $this->db->query("UPDATE " . DB_PREFIX . "block SET image = '" . $this->db->escape(html_entity_decode($data['image'], ENT_QUOTES, 'UTF-8')) . "' WHERE block_id = '" . (int) $block_id . "'");
        }

        foreach ($data['block_description'] as $language_id => $value) {
            $this->db->query("INSERT INTO " . DB_PREFIX . "block_description SET block_id = '" . (int) $block_id . "', language_id = '" . (int) $language_id . "', title = '" . $this->db->escape($value['title']) . "', sub_title = '" . $this->db->escape($value['sub_title']) . "'");
        }
        
        if (isset($data['units'])) {
            foreach ($data['units'] as $unit) {
                $this->db->query("INSERT INTO " . DB_PREFIX . "block_unit SET block_id = '" . (int) $block_id . "', `class`='".$this->db->escape($unit['class'])."',`additional_class`='".$this->db->escape($unit['additional_class'])."'");
            }
        }
    }

    public function editBlock($block_id, $data) {
        $this->db->query("UPDATE " . DB_PREFIX . "block SET `class` = '" . $this->db->escape($data['class']) . "',additional_classes = '" . $this->db->escape($data['additional_classes']) . "',show_image = '" . (isset($data['show_image']) ? (int) $data['show_image'] : 0) . "',show_title = '" . (isset($data['show_title']) ? (int) $data['show_title'] : 0) . "',show_sub_title = '" . (isset($data['show_sub_title']) ? (int) $data['show_sub_title'] : 0) . "', date_modified = NOW() WHERE block_id = '" . (int) $block_id . "'");

        if (isset($data['image'])) {
            $this->db->query("UPDATE " . DB_PREFIX . "block SET image = '" . $this->db->escape(html_entity_decode($data['image'], ENT_QUOTES, 'UTF-8')) . "' WHERE block_id = '" . (int) $block_id . "'");
        }

        $this->db->query("DELETE FROM " . DB_PREFIX . "block_description WHERE block_id = '" . (int) $block_id . "'");

        foreach ($data['block_description'] as $language_id => $value) {
            $this->db->query("INSERT INTO " . DB_PREFIX . "block_description SET block_id = '" . (int) $block_id . "', language_id = '" . (int) $language_id . "', title = '" . $this->db->escape($value['title']) . "', sub_title = '" . $this->db->escape($value['sub_title']) . "'");
        }
        
        $this->db->query("DELETE FROM " . DB_PREFIX . "block_unit WHERE block_id = '" . (int) $block_id . "'");

        if (isset($data['units'])) {
            foreach ($data['units'] as $unit) {
                $this->db->query("INSERT INTO " . DB_PREFIX . "block_unit SET block_id = '" . (int) $block_id . "', `class`='".$this->db->escape($unit['class'])."',`additional_class`='".$this->db->escape($unit['additional_class'])."'");
            }
        }
    }

    public function getBlock($block_id) {
        $query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "block WHERE block_id = '" . (int) $block_id . "'");

        return $query->row;
    }

    public function getBlocks($data = array()) {
        $sql = "SELECT * FROM " . DB_PREFIX . "block b LEFT JOIN " . DB_PREFIX . "block_description bd ON(b.block_id = bd.block_id) WHERE bd.language_id = '" . (int) $this->config->get('config_language_id') . "'";

        $sort_data = array('bd.title');

        if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
            $sql .= " ORDER BY " . $data['sort'];
        } else {
            $sql .= " ORDER BY bd.title";
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

    public function deleteBlock($block_id) {
        $this->db->query("DELETE FROM " . DB_PREFIX . "block WHERE block_id = '" . (int) $block_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "block_description WHERE block_id = '" . (int) $block_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "block_unit WHERE block_id = '" . (int) $block_id . "'");
    }

    public function getBlockDescriptions($block_id) {
        $block_description_data = array();

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "block_description WHERE block_id = '" . (int) $block_id . "'");

        foreach ($query->rows as $result) {
            $block_description_data[$result['language_id']] = array(
                'title' => $result['title'],
                'sub_title' => $result['sub_title']
            );
        }

        return $block_description_data;
    }

    public function getUnitsByBlockId($block_id) {
        
        $query = $this->db->query("SELECT * FROM ".DB_PREFIX."block_unit WHERE block_id = '".(int) $block_id."'");
        
        return $query->rows;
    }

    public function getTotalBlocks() {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "block");

        return $query->row['total'];
    }

}
