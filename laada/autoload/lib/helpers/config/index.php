<?php

use Dotenv\Dotenv;
use Symfony\Component\HttpFoundation\Request;

function laada_wp_config($root_dir)
{
  $app_dir = $root_dir . '/app';
  if (is_dir($root_dir) && is_dir($app_dir)) {
    Dotenv::createImmutable($root_dir)->safeLoad();

    define('LAADA_ROOT', $root_dir);
    define('LAADA_DOCUMENT_ROOT', $app_dir);

    define('WP_ENVIRONMENT_TYPE', env('WP_ENVIRONMENT_TYPE', 'local'));
    define('WP_THEME', env('WP_THEME', 'custom'));
    define('WP_ALLOW_MULTISITE', env('WP_ALLOW_MULTISITE', true));
    define('WP_DIR', env('WP_DIR', 'wp'));
    define('WP_APP', env('WP_APP', LAADA_DOCUMENT_ROOT));
    define('WP_PUBLIC_PATH', env('WP_PUBLIC_PATH', LAADA_DOCUMENT_ROOT . '/public'));
    define('WP_TEMP_DIR', env('WP_TEMP_DIR', LAADA_DOCUMENT_ROOT . '/tmp'));
    define('WP_HOME', env('WP_HOME', Request::createFromGlobals()->getSchemeAndHttpHost()));
    define('WP_SITEURL', env('WP_SITEURL', sprintf('%s/%s', WP_HOME, WP_DIR)));
    define('WP_CONTENT_DIR', env('WP_CONTENT_DIR', LAADA_DOCUMENT_ROOT));
    define('WP_CONTENT_URL', env('WP_CONTENT_URL', WP_HOME));
    define('WP_PREFIX', env('WP_PREFIX', 'wp_'));
    define('WP_POST_REVISIONS', env('WP_POST_REVISIONS', 5));
    define('WP_DEBUG_DISPLAY', env('WP_DEBUG_DISPLAY', false));
    define('WP_DEBUG_LOG', env('WP_DEBUG_LOG', false));
    define('WP_DEBUG', env('WP_DEBUG', false));
    define('WP_CACHE', env('WP_CACHE', false));

    define('DB_HOST', env('DB_HOST'));
    define('DB_NAME', env('DB_NAME'));
    define('DB_USER', env('DB_USER'));
    define('DB_PASSWORD', env('DB_PASSWORD'));
    define('DB_COLLATE', env('DB_COLLATE', ''));
    define('DB_CHARSET', env('DB_CHARSET', 'utf8'));
    define('USE_MYSQL_SSL', env('USE_MYSQL_SSL', false));

    define('AUTH_KEY', env('AUTH_KEY'));
    define('SECURE_AUTH_KEY', env('SECURE_AUTH_KEY'));
    define('LOGGED_IN_KEY', env('LOGGED_IN_KEY'));
    define('NONCE_KEY', env('NONCE_KEY'));
    define('AUTH_SALT', env('AUTH_SALT'));
    define('SECURE_AUTH_SALT', env('SECURE_AUTH_SALT'));
    define('LOGGED_IN_SALT', env('LOGGED_IN_SALT'));
    define('NONCE_SALT', env('NONCE_SALT'));

    define('SERVER_PORT', env('SERVER_PORT', 80));
    define('MULTISITE', env('MULTISITE', false));
    define('SUBDOMAIN_INSTALL', env('SUBDOMAIN_INSTALL', false));
    define('DOMAIN_CURRENT_SITE', env('DOMAIN_CURRENT_SITE', 'localhost'));
    define('PATH_CURRENT_SITE', env('PATH_CURRENT_SITE', '/'));
    define('SITE_ID_CURRENT_SITE', env('SITE_ID_CURRENT_SITE', 1));
    define('BLOG_ID_CURRENT_SITE', env('BLOG_ID_CURRENT_SITE', 1));

    define('UPLOADS', 'media');
    define('DISABLE_WP_CRON', env('DISABLE_WP_CRON', false));
    define('AUTOSAVE_INTERVAL', env('AUTOSAVE_INTERVAL', 3600));
    define('EMPTY_TRASH_DAYS', env('EMPTY_TRASH_DAYS', 7));
    define('AUTOMATIC_UPDATER_DISABLED', env('AUTOMATIC_UPDATER_DISABLED', true));
    define('DISALLOW_FILE_EDIT', env('DISALLOW_FILE_EDIT', true));
    define('DISALLOW_FILE_MODS', env('DISALLOW_FILE_MODS', false));
    define('IMAGE_EDIT_OVERWRITE', env('IMAGE_EDIT_OVERWRITE', false));

    define('LAADA_FRONTEND_URL', env('LAADA_FRONTEND_URL'));
    define('LAADA_FRONTEND_API_PATH', env('LAADA_FRONTEND_API_PATH'));
    define('LAADA_FRONTEND_PREVIEW_SECRET', env('LAADA_FRONTEND_PREVIEW_SECRET'));
    define('LAADA_INTERNAL_REQUEST_TIMEOUT', env('LAADA_INTERNAL_REQUEST_TIMEOUT', 60));
    define('LAADA_EXTERNAL_REQUEST_TIMEOUT', env('LAADA_EXTERNAL_REQUEST_TIMEOUT', 1800));
    define('LAADA_DEFAULT_VIDEO_RATE_LIMIT', env('LAADA_DEFAULT_VIDEO_RATE_LIMIT', 500));
    define('LAADA_DOD_IST_USER', env('LAADA_DOD_IST_USER'));
    define('LAADA_BUCKET_URL', env('LAADA_BUCKET_URL'));

    define('ACF_PRO_LICENSE', env('ACF_PRO_LICENSE', null));
    define('META_BOX_KEY', env('META_BOX_KEY', null));

    define('WP_STATELESS_MEDIA_JSON_KEY', env('WP_STATELESS_MEDIA_JSON_KEY', null));
    define('WP_STATELESS_MEDIA_BUCKET', env('WP_STATELESS_MEDIA_BUCKET', null));
    define('WP_STATELESS_MEDIA_ROOT_DIR', env('WP_STATELESS_MEDIA_ROOT_DIR', '/%site_id%/'));
    define('WP_STATELESS_SKIP_ACL_SET', env('WP_STATELESS_SKIP_ACL_SET', true));
    define('WP_STATELESS_MEDIA_MODE', env('WP_STATELESS_MEDIA_MODE', 'cdn'));
    define('WP_STATELESS_MEDIA_CACHE_BUSTING', env('WP_STATELESS_MEDIA_CACHE_BUSTING', false));
    define('WP_STATELESS_MEDIA_HIDE_SETTINGS_PANEL', env('WP_STATELESS_MEDIA_HIDE_SETTINGS_PANEL', false));
    define('WP_STATELESS_MEDIA_HIDE_SETUP_ASSISTANT', env('WP_STATELESS_MEDIA_HIDE_SETUP_ASSISTANT', false));
    define('WP_STATELESS_MEDIA_BODY_REWRITE', env('WP_STATELESS_MEDIA_BODY_REWRITE', false));

    if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
      $_SERVER['HTTPS'] = 'on';
    }

    if (USE_MYSQL_SSL) {
      define('MYSQL_CLIENT_FLAGS', MYSQLI_CLIENT_SSL);
      define('MYSQL_SSL_CERT', '/usr/local/share/ca-certificates/');
    }

    if (!defined('WP_CLI')) {
      if (WP_ENVIRONMENT_TYPE == 'local' && DOMAIN_CURRENT_SITE != @$_SERVER['HTTP_HOST']) {
        $_SERVER['HTTP_HOST'] = DOMAIN_CURRENT_SITE;
      }

      if (WP_ENVIRONMENT_TYPE == 'local' && WP_DEBUG) {
        define('WP_DISABLE_FATAL_ERROR_HANDLER', true);
      }

      if (!defined('WP_DISABLE_FATAL_ERROR_HANDLER')) {
        define('WP_DISABLE_FATAL_ERROR_HANDLER', env('WP_DISABLE_FATAL_ERROR_HANDLER', false));
      }
    }
  } else {
    die('Failed to setup Laada environment variables');
  }
}