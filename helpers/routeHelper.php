<?php

class RouteHelper
{
    private static $routeList = [];

    public static function get($link, $callBack, $middleWare = false)
    {
        self::$routeList['GET'][$link] = ['callback' => $callBack];

        if ($middleWare) {
            self::$routeList['GET'][$link]['middleWare'] = $middleWare;
        }
    }

    public static function post($link, $callBack, $middleWare = false)
    {
        self::$routeList['POST'][$link] = ['callback' => $callBack, 'meth' => 'post'];

        if ($middleWare) {
            self::$routeList['POST'][$link]['middleWare'] = $middleWare;
        }
    }

    public static function index()
    {
        $request = $_SERVER['REQUEST_URI'];
        $requestMeth = $_SERVER['REQUEST_METHOD'];

        if (
            isset(self::$routeList[$requestMeth])
            && isset(self::$routeList[$requestMeth][$request])
        ) {
            $currentRoute = self::$routeList[$requestMeth][$request];

            if (
                class_exists($currentRoute['callback'][0])
                && method_exists($currentRoute['callback'][0], $currentRoute['callback'][1])
            ) {
                if (self::checkMiddleWare($currentRoute)) {
                    return call_user_func([$currentRoute['callback'][0], $currentRoute['callback'][1]]);
                }
            }
        }

        http_response_code(404);
        Helpers::view("404");
    }

    private static function checkMiddleWare($currentRoute)
    {
        if (isset($currentRoute['middleWare'])) {
            $middleWare = $currentRoute['middleWare'];
            if (
                class_exists($middleWare[0])
                && method_exists($middleWare[0], $middleWare[1])
            ) {
                return call_user_func([$middleWare[0], $middleWare[1]]);
            }
        }

        return true;
    }

    public static function getRoute($url)
    {
        $protocol = stripos($_SERVER['SERVER_PROTOCOL'], 'https') === 0 ? 'https://' : 'http://';
        $newURL = $protocol . $_SERVER['SERVER_NAME'] . dirname($_SERVER["REQUEST_URI"] . '?') . $url;

        return $newURL;
    }
}
