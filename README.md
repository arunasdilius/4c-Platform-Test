# 4C Platform Test

## Installation:

Please make sure you have the PHP `pcov` extension installed for code coverage

### PHP 7.4 for macOS
```bash
/bin/bash -c "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/master/install.sh)"
brew install php@7.4
brew link php@7.4 --force
sudo pecl install pcov
```

### PHP 7.4 for GNU/Linux
```bash
sudo apt install software-properties-common
sudo add-apt-repository ppa:ondrej/php -y
sudo apt-get update
sudo apt-get install composer php7.4-cli php7.4-dev php7.4-xml php7.4-mbstring php7.4-curl php7.4-pcov php7.4-gd php7.4-sqlite3 sqlite3
sudo pecl install pcov
```

``` bash
$ composer install
$ copy .env.example .env
$ touch database/database.sqlite
$ php artisan migrate:fresh
```

## Database Seeding:

When running the `UserSeeder` this will create a user account that can be used with the api, the details will be outputted to the console.

For example:
```bash
User created with email address: angela.johns@rice.net
User created with password: ',>o$%Zn)=</comment>
User api auth header: Bearer 1|qnfsOch4SsPryY8q9iNmwSN1cvHBaXi3HmdHAiZK
```

``` bash
$ php artisan db:seed --class=UserSeeder
```

## Running the server:

```bash
$ php artisan serve
```

## Running unit tests:
``` bash
$ php artisan test
```

## Generating code coverage reports:

To help you understand how much unit test coverage is needed for the code written, you can use the following composer command:

``` bash
$ composer coverage
```
This will generate HTML coverage reports under `tests/code-coverage-report` which can be viewed locally in your web browser by opening `tests/code-coverage-report/index.html`.

## Automatically fix code style using `php-cs-fixer`:
``` bash
$ composer fixer
```

## If you are using PHPStorm 😻

- We advise the use of the [PHP Inspections (EA Extended)](https://plugins.jetbrains.com/plugin/7622-php-inspections-ea-extended-) plugin
- Any code submitted **must* display the 'Green Tick' in the top right of the IDE
- PHP CS Fixer configuration file `.php_cs` is included in the root of this test and can enabled via PHP Quality Tools


## Laravel Telescope (debugging API):

This is available from the following URL: [http://127.0.0.1:8000/telescope](http://127.0.0.1:8000/telescope)

## Postman:

Public collection URL: [https://www.getpostman.com/collections/c95a7513c0c90c58ca9e](https://www.getpostman.com/collections/c95a7513c0c90c58ca9e)

When selecting the collection you need to assign the following environment to it: `4C Platform Developer Test`. This allows automatic `base_url` and bearer `token` to be set.

This has all the required endpoints available.

## Authenticating with the API:

There are two api endpoints already created in this scaffolding `/api/register` and `/api/login`

`POST : /api/register`

Body:

```
- name
- email
- password
```

Response:

```
- token
- type
```

`POST : /api/login`

Body:

```
- email
- password
```

Response:

```
- token
- type
```

## Third party Cat and Dog API

Information about the endpoints for the third party API can be found at the following links:

  - [https://docs.thecatapi.com/api-reference/breeds/breeds-search](https://docs.thecatapi.com/api-reference/breeds/breeds-search)
  - [https://docs.thecatapi.com/api-reference/breeds/breeds-list](https://docs.thecatapi.com/api-reference/breeds/breeds-list)
  - [https://docs.thedogapi.com/api-reference/breeds/breeds-search](https://docs.thedogapi.com/api-reference/breeds/breeds-search)
  - [https://docs.thedogapi.com/api-reference/breeds/breeds-list](https://docs.thedogapi.com/api-reference/breeds/breeds-list)

### Api Keys

The api keys can be retrieved via the .env using the following environmental vars:

- `CAT_API_KEY`
- `DOG_API_KEY`




