[![CircleCI](https://circleci.com/gh/gabrielanhaia/currency-api/tree/master.svg?style=svg)](https://circleci.com/gh/gabrielanhaia/currency-api/tree/master)
    <img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License">

## About the Project

Following the document, I decided to create a problem to solve and show my knowledge about some important points that I think it is important as a developer.

1. Object Orientation
2. Design Patterns
3. Solid.
4. Maintainability
5. Tests.
6. Reusability.
7. PHP and developing without a framework (on the integration packages)
8. Laravel
9. Organization (I used the trello for all tasks, I could share with you).
10. Clean code and PSRs.

## The problem

I searched about how the real company works and the idea behind sending money abroad. So I realized that it is necessary for one bank operating over each different currency over the world. I decided to implement a structure for new integrations reusable, maintainable, easy to test and to extend. This structure follows standards defined by me and they are part of this repository and another part split in subprojects installed by composer.

Another good advantage of developing on packages is that we could easily rewrite the code on this repository and just require the packages by the composer.

Here are the repositories that are used as a dependency of this project:

[Integration Irish Bank](https://github.com/gabrielanhaia/currency-integration-irish-bank/blob/master/README.md)
[Integration Brazilian Bank](https://github.com/gabrielanhaia/currency-integration-brazilian-bank/blob/master/README.md)

## Fundamental things for the project 

1. Never duplicate a transaction (I added a unique key for the fields on the database) and I check it before inserting a new transaction. I think a limit of requests for millisecond could be interesting too.
2. Think about the future of the application.
3. Application Scalable.

## Important things implemented by me

0. I Implemented a structure as a Service, this structure of files is responsible for using the packages of the integrations. I extended the Jobs (Laravel), I am sending all transactions for the queue, so I can process each on individually and split the processing, scaling the application.
1. Repository layer: I use to implement this pattern to encapsulate the ORM/database, so if it was necessary we can easily change some parts of our database, maybe a no-relational should be much more interesting in the future. Besides that, it is much easier to test and remove the business rules from the controllers.
2. I implemented a middleware to version the API, there is an organization in some directories as Controllers, Requests, Resources... So it is really easy to change our integrations with the back-end (apps, web platforms...) and it will not break any integration working.
3. I am using the Service Container (Laravel) to inject some dependencies (DI).
4. I am using Soft Deletes to don't lost transactions deleted in the past (they are really important data).
5. The first thing i did was a board (trello to organize the tasks to do). After I modulated the database (I can share it with you).


## Notes

1. I didn't focus on the front-end so the URL that are loading the front-end is really simple. I thought about implementing sockets or something like that to see the transactions in real-time.
2. There are a few unit tests in this package, you can see more unit tests on the integration packages.
3. I considered that the datimetime on the field (timePlaced) is day- month-year.
4. I use prefix for the commit to identify the type (feature, fix, sty).
5. I didn't focus on Exception handling and logs. It must be improved. However, I just wanted to point out that I realized it 


## License

It is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
