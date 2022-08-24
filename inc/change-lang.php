<?php 
session_start();

if(isset($_REQUEST['lang'])){
    if($_REQUEST['lang'] == 'ar'){
        $_SESSION['lang'] = "ar";
    }else{
         $_SESSION['lang'] = "en";
    }
}else{
    $_SESSION['lang'] = "en";
}



header("location:".$_SERVER["HTTP_REFERER"]);