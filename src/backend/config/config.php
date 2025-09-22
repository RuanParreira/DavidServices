<?php
// Load environment variables from .env file
function loadEnv($path)
{
    if (!file_exists($path)) {
        return;
    }

    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) {
            continue; // Skip comments
        }

        list($name, $value) = explode('=', $line, 2);
        $name = trim($name);
        $value = trim($value);

        if (!array_key_exists($name, $_ENV)) {
            $_ENV[$name] = $value;
        }
    }
}

// Load .env file (adjust path as needed - going up 3 levels from src/backend/config/)
loadEnv(__DIR__ . '/../../../.env');

// Database configuration using environment variables
define('CONF_DB_HOST', $_ENV['DB_HOST'] ?? 'localhost');
define('CONF_DB_USER', $_ENV['DB_USER'] ?? 'root');
define('CONF_DB_PASS', $_ENV['DB_PASS'] ?? '');
define('CONF_DB_NAME', $_ENV['DB_NAME'] ?? 'davidservices');
define('CONF_DB_CHARSET', 'utf8');

// Project URLs
define("CONF_URL_BASE", "http://localhost/DavidServices");
define("CONF_URL_ADMIN", CONF_URL_BASE . "/admin");
define("CONF_URL_ERROR", CONF_URL_BASE . "/404");

//Dates)
date_default_timezone_set('America/Sao_Paulo');
define("CONF_DATE_BR", "d/m/Y");
define("CONF_DATE_APP", "Y-m-d H:i:s");
