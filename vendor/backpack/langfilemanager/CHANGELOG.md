# Changelog

All Notable changes to `Backpack LangFileManager` will be documented in this file

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


## [1.0.21] - 2017-08-30

### Fixed
- disabled languages were still accessible;


## [1.0.20] - 2017-08-30

### Added
- Portugese (pt) language files, thanks to [Toni Almeida](https://github.com/promatik);
- Laravel 5.5 package auto-discovery support;


## [1.0.19] - 2017-08-11

### Added
- Brasilian Portugese (pt_BR) language files, thanks to [Guilherme Augusto Henschel](https://github.com/cenoura);


## [1.0.18] - 2016-09-24

### Fixed
- Routes now follow base prefix - thanks to [Twaambo Haamucenje](https://github.com/twoSeats);


## [1.0.17] - 2016-09-21

### Fixed
- Translation texts can hold HTML.


## [1.0.16] - 2016-08-03

### Fixed
- Small english text change.


## [1.0.15] - 2016-07-31

### Fixed
- Working bogus unit tests.


## [1.0.13] - 2016-07-12
### Added by [Federico Liva](http://www.federicoliva.info)
- Sort file list alphabetically for better readability


## [1.0.12] - 2016-07-03

### Fixed by [Federico Liva](http://www.federicoliva.info)
- Native language can also be translated now.
- Clone default language folder on new language.
- Config values were ignored.


## [1.0.11] - 2016-06-13

### Added by [Federico Liva](http://www.federicoliva.info)
- Add translations and italian localization


## [1.0.10] - 2016-06-07

### Added
- Using Backpack\CRUD v2 (with new API);
- Bogus unit test;

### Added
- Code style issues;
- Namespace error;


## [1.0.8] - 2016-03-16

### Fixed
- Added page title.


## [1.0.7] - 2016-03-12

### Fixed
- LangFileManager can no longer use package lang files for backup, because that broke all other packages' backup lang files. Lang files for this package need to be published.

## [1.0.6] - 2016-03-12

### Fixed
- Lang files are pushed in the correct folder now. For realsies.
- Backpack\CRUD is now a composer requirement.


## [1.0.5] - 2016-03-12

### Fixed
- Change folder structure to resemble a Laravel app and other Backpack packages.
- Added the empty_file translation key in langfilemanager's language file.


## [1.0.4] - 2016-03-12

### Fixed
- Using a separate lang file from other Backpack packages, which can be published.


## [1.0.3] - 2016-03-12

### Fixed
- Renamed from Dick\TranslationManager to Backpack\TranslationManager.
- Now using separate config file.


## [1.0.2] - 2015-09-10

### Added
- Migrations and seeds for Laravel-Localizable integration.
- Extra methods on the Language model.

## [1.0.0] - 2015-09-07

### Added
- Base functionality (edit language files).
- Improved UX over the old interface.
