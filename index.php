<?php

// 检测PHP环境
if(version_compare(PHP_VERSION,'5.3.0','<'))  die('require PHP > 5.3.0 !');

define('BASE_PATH',realpath(dirname(__FILE__)));
define('APP_DEBUG',true);
// 
define('APP_PATH','./app/');

define('RUNTIME_PATH','./runtime/');

define('API_USER','ttchina_ses');

define('API_KEY','riidPyhyKz7HKkGv');
require './core/core.php';
