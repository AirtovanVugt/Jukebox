<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url('css/style.css'); ?>">
    <title>InlogScherm</title>
</head>
<body>

<header>
    <?php
        if(isset($create)){
    ?>
        <a href="/"><button class="hoofdLetters">inloggen</button></a>
    <?php
        }
        else{
    ?>
        <a href="/create/createAccount"><button class="hoofdLetters">create account</button></a>
    <?php
        }
    ?>
</header>