<?php

class RegisterController
{
    public static function index()
    {
        EnqueueHelper::addJs('validate.js');
        EnqueueHelper::addStyle('style.css');

        return Helpers::view('register');
    }

    public static function createUser()
    {
        $request = new RequestHelper;
        if ($request->checkCsrfToken($request->getField('token'))) {
            $validateData = ValidateAuthForm::index($request->all());

            $errors = $validateData['errors'];

            if ($validateData['isValid']) {
                $username = trim($request->getField('username'));
                $email = $request->getField('email');
                $password = $request->getField('password');

                $password = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);


                $result = (new DB)->table('users')->insert(['username' => $username, 'email' => $email, 'password' => $password]);
                if ($result['result']) {
                    AuthController::loginUser($result['userID']);
                } else {
                    array_push($errors, 'Something went wrong. Please try again later.');
                }
            }
        } else {
            Helpers::setError("Please refresh the website");
        }

        return Helpers::view('register', ['errors' => $errors]);
    }
}
