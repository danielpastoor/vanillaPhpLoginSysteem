<?php

class LoginController
{
    public static function index()
    {
        return Helpers::view('login');
    }

    public static function loginUser()
    {
        $request = new RequestHelper;
        $errors = [];

        if ($request->checkCsrfToken($request->getField('token'))) {
            $username = trim($request->getField('username'));
            $password = $request->getField('password');

            if (empty($username)) {
                array_push($errors, 'Username is required.');
            }

            if (empty($password)) {
                array_push($errors, 'Password is required.');
            }

            if (!count($errors)) {
                $user = (new DB)->table('users')->where('username', $username)->first();

                if (password_verify($password, $user->password)) {
                    AuthController::loginUser($user->userID);
                } else {
                    array_push($errors, 'Password is wrong');
                }
            }
        } else {
            Helpers::setError("Please refresh the website");
        }

        return Helpers::view('login', ['errors' => $errors]);
    }

    public static function logout()
    {
        if (session_id() == '' || !isset($_SESSION) || session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        unset($_SESSION['userID']);
        session_unset();
        session_destroy();

        Helpers::redirect('login');
    }
}
