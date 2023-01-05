#!/bin/sh
# activate maintenance mode
/usr/local/bin/php ./artisan down
# update source code
/usr/local/bin/git pull
# update PHP dependencies
/usr/local/bin/composer install --no-interaction --prefer-dist --ignore-platform-reqs
# --no-interaction Do not ask any interactive question
# --no-dev  Disables installation of require-dev packages.
# --prefer-dist  Forces installation from package dist even for dev versions.
# update database
/usr/local/bin/php ./artisan migrate --force
# --force  Required to run when in production.
/usr/local/bin/php ./artisan cache:clear
/usr/local/bin/php ./artisan config:cache
# stop maintenance mode
/usr/local/bin/php ./artisan up
