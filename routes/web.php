<?php

$router->get('/', function () use ($router) {
    return $router->app->version();
});

// transaction routes

$router->get('/transaction','TransactionController@index');
$router->get('/transaction/{TransactionID}','TransactionController@showTransaction');
$router->post('/transaction','TransactionController@addTransaction');
$router->delete('/transaction/{TransactionID}','TransactionController@deleteTransaction');

// invoice routes

$router->get('/invoice','InvoicesController@index');
$router->get('/invoice/{InvoiceID}','InvoicesController@showInvoices');
$router->post('/invoice','InvoicesController@addInvoice');
$router->delete('/invoice/{InvoiceID}','InvoicesController@deleteInvoices');


// Transaction Features

$router->get('/claim/{ItemID}','FeaturesController@claimItem');
$router->get('/buyer/{SellerID}','FeaturesController@showBuyer');