<?php return array (
  'app' => 
  array (
    'name' => 'Supplies Inventory Management System',
    'env' => 'local',
    'debug' => true,
    'url' => 'http://localhost',
    'timezone' => 'UTC',
    'locale' => 'en',
    'fallback_locale' => 'en',
    'key' => 'base64:HWQ4B8/2segWMHryuPRdcIBbjXoMH/sVX/UNtHa2eYY=',
    'cipher' => 'AES-256-CBC',
    'log' => 'daily',
    'log_level' => 'debug',
    'providers' => 
    array (
      0 => 'Illuminate\\Auth\\AuthServiceProvider',
      1 => 'Illuminate\\Broadcasting\\BroadcastServiceProvider',
      2 => 'Illuminate\\Bus\\BusServiceProvider',
      3 => 'Illuminate\\Cache\\CacheServiceProvider',
      4 => 'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider',
      5 => 'Illuminate\\Cookie\\CookieServiceProvider',
      6 => 'Illuminate\\Database\\DatabaseServiceProvider',
      7 => 'Illuminate\\Encryption\\EncryptionServiceProvider',
      8 => 'Illuminate\\Filesystem\\FilesystemServiceProvider',
      9 => 'Illuminate\\Foundation\\Providers\\FoundationServiceProvider',
      10 => 'Illuminate\\Hashing\\HashServiceProvider',
      11 => 'Illuminate\\Mail\\MailServiceProvider',
      12 => 'Illuminate\\Notifications\\NotificationServiceProvider',
      13 => 'Illuminate\\Pagination\\PaginationServiceProvider',
      14 => 'Illuminate\\Pipeline\\PipelineServiceProvider',
      15 => 'Illuminate\\Queue\\QueueServiceProvider',
      16 => 'Illuminate\\Redis\\RedisServiceProvider',
      17 => 'Illuminate\\Auth\\Passwords\\PasswordResetServiceProvider',
      18 => 'Illuminate\\Session\\SessionServiceProvider',
      19 => 'Illuminate\\Translation\\TranslationServiceProvider',
      20 => 'Illuminate\\Validation\\ValidationServiceProvider',
      21 => 'Illuminate\\View\\ViewServiceProvider',
      22 => 'Laravel\\Tinker\\TinkerServiceProvider',
      23 => 'App\\Providers\\AppServiceProvider',
      24 => 'App\\Providers\\AuthServiceProvider',
      25 => 'App\\Providers\\EventServiceProvider',
      26 => 'App\\Providers\\RouteServiceProvider',
      27 => 'Collective\\Html\\HtmlServiceProvider',
      28 => 'Backpack\\Base\\BaseServiceProvider',
      29 => 'Backpack\\CRUD\\CrudServiceProvider',
      30 => 'Backpack\\LangFileManager\\LangFileManagerServiceProvider',
      31 => 'Spatie\\Backup\\BackupServiceProvider',
      32 => 'Backpack\\BackupManager\\BackupManagerServiceProvider',
      33 => 'Backpack\\LogManager\\LogManagerServiceProvider',
      34 => 'Backpack\\Settings\\SettingsServiceProvider',
      35 => 'Cviebrock\\EloquentSluggable\\ServiceProvider',
      36 => 'Backpack\\PageManager\\PageManagerServiceProvider',
      37 => 'Barryvdh\\DomPDF\\ServiceProvider',
    ),
    'aliases' => 
    array (
      'App' => 'Illuminate\\Support\\Facades\\App',
      'Artisan' => 'Illuminate\\Support\\Facades\\Artisan',
      'Auth' => 'Illuminate\\Support\\Facades\\Auth',
      'Blade' => 'Illuminate\\Support\\Facades\\Blade',
      'Broadcast' => 'Illuminate\\Support\\Facades\\Broadcast',
      'Bus' => 'Illuminate\\Support\\Facades\\Bus',
      'Cache' => 'Illuminate\\Support\\Facades\\Cache',
      'Config' => 'Illuminate\\Support\\Facades\\Config',
      'Cookie' => 'Illuminate\\Support\\Facades\\Cookie',
      'Crypt' => 'Illuminate\\Support\\Facades\\Crypt',
      'DB' => 'Illuminate\\Support\\Facades\\DB',
      'Eloquent' => 'Illuminate\\Database\\Eloquent\\Model',
      'Event' => 'Illuminate\\Support\\Facades\\Event',
      'File' => 'Illuminate\\Support\\Facades\\File',
      'Gate' => 'Illuminate\\Support\\Facades\\Gate',
      'Hash' => 'Illuminate\\Support\\Facades\\Hash',
      'Lang' => 'Illuminate\\Support\\Facades\\Lang',
      'Log' => 'Illuminate\\Support\\Facades\\Log',
      'Mail' => 'Illuminate\\Support\\Facades\\Mail',
      'Notification' => 'Illuminate\\Support\\Facades\\Notification',
      'Password' => 'Illuminate\\Support\\Facades\\Password',
      'Queue' => 'Illuminate\\Support\\Facades\\Queue',
      'Redirect' => 'Illuminate\\Support\\Facades\\Redirect',
      'Redis' => 'Illuminate\\Support\\Facades\\Redis',
      'Request' => 'Illuminate\\Support\\Facades\\Request',
      'Response' => 'Illuminate\\Support\\Facades\\Response',
      'Route' => 'Illuminate\\Support\\Facades\\Route',
      'Schema' => 'Illuminate\\Support\\Facades\\Schema',
      'Session' => 'Illuminate\\Support\\Facades\\Session',
      'Storage' => 'Illuminate\\Support\\Facades\\Storage',
      'URL' => 'Illuminate\\Support\\Facades\\URL',
      'Validator' => 'Illuminate\\Support\\Facades\\Validator',
      'View' => 'Illuminate\\Support\\Facades\\View',
      'Form' => 'Collective\\Html\\FormFacade',
      'HTML' => 'Collective\\Html\\HtmlFacade',
      'Input' => 'Illuminate\\Support\\Facades\\Input',
      'PDF' => 'Barryvdh\\DomPDF\\Facade',
    ),
  ),
  'auth' => 
  array (
    'defaults' => 
    array (
      'guard' => 'web',
      'passwords' => 'users',
    ),
    'guards' => 
    array (
      'web' => 
      array (
        'driver' => 'session',
        'provider' => 'users',
      ),
      'api' => 
      array (
        'driver' => 'token',
        'provider' => 'users',
      ),
    ),
    'providers' => 
    array (
      'users' => 
      array (
        'driver' => 'eloquent',
        'model' => 'App\\User',
      ),
    ),
    'passwords' => 
    array (
      'users' => 
      array (
        'provider' => 'users',
        'table' => 'password_resets',
        'expire' => 60,
      ),
    ),
  ),
  'backpack' => 
  array (
    'base' => 
    array (
      'project_name' => 'Supplies Inventory Management System',
      'logo_lg' => '<b>S</b>upplies <b>I</b>nventory',
      'logo_mini' => 'SI',
      'developer_name' => 'College Of Computer and Information Sciences - Server',
      'developer_link' => '#',
      'show_powered_by' => false,
      'skin' => 'skin-black-light',
      'default_date_format' => 'j F Y',
      'default_datetime_format' => 'j F Y H:i',
      'registration_open' => true,
      'route_prefix' => '',
      'setup_auth_routes' => false,
      'setup_dashboard_routes' => false,
      'user_model_fqn' => '\\App\\User',
      'license_code' => false,
      'username' => 'Username',
    ),
    'crud' => 
    array (
      'default_save_action' => 'save_and_back',
      'show_save_action_change' => true,
      'tabs_type' => 'horizontal',
      'show_grouped_errors' => true,
      'show_inline_errors' => true,
      'default_page_length' => 25,
      'show_translatable_field_icon' => true,
      'translatable_field_icon_position' => 'right',
      'locales' => 
      array (
        'en' => 'English',
        'fr' => 'French',
        'it' => 'Italian',
        'ro' => 'Romanian',
      ),
    ),
    'pagemanager' => 
    array (
      'admin_controller_class' => 'Backpack\\PageManager\\app\\Http\\Controllers\\Admin\\PageCrudController',
      'page_model_class' => 'Backpack\\PageManager\\app\\Models\\Page',
    ),
    'backupmanager' => 
    array (
      'backup' => 
      array (
        'name' => 'http://localhost',
        'source' => 
        array (
          'files' => 
          array (
            'include' => 
            array (
              0 => 'C:\\xampp\\htdocs\\sims',
            ),
            'exclude' => 
            array (
              0 => 'C:\\xampp\\htdocs\\sims\\vendor',
              1 => 'C:\\xampp\\htdocs\\sims\\storage',
            ),
          ),
          'databases' => 
          array (
            0 => 'mysql',
          ),
        ),
        'destination' => 
        array (
          'disks' => 
          array (
            0 => 'backups',
          ),
        ),
      ),
      'cleanup' => 
      array (
        'strategy' => 'Spatie\\Backup\\Tasks\\Cleanup\\Strategies\\DefaultStrategy',
        'defaultStrategy' => 
        array (
          'keepAllBackupsForDays' => 7,
          'keepDailyBackupsForDays' => 16,
          'keepWeeklyBackupsForWeeks' => 8,
          'keepMonthlyBackupsForMonths' => 4,
          'keepYearlyBackupsForYears' => 2,
          'deleteOldestBackupsWhenUsingMoreMegabytesThan' => 5000,
        ),
      ),
      'monitorBackups' => 
      array (
        0 => 
        array (
          'name' => 'http://localhost',
          'disks' => 
          array (
            0 => 'backups',
          ),
          'newestBackupsShouldNotBeOlderThanDays' => 1,
          'storageUsedMayNotBeHigherThanMegabytes' => 5000,
        ),
      ),
      'notifications' => 
      array (
        'handler' => 'Spatie\\Backup\\Notifications\\Notifier',
        'events' => 
        array (
          'whenBackupWasSuccessful' => 
          array (
            0 => 'log',
          ),
          'whenCleanupWasSuccessful' => 
          array (
            0 => 'log',
          ),
          'whenHealthyBackupWasFound' => 
          array (
            0 => 'log',
          ),
          'whenBackupHasFailed' => 
          array (
            0 => 'log',
            1 => 'mail',
          ),
          'whenCleanupHasFailed' => 
          array (
            0 => 'log',
            1 => 'mail',
          ),
          'whenUnHealthyBackupWasFound' => 
          array (
            0 => 'log',
            1 => 'mail',
          ),
        ),
        'mail' => 
        array (
          'from' => 'your@email.com',
          'to' => 'your@email.com',
        ),
        'slack' => 
        array (
          'channel' => '#backups',
          'username' => 'Backup bot',
          'icon' => ':robot:',
        ),
      ),
    ),
  ),
  'broadcasting' => 
  array (
    'default' => 'log',
    'connections' => 
    array (
      'pusher' => 
      array (
        'driver' => 'pusher',
        'key' => '',
        'secret' => '',
        'app_id' => '',
        'options' => 
        array (
        ),
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'default',
      ),
      'log' => 
      array (
        'driver' => 'log',
      ),
      'null' => 
      array (
        'driver' => 'null',
      ),
    ),
  ),
  'cache' => 
  array (
    'default' => 'file',
    'stores' => 
    array (
      'apc' => 
      array (
        'driver' => 'apc',
      ),
      'array' => 
      array (
        'driver' => 'array',
      ),
      'database' => 
      array (
        'driver' => 'database',
        'table' => 'cache',
        'connection' => NULL,
      ),
      'file' => 
      array (
        'driver' => 'file',
        'path' => 'C:\\xampp\\htdocs\\sims\\storage\\framework/cache/data',
      ),
      'memcached' => 
      array (
        'driver' => 'memcached',
        'persistent_id' => NULL,
        'sasl' => 
        array (
          0 => NULL,
          1 => NULL,
        ),
        'options' => 
        array (
        ),
        'servers' => 
        array (
          0 => 
          array (
            'host' => '127.0.0.1',
            'port' => 11211,
            'weight' => 100,
          ),
        ),
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'default',
      ),
    ),
    'prefix' => 'laravel',
  ),
  'database' => 
  array (
    'default' => 'mysql',
    'connections' => 
    array (
      'sqlite' => 
      array (
        'driver' => 'sqlite',
        'database' => 'sims',
        'prefix' => '',
      ),
      'mysql' => 
      array (
        'driver' => 'mysql',
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'sims',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'strict' => true,
        'engine' => NULL,
        'dump' => 
        array (
          'dump_binary_path' => 'C:\\xampp\\mysql\\bin',
          0 => 'use_single_transaction',
          'timeout' => 300,
        ),
      ),
      'pgsql' => 
      array (
        'driver' => 'pgsql',
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'sims',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8',
        'prefix' => '',
        'schema' => 'public',
        'sslmode' => 'prefer',
      ),
    ),
    'migrations' => 'migrations',
    'redis' => 
    array (
      'client' => 'predis',
      'default' => 
      array (
        'host' => '127.0.0.1',
        'password' => NULL,
        'port' => '6379',
        'database' => 0,
      ),
    ),
  ),
  'elfinder' => 
  array (
    'dir' => 
    array (
      0 => 'uploads',
    ),
    'disks' => 
    array (
    ),
    'route' => 
    array (
      'prefix' => '/elfinder',
      'middleware' => 
      array (
        0 => 'web',
        1 => 'admin',
      ),
    ),
    'access' => 'Barryvdh\\Elfinder\\Elfinder::checkAccess',
    'roots' => NULL,
    'options' => 
    array (
    ),
    'root_options' => 
    array (
    ),
  ),
  'filesystems' => 
  array (
    'default' => 'local',
    'cloud' => 's3',
    'disks' => 
    array (
      'local' => 
      array (
        'driver' => 'local',
        'root' => 'C:\\xampp\\htdocs\\sims\\storage\\app',
      ),
      'public' => 
      array (
        'driver' => 'local',
        'root' => 'C:\\xampp\\htdocs\\sims\\storage\\app/public',
        'url' => 'http://localhost/storage',
        'visibility' => 'public',
      ),
      's3' => 
      array (
        'driver' => 's3',
        'key' => NULL,
        'secret' => NULL,
        'region' => NULL,
        'bucket' => NULL,
      ),
      'uploads' => 
      array (
        'driver' => 'local',
        'root' => 'C:\\xampp\\htdocs\\sims\\public\\uploads',
      ),
      'backups' => 
      array (
        'driver' => 'local',
        'root' => 'C:\\xampp\\htdocs\\sims\\storage\\backups',
      ),
      'storage' => 
      array (
        'driver' => 'local',
        'root' => 'C:\\xampp\\htdocs\\sims\\storage\\backup_logs',
      ),
    ),
  ),
  'laravel-backup' => 
  array (
    'backup' => 
    array (
      'name' => 'http://localhost',
      'source' => 
      array (
        'files' => 
        array (
          'include' => 
          array (
            0 => 'C:\\xampp\\htdocs\\sims',
          ),
          'exclude' => 
          array (
            0 => 'C:\\xampp\\htdocs\\sims\\vendor',
            1 => 'C:\\xampp\\htdocs\\sims\\storage',
          ),
        ),
        'databases' => 
        array (
          0 => 'mysql',
        ),
      ),
      'destination' => 
      array (
        'disks' => 
        array (
          0 => 'backups',
        ),
      ),
    ),
    'notifications' => 
    array (
      'handler' => 'Spatie\\Backup\\Notifications\\Notifier',
      'events' => 
      array (
        'whenBackupWasSuccessful' => 
        array (
          0 => 'log',
        ),
        'whenCleanupWasSuccessful' => 
        array (
          0 => 'log',
        ),
        'whenHealthyBackupWasFound' => 
        array (
          0 => 'log',
        ),
        'whenBackupHasFailed' => 
        array (
          0 => 'log',
          1 => 'mail',
        ),
        'whenCleanupHasFailed' => 
        array (
          0 => 'log',
          1 => 'mail',
        ),
        'whenUnHealthyBackupWasFound' => 
        array (
          0 => 'log',
          1 => 'mail',
        ),
      ),
      'mail' => 
      array (
        'from' => 'your@email.com',
        'to' => 'your@email.com',
      ),
      'slack' => 
      array (
        'channel' => '#backups',
        'username' => 'Backup bot',
        'icon' => ':robot:',
      ),
    ),
    'monitorBackups' => 
    array (
      0 => 
      array (
        'name' => 'http://localhost',
        'disks' => 
        array (
          0 => 'backups',
        ),
        'newestBackupsShouldNotBeOlderThanDays' => 1,
        'storageUsedMayNotBeHigherThanMegabytes' => 5000,
      ),
    ),
    'cleanup' => 
    array (
      'strategy' => 'Spatie\\Backup\\Tasks\\Cleanup\\Strategies\\DefaultStrategy',
      'defaultStrategy' => 
      array (
        'keepAllBackupsForDays' => 7,
        'keepDailyBackupsForDays' => 16,
        'keepWeeklyBackupsForWeeks' => 8,
        'keepMonthlyBackupsForMonths' => 4,
        'keepYearlyBackupsForYears' => 2,
        'deleteOldestBackupsWhenUsingMoreMegabytesThan' => 5000,
      ),
    ),
  ),
  'mail' => 
  array (
    'driver' => 'smtp',
    'host' => 'smtp.mailtrap.io',
    'port' => '2525',
    'from' => 
    array (
      'address' => 'hello@example.com',
      'name' => 'Example',
    ),
    'encryption' => NULL,
    'username' => NULL,
    'password' => NULL,
    'sendmail' => '/usr/sbin/sendmail -bs',
    'markdown' => 
    array (
      'theme' => 'default',
      'paths' => 
      array (
        0 => 'C:\\xampp\\htdocs\\sims\\resources\\views/vendor/mail',
      ),
    ),
  ),
  'prologue' => 
  array (
    'alerts' => 
    array (
      'levels' => 
      array (
        0 => 'info',
        1 => 'warning',
        2 => 'error',
        3 => 'success',
      ),
      'session_key' => 'alert_messages',
    ),
  ),
  'queue' => 
  array (
    'default' => 'sync',
    'connections' => 
    array (
      'sync' => 
      array (
        'driver' => 'sync',
      ),
      'database' => 
      array (
        'driver' => 'database',
        'table' => 'jobs',
        'queue' => 'default',
        'retry_after' => 90,
      ),
      'beanstalkd' => 
      array (
        'driver' => 'beanstalkd',
        'host' => 'localhost',
        'queue' => 'default',
        'retry_after' => 90,
      ),
      'sqs' => 
      array (
        'driver' => 'sqs',
        'key' => 'your-public-key',
        'secret' => 'your-secret-key',
        'prefix' => 'https://sqs.us-east-1.amazonaws.com/your-account-id',
        'queue' => 'your-queue-name',
        'region' => 'us-east-1',
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'default',
        'queue' => 'default',
        'retry_after' => 90,
      ),
    ),
    'failed' => 
    array (
      'database' => 'mysql',
      'table' => 'failed_jobs',
    ),
  ),
  'services' => 
  array (
    'mailgun' => 
    array (
      'domain' => NULL,
      'secret' => NULL,
    ),
    'ses' => 
    array (
      'key' => NULL,
      'secret' => NULL,
      'region' => 'us-east-1',
    ),
    'sparkpost' => 
    array (
      'secret' => NULL,
    ),
    'stripe' => 
    array (
      'model' => 'App\\User',
      'key' => NULL,
      'secret' => NULL,
    ),
  ),
  'session' => 
  array (
    'driver' => 'file',
    'lifetime' => 120,
    'expire_on_close' => false,
    'encrypt' => false,
    'files' => 'C:\\xampp\\htdocs\\sims\\storage\\framework/sessions',
    'connection' => NULL,
    'table' => 'sessions',
    'store' => NULL,
    'lottery' => 
    array (
      0 => 2,
      1 => 100,
    ),
    'cookie' => 'laravel_session',
    'path' => '/',
    'domain' => NULL,
    'secure' => false,
    'http_only' => true,
  ),
  'snappy' => 
  array (
    'pdf' => 
    array (
      'enabled' => true,
      'binary' => 'C:\\xampp\\htdocs\\sims\\vendor/h4cc/wkhtmltopdf-amd64/bin/wkhtmltopdf-amd64',
      'timeout' => false,
      'options' => 
      array (
      ),
      'env' => 
      array (
      ),
    ),
    'image' => 
    array (
      'enabled' => true,
      'binary' => 'C:\\xampp\\htdocs\\sims\\vendor/h4cc/wkhtmltoimage-amd64/bin/wkhtmltoimage-amd64',
      'timeout' => false,
      'options' => 
      array (
      ),
      'env' => 
      array (
      ),
    ),
  ),
  'view' => 
  array (
    'paths' => 
    array (
      0 => 'C:\\xampp\\htdocs\\sims\\resources\\views',
    ),
    'compiled' => 'C:\\xampp\\htdocs\\sims\\storage\\framework\\views',
  ),
  'image' => 
  array (
    'driver' => 'gd',
  ),
  0 => 'config/laravel-backup.php',
  'sluggable' => 
  array (
    'source' => NULL,
    'maxLength' => NULL,
    'method' => NULL,
    'separator' => '-',
    'unique' => true,
    'uniqueSuffix' => NULL,
    'includeTrashed' => false,
    'reserved' => NULL,
    'onUpdate' => false,
  ),
  'dompdf' => 
  array (
    'show_warnings' => false,
    'orientation' => 'portrait',
    'defines' => 
    array (
      'DOMPDF_FONT_DIR' => 'C:\\xampp\\htdocs\\sims\\storage\\fonts/',
      'DOMPDF_FONT_CACHE' => 'C:\\xampp\\htdocs\\sims\\storage\\fonts/',
      'DOMPDF_TEMP_DIR' => 'C:\\Users\\Zero\\AppData\\Local\\Temp',
      'DOMPDF_CHROOT' => 'C:\\xampp\\htdocs\\sims',
      'DOMPDF_UNICODE_ENABLED' => true,
      'DOMPDF_ENABLE_FONT_SUBSETTING' => false,
      'DOMPDF_PDF_BACKEND' => 'CPDF',
      'DOMPDF_DEFAULT_MEDIA_TYPE' => 'screen',
      'DOMPDF_DEFAULT_PAPER_SIZE' => 'a4',
      'DOMPDF_DEFAULT_FONT' => 'serif',
      'DOMPDF_DPI' => 96,
      'DOMPDF_ENABLE_PHP' => false,
      'DOMPDF_ENABLE_JAVASCRIPT' => true,
      'DOMPDF_ENABLE_REMOTE' => true,
      'DOMPDF_FONT_HEIGHT_RATIO' => 1.1000000000000001,
      'DOMPDF_ENABLE_CSS_FLOAT' => false,
      'DOMPDF_ENABLE_HTML5PARSER' => false,
    ),
  ),
  'langfilemanager' => 
  array (
    'language_ignore' => 
    array (
      0 => 'pagination',
      1 => 'reminders',
      2 => 'validation',
      3 => 'log',
      4 => 'crud',
    ),
  ),
);
