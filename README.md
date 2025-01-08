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
4. Install npm: `npm install`
5. Generate application key: `php artisan key:generate`
6. Run migrations: `php artisan migrate` (This command sets up the database tables based on defined migrations) or `php artisan migrate:rollback`
7. (Optional) Seed the database: `php artisan db:seed` (This command populates the database with sample data, if available)
8. Run Application `php artisan serve`,
9. Link Storage `php artisan storage:link`

php artisan make:filament-relation-manager TicketResource categories name
php artisan make:filament-relation-manager RoleResource permissions title
php artisan make:filament-relation-manager RoleResource roles title

php artisan make:seeder UserTableSeeder
php artisan make:seeder RoleTableSeeder
php artisan make:seeder PermissionTableSeeder
php artisan make:seeder PermissionRoleTableSeeder
php artisan make:seeder UserRoleTableSeeder

php artisan migrate:fresh --seed

php artisan make:filament-relation-manager UserResource roles title

php artisan make:migration "create role_user create"

`php artisan migrate`

php artisan make:policy CategoryPolicy --model=Category
php artisan make:policy TicketPolicy --model=Ticket
php artisan make:policy RolePolicy --model=Role
php artisan make:policy PermissionPolicy --model=Permission
php artisan make:policy UserPolicy --model=User

php artisan make:filament-widget StatsOverview --stats-overview
php artisan make:filament-widget LatestTickets --table

php artisan make:filament-widget TicketOverviewChart --chart
composer require flowframe/laravel-trend
