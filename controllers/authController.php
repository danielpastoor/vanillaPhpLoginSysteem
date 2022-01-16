<?php

class AuthController
{
    public static function loginUser($userID)
    {
        if (session_id() == '' || !isset($_SESSION) || session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION['userID'] = $userID;

        Helpers::redirect('');
    }
}
