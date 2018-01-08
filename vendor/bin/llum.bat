@ECHO OFF
setlocal DISABLEDELAYEDEXPANSION
SET BIN_TARGET=%~dp0/../acacha/llum/llum
php "%BIN_TARGET%" %*
