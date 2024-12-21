<?php

// Require database connection
require_once 'config/config.php';
require 'config/connectDB.php';

// require vendor
require 'vendor/autoload.php';

// require controller
require 'controller/CategoryController.php';

// require model
require 'model/Category.php';
require 'model/CategoryRepository.php';

// require router
require 'routes/api.php';
require 'routes/Router.php';
new Router($router);
