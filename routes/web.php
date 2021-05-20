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

$router->group(['prefix'=>'api/v1'],function () use ($router)
{
   $router->get('acccustomerinvoicelist','AccCustomerInvoiceController@index');
   $router->post('acccustomerinvoicestore','AccCustomerInvoiceController@create');
   $router->get('acccustomerinvoiceedit','AccCustomerInvoiceController@show');
   $router->put('acccustomerinvoiceupdate','AccCustomerInvoiceController@update');
   $router->delete('acccustomerinvoicedelete','AccCustomerInvoiceController@destroy');

   $router->get('customerlist','CustomerListController@index');

   $router->get('detailcustomeredit','DetailCustomerController@show');

   $router->get('datasuratjalanlist','DataSuratJalanController@index');

   $router->get('addcustomerfromsjlist','AddCustomerFromSjController@index');

   $router->get('adddodtllist','AddDoDtlController@index');

});
