<?php
namespace lib;

use db\UserQuery;
use model\UserModel;
use Throwable;

class Auth {
    public static function login($id, $pwd){
        try {
            $is_success = false;
    
            $user = UserQuery::fetchById($id);
            if(!empty($user) && $user->del_flg !== 1){

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

        } catch (Throwable $e) {
            $is_success = false;
            Msg::push(Msg::DEBUG, $e->getMessage());
            Msg::push(Msg::ERROR, 'ログイン処理でエラーが発生しました。少し時間をおいてから再度お試しください。');
        }

    }

    public static function regist($user){
        try {
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

        } catch (Throwable $e) {
            $is_success = false;
            Msg::push(Msg::DEBUG, $e->getMessage());
            Msg::push(Msg::ERROR, 'ユーザー登録処理でエラーが発生しました。少し時間をおいてから再度お試しください。');
        }

        
    }

    public static function isLogin() {
        try {
            $user = UserModel::getSession();
        } catch (Throwable $e) {
            UserModel::clearSession();
            Msg::push(Msg::DEBUG, $e->getMessage());
            Msg::push(Msg::ERROR, 'エラーが起きました。再度ログインを行なってください。');
            return false;
        }

        if (isset($user)) {
            return true;
        } else {
            return false;
        }
    }
}
