<?php

class EnqueueHelper
{
    private static $styleFiles = [];
    private static $javascriptFiles = [];

    public static function addJs($jsURI)
    {
        $jsURI = self::generateURI("js/".$jsURI);
        self::$javascriptFiles[] = "<script src='$jsURI'></script>";
    }

    public static function addStyle($styleUri)
    {
        $styleUri = self::generateURI("css/".$styleUri);
        self::$styleFiles[] = "<link rel='stylesheet' href='$styleUri'>";
    }

    private static function generateURI($url)
    {
        if (filter_var($url, FILTER_VALIDATE_URL) === FALSE) {
            $protocol = stripos($_SERVER['SERVER_PROTOCOL'], 'https') === 0 ? 'https://' : 'http://';
            $url = $protocol . $_SERVER['SERVER_NAME'] . dirname($_SERVER["REQUEST_URI"] . '?') . $url;
        }

        return $url;
    }

    public static function getStyling()
    {
        return implode("", self::$styleFiles);
    }

    public static function getJavscript()
    {
        return implode("", self::$javascriptFiles);
    }
}
