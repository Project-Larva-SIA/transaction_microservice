<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

// transaction routes

$router->get('/transaction','TransactionController@getTransaction');
$router->get('/transaction/{TransactionID}','TransactionController@showTransaction');
$router->post('/transaction','TransactionController@addTransaction');
$router->put('/transaction/{TransactionID}','TransactionController@updateTransaction');
$router->delete('/transaction/{TransactionID}','TransactionController@deleteTransaction');

// invoice routes

$router->get('/invoice','InvoicesController@getInvoices');
// $router->get('/invoice/{BidID}', 'BidsController@show');
$router->get('/invoice/{InvoiceID}','InvoicesController@showInvoices');
$router->post('/invoice','InvoicesController@addInvoices');
$router->put('/invoice/{InvoiceID}','InvoicesController@updateInvoices');
$router->delete('/invoice/{InvoiceID}','InvoicesController@deleteInvoices');
