<?php

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', __DIR__ . DS);

define('IS_LOCAL', in_array($_SERVER['REMOTE_ADDR'],['127.0.0.1','::1']) ? true : false );
define('PORT', IS_LOCAL ? '80' : 'REMOTE PORT');
define('URL', IS_LOCAL ? '127.0.0.5:' . PORT . DS : 'REMOTE URL');

define('DB_HOST', IS_LOCAL ? 'localhost' : 'REMOTE HOST');
define('DB_USER', IS_LOCAL ? 'root' : 'REMOTE USER');
define('DB_PASS', IS_LOCAL ? '' : 'REMOTE PASSWORD');
define('DB_NAME', IS_LOCAL ? 'vitalcare' : 'REMOTE DATABASE NAME');

define('CLASSES',       ROOT . 'classes' . DS);
define('CLASSES_PATH',  ROOT . '..' . DS);
define('CONTROLLERS',   ROOT . 'controllers' . DS);
define('RESOURCES',     ROOT . 'resources' . DS);

define('BASE_URL', IS_LOCAL ? '/VitalCare/app/public/' : '127.0.0.1');  // ajusta si cambia en producción
define('CSS', BASE_URL . 'assets/css/');
define('JS',  BASE_URL . 'assets/js/');
define('IMG', BASE_URL . 'assets/img/'); 

define('LAYOUTS',       RESOURCES . 'layouts' . DS);
define('VIEWS',         RESOURCES . 'views' . DS);
define('FUNCTIONS',     RESOURCES . 'functions' . DS);