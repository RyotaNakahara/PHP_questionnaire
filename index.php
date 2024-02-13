<?php

use lib\Msg;

require_once 'config.php';

// Library
require_once SOURCE_BASE . 'libs/helper.php';
require_once SOURCE_BASE . 'libs/auth.php';
require_once SOURCE_BASE . 'libs/router.php';

// model
require_once SOURCE_BASE . 'model/abstract.model.php';
require_once SOURCE_BASE . 'model/user.model.php';

// Message
require_once SOURCE_BASE . 'libs/message.php';

// db
require_once SOURCE_BASE . 'db/datasource.php';
require_once SOURCE_BASE . 'db/user.query.php';

// use db\UserQuery;
// $result = UserQuery::fetchById('test');
// var_dump($result);

use function lib\route;

session_start(); //model,dbの後に記述すること
require_once SOURCE_BASE . 'partials/header.php';

$rpath = str_replace('/poll/php/views/', '', CURRENT_URI); //~~.phpの~~のみ取得する
$method = strtolower($_SERVER['REQUEST_METHOD']);

route($rpath, $method);

require_once SOURCE_BASE . 'partials/footer.php';
?>
