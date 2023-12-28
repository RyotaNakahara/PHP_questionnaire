<?php 
require_once 'config.php';
require_once SOURCE_BASE . 'partials/header.php';

$rpath = str_replace('/poll/php/views/', '', $_SERVER['REQUEST_URI']); //~~.phpの~~のみ取得する
$method = strtolower($_SERVER['REQUEST_METHOD']);

route($rpath, $method);
function route($rpath, $method) {
    if($rpath === ''){
        $rpath = 'home';
    }
    
    $targetFile = SOURCE_BASE . "controllers/{$rpath}.php";
    
    if(!file_exists($targetFile)){
        require_once SOURCE_BASE . "views/404.php";
        return;
    }

    require_once $targetFile;

    $fn = "controller\\{$rpath}\\{$method}";
    
    $fn();
}

// if($_SERVER['REQUEST_URI'] === '/poll/php/views/login') {
//     require_once SOURCE_BASE . 'controllers/login.php';
// } elseif($_SERVER['REQUEST_URI'] === '/poll/php/views/register') {
//     require_once SOURCE_BASE . 'controllers/register.php';
// } elseif($_SERVER['REQUEST_URI'] === '/poll/php/views/home') {
//     require_once SOURCE_BASE . 'controllers/home.php';
// }

require_once SOURCE_BASE . 'partials/footer.php';
?>
