<?php

class RequestHelper
{
    protected $request = [];

    public function __construct()
    {
        $this->request = $this->escapeRequest($_REQUEST);
    }

    private function escapeRequest($request)
    {
        $returnData = [];
        foreach ($request as $key => $item) {
            if (is_array($item)) {
                foreach ($item as $childKey => $childItem) {
                    $returnData[$key][$childKey] = htmlspecialchars($childItem);
                }
            } else {
                $returnData[$key] = htmlspecialchars($item);
            }
        }

        return $returnData;
    }

    public function getField($fieldKey)
    {
        if (isset($this->request[$fieldKey])) {
            return $this->request[$fieldKey];
        }

        return false;
    }

    public function all()
    {
        return $this->request;
    }

    public function checkCsrfToken($token)
    {
        if (session_id() == '' || !isset($_SESSION) || session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!empty($_SESSION['token'])) {
            if (hash_equals($_SESSION['token'], $token)) {
                return true;
            }
        }

        return false;
    }

    public static function getCsrfToken()
    {
        if (session_id() == '' || !isset($_SESSION) || session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['token']) && empty($_SESSION['token'])) {
            $_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(32));
        }

        return $_SESSION['token'];
    }
}
