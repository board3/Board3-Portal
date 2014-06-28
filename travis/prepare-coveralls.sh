#!/bin/bash
#
# This file is part of the phpBB Forum Software package.
#
# @copyright (c) phpBB Limited <https://www.phpbb.com>
# @license GNU General Public License, version 2 (GPL-2.0)
#
# For full copyright and license information, please see
# the docs/CREDITS.txt file.
#
set -e
set -x

DB=$1
TRAVIS_PHP_VERSION=$2

if [ "$TRAVIS_PHP_VERSION" == "5.5" -a "$DB" == "mysqli" ]
then
	sed -n '1h;1!H;${;g;s/\"squizlabs\/php_codesniffer\": \"1.*\"/\"squizlabs\/php_codesniffer\": \"1.*\",\n\t\t\"satooshi\/php-coveralls\"\: \"dev-master\"/g;p;}' phpBB/composer.json &> composer.json
	cp composer.json phpBB/composer.json
	cd phpBB
	rm composer.lock
	php ../composer.phar update
	cd ..
fi
