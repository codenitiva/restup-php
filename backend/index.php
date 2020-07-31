<?php

require(__DIR__ . '/requirements.php');

use Codenitiva\PHP\Application;
use Codenitiva\PHP\Routers\SampleRouter;

$db = new Database();
$db->open_connection();
$db->close_connection();

// ? How to use
// ? Step 1: create a new REST API Application instance
$app = new Application;

// ? Step 2: add a sub router using add_sub_router method
$app->add_sub_router(new SampleRouter);

// ? Step 3: dont't forget to call the serve method to make sure the app is up and running.
$app->serve();
