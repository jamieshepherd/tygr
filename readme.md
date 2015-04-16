## Tygr - Issue management system
####Version 1.0.10

[![Build Status](https://travis-ci.org/jamieshepherd/tygr.svg?)](https://travis-ci.org/jamieshepherd/tygr)

This repository hosts the source code for the tygr issue management system, a project and issue management system developed primarily for companies in the elearning industry. The project is open source under the MIT license.

### Production prerequisites

* PHP 5.5

### Development prerequisites

* [Composer](https://getcomposer.org/)
* [Node.js](nodejs.org)
* [Laravel Homestead*](http://laravel.com/docs/master/homestead)

*Homestead is not required, but makes development and deployment very easy.

### Installation

To begin developing Tygr, you must first have the aforementioned pre-requisites. You can use the following commands to install your development environment.

* Run `homestead up` to start your local development environment, if using Homestead
* Run `composer update` to get all of the PHP dependencies
* Run `npm install` to get any Node dependencies
* Run `gulp watch` to process SCSS
* Connect to your local VM `homestead ssh`(if using Homestead) and `cd` to your project directory
* Run `php artisan migrate --seed` to migrate and seed the database

### License
This repository is released as open-sourced software licensed under the MIT license
