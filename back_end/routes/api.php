<?php
$router = new AltoRouter();

// category
$router->map('GET', '/api/v1/categories', 'CategoryController@index', 'category.index');
