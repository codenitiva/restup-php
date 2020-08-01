<?php

require_once(__DIR__ . '/app/Application.php');
require_once(__DIR__ . '/controller/Controller.php');
require_once(__DIR__ . '/db/Database.php');
require_once(__DIR__ . '/request/Request.php');
require_once(__DIR__ . '/response/Response.php');
require_once(__DIR__ . '/response/ResponseContentType.php');
require_once(__DIR__ . '/router/Router.php');
require_once(__DIR__ . '/router/SubRouter.php');
require_once(__DIR__ . '/middleware/Middleware.php');
require_once(__DIR__ . '/helper/JSONHelper.php');
require_once(__DIR__ . '/helper/CookieHelper.php');
require_once(__DIR__ . '/helper/URLQueryParamsHelper.php');
require_once(__DIR__ . '/exception/UnknownRouterMethodException.php');
require_once(__DIR__ . '/exception/UnknownRouteException.php');
require_once(__DIR__ . '/exception/IllegalPrefixPathException.php');
require_once(__DIR__ . '/config/AppConfig.php');

// ? Insert your custom classes here
// ? Custom classes can be a sub router, middleware, and controller;
require_once(__DIR__ . '/controller/SampleController.php');
require_once(__DIR__ . '/router/SampleRouter.php');
require_once(__DIR__ . '/middleware/SampleMiddleware.php');
