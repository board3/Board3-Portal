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
	cd ../board3/Board3-Portal
	wget https://scrutinizer-ci.com/ocular.phar
	php ocular.phar code-coverage:upload --access-token="681b2ead2ea75fe4ce287bae485a916f47034c76f39209a9397545058e7c045e" --format=php-clover ../../phpBB3/build/logs/clover.xml
fi
