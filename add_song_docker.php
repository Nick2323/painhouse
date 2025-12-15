<?php
// Define the paths based on the container's filesystem
$basePath = '/var/www/html';
require_once($basePath . '/protected/yii.php');
$config = require_once($basePath . '/protected/config/main.php');
Yii::createWebApplication($config);

// Load the required models
Yii::import('application.models.repertoireDB');

$songName = 'Розпрягайте хлопці коні';
$categoryName = 'Українські народні пісні';

// Check if the song already exists
$songExists = repertoireDB::model()->find("Name=?", array($songName));
if ($songExists) {
    echo "Song '{$songName}' already exists.\n";
    exit;
}

// Check if the category exists, if not create it
$categoryExists = repertoireDB::model()->find("Name='' AND Category=?", array($categoryName));
if (!$categoryExists) {
    $categoryModel = new repertoireDB();
    $categoryModel->Name = '';
    $categoryModel->Category = $categoryName;
    if($categoryModel->save()) {
        echo "Category '{$categoryName}' created successfully.\n";
    } else {
        echo "Error creating category '{$categoryName}'.\n";
        print_r($categoryModel->getErrors());
        exit;
    }
}

// Add the song
$songModel = new repertoireDB();
$songModel->Name = $songName;
$songModel->Category = $categoryName;

if ($songModel->save()) {
    echo "Song '{$songName}' added to category '{$categoryName}' successfully.\n";
} else {
    echo "Error adding song '{$songName}'.\n";
    print_r($songModel->getErrors());
}
?>