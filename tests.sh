#!/usr/bin/env sh

bin/phpstan analyse -l 5 app
if [ $? -eq 0 ]
then
    php artisan test
    if [ $? -eq 0 ]
    then
        exit 0
    fi
fi

exit 1