<?php
define('BASE_DIR', dirname(dirname(__DIR__)) . '/');
define('ROOT_URL', '/');
define('PROTOCOL_URL', 'http');
define('SITE_URL', PROTOCOL_URL . '://localhost:8000' . ROOT_URL);
define('BASE', '');
define('BASE_URL', SITE_URL . BASE);
define('DB_SERVER', '127.0.0.1');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_Name', 'openmagazinedb');