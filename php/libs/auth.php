<?php
namespace lib;

use db\UserQuery;
use model\UserModel;
use Throwable;

class Auth {
    public static function login($id, $pwd){
        try {
            if (!UserModel::validateId($id)
                || !UserModel::validatePwd($id)) {
                return false;
            }

            $is_success = false;
    
            $user = UserQuery::fetchById($id);
            if(!empty($user) && $user->del_flg !== 1){

                if(password_verify($pwd, $user->pwd)){
                    $is_success = true;
                    UserModel::setSession($user);
                } else {

                    Msg::push(Msg::ERROR, 'パスワードが一致しません');

                }

            } else {

                Msg::push(Msg::ERROR, 'ユーザが見つかりません');

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
          if (!($user->isValidId()
            * $user->isValidPwd()
            * $user->isValidNickname())) {
                return false;
            }

            $is_success = false;

            $exist_user = UserQuery::fetchById($user->id);

            if(!empty($exist_user)){
                
                Msg::push(Msg::ERROR, 'ユーザーがすでに存在しています。');
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

    public static function logout() {
        try {

            UserModel::clearSession();

        } catch (Throwable $e) {

            Msg::push(Msg::DEBUG, $e->getMessage());
            return false;

        }

        return true;
    }
}
