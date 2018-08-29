<?php

require_once 'functions.php';

$link = mysqli_connect("localhost:3306", "root", "1121", "tr");
//$link = mysqli_connect("localhost", "cr92525_tr", "ZiQVKuj4", "cr92525_tr");

if (!$link) {
    /*$error = mysqli_connect_error();
    $content = render_template('templates/error.php',
        [
            'error' => $error
        ]);

    $layout = render_template('templates/layout.php',
        [
            'content' => $content,
        ]);

    print $layout;*/

    echo "Ошибка";
    exit();
}

