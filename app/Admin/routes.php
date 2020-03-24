<?php

use Illuminate\Routing\Router;

Admin::registerHelpersRoutes();

Route::group([
    'prefix' => config('admin.prefix'),
    'namespace' => Admin::controllerNameadmin . prefixspace(),
    'middleware' => ['web', 'admin'],
], function (Router $router) {

    $router->get('/', 'HomeController@index');
    $router->resource('users', UsersController::class);
    $router->post('users/userlogin', 'UsersController@login');
    $router->resource('postarticle', PostsArticleController::class);
    //$router->resource('postarticle2', PostsArticle2Controller::class);
    $router->resource('posttag', PostsTagController::class);
    $router->resource('postfilter', PostsFilterController::class);
    $router->resource('postcmt', CmtController::class);

});
