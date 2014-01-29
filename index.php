<?php
/**
 * [WeEngine System] Copyright (c) 2013 WE7.CC
 */
define('IN_SYS', true);
require 'source/bootstrap.inc.php';
define('CONTROLLER', 'home');
$actions = array('attachment', 'help', 'announcement', 'module', 'welcome', 'sysinfo');
$action = in_array($action, $actions) ? $action : 'frame';
require router(CONTROLLER, $action);
