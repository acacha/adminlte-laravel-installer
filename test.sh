#!/bin/bash
composer install --prefer-source --no-interaction --dev
composer global require "laravel/installer"
composer global require "acacha/llum"
./sandbox_setup.sh
cd sandbox
./vendor/phpunit/phpunit --configuration ../phpunit.xml ../tests/InstallCommandTest.php



  -