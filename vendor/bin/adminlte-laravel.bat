@ECHO OFF
setlocal DISABLEDELAYEDEXPANSION
SET BIN_TARGET=%~dp0/../acacha/adminlte-laravel-installer/adminlte-laravel
php "%BIN_TARGET%" %*
