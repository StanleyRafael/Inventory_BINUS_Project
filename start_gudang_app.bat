@echo off

REM Start Laravel app in the background
start "Laravel Server" /B php artisan serve

REM Open browser to localhost
start http://127.0.0.1:8000

REM Wait for user to close the batch file
pause

REM Find and stop the PHP process running the Laravel app
taskkill /IM php.exe /FI "WINDOWTITLE eq Laravel Server*"

exit
