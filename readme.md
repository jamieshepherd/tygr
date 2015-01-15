## Tygr - Issue management system

This repository hosts the source code for the tygr issue management system, a project and issue management system developed primarily for companies in the elearning industry. The project is open source under the MIT license.

### Development requirements

* Composer
* Node.js
* Gulp (globally)
* Laravel Homestead (recommended)

### Installation

To begin developing the issue management system, you must first have the aforementioned pre-requisites.

* If you have Laravel Homestead installed, run `homestead up`
* Run `composer update` to get all of the PHP dependencies
* Run `gulp watch` to process SCSS
* Run `php artisan migrate --seed` to migrate and seed the database
