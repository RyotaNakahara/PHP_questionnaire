<?php 
function get_param($key, $default_val, $is_post = true){
    $arry = $is_post ? $_POST : $_GET;
    return $arry[$key] ?? $default_val;
}

function redirect($path) {
    if ($path === GO_HOME) {
        $path = 'home';
    } else if ($path === GO_REFERE) {
        $path = $_SERVER['HTTP_REFERER'];
    }

    header("Location: {$path}");
}