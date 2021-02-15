<?php

$url = explode('/', $_SERVER['REQUEST_URI']); // full url path
$root = $url[1] == 'pages' ? '..' : '.';
$pages_root = $url[1] == 'pages' ? '.' : './pages';
$page_title = ($url[1] == 'pages' && isset($url[2])) ? substr($url[2], 0, strpos($url[2], '.')) : 'Moosic';
$current_page = ($url[1] == 'pages' && isset($url[2])) ? "../".$url[1]."/".$url[2] : '../index.php';

?>