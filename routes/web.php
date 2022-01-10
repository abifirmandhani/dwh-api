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
app()->router->get('zoap/{key}/server', [
    'as' => 'zoap.server.wsdl',
    'uses' => '\Viewflex\Zoap\ZoapController@server'
]);

app()->router->post('zoap/{key}/server', [
    'as' => 'zoap.server',
    'uses' => '\Viewflex\Zoap\ZoapController@server'
]);

$router->get("test_http", function(){

    $ch = curl_init("http://localhost/test-soap/public/zoap/demo/server?wsdl");
    // $fp = fopen("example_homepage.txt", "w");

    // curl_setopt($ch, CURLOPT_FILE, $fp);
    curl_setopt($ch, CURLOPT_HEADER, 0);

    curl_exec($ch);

    curl_close($ch);
    // fclose($fp);
});

    // ------------------------------------------------------
    // Route for Datawarehouse
    // ------------------------------------------------------
    $router->group([
        "namespace" => "DataWarehouse",
        // dwh_auth not user, adapts to the asiaTrade API
        // "middleware" => "dwh_auth"
    ], function () use ($router) {

        $router->get("dwh_web_service", [
            'as'    =>  'zoap.server.wsdwl',
            'uses'  =>  'SoapController@server'
        ]);

        $router->post("dwh_web_service", [
            'as'    =>  'zoap.server',
            'uses'  =>  'SoapController@server'
        ]);

        $router->post("login", "UserController@login");

        $router->get("users", "UserController@all");
        $router->get("cms/users", "UserController@allCms");
        $router->get("atpf/users", "UserController@allAtpf");
        $router->get("atpf/realaccount", "UserController@atpfRealAccount");
        $router->get("atpf/village_detail", "AtpfController@village_detail");
        $router->get("atpf/mt4_trade", "AtpfController@mt4_trade");


    });
    // ------------------------------------------------------
