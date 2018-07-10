<?php

function env($key, $default = null)
{
    $value = getenv($key);
    if ($value === 'false') { return false; }
    if ($value === 'true') { return true; }
    if ($value === false) { return $default; }
    return $value;
}

$root_dir = dirname(__DIR__);

require_once($root_dir . '/vendor/autoload.php');

$dotenv = new Dotenv\Dotenv($root_dir);
if (file_exists($root_dir)) {
    $dotenv->load();
    $dotenv->required(['DB_NAME', 'DB_USER', 'DB_PASSWORD', 'WP_URL']);
}

define('DB_NAME', env('DB_NAME'));
define('DB_USER', env('DB_USER'));
define('DB_PASSWORD', env('DB_PASSWORD'));
define('DB_HOST', env('DB_HOST', 'localhost'));

define('DB_CHARSET', 'utf8');
define('DB_COLLATE', '');

$httpHost = isset($_SERVER['HTTP_HOST']) ? 'http://'. $_SERVER['HTTP_HOST'] : '';
define('WP_HOME', env('WP_URL', $httpHost));
define('WP_SITEURL', env('WP_SITEURL', WP_HOME.'/'.env('WP_DIR', 'wordpress')));

define('WP_CONTENT_DIR', env('WP_CONTENT_DIR', __DIR__. '/content'));
define('WP_CONTENT_URL', env('WP_CONTENT_URL', WP_HOME. '/content'));

define('WP_DEFAULT_THEME', env('WP_THEME', 'wordpress-test'));

$table_prefix = env('WP_PREFIX', 'frame_');

/** Absolute path to the WordPress directory. */
if (!defined('ABSPATH')) {
    define('ABSPATH', dirname(__FILE__) . '/');
}

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
