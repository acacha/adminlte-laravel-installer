#!/bin/bash
composer install --prefer-source --no-interaction --dev
./sandbox_setup.sh
cd sandbox
./vendor/phpunit/phpunit --configuration ../phpunit.xml ../tests/InstallCommandTest.php



  -