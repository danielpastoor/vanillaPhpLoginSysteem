<?php

class DashboardController
{
    public static function index()
    {
        $user = Helpers::user();

        return Helpers::view('dashboard', ['user' => $user]);
    }
}
