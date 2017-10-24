# Backpack\LogManager

[![Latest Version on Packagist](https://img.shields.io/packagist/v/backpack/logmanager.svg?style=flat-square)](https://packagist.org/packages/backpack/logmanager)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/laravel-backpack/logmanager/master.svg?style=flat-square)](https://travis-ci.org/laravel-backpack/logmanager)
[![Coverage Status](https://img.shields.io/scrutinizer/coverage/g/laravel-backpack/logmanager.svg?style=flat-square)](https://scrutinizer-ci.com/g/laravel-backpack/logmanager/code-structure)
[![Quality Score](https://img.shields.io/scrutinizer/g/laravel-backpack/logmanager.svg?style=flat-square)](https://scrutinizer-ci.com/g/laravel-backpack/logmanager)
[![Style CI](https://styleci.io/repos/52886512/shield)](https://styleci.io/repos/52886512)
[![Total Downloads](https://img.shields.io/packagist/dt/backpack/logmanager.svg?style=flat-square)](https://packagist.org/packages/backpack/crud)

An interface to preview, download and delete Laravel log files.


> ### Security updates and breaking changes
> Please **[subscribe to the Backpack Newsletter](http://eepurl.com/bUEGjf)** so you can find out about any security updates, breaking changes or major features. We send an email every 1-2 months.

## Install

1) Install via composer:

``` bash
$ composer require backpack/logmanager
```

2) Then add the service provider to your config/app.php file:

```
    Backpack\LogManager\LogManagerServiceProvider::class,
```

3) Add a "storage" filesystem in config/filesystems.php:

```
// used for Backpack/LogManager
'storage' => [
            'driver' => 'local',
            'root'   => storage_path(),
        ],
```

4) [Optional] Configure Laravel to create a new log file for every day, in your .ENV file, if it's not already. Otherwise there will only be one file at all times.

```
    APP_LOG=daily
```

or directly in your config/app.php file:
```
    'log' => env('APP_LOG', 'daily'),
```

5) [Optional] Publish the lang files if you think you'll need to modify them.

```bash
    php artisan vendor:publish --provider="Backpack\LogManager\LogManagerServiceProvider"
```

6) [optional] Add a menu item for it in resources/views/vendor/backpack/base/inc/sidebar.blade.php or menu.blade.php:

```html
<li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/log') }}"><i class="fa fa-terminal"></i> <span>Logs</span></a></li>
```

## Usage

Add a menu element for it or just try at **your-project-domain/admin/log**

![LogManager interface](https://backpackforlaravel.com/uploads/screenshots/log_list.png)

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
- create a ```routes/backpack/logmanager.php``` file; the package will see that, and load _your_ routes file, instead of the one in the package; 
- create controllers/models that extend the ones in the package, and use those in your new routes file;
- modify anything you'd like in the new controllers/models;

## Security

If you discover any security related issues, please email :author_email instead of using the issue tracker.

Please **[subscribe to the Backpack Newsletter](http://eepurl.com/bUEGjf)** so you can find out about any security updates, breaking changes or major features. We send an email every 1-2 months.

## Credits

- [Cristian Tabacitu](https://tabacitu.ro)
- [All Contributors](../../contributors)

## License

Backpack is free for non-commercial use and 39 EUR/project for commercial use. Please see [License File](LICENSE.md) and [backpackforlaravel.com](https://backpackforlaravel.com/#pricing) for more information.
