<?php
namespace lib;

use db\UserQuery;

class Auth {
    public static function login($id, $pwd){
        $is_success = false;
    
        $user = UserQuery::fetchById($id);
        if(!empty($user) && $user->del_flg !== 1){
            // $result = password_verify($pwd, $user->pwd);
            if(password_verify($pwd, $user->pwd)){
                $is_success = true;
                $_SESSION['user'] = $user;
            } else {
                echo 'パスワードが一致しません';
            }
        } else {
            echo 'ユーザが見つかりません';
        }
        return $is_success;
    }
}
