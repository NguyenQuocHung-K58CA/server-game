# Demo send gift using Laravel 5.2

### Introduction
This app is virtual system to send gift game LOL to user after they choose gift. When user access to page, they must login to go to main page. If they haven't choosen gift before, show them the page with gifts, they choose gift and wait for server send gift to their account. If they have choosen gift, system don't show the main page and have message to notify they must wait or check account.

### Installation
This installation is for Linux OS. For Window, some steps are different.

To run this app, your server must have Apache, Mysql, PHP >= 5.5.9, Composer and Redis.

```sh
$ git clone https://github.com/NguyenQuocHung-K58CA/server-game.git
$ composer install
$ cp .env.example .env
```
- Change DATABASE_NAME PASSWORD in file .env
```sh
$ php artisan key:generate
$ php artisan migrate
$ php artisan serve
Laravel development server started on http://localhost:8000/
```
