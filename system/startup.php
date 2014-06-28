<?php

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
 * @package     Semite LLC
 * @version     $Id: startup.php Jun 14, 2014 ahmet
 * @copyright   Copyright (c) 2014 Semite LLC .
 * @license     http://www.semitepayment.com/license/
 */
/**
 * Description of startup.php
 *
 * @author ahmet
 */
// Error Reporting
error_reporting(E_ALL);

// Check Version
if (version_compare(phpversion(), '5.1.0', '<') == true) {
    exit('PHP5.1+ Required');
}

// Register Globals
if (ini_get('register_globals')) {
    ini_set('session.use_cookies', 'On');
    ini_set('session.use_trans_sid', 'Off');

    session_set_cookie_params(0, '/');
    session_start();

    $globals = array($_REQUEST, $_SESSION, $_SERVER, $_FILES);

    foreach ($globals as $global) {
        foreach (array_keys($global) as $key) {
            unset(${$key});
        }
    }
}

// Magic Quotes Fix
if (ini_get('magic_quotes_gpc')) {

    function clean($data) {
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                $data[clean($key)] = clean($value);
            }
        } else {
            $data = stripslashes($data);
        }

        return $data;
    }

    $_GET = clean($_GET);
    $_POST = clean($_POST);
    $_REQUEST = clean($_REQUEST);
    $_COOKIE = clean($_COOKIE);
}

if (!ini_get('date.timezone')) {
    date_default_timezone_set('UTC');
}

// Windows IIS Compatibility  
if (!isset($_SERVER['DOCUMENT_ROOT'])) {
    if (isset($_SERVER['SCRIPT_FILENAME'])) {
        $_SERVER['DOCUMENT_ROOT'] = str_replace('\\', '/', substr($_SERVER['SCRIPT_FILENAME'], 0, 0 - strlen($_SERVER['PHP_SELF'])));
    }
}

if (!isset($_SERVER['DOCUMENT_ROOT'])) {
    if (isset($_SERVER['PATH_TRANSLATED'])) {
        $_SERVER['DOCUMENT_ROOT'] = str_replace('\\', '/', substr(str_replace('\\\\', '\\', $_SERVER['PATH_TRANSLATED']), 0, 0 - strlen($_SERVER['PHP_SELF'])));
    }
}

if (!isset($_SERVER['REQUEST_URI'])) {
    $_SERVER['REQUEST_URI'] = substr($_SERVER['PHP_SELF'], 1);

    if (isset($_SERVER['QUERY_STRING'])) {
        $_SERVER['REQUEST_URI'] .= '?' . $_SERVER['QUERY_STRING'];
    }
}

if (!isset($_SERVER['HTTP_HOST'])) {
    $_SERVER['HTTP_HOST'] = getenv('HTTP_HOST');
}

// Class Loader

require_once (DIR_SYSTEM. 'engine' . DS . 'autoloader.php');

$auto_loader = new Autoloader();

$classes['helper'] = array(
    'json',
    'utf8',
    'debug');
$classes['engine'] = array(
    'registry',
    'action',
    'controller',
    'front',
    'loader',
    'model',
    'page'
);
$classes['library'] = array(
    'user',
    'config',
    'db',
    'url',
    'log',
    'request',
    'response',
    'cache',
    'session',
    'language',
    'document',
    'currency',
    'mail',
    'pagination',
    'image',
    'encryption',
    'content',
    'module',
    'creditcards');

if ((isset($classes)) && is_array($classes)) {

    $auto_loader->_loadFromArray($classes);

}

