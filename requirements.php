<?php

// imports for RESTup application classes
require_once(__DIR__ . '/app/Application.php');
require_once(__DIR__ . '/config/AppConfig.php');

// imports for base classes
require_once(__DIR__ . '/controller/Controller.php');
require_once(__DIR__ . '/db/Database.php');
require_once(__DIR__ . '/db/DBConstants.php');
require_once(__DIR__ . '/middleware/Middleware.php');
require_once(__DIR__ . '/model/BaseModel.php');
require_once(__DIR__ . '/router/Router.php');
require_once(__DIR__ . '/router/SubRouter.php');

// imports for request and response classes
require_once(__DIR__ . '/request/Request.php');
require_once(__DIR__ . '/response/Response.php');
require_once(__DIR__ . '/response/ResponseContentType.php');

// imports for helper classes
require_once(__DIR__ . '/helper/JSONHelper.php');
require_once(__DIR__ . '/helper/CookieHelper.php');
require_once(__DIR__ . '/helper/URLQueryParamsHelper.php');
require_once(__DIR__ . '/helper/TypeChecker.php');
require_once(__DIR__ . '/helper/QueryBuilder.php');

// imports for exception classes
require_once(__DIR__ . '/exception/UnknownRouterMethodException.php');
require_once(__DIR__ . '/exception/UnknownRouteException.php');
require_once(__DIR__ . '/exception/IllegalPrefixPathException.php');

// add your custom imports here
require_once(__DIR__ . '/app/controller/SampleController.php');
require_once(__DIR__ . '/app/router/SampleRouter.php');
require_once(__DIR__ . '/app/middleware/SampleMiddleware.php');
