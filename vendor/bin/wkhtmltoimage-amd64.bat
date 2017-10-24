@ECHO OFF
setlocal DISABLEDELAYEDEXPANSION
SET BIN_TARGET=%~dp0/../h4cc/wkhtmltoimage-amd64/bin/wkhtmltoimage-amd64
php "%BIN_TARGET%" %*
