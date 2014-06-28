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

class Page {

    private $page;
    private $page_id;
    private $page_title;
    private $page_sub_title;
    private $featured;
    private $description;
    private $keyword;
    private $page_blocks = array();

    public function __construct($registry) {



        $this->db = $registry->get('db');
        $this->request = $registry->get('request');
        $this->session = $registry->get('session');
        $this->config = $registry->get('config');
        $this->load = $registry->get('load');

        require_once DIR_APPLICATION . 'model/tool/image.php';

        $this->imager = new ModelToolImage($registry);
    }

    public function setPage($page) {
        $this->page = $page;

        $this->setPageId($this->page['page_id']);
        $this->setPageTitle($this->page['title']);
        $this->setPageSubTitle($this->page['sub_title']);
        $this->setFeatured($this->page['image']);
        $this->setDescription($this->page['meta_description']);
        $this->setKeyword($this->page['meta_keyword']);
    }

    public function getPage() {
        return $this->page;
    }

    public function setPageId($page_id) {
        $this->page_id = $page_id;
    }

    public function getPageId() {
        return $this->page_id;
    }

    public function setPageTitle($page_title) {
        $this->page_title = $page_title;
    }

    public function getPageTitle() {
        if ($this->page['show_title']) {

            return $this->page_title;
        } else {
            return false;
        }
    }

    public function setPageSubTitle($page_sub_title) {
        $this->page_sub_title = $page_sub_title;
    }

    public function getPageSubTitle() {
        if ($this->page['show_sub_title']) {

            return $this->page_sub_title;
        } else {
            return false;
        }
    }

    public function setFeatured($featured) {

        if (isset($featured) && file_exists(DIR_IMAGE . $featured)) {
            $this->featured = $this->imager->resize($featured, 1170, 239);
        } else {
            return false;
        }
    }

    public function getFeatured() {

        if ($this->featured) {
            $featured = '<img src="' . $this->featured . '"/>';

            return $featured;
        } else {
            return false;
        }
    }
    
    public function setDescription($description){
        
        $this->description = $description;
    }
    
    public function getDescription(){
        return $this->description;
    }
    
    public function setKeyword($keyword){
        
        $this->keyword = $keyword;
    }
    
    public function getKeyword(){
        return $this->keyword;
    }
    
    public function getPageBlocks(){
        
        $results = $this->db->query("SELECT * FROM ".DB_PREFIX."page_to_block WHERE page_id = '".(int) $this->page_id."'");
        
        
        return $results->rows;
    }

}
