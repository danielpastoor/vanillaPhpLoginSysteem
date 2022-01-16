<?php
class ValidateAuthForm
{
    public static function index($data)
    {
        $errors = [];

        if (isset($data['email'])) {
            $email = $data['email'];
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                array_push($errors, 'Email is not valid');
            }
        }

        if (isset($data['password'])) {
            $password = $data['password'];

            if (empty($password)) {
                array_push($errors, 'Password is required.');
            } else if (strlen($password) < 6) {
                array_push($errors, 'Password must be more than 6 characters.');
            }

            if (isset($data['password2'])) {
                $password2 = $data['password2'];

                if ($password !== $password2) {
                    array_push($errors, "Password must be the same");
                }
            }
        }

        if (isset($data['username'])) {
            $username = $data['username'];
            if (empty($username)) {
                array_push($errors, 'Username is required.');
            } else if (strlen($username) < 3 || strlen($username) > 50) {
                array_push($errors, 'Username must be between 4 and 50 characters.');
            }

            if (!count($errors)) {
                $checkIfUsrExists =  (new DB)->table('users')->columns(['userID'])->where('username', $username)->first();
                if ($checkIfUsrExists) {
                    array_push($errors, 'This username is already in use.');
                }
            }
        }

        return ['isValid' => count($errors) === 0, 'errors' => $errors];
    }
}
