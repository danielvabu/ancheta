<?php

if (preg_match("/dominio.com/i", $_SERVER["HTTP_HOST"])) {
    define('DB_SERVER', 'localhost');
    define('DB_TIPO', 'mysqli');
    define('DB_DEBUG', false);
    define('DB_USER', 'root');
    define('DB_CLAVE', 'pass');
    define('DB_DB', 'basededato');
} else {
    define('DB_SERVER', 'localhost');
    define('DB_TIPO', 'mysqli');
    define('DB_DEBUG', false);
    define('DB_USER', 'root');
    define('DB_CLAVE', '');
    define('DB_DB', 'basicosistema2');
}
define('DB_SCHEMAS', 'artesabi_schemas');

