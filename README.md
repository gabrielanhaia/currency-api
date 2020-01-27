[![CircleCI](https://circleci.com/gh/gabrielanhaia/currency-api/tree/master.svg?style=svg)](https://circleci.com/gh/gabrielanhaia/currency-api/tree/master)
    <img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License">

## About the Project

Following the document, I decided to create a problem to solve and show my knowledge about some points that I think it is important as a developer.

1. Object Orientation
2. Design Patterns
3. Solid.
4. Maintainability
5. Tests.
6. Reusability.
7. PHP and developing without a framework (on the integration packages)
8. Laravel
9. Organization (I used the trello for controlling all tasks, I can share it with you if you would like).
10. Clean Code and PSRs.


*DONT FORGET TO LOOK AT THESE TWO PACKAGES (They are part of the test)*<br>
[Integration Irish Bank](https://github.com/gabrielanhaia/currency-integration-irish-bank/blob/master/README.md)
<br>
[Integration Brazilian Bank](https://github.com/gabrielanhaia/currency-integration-brazilian-bank/blob/master/README.md)

## The problem

I searched about how the real company works and the idea behind sending money abroad. So I realized that it is necessary to have one bank operating over each different currency across the world. I decided to implement a structure for new integrations reusable, maintainable, easy to test and to extend. This structure follows standards defined by me and they are part of this repository and another part split in subprojects installed by composer.

Another good advantage of developing on packages is that we could easily rewrite the code on this repository and just require the packages by the composer.

Here are the repositories that are used as a dependency of this project:

[Integration Irish Bank](https://github.com/gabrielanhaia/currency-integration-irish-bank/blob/master/README.md)
<br>
[Integration Brazilian Bank](https://github.com/gabrielanhaia/currency-integration-brazilian-bank/blob/master/README.md)

## Fundamental things for the project 

1. Never duplicate a transaction (I added a unique key for the fields on the database) and I check it before inserting a new transaction. I think a limit of requests for millisecond could be interesting too.
2. Think about the future of the application.
3. Application Scalable.

## Important things implemented by me

0. I Implemented a structure as a Service, this structure of files is responsible for using the packages of the integrations. I extended the Jobs (Laravel), I am sending all transactions for the queue, so I can process each on individually and split the processing, scaling the application.
1. Repository layer: I use to implement this pattern to encapsulate the ORM/database, so if it was necessary we can easily change some parts of our database, maybe a no-relational should be much more interesting in the future. Besides that, it is much easier to test and remove the business rules from the controllers.
2. I implemented a middleware to version the API, there is an organization in some directories as Controllers, Requests, Resources... So it is really easy to change our integrations with the back-end (apps, web platforms...) and it will not break any integration that is working.
3. I am using the Service Container (Laravel) to inject some dependencies (DI).
4. I am using Soft Deletes to don't lost transactions deleted in the past (they are really important data).
5. The first thing I did was a board (trello to organize the tasks to do). After I modulated the database (I can share it with you).

## Technologies/Methodologies

**PHP 7.3:** I decided to use PHP because that is the role and I want to show all my knowledge about it. Besides that, all of the benefits of using PHP in an application. For sure I know that for this type of application maybe it wouldn't be the best option.

**MySQL/MariaDB**: I was thinking about using a no-SQL database, maybe it could make sense in for the future of the application, but after analyzing the POST JSON  (test example) and maybe there are loads of relations, so I decided to use the MySQL that I have more knowledge. In a real application, I would discuss it with the team. Anyway, I am implementing repositories, so it would be easy to change the database if it was necessary.

**Laravel:** I decided to use the Laravel framework because I believe it is the consolidated framework in PHP at the moment and with the largest community of PHP developer, so we have more developers using it, more packages developed and it is easier for the company who maintain the project to hire people.

**Docker:** I am using docker because I can version the infrastructure in the code. There are many more reasons like for example for new developers to start working on the project, just a few commands and everything is working.

**Composer:** The Processor and Integrations were developed in external packages and used as dependency on the main project. We have loads of benefits on this way.

**PHPUnit:** I am using the PHPUnit for writing the unit tests on the application.

**CircleCi:** The CI is running on CircleCI (PHPUnit...)

**Trello:** I tried to follow the scrum principles (actually planning and using the kanban) to keep the project organized. In the cards, there are the number of the issues on GitHub.

**PSRs:** I am following the PSR's for a clean code.

** Another technologies:** GitHub, GIT


## Tests

I didn't implement all unit tests, there are more unit tests on the packages (integrations). But there are a few important tests that could be checked.

Running the tests: `php vendor/bin/phpunit`

## Running the project without docker

1. For some reason the Guzzle Http can't access the same server when we are using (PHP built in / php artisan serve).
So I recommend that you install in you machine Apache or Nginx and clone the folder inside your web directory. The index should be the folder *public*.

2. Copy the file *.env.example* to *.env* and change the variables bellow:
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=currency_fair
DB_USERNAME=root
DB_PASSWORD=root

API_BRAZILIAN_BANK_BASE_URL=http://localhost:8888/api/v1
API_IRISH_BANK_BASE_URL=http://localhost:8888/api/v1

Note: The URL of the APIS should be the same as the server running.

3. Run the command `composer install`
4. Run `php artisan migrate`
5. Enjoy :)

## Running the project by Docker

1. Access the folder *laradock* and run: <br>
```docker-compose up -d nginx mysql phpmyadmin  workspace```

2. Copy the file *.env.example* to *.env* and change the variables bellow:
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=currency_fair
DB_USERNAME=root
DB_PASSWORD=root

API_BRAZILIAN_BANK_BASE_URL=http://localhost:8888/api/v1
API_IRISH_BANK_BASE_URL=http://localhost:8888/api/v1

Note: The URL of the APIS should be the same as the server running.

3. Run the command `composer install`
4. Run `php artisan migrate`
5. Enjoy :)

## Notes

1. I didn't focus on the front-end so the URL that are loading the front-end is really simple. I thought about implementing sockets or something like that to see the transactions in real-time.
2. There are a few unit tests in this package, you can see more unit tests on the integration packages.
3. I considered that the datetime on the field (timePlaced) is day- month-year.
4. I use prefix for the commit to identify the type (feature, fix, sty).
5. I didn't focus on Exception handling and logs. It must be improved. However, I just wanted to point out that I realized it.


## License

It is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
