<?php

session_start();
include "classes/Db.php";
include "classes/Link.php";
include "classes/Validator.php";

if (isset($_POST['submit'])) {
    $url = $_POST['url'];
    $shortUrl = uniqid();

    // validate url
    $validator = new Validator();
    $url = $validator->checkUrl($url);
    if (!$url) {
        echo $validator->error;
        
    } else {
        $link = new Link();
        $is_saved = $link->addUrl($url, $shortUrl);

        if ($is_saved) {
            printf("Your short link is: " . "http://localhost/php_oop/ahmed-zaki-sat-3/?id=" . $shortUrl);
        } else {
            header('location:index.php');
        }
    }
}
