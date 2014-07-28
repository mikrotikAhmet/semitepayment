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
 * Description of mail Class
 *
 * @author ahmet
 */
class ModelDesignMail extends Model{
    
    public function addMailTemplate($data=array()){
        
        $this->db->query("INSERT INTO ".DB_PREFIX."mail_template SET date_added = NOW(), date_modified = NOW(), status = '".(int) $data['status']."'");
        
        $mail_template_id = $this->db->getLastId();
        
        if ($data['mail_description']){
            foreach ($data['mail_description'] as $language_id => $value) {
                $this->db->query("INSERT INTO " . DB_PREFIX . "mail_template_description SET mail_template_id = '" . (int) $mail_template_id . "', language_id = '" . (int) $language_id . "', title = '" . $this->db->escape($value['title']) . "', template = '" . $this->db->escape($value['mail_template']) . "'");
            }
        }
        
    }
    
    public function editMailTemplate($mail_template_id,$data=array()){
        
        $this->db->query("UPDATE ".DB_PREFIX."mail_template SET date_modified = NOW(), status = '".(int) $data['status']."'");
        
        $this->db->query("DELETE FROM ".DB_PREFIX."mail_template_description WHERE mail_template_id = '".(int) $mail_template_id."'");
        
        if ($data['mail_description']){
            foreach ($data['mail_description'] as $language_id => $value) {
                $this->db->query("INSERT INTO " . DB_PREFIX . "mail_template_description SET mail_template_id = '" . (int) $mail_template_id . "', language_id = '" . (int) $language_id . "', title = '" . $this->db->escape($value['title']) . "', template = '" . $this->db->escape($value['mail_template']) . "'");
            }
        }
        
    }
    
    public function getMailTemplate($mail_template_id) {

        $query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "mail_template WHERE mail_template_id = '" . (int) $mail_template_id . "'");

        return $query->row;
    }
    
    public function getMailTemplates($data = array()) {
        $sql = "SELECT * FROM " . DB_PREFIX . "mail_template m LEFT JOIN " . DB_PREFIX . "mail_template_description md ON(m.mail_template_id = md.mail_template_id) WHERE md.language_id = '" . (int) $this->config->get('config_language_id') . "'";

        $sort_data = array('pd.title');

        if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
            $sql .= " ORDER BY " . $data['sort'];
        } else {
            $sql .= " ORDER BY md.title";
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
    
     public function deleteMailTemplate($mail_template_id) {
        $this->db->query("DELETE FROM " . DB_PREFIX . "mail_template WHERE mail_template_id = '" . (int) $mail_template_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "mail_template_description WHERE mail_template_id = '" . (int) $mail_template_id . "'");
    }

    public function getMailTemplateDescriptions($mail_template_id) {
        $mail_description_data = array();

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "mail_template_description WHERE mail_template_id = '" . (int) $mail_template_id . "'");

        foreach ($query->rows as $result) {
            $mail_description_data[$result['language_id']] = array(
                'title' => $result['title'],
                'template' => $result['template'],
            );
        }

        return $mail_description_data;
    }
    
     public function getTotalMailTemplates() {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "mail_template");

        return $query->row['total'];
    }
}
