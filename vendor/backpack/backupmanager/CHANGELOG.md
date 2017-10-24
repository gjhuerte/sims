# Changelog

All Notable changes to `backupmanager` will be documented in this file

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


## [1.2.0] - 2017-08-30

### Fixed
- upgraded to Spatie/Backup v4; breaking change: dump variables are now named inside an array in config/database.php;


## [1.1.18] - 2017-07-06

### Added
- overwritable routes file;


## [1.1.17] - 2017-07-05

### Added
- Portugese translation (thanks to [Toni Almeida](https://github.com/promatik));
- Portugese (Brasilian) translation (thanks to [Guilherme Augusto Henschel](https://github.com/cenoura));


## [1.1.16] - 2017-04-05

### Added
- French translation;
- Dutch translation (thanks to [Mark van Beek](https://github.com/chancezeus));
- fixed App namespace issue;

## [1.1.15] - 2017-01-21

### Added
- Ability to publish views;
- Ability to overwrite views the same way you overwrite views in CRUD;


## [1.1.14] - 2017-01-08

### Fixed
- removed duplicate namespace in BackupController;



## [1.1.13] - 2016-12-22

### Fixed
- delete route filename conflict - thanks to [Vincenzo Raco](https://github.com/vincenzoraco);


## [1.1.12] - 2016-12-13

### Added
- Greek translation file, thanks to [Stamatis Katsaounis](https://github.com/skatsaounis);


## [1.1.11] - 2016-09-24

### Fixed
- Routes now follow base prefix - thanks to [Twaambo Haamucenje](https://github.com/twoSeats);


## 1.1.10 - 2016-08-17

### Added
- Spanish translation, thanks to [Rafael Ernesto Ferro González](https://github.com/rafix);


## 1.1.9 - 2016-07-30

### Added
- Bogus unit tests. At least we'be able to use travis-ci for requirements errors, until full unit tests are done.


## 1.1.8 - 2016-07-25

### Fixed
- Download button with subfolders.


## 1.1.7 - 2016-07-13

### Added
- Showing files from multiple disks.
- Can delete files from other disks, other than local (tested Dropbox).

### Fixed
- Download link is no longer dependant on the suggested backups storage disk.
- Hidden download link if not using the Local filesystem.

### Removed
- Subfolder listing and downloading.

## 1.1.6 - 2016-06-03

### Fixed
- Download and delete buttons now work too, for subfolders.


## 1.1.5 - 2016-06-03

### Fixed
- Showing zip files from subfolders, too, since laravel-backup stores them that way.


## 1.1.4 - 2016-03-16

### Fixed
- Added page title.

## 1.1.3 - 2016-03-16

### Fixed
- Eliminated console logs from backup js.
- Added screenshot in README.

## 1.1.2 - 2016-03-16

### Fixed
- Made the backup button work.
- Added another error type - the warning when something failed.
- Logging the progress in the log files.
- Showing the artisan command output in the ajax response.
- Added the dump_command_path configuration.
- Changed README to instruct on common misconfiguration issue.


## 1.1.1 - 2016-03-15

### Fixed
- Correct name in readme. Confirming packagist hook.


## 1.1 - 2016-03-15

### Added
- Updated to v3 of spatie's laravel-backup package.
- Renamed everything to be part of Backpack instead of Dick.
