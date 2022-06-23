<?php

require_once(dirname(__FILE__, 2) . '/src/init.php');
$router = new App();

$router->get('/api/pembayaran', "TransaksiController@index");
$router->post('/api/pembayaran', [TransaksiController::class, "create"]);

$router->run();
