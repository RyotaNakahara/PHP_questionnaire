<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>みんなのアンケート</title>
    <link rel="stylesheet" href="../../css/sample.css">
</head>
<body>
<?php 
    use lib\Auth;

    if (Auth::isLogin()) {
        echo 'ログイン中！';
    } else {
        echo 'ログインしていません。';
    }

    ?>