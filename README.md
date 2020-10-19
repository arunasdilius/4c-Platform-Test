# 4C Platform Test

## Setup:

Use vagrant to run application

```
& vagrant up
& vagrant ssh
```

## Endpoints

The application consists of two main endpoints:

Lists all breeds by query parameters
```
GET /api/breeds?animal_type={animal_type}&name={partial_name}
```
The application will make a request to external source for breeds if it could not be found on internal database


Updates breed module by supplied id and form data
```
PUT /api/breeds/{breed}
`

## Tests

Run Unit and Feature tests for application
```
& php artisan test
```

Run package tests

```
& cd packages/fcp/animal-breeds-search
& composer install
& ./vendor/bin/phpunit
```

## TODO
* Capture api fail status codes
* use dedicated db instead of sqlite to transactions transactions in tests and updates
* BreedRepository should rely on unit tests instead of Feature tests