<?php

class AuthMiddleWare
{
    public static function authMiddle()
    {
        if (session_id() == '' || !isset($_SESSION) || session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_SESSION['userID']) && is_numeric($_SESSION['userID'])) {
            if (isset($_SESSION['timestamp']) && time() - $_SESSION['timestamp'] > 900) {
                RouteHelper::getRoute('logout');
            } else {
                $_SESSION['timestamp'] = time();
            }

            return true;
        } else {
            return Helpers::redirect('login');
        }
    }
}
