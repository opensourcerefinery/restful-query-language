# Query language

[![Build Status](https://travis-ci.org/opensourcerefinery/restful-query-language.svg?branch=master)](https://travis-ci.org/opensourcerefinery/restful-query-language)

# Contribute

* Clone the project `git clone git@github.com:opensourcerefinery/restful-query-language.git`
* Install the dependencies `composer install`
* Create your PR and push to a new branch.

# Testing

* Running [Behat](https://docs.behat.org/) tests: `bin/behat`
* Running [PHPunit](https://phpunit.de/) tests: `bin/phpunit`
* Running [PHP_CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer): `bin/phpcs`
* Running [PHPStan](https://phpstan.org/): `bin/phpstan analyze`
* Running [Infection](https://infection.github.io/): `bin/infection` (**Note**: Must be run when phpunit tests are all passing)
