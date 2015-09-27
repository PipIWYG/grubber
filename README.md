### Grubber
An Agile web based application built with Laravel, based on the <a href="https://github.com/modestkdr/scrumwala">Scrumwala</a> project.

### Features
* Create and manage projects with plan and work views
* Group issues in a project into sprints
* Set deadlines for issues, active sprints and projects
* Get reminders via email listing issues nearing deadline
* Responsive UI, *thanks to Bootstrap*

### Install Instructions
To install Grubber you can clone the repository:

```
$ git clone https://github.com/PipIWYG/grubber.git
```

Next, enter the project's root directory and install the project dependencies:

```
$ composer install
```

Next, configure your .env file (root directory) and database (config/database.php). Subsequently, create the database and then run the migrations:

```
$ php artisan migrate
```

### License
Scrumwala is licensed under the MIT license. If you find something wrong with the code or think it could be improved, I welcome you to create an <a href="https://github.com/modestkdr/scrumwala/issues">issue</a> or submit a pull request!
