# Changelog

All Notable changes to `Backpack Settings` will be documented in this file

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


## [2.0.23] - 2017-11-02

## Fixed
- route uses CRUD facade instead of route, for it to have the search route in CRUD 3.3;


## [2.0.22] - 2017-08-30

## Added
- package autodiscovery;

## Fixed
= text type columns for values in example migrations;

## [2.0.21] - 2017-08-11

## Added
- Russian (ru) language files, thanks to [Андрей](https://github.com/parabellumKoval);


## [2.0.20] - 2017-08-11

## Added
- Danish (da_DK) language files, thanks to [Frederik Rabøl](https://github.com/Xayer);


## 2.0.19 - 2017-07-06

### Added
- overwritable routes file;

## 2.0.18 - 2017-07-05

### Fixed
- Removed HHVM from TravisCI, since Laravel 5.4 no longer supports it;

## 2.0.17 - 2017-07-05

### Added
- Portugese translation (thanks to [Toni Almeida](https://github.com/promatik));
- Portugese (Brasilian) translation (thanks to [Guilherme Augusto Henschel](https://github.com/cenoura));
- command line feedback when seeding the settings table;


## 2.0.16 - 2017-04-21

### Removed
- Backpack\CRUD no longer loads translations, as Backpack\Base does it for him.


## 2.0.15 - 2017-02-14

### Removed
- Support for PHP 5.5 and HHVM, as Laravel 5.4 no longer supports them;


## 2.0.14 - 2017-02-14

### Added
- Support for Backpack\CRUD 3.2


## 2.0.13 - 2017-01-08

### Added
- Lang files for the Settings package, thanks to [Phouvanh Korngchansavath](https://www.phouvanh.com/);



## 2.0.12 - 2016-12-13

### Fixed
- Can now publish assets again.



## 2.0.11 - 2016-12-07

### Fixed
- No longer conflicting with artisan when no database is present.


## 2.0.10 - 2016-09-21

### Fixed
- Settings now respects the admin prefix set in Backpack\Base's config file - thanks to [Twaambo Haamucenje](https://github.com/twoSeats);


## 2.0.9 - 2016-08-31

### Fixed
- Setting name is again disabled in the Edit screen;
- Support for Laravel 5.3 (Backpack\CRUD 3.1.x);


## 2.0.8 - 2016-08-05

### Fixed
- PosgreSQL / SQLite support;


## 2.0.7 - 2016-07-31

### Added
- Bogus unit tests. At least we'be able to use travis-ci for requirements errors, until full unit tests are done.


## 2.0.5 - 2016-07-12

### Fixed
- Seeds had missing Field column for two demo entries.


## 2.0.4 - 2016-06-06

### Fixed
- Seeds had slashes, which caused installation problems for some users.


## 2.0.3 - 2016-06-02

### Fixed
- It did not load the correct field type on edit (from the db). Now it does.


## 2.0.2 - 2016-06-02

### Fixed
- Routes are now defined in the SettingsServiceProvider;
- Using the Admin middleware instead of Auth, as of Backpack\Base v0.6.0;


## 2.0.1 - 2016-05-20

### Fixed
- composer.json now requires Backpack\CRUD v2


## 2.0.0 - 2016-05-20

### Added
- SettingCrudController syntax changed to match the new API-based Backpack\CRUD v2.


## 1.2.3 - 2016-03-16

### Fixed
- Added page titles.


## 1.2.2 - 2016-03-11

### Fixed
- Changed folder structure to resemble a Laravel application - Http and Models are in an app folder.


## 1.2.1 - 2016-03-11

### Fixed
- Removed some more Dick mentions and fixed readme badges.


## 1.2.0 - 2016-03-11

### Fixed
- Changes namespaces to Backpack and removed every mention of Dick.


## 1.1.3 - 2015-09-10

### Fixed
- Namespacing and classes in seedfile, to allow seeding without publishing the assets.
