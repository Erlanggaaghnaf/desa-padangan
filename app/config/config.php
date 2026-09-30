<?php

define('DB_HOST', 'localhost');
define('DB_NAME', 'db_padangan');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_CHARSET', 'utf8mb4');

// Secret setup lokal tidak disimpan di repository.
$setupConfigFile = __DIR__ . '/setup.local.php';
if (is_file($setupConfigFile)) {
    $setupConfig = require $setupConfigFile;
    if (is_array($setupConfig)) {
        define('ADMIN_SETUP_ENABLED', (bool) ($setupConfig['enabled'] ?? true));
        define('ADMIN_SETUP_KEY', (string) ($setupConfig['key'] ?? ''));
    }
}

if (!defined('ADMIN_SETUP_ENABLED')) {
    define('ADMIN_SETUP_ENABLED', false);
}

if (!defined('ADMIN_SETUP_KEY')) {
    define('ADMIN_SETUP_KEY', '');
}
