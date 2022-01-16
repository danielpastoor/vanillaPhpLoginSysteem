<?php

class Helpers
{
    public static function view($viewFile, $variables = [])
    {
        extract($variables);
        ob_start();
        include BASEPATHWEBSITE . "/resources/$viewFile.php";
        $viewFile = ob_get_clean();
        ob_flush();

        ob_start();
        include BASEPATHWEBSITE . "/resources/layouts/layout.php";
        $layout = ob_get_clean();
        ob_flush();

        $layout = str_replace('@content', $viewFile, $layout);

        echo $layout;
        die;
    }

    public static function user()
    {
        $userID = self::getUserID();
        return (new DB)->table("users")->where('userID', intval($userID))->first();

        return false;
    }

    public static function redirect($redirectURI)
    {
        $protocol = stripos($_SERVER['SERVER_PROTOCOL'], 'https') === 0 ? 'https://' : 'http://';
        $newURL = $protocol . $_SERVER['SERVER_NAME'] . dirname($_SERVER["REQUEST_URI"] . '?') . $redirectURI;

        header('Location: ' . $newURL);
        die;
    }

    public static function getUserID()
    {
        if (session_id() == '' || !isset($_SESSION) || session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_SESSION['userID']) && is_numeric($_SESSION['userID'])) {
            return $_SESSION["userID"];
        }

        return  self::redirect('login');
    }

    public static function setError($errorLog)
    {
        return Helpers::view('error', ['error' => $errorLog]);
        die;
    }
}
