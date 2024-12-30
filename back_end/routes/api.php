<?php
$router = new AltoRouter();

// category
$router->map('GET', '/api/v1/categories', 'CategoryController@index', 'category.index');
$router->map('GET', '/api/v1/categories/[i:id]', 'CategoryController@show', 'category.show');
$router->map('POST', '/api/v1/categories', 'CategoryController@store', 'category.store');
$router->map('PUT', '/api/v1/categories/[i:id]', 'CategoryController@update', 'category.update');
$router->map('DELETE', '/api/v1/categories/[i:id]', 'CategoryController@destroy', 'category.destroy');
