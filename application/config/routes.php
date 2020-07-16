<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// $route['index/index_list']='index/index_list/1';
$route['default_controller'] = 'index/index_list';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
//$route['index/([a-z]+)/([a-z]+)/(\d+)']="$1/$2/$3";