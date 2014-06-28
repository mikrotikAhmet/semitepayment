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
 * Description of footer
 *
 * @author ahmet
 */
class ControllerCommonFooter extends Controller {

    protected function index() {
        $this->language->load('common/footer');

        $this->data['text_confirm'] = $this->language->get('text_confirm');
        $this->data['text_footer'] = sprintf($this->language->get('text_footer'), VERSION);

        if (file_exists(DIR_SYSTEM . 'config/svn/svn.ver')) {
            $this->data['text_footer'] .= '.r' . trim(file_get_contents(DIR_SYSTEM . 'config/svn/svn.ver'));
        }

        $this->template = 'common/footer.tpl';

        $this->render();
    }

}
