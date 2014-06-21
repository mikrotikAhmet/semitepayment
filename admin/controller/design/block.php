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
class ControllerDesignBlock extends Controller {

    private $error = array();

    public function index() {
        $this->language->load('design/block');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('design/block');

        $this->getList();
    }

    public function insert() {
        $this->language->load('design/block');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('design/block');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
            $this->model_design_block->addBlock($this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            $url = '';

            if (isset($this->request->get['sort'])) {
                $url .= '&sort=' . $this->request->get['sort'];
            }

            if (isset($this->request->get['order'])) {
                $url .= '&order=' . $this->request->get['order'];
            }

            if (isset($this->request->get['page'])) {
                $url .= '&page=' . $this->request->get['page'];
            }

            $this->redirect($this->url->link('design/block', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }

        $this->getForm();
    }

    public function update() {
        $this->language->load('design/block');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('design/block');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {

            $this->model_design_block->editBlock($this->request->get['block_id'], $this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            $url = '';

            if (isset($this->request->get['sort'])) {
                $url .= '&sort=' . $this->request->get['sort'];
            }

            if (isset($this->request->get['order'])) {
                $url .= '&order=' . $this->request->get['order'];
            }

            if (isset($this->request->get['page'])) {
                $url .= '&page=' . $this->request->get['page'];
            }

            $this->redirect($this->url->link('design/block', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }

        $this->getForm();
    }

    public function delete() {
        $this->language->load('design/block');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('design/block');

        if (isset($this->request->post['selected']) && $this->validateDelete()) {
            foreach ($this->request->post['selected'] as $block_id) {
                $this->model_design_block->deleteBlock($block_id);
            }

            $this->session->data['success'] = $this->language->get('text_success');

            $url = '';

            if (isset($this->request->get['sort'])) {
                $url .= '&sort=' . $this->request->get['sort'];
            }

            if (isset($this->request->get['order'])) {
                $url .= '&order=' . $this->request->get['order'];
            }

            if (isset($this->request->get['page'])) {
                $url .= '&page=' . $this->request->get['page'];
            }
            $this->redirect($this->url->link('design/block', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }

        $this->getList();
    }

    protected function getList() {
        if (isset($this->request->get['sort'])) {
            $sort = $this->request->get['sort'];
        } else {
            $sort = 'bd.title';
        }

        if (isset($this->request->get['order'])) {
            $order = $this->request->get['order'];
        } else {
            $order = 'ASC';
        }

        if (isset($this->request->get['page'])) {
            $page = $this->request->get['page'];
        } else {
            $page = 1;
        }

        $url = '';

        if (isset($this->request->get['sort'])) {
            $url .= '&sort=' . $this->request->get['sort'];
        }

        if (isset($this->request->get['order'])) {
            $url .= '&order=' . $this->request->get['order'];
        }

        if (isset($this->request->get['page'])) {
            $url .= '&page=' . $this->request->get['page'];
        }

        $this->data['breadcrumbs'] = array();

        $this->data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => false
        );

        $this->data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('design/block', 'token=' . $this->session->data['token'] . $url, 'SSL'),
            'separator' => ' :: '
        );

        $this->data['insert'] = $this->url->link('design/block/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
        $this->data['delete'] = $this->url->link('design/block/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');

        $this->data['blocks'] = array();

        $data = array(
            'sort' => $sort,
            'order' => $order,
            'start' => ($page - 1) * $this->config->get('config_admin_limit'),
            'limit' => $this->config->get('config_admin_limit')
        );

        $block_total = $this->model_design_block->getTotalBlocks();

        $results = $this->model_design_block->getBlocks($data);

        foreach ($results as $result) {
            $action = array();

            $action[] = array(
                'text' => $this->language->get('text_edit'),
                'href' => $this->url->link('design/block/update', 'token=' . $this->session->data['token'] . '&block_id=' . $result['block_id'] . $url, 'SSL')
            );

            $this->data['blocks'][] = array(
                'block_id' => $result['block_id'],
                'title' => $result['title'],
                'selected' => isset($this->request->post['selected']) && in_array($result['block_id'], $this->request->post['selected']),
                'action' => $action
            );
        }

        $this->data['heading_title'] = $this->language->get('heading_title');

        $this->data['text_no_results'] = $this->language->get('text_no_results');

        $this->data['column_title'] = $this->language->get('column_title');
        $this->data['column_action'] = $this->language->get('column_action');

        $this->data['button_insert'] = $this->language->get('button_insert');
        $this->data['button_delete'] = $this->language->get('button_delete');

        if (isset($this->error['warning'])) {
            $this->data['error_warning'] = $this->error['warning'];
        } else {
            $this->data['error_warning'] = '';
        }

        if (isset($this->session->data['success'])) {
            $this->data['success'] = $this->session->data['success'];

            unset($this->session->data['success']);
        } else {
            $this->data['success'] = '';
        }

        $url = '';

        if ($order == 'ASC') {
            $url .= '&order=DESC';
        } else {
            $url .= '&order=ASC';
        }

        if (isset($this->request->get['page'])) {
            $url .= '&page=' . $this->request->get['page'];
        }

        $this->data['sort_title'] = $this->url->link('design/block', 'token=' . $this->session->data['token'] . '&sort=bd.title' . $url, 'SSL');

        $url = '';

        if (isset($this->request->get['sort'])) {
            $url .= '&sort=' . $this->request->get['sort'];
        }

        if (isset($this->request->get['order'])) {
            $url .= '&order=' . $this->request->get['order'];
        }

        $pagination = new Pagination();
        $pagination->total = $block_total;
        $pagination->page = $page;
        $pagination->limit = $this->config->get('config_admin_limit');
        $pagination->text = $this->language->get('text_pagination');
        $pagination->url = $this->url->link('design/block', 'token=' . $this->session->data['token'] . $url . '&block={block}', 'SSL');

        $this->data['pagination'] = $pagination->render();

        $this->data['sort'] = $sort;
        $this->data['order'] = $order;

        $this->template = 'design/block_list.tpl';
        $this->children = array(
            'common/header',
            'common/footer'
        );

        $this->response->setOutput($this->render());
    }

    protected function getForm() {
        $this->data['heading_title'] = $this->language->get('heading_title');

        $this->document->addScript('view/javascript/jquery/tabs.js');

        $this->data['text_default'] = $this->language->get('text_default');
        $this->data['text_select'] = $this->language->get('text_select');
        $this->data['text_image_manager'] = $this->language->get('text_image_manager');
        $this->data['text_browse'] = $this->language->get('text_browse');
        $this->data['text_clear'] = $this->language->get('text_clear');

        $this->data['entry_title'] = $this->language->get('entry_title');
        $this->data['entry_sub_title'] = $this->language->get('entry_sub_title');
        $this->data['entry_image'] = $this->language->get('entry_image');
        $this->data['entry_class'] = $this->language->get('entry_class');
        $this->data['entry_additional_classes'] = $this->language->get('entry_additional_classes');
        $this->data['entry_show_image'] = $this->language->get('entry_show_image');
        $this->data['entry_show_title'] = $this->language->get('entry_show_title');
        $this->data['entry_show_sub_title'] = $this->language->get('entry_show_sub_title');
        $this->data['entry_description'] = $this->language->get('entry_description');
        
        $this->data['entry_subject'] = $this->language->get('entry_subject');
        $this->data['entry_unit_class'] = $this->language->get('entry_unit_class');
        $this->data['entry_unit_additional_class'] = $this->language->get('entry_unit_additional_class');
        $this->data['entry_sort_order'] = $this->language->get('entry_sort_order');

        $this->data['tab_general'] = $this->language->get('tab_general');
        $this->data['tab_data'] = $this->language->get('tab_data');
        $this->data['tab_block_content'] = $this->language->get('tab_block_content');
        $this->data['tab_unit'] = $this->language->get('tab_unit');

        $this->data['button_save'] = $this->language->get('button_save');
        $this->data['button_cancel'] = $this->language->get('button_cancel');
        $this->data['button_remove'] = $this->language->get('button_remove');
        $this->data['button_add_unit'] = $this->language->get('button_add_unit');
        $this->data['button_add_subject'] = $this->language->get('button_add_subject');

        if (isset($this->error['warning'])) {
            $this->data['error_warning'] = $this->error['warning'];
        } else {
            $this->data['error_warning'] = '';
        }

        if (isset($this->error['title'])) {
            $this->data['error_title'] = $this->error['title'];
        } else {
            $this->data['error_title'] = array();
        }

        $url = '';

        if (isset($this->request->get['sort'])) {
            $url .= '&sort=' . $this->request->get['sort'];
        }

        if (isset($this->request->get['order'])) {
            $url .= '&order=' . $this->request->get['order'];
        }

        if (isset($this->request->get['page'])) {
            $url .= '&page=' . $this->request->get['page'];
        }

        $this->data['breadcrumbs'] = array();

        $this->data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => false
        );

        $this->data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('design/block', 'token=' . $this->session->data['token'] . $url, 'SSL'),
            'separator' => ' :: '
        );

        if (!isset($this->request->get['block_id'])) {
            $this->data['action'] = $this->url->link('design/block/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
        } else {
            $this->data['action'] = $this->url->link('design/block/update', 'token=' . $this->session->data['token'] . '&block_id=' . $this->request->get['block_id'] . $url, 'SSL');
        }

        if (isset($this->request->get['block_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
            $block_info = $this->model_design_block->getBlock($this->request->get['block_id']);
        }

        $this->data['cancel'] = $this->url->link('design/block', 'token=' . $this->session->data['token'] . $url, 'SSL');

        $this->data['token'] = $this->session->data['token'];

        $this->load->model('localisation/language');

        $this->data['languages'] = $this->model_localisation_language->getLanguages();

        if (isset($this->request->post['block_description'])) {
            $this->data['block_description'] = $this->request->post['block_description'];
        } elseif (isset($this->request->get['block_id'])) {
            $this->data['block_description'] = $this->model_design_block->getBlockDescriptions($this->request->get['block_id']);
        } else {
            $this->data['block_description'] = array();
        }
        
        if (isset($this->request->post['image'])) {
            $this->data['image'] = $this->request->post['image'];
        } elseif (!empty($block_info)) {
            $this->data['image'] = $block_info['image'];
        } else {
            $this->data['image'] = '';
        }

        $this->load->model('tool/image');

        if (isset($this->request->post['image']) && file_exists(DIR_IMAGE . $this->request->post['image'])) {
            $this->data['thumb'] = $this->model_tool_image->resize($this->request->post['image'], 100, 100);
        } elseif (!empty($block_info) && $block_info['image'] && file_exists(DIR_IMAGE . $block_info['image'])) {
            $this->data['thumb'] = $this->model_tool_image->resize($block_info['image'], 100, 100);
        } else {
            $this->data['thumb'] = $this->model_tool_image->resize('no_image.jpg', 100, 100);
        }

        $this->data['no_image'] = $this->model_tool_image->resize('no_image.jpg', 100, 100);
        
        if (isset($this->request->post['class'])) {
            $this->data['class'] = $this->request->post['class'];
        } elseif (!empty($block_info)) {
            $this->data['class'] = $block_info['class'];
        } else {
            $this->data['class'] = 'block';
        }

        if (isset($this->request->post['additional_classes'])) {
            $this->data['additional_classes'] = $this->request->post['additional_classes'];
        } elseif (!empty($block_info)) {
            $this->data['additional_classes'] = $block_info['additional_classes'];
        } else {
            $this->data['additional_classes'] = '';
        }
        
        if (isset($this->request->post['show_image'])) {
            $this->data['show_image'] = $this->request->post['show_image'];
        } elseif (!empty($block_info)) {
            $this->data['show_image'] = $block_info['show_image'];
        } else {
            $this->data['show_image'] = 0;
        }
        
        if (isset($this->request->post['show_title'])) {
            $this->data['show_title'] = $this->request->post['show_title'];
        } elseif (!empty($block_info)) {
            $this->data['show_title'] = $block_info['show_title'];
        } else {
            $this->data['show_title'] = 0;
        }
        
        if (isset($this->request->post['show_sub_title'])) {
            $this->data['show_sub_title'] = $this->request->post['show_sub_title'];
        } elseif (!empty($block_info)) {
            $this->data['show_sub_title'] = $block_info['show_sub_title'];
        } else {
            $this->data['show_sub_title'] = 0;
        }
        
        if (isset($this->request->post['units'])) {
            $this->data['units'] = $this->request->post['units'];
        } elseif (!empty($block_info)) {
            $this->data['units'] = $this->model_design_block->getUnitsByBlockId($block_info['block_id']);
        } else {
            $this->data['units'] = array();
        }
        
        $this->load->model('application/content');
        
        $this->data['contents'] = $this->model_application_content->getContents();
        
        $this->data['unit_subjects'] = array();
        
        if (isset($this->request->post['subject'])) {
            $this->data['unit_subjects'] = $this->request->post['subject'];
        } elseif (!empty($block_info)) {
            $units = $this->model_design_block->getUnitsByBlockId($block_info['block_id']);
            $subjects = array();
            
            foreach ($units as $unit) {
                $subjects[] = (!empty($unit['subject']) ? unserialize($unit['subject']) : null);
                
            }
            $this->data['unit_subjects'] = $subjects;
        } else {
            $this->data['unit_subjects'] = array();
        }
        

        
        $this->template = 'design/block_form.tpl';
        $this->children = array(
            'common/header',
            'common/footer'
        );

        $this->response->setOutput($this->render());
    }

    protected function validateForm() {
        if (!$this->user->hasPermission('modify', 'design/block')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        foreach ($this->request->post['block_description'] as $language_id => $value) {
            if ((utf8_strlen($value['title']) < 3) || (utf8_strlen($value['title']) > 64)) {
                $this->error['title'][$language_id] = $this->language->get('error_title');
            }
        }

        if (!$this->error) {
            return true;
        } else {
            return false;
        }
    }

    protected function validateDelete() {
        if (!$this->user->hasPermission('modify', 'design/block')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }
        
        $this->load->model('design/page');
        
        foreach ($this->request->post['selected'] as $block_id) {
            
            $page_total = $this->model_design_page->getTotalPagesByBlockId($block_id);

            if ($page_total) {
                $this->error['warning'] = sprintf($this->language->get('error_page'), $page_total);
            }
        }

        if (!$this->error) {
            return true;
        } else {
            return false;
        }
    }

}
