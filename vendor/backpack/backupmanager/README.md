# Backpack\BackupManager

[![Latest Version on Packagist](https://img.shields.io/packagist/v/backpack/backupmanager.svg?style=flat-square)](https://packagist.org/packages/backpack/backupmanager)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/laravel-backpack/backupmanager/master.svg?style=flat-square)](https://travis-ci.org/laravel-backpack/backupmanager)
[![Coverage Status](https://img.shields.io/scrutinizer/coverage/g/laravel-backpack/backupmanager.svg?style=flat-square)](https://scrutinizer-ci.com/g/laravel-backpack/backupmanager/code-structure)
[![Quality Score](https://img.shields.io/scrutinizer/g/laravel-backpack/backupmanager.svg?style=flat-square)](https://scrutinizer-ci.com/g/laravel-backpack/backupmanager)
[![Style CI](https://styleci.io/repos/53956594/shield)](https://styleci.io/repos/53956594)
[![Total Downloads](https://img.shields.io/packagist/dt/backpack/backupmanager.svg?style=flat-square)](https://packagist.org/packages/backpack/backupmanager)

An admin interface for managing backups (download and delete). Used in the Backpack package, on Laravel 5.2+


> ### Security updates and breaking changes
> Please **[subscribe to the Backpack Newsletter](http://eepurl.com/bUEGjf)** so you can find out about any security updates, breaking changes or major features. We send an email every 1-2 months.
![Backpack\BackupManager screenshot](https://backpackforlaravel.com/uploads/screenshots/backups_running.png)


## Install

1) In your terminal

``` bash
$ composer require backpack/backupmanager
```

2) For Laravel <5.5, add the service providers to your config/app.php file:

```
Spatie\Backup\BackupServiceProvider::class,
Backpack\BackupManager\BackupManagerServiceProvider::class,
```

3) Publish the config file and lang files:

```
php artisan vendor:publish --provider="Backpack\BackupManager\BackupManagerServiceProvider"
```

4) Add a new "disk" to config/filesystems.php:

```php
        // used for Backpack/BackupManager
        'backups' => [
            'driver' => 'local',
            'root'   => storage_path('backups'), // that's where your backups are stored by default: storage/backups
        ],
```
This is where you choose a different driver if you want your backups to be stored somewhere else (S3, Dropbox, Google Drive, Box, etc).

5) [optional] Add a menu item for it in resources/views/vendor/backpack/base/inc/sidebar.blade.php or menu.blade.php:

```html
<li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/backup') }}"><i class="fa fa-hdd-o"></i> <span>Backups</span></a></li>
```

6) [optional] Modify your backup options in config/laravel-backup.php

7) [optional] Instruct Laravel to run the backups automatically in your console kernel:

```php
// app/Console/Kernel.php

protected function schedule(Schedule $schedule)
{
   $schedule->command('backup:clean')->daily()->at('04:00');
   $schedule->command('backup:run')->daily()->at('05:00');
}
```

8) Check that it works

If the "unknown error" yellow bubble is thrown and you see the "_Backup failed because The dump process failed with exitcode 127 : Command not found._" error in the log file, either mysqldump / pg_dump is not installed or you need to specify its location.

You can do that in your config/database.php file, where you define your database credentials, by adding the dump variables. Example for Mac OS X's MAMP:

```php
'mysql' => [
            'driver'            => 'mysql',
            'host'              => env('DB_HOST', 'localhost'),
            'database'          => env('DB_DATABASE', 'forge'),
            'username'          => env('DB_USERNAME', 'forge'),
            'password'          => env('DB_PASSWORD', ''),
            'charset'           => 'utf8',
            'collation'         => 'utf8_unicode_ci',
            'prefix'            => '',
            'strict'            => false,
            'engine'            => null,
            'dump' => [
               'dump_binary_path' => '/Applications/MAMP/Library/bin/', // only the path, so without `mysqldump` or `pg_dump`; this is a working example from MAMP on Mac OS
               'use_single_transaction',
               'timeout' => 60 * 5, // 5 minute timeout
               // 'exclude_tables' => ['table1', 'table2'],
               // 'add_extra_option' => '--optionname=optionvalue',
            ]
        ],
```

## Usage

Point and click, baby. Point and click.

Try at **your-project-domain/admin/backup**


## Upgrading from 1.1.x to 1.2.x

The only breaking change is that the ```config/database.php``` dump variables are now inside an array. Please see the step 8 above, copy-paste the ```dump``` array from there and customize.


## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Overwriting Functionality

If you need to modify how this works in a project: 
- create a ```routes/backpack/backupmanager.php``` file; the package will see that, and load _your_ routes file, instead of the one in the package; 
- create controllers/models that extend the ones in the package, and use those in your new routes file;
- modify anything you'd like in the new controllers/models;

## Security

If you discover any security related issues, please email hello@tabacitu.ro instead of using the issue tracker.

Please **[subscribe to the Backpack Newsletter](http://eepurl.com/bUEGjf)** so you can find out about any security updates, breaking changes or major features. We send an email every 1-2 months.

## Credits

- [Cristian Tabacitu](https://github.com/tabacitu)
- [All Contributors](../../contributors)

## License

Backpack is free for non-commercial use and 39 EUR/project for commercial use. Please see [License File](LICENSE.md) and [backpackforlaravel.com](https://backpackforlaravel.com/#pricing) for more information.
