<?php

namespace Helpers;

class Auth
{
    static $loginUrl = '/index.php';

    static function check() {
        session_start();
        if(isset($_SESSION['user'])) {
            return $_SESSION['user'];
        } else {
            HTTP::redirect(static::$loginUrl);
        }
    }

    static function checkToken($token) {
        if($token === $_SESSION['csrf']) {
            return true;
        } else {
            return false;
        }
    }

    static function setToken() {
        $token = sha1(rand(1, 1000) . 'csrf secret');

        $_SESSION['csrf'] = $token;
        return $token;
    }
}