#!/usr/bin/env bash

php bin/console cache:clear --env=dev
php bin/console cache:clear --env=prod
