<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="PANEL, DEV-Afrika">

    <meta name="author" content="DOP - Yitzak DEKPEMOU for DEV-Afrika">

    <link rel="icon" href="<?= $MEDIAS . '/uses/logo-p.png'; ?>">

    <title><?= WEBSITE_NAME . ' | ' . set_ptle($m[1]); ?></title>

    <link rel="stylesheet" type="text/css" href="<?= CDN . 'bootstrap/css/bootstrap.min.css'; ?>">

    <link rel="stylesheet" type="text/css" href="<?= CDN . 'aristo/Aristo.css'; ?>">

    <?php 

        if(isset($_SESSION['uid'])) { 

            $upref = find_one("uprefs", "uid", get_session('uid'));

            if($upref->stylemode === "D") {
            
            ?>
            
            <link rel="stylesheet" type="text/css" id="p-css-switch" href="<?= $CSS . '/panel-dark.style.css'; ?>">
            
            <?php

            } elseif($upref->stylemode === "C") {
            
            ?>
            
            <link rel="stylesheet" type="text/css" id="p-css-switch" href="<?= $CSS . '/panel.style.css'; ?>">
            
            <?php
    
            }  

        } else {
            
        ?>
        
        <link rel="stylesheet" type="text/css" id="p-css-switch" href="<?= $CSS . '/panel.style.css'; ?>">
        
        <?php
            
        }

    ?>

</head>

<body>