#!/usr/bin/env bash

SCRIPT_DIR="$( cd "$( dirname "$0" )" && pwd )"
SCRIPT_PARENT_DIR="${SCRIPT_DIR%/*}" 

PHP_CS_FIXER="${SCRIPT_PARENT_DIR}/vendor/friendsofphp/php-cs-fixer/php-cs-fixer"

$PHP_CS_FIXER $@