<?php 
require_once 'connection.php';

$lang = "en";

if(isset($_SESSION['lang'])){
    $lang = $_SESSION['lang'];
}

if($lang == 'ar'){
    require_once 'message_ar.php';
}else{
    require_once 'message_en.php';
}

?>

<!DOCTYPE html>
<html lang="<?= $lang; ?>" dir="<?= $message['dir']?>">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>
<body>