<?php

RouteHelper::get('/', ['DashboardController', 'index'], ['AuthMiddleWare', 'authMiddle']);
RouteHelper::get('/login', ['LoginController', 'index']);
RouteHelper::get('/register', ['RegisterController', 'index']);
RouteHelper::get('/logout', ['LoginController', 'logout']);

RouteHelper::post('/register', ['RegisterController', 'createUser']);
RouteHelper::post('/login', ['LoginController', 'loginUser']);
