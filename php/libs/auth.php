<?php
namespace lib;

use db\UserQuery;
use model\UserModel;

class Auth {
    public static function login($id, $pwd){
        $is_success = false;
    
        $user = UserQuery::fetchById($id);
        if(!empty($user) && $user->del_flg !== 1){
            // $result = password_verify($pwd, $user->pwd);
            if(password_verify($pwd, $user->pwd)){
                $is_success = true;
                UserModel::setSession($user);
            } else {
                echo 'パスワードが一致しません';
            }
        } else {
            echo 'ユーザが見つかりません';
        }
        return $is_success;
    }

    public static function regist($user){
        $is_success = false;

        $exist_user = UserQuery::fetchById($user->id);

        if(!empty($exist_user)){
            echo 'ユーザーがすでに存在しています。';
            return false;
        }

        $is_success = UserQuery::insert($user);

        if ($is_success) {
            UserModel::setSession($user);
        }

        return $is_success;
    }

    public static function isLogin() {
        $user = UserModel::getSession();

        if (isset($user)) {
            return true;
        } else {
            return false;
        }
    }
}
