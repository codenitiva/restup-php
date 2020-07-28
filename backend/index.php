<?php

require_once(__DIR__ . '/db/Database.php');

$db = new Database();
$db->open_connection();
$db->close_connection();
