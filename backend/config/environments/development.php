<?php

/**
 * Configuration overrides for WP_ENV === 'development'
 */

use Roots\WPConfig\Config;
use function Env\env;

Config::define('SAVEQUERIES', true);
Config::define('WP_DEBUG', true);
Config::define('WP_DEBUG_DISPLAY', true);
Config::define('WP_DEBUG_LOG', env('WP_DEBUG_LOG') ?? true);
Config::define('WP_DISABLE_FATAL_ERROR_HANDLER', true);
Config::define('SCRIPT_DEBUG', true);
Config::define('DISALLOW_INDEXING', true);
Config::define('FS_METHOD', 'direct');
Config::define('WP_USE_THEMES', false);
Config::define('JWT_AUTH_SECRET_KEY', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9hcGVjcm9zbWllcmVzLmxvY2FsIiwiaWF0IjoxNjU4MzkxNTkxLCJuYmYiOjE2NTgzOTE1OTEsImV4cCI6MTY1ODk5NjM5MSwiZGF0YSI6eyJ1c2VyIjp7ImlkIjoxLCJkZXZpY2UiOiIiLCJwYXNzIjoiMzBjYWU3ZTdhOTMzODllNmI3ZTIxODQwZDhiNzJkMDgifX19.h7TrQV7IaEJZT3uwabJZxM6C5cr7o85AAvETQcWd6Lc');

ini_set('display_errors', '1');

// Enable plugin and theme updates and installation from the admin
Config::define('DISALLOW_FILE_MODS', false);
