<?php

require(__DIR__ . '/requirements.php');

use Codenitiva\PHP\Application;
use Codenitiva\PHP\Routers\SampleRouter;
use Codenitiva\PHP\Middlewares\SampleMiddleware;

$app = new Application;

$app->add_sub_router(new SampleRouter, new SampleMiddleware);

$app->serve();
