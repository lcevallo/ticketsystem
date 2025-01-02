## URL

https://stackoverflow.com/questions/46877667/how-to-add-a-new-project-to-github-using-vs-code

## BluePrint

`php artisan blueprint:erase`
`php artisan blueprint:build`
`php artisan blueprint:new`

## Installation

To set up the schoolMIS application, follow these steps:

1. Clone the repository: `git clone https://github.com/lcevallo/ticketsystem.git`
2. Configure environment variables: Run `cd schoolmis && cp .env.example .env` ,
3. Install composer: `composer install`
4. Generate application key: `php artisan key:generate`
5. Run migrations: `php artisan migrate` (This command sets up the database tables based on defined migrations) or `php artisan migrate:rollback`
6. (Optional) Seed the database: `php artisan db:seed` (This command populates the database with sample data, if available)
7. Run Application `php artisan serve`,
8. Link Storage `php artisan storage:link`

php artisan make:filament-relation-manager TicketResource categories name
