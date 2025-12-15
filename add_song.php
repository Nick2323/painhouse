<?php
require_once('index.php');

$_POST['Name'] = 'Розпрягайте хлопці коні';
$_POST['Category'] = 'Українські народні пісні';

$controller = new AdminController('admin');
$controller->actionAddrepertoire();
?>