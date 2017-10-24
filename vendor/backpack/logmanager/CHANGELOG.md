# Changelog

All Notable changes to `LogManager` will be documented in this file

## NEXT - YYYY-MM-DD

### Added
- Nothing

### Deprecated
- Nothing

### Fixed
- Nothing

### Removed
- Nothing

### Security
- Nothing


## [2.3.16] - 2017-08-30

## Added
- package auto-discovery for Laravel 5.5 apps;


## [2.3.15] - 2017-08-11

## Added
- Danish (da_DK) language files, thanks to [Frederik Rabøl](https://github.com/Xayer);


## [2.3.14] - 2017-07-10

### Added
- Romanian language file;


## [2.3.13] - 2017-07-06

### Added
- overwritable routes file;


## [2.3.12] - 2017-07-05

### Added
- Portugese translation (thanks to [Toni Almeida](https://github.com/promatik));
- Portugese (Brasilian) translation (thanks to [Guilherme Augusto Henschel](https://github.com/cenoura));


## [2.3.11] - 2017-04-21

### Removed
- Backpack\CRUD no longer loads translations, as Backpack\Base does it for him.


## [2.3.10] - 2017-04-05

### Added
- Dutch translation (thanks to [Mark van Beek](https://github.com/chancezeus));

### Fixed
- App namespace issue;


## [2.3.9] - 2017-01-21

### Added
- Ability to publish views;
- Ability to overwrite views the same way you overwrite views in CRUD;


## [2.3.8] - 2016-09-23

### Fixed
- Breadcrumbs and routes now follow the route_prefix set in the config/backpack/base.php file- thanks to [Twaambo Haamucenje](https://github.com/twoSeats);
- Breadcrumb first item now shows the project name correctly;


## [2.3.7] - 2016-09-22

### Added
- French translations - thanks to [7ute](https://github.com/7ute);



## [2.3.6] - 2016-07-31

### Added
- Bogus unit tests. At least we'be able to use travis-ci for requirements errors, until full unit tests are done.


## [2.3.5] - 2016-06-02

### Fixed
- Using the Admin middleware instead of Auth, as of Backpack\Base v0.6.0;
- Moved routes definition to LogManagerServiceProvider instead of routes.php file;


## [2.3.4] - 2016-03-16

### Fixed
- Added page title.


## [2.3.3] - 2016-03-12

### Fixed
- Lang files are pushed in the correct folder now. For realsies.


## 2.3.2 - 2016-03-12

### Fixed
- language files are published in the correct folder, no /vendor/ subfolder


## 2.3.1 - 2016-03-10

### Fixed
- In views, switched to one header section instead of separate sections for page title and breadcrumbs.


## 2.3.0 - 2016-03-10

### Added
- Working notification bubbles (alerts).

## 2.2.1 - 2016-03-10

### Fixed
- Changed BackPack\Base requirement in composer.json to ^0.2


## 2.2.0 - 2016-03-04

### Fixed
- Changed base layout usage to work with BackPack\Base 0.4.x


## 2.1.1 - 2016-03-04

### Fixed
- "The log file doesn't exist." error message wasn't in the lang files. Now it is.


## 2.1.0 - STABLE - 2016-03-04

### Security
- Log pages now need the user to be authenticated.

### Fixed
- Changed directory structure to resemble Laravel: Http folder is inside an app folder now.


## 2.0.1 - 2016-03-03

### Fixed
- Removed screenshots from readme file.
- Added backpack/base dependency.


## 2.0.0 - 2016-03-03

### Fixed
- Made it work on Backpack instead of Dick.
