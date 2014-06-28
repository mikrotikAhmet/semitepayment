<?php

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


if (!defined('DIR_APPLICATION'))
    exit('No direct script access allowed');

/**
 * Description of country
 *
 * @author ahmet
 */
class ModelLocalisationCountry extends Model {

    public function addCountry($data) {
        $this->db->query("INSERT INTO " . DB_PREFIX . "country SET name = '" . $this->db->escape($data['name']) . "', iso_code_2 = '" . $this->db->escape($data['iso_code_2']) . "', iso_code_3 = '" . $this->db->escape($data['iso_code_3']) . "', address_format = '" . $this->db->escape($data['address_format']) . "', postcode_required = '" . (int) $data['postcode_required'] . "', status = '" . (int) $data['status'] . "'");

        $this->cache->delete('country');
        
        $country_id = $this->db->getLastId();
        
        $geocode=file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address='.  ucfirst($data['name']).'&sensor=false');
        $output= json_decode($geocode);
        
        
        if ($output->status == 'OK'){
           $this->db->query("DELETE FROM ".DB_PREFIX."country_geo_data WHERE country_id = '".(int) $country_id."'");
           $this->db->query("INSERT INTO ".DB_PREFIX."country_geo_data SET country_id = '".(int) $country_id."',lat = '".(isset($output->results[0]->geometry->location->lat) ? (float) $output->results[0]->geometry->location->lat : (float) $output->results->geometry->location->lat)."',lng = '".(isset($output->results[0]->geometry->location->lng) ? (float) $output->results[0]->geometry->location->lng : (float) $output->results->geometry->location->lng)."',location_type = '".(isset($output->results[0]->geometry->location_type) ? $this->db->escape($output->results[0]->geometry->location_type) : $this->db->escape($output->results->geometry->location_type))."'");
        }
    }

    public function editCountry($country_id, $data) {
        
        $this->db->query("UPDATE " . DB_PREFIX . "country SET name = '" . $this->db->escape($data['name']) . "', iso_code_2 = '" . $this->db->escape($data['iso_code_2']) . "', iso_code_3 = '" . $this->db->escape($data['iso_code_3']) . "', address_format = '" . $this->db->escape($data['address_format']) . "', postcode_required = '" . (int) $data['postcode_required'] . "', status = '" . (int) $data['status'] . "' WHERE country_id = '" . (int) $country_id . "'");

        $this->cache->delete('country');
        
        $geocode=file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address='.  ucfirst($data['name']).'&sensor=false');
        $output= json_decode($geocode);
        
        if ($output->status == 'OK'){
           $this->db->query("DELETE FROM ".DB_PREFIX."country_geo_data WHERE country_id = '".(int) $country_id."'");
           $this->db->query("INSERT INTO ".DB_PREFIX."country_geo_data SET country_id = '".(int) $country_id."',lat = '".(isset($output->results[0]->geometry->location->lat) ? (float) $output->results[0]->geometry->location->lat : (float) $output->results->geometry->location->lat)."',lng = '".(isset($output->results[0]->geometry->location->lng) ? (float) $output->results[0]->geometry->location->lng : (float) $output->results->geometry->location->lng)."',location_type = '".(isset($output->results[0]->geometry->location_type) ? $this->db->escape($output->results[0]->geometry->location_type) : $this->db->escape($output->results->geometry->location_type))."'");
        }
             
//        if (!empty($data['coords'])){
//            
//            $this->db->query("DELETE FROM ".DB_PREFIX."map_point WHERE country_id = '".(int) $country_id."'");
//            $this->db->query("INSERT INTO ".DB_PREFIX."map_point SET country_id = '".(int) $country_id."', point = '".$this->db->escape($data['coords'])."'");
//        }
    }

    public function deleteCountry($country_id) {
        $this->db->query("DELETE FROM " . DB_PREFIX . "country WHERE country_id = '" . (int) $country_id . "'");

        $this->cache->delete('country');
        
//        $this->db->query("DELETE FROM ".DB_PREFIX."map_point WHERE country_id = '".(int) $country_id."'");
    }

    public function getCountry($country_id) {
        $query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "country WHERE country_id = '" . (int) $country_id . "'");

        return $query->row;
    }

    public function getCountries($data = array()) {
        if ($data) {
            $sql = "SELECT * FROM " . DB_PREFIX . "country";

            $sort_data = array(
                'name',
                'iso_code_2',
                'iso_code_3'
            );

            if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
                $sql .= " ORDER BY " . $data['sort'];
            } else {
                $sql .= " ORDER BY name";
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
            $country_data = $this->cache->get('country');

            if (!$country_data) {
                $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "country ORDER BY name ASC");

                $country_data = $query->rows;

                $this->cache->set('country', $country_data);
            }

            return $country_data;
        }
    }
    
    public function getCoordsByCountryId($country_id){
        
        $query = $this->db->query("SELECT * FROM ".DB_PREFIX."country_geo_data WHERE country_id = '".(int) $country_id."'");
        
        return $query->row;
    }

    public function getTotalCountries() {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "country");

        return $query->row['total'];
    }

}
