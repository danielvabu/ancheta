<?php

if (preg_match("/artesabio.com/i", $_SERVER["HTTP_HOST"])) {
    define('DB_SERVER', 'localhost');
    define('DB_TIPO', 'mysqli');
    define('DB_DEBUG', false);
    define('DB_USER', 'artesabi_arte');
    define('DB_CLAVE', 'Asdf1234.#');
    define('DB_DB', 'artesabi_artesabio');
} else {
    define('DB_SERVER', 'localhost');
    define('DB_TIPO', 'mysqli');
    define('DB_DEBUG', false);
    define('DB_USER', 'root');
    define('DB_CLAVE', '');
    define('DB_DB', 'basicosistema2');
}
define('DB_SCHEMAS', 'artesabi_schemas');

