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
 * Date : Jun 19, 2014
 */

class Content {
    
    private $content_data = array();
    private $title;
    private $image;
    private $content;
    private $type;


    public function __construct($registry) {
        
        require_once DIR_APPLICATION.'model/tool/image.php';
        
        $this->db = $registry->get('db');
        $this->imager = new ModelToolImage($registry);
        $this->request = $registry->get('request');
        $this->session = $registry->get('session');
        $this->config = $registry->get('config');
    }
    
    public function setContent($content_id){
        
        $this->content_data = $this->db->query("SELECT * FROM ".DB_PREFIX."content_description WHERE language_id = '".(int) $this->config->get('config_language_id')."' AND content_id = '".(int) $content_id."'");
           
    }
    
    public function getTitle(){
        return $this->content_data->row['title'];
    }
    
    public function getContent(){
        return html_entity_decode($this->content_data->row['description'], ENT_QUOTES, 'UTF-8');
        
    }
    
}

