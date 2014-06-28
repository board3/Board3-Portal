#!/bin/bash
#
# This file is part of the Board3 Portal package.
#
# @copyright (c) Board3 Group <http://www.board3.de>
# @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
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
