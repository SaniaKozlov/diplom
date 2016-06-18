#!/usr/bin/env bash

php bin/console doctrine:generate:entities DiplomBundle
php bin/console doctrine:schema:update --force