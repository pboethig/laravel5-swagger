<?php

use Psr\Http\Message\ServerRequestInterface;
Route::group(array('module' => 'Api', 'namespace' => 'App\Modules\Api\Controllers'), function() {

    /**
    * Return a specific user
    */
    Route::get('Api/get/{id}', 'ApiController@get');

    /**
    * Return a list of users
    */
    Route::get('Api/list', 'ApiController@list');

    /**
    * Return a searchresult on users
    */
    Route::get('Api/search/{term}', 'ApiController@search');
});	