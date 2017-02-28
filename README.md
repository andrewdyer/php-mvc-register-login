# PHP MVC Register & Login

[![Codacy Badge](https://api.codacy.com/project/badge/Grade/19f8340ac12d47bc93b54801ff25d7ae)](https://www.codacy.com/app/andrewdyer/php-mvc-register-login?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=andrewdyer/php-mvc-register-login&amp;utm_campaign=Badge_Grade)

A simple PHP MVC user authentication application. I’ve used this as a starter framework for some of my own PHP applications. This would be useful for small projects. It will be advantageous if you know the basics of object-oriented programming and MVC and you are able to use the command line. This script is not for beginners.

## License
Licensed under MIT. Totally free for private or commercial projects.

## Requirements
* PHP 5.5+
* MySQL 5 database

## Installation
* Make sure you have Apache, PHP, MySQL installed.
* Clone this repo to a folder on your server.
* Activate mod_rewrite, route all traffic to application's www/public_html folder.
* Edit config.php and set your database credentials.
* Execute the SQL statements in the _install directory to setup database tables.

### Install Composer
Go to project folder and run the composer install command;

```bash
composer install
```

### Install Bower Components
Go to project folder and run the bower install command;

```bash
bower install
```

### Install Database
Execute the SQL statements via phpmyadmin or the command line. In the following example "root", "password", "myApp" are the username, password and database name.

```bash
cat _install/db01-structure.sql | mysql --user=root --password=password myApp
cat _install/db02-constraints.sql | mysql --user=root --password=password myApp
cat _install/db03-inserts.sql | mysql --user=root --password=password myApp
```