### Grubber
An Agile web based application built with Laravel, based on the <a href="https://github.com/modestkdr/scrumwala">Scrumwala</a> project.

[![Build Status](https://travis-ci.org/PipIWYG/grubber.svg)](https://travis-ci.org/PipIWYG/grubber)
[![Total Downloads](https://poser.pugx.org/pipiwyg/grubber/downloads)](https://packagist.org/packages/pipiwyg/grubber)
[![Latest Stable Version](https://poser.pugx.org/pipiwyg/grubber/v/stable)](https://packagist.org/packages/pipiwyg/grubber)
[![Latest Unstable Version](https://poser.pugx.org/pipiwyg/grubber/v/unstable)](https://packagist.org/packages/pipiwyg/grubber)
[![License](https://poser.pugx.org/pipiwyg/grubber/license)](https://packagist.org/packages/pipiwyg/grubber)

### Features
* Create and manage projects with plan and work views
* Group issues in a project into sprints
* Set deadlines for issues, active sprints and projects
* Get reminders via email listing issues nearing deadline
* Responsive UI, *thanks to Bootstrap*

### Install Instructions
To install Grubber you can clone the repository:

```
git clone https://github.com/PipIWYG/grubber.git
```

Next, enter the project's root directory and install the project dependencies:

```
composer install
composer update
```

Next, configure your .env file (root directory - you can copy the .env.example) and database (config/database.php). Subsequently, create the database and then run the migrations:

#####MySQL
```
mysql -uroot -p
```

```
mysql> CREATE SCHEMA grubber;
Query OK, 1 row affected (0.00 sec)
```
```
mysql> quit
```

#####.env
```
DB_HOST=localhost
DB_DATABASE=grubber
DB_USERNAME=yourdbusername
DB_PASSWORD=yourdbpassword
```

Once configured as above, run the php artisan command to migrate the tables:

```
php artisan migrate
```

Once the database tables have successfully been migrated, seed the database tables to create the initial admin user for access to the system.

```
$ php artisan db:seed
```

Finally, configure your virtual host and set-up your web server environment, and head on to the url assigned to the application. Log in using the following credentials:

```
Username: dummy@domain.com
Password: N3wT0N
```

### License
Grubber is licensed under the MIT license. If you find something wrong with the code or think it could be improved, I welcome you to create an <a href="https://github.com/PipIWYG/grubber/issues">issue</a> or submit a pull request!
