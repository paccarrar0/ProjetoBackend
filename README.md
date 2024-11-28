## Equipment Reservation Management System(ERMS)

The Equipment Reservation Management System (ERMS) is a web platform that makes managing equipment rentals easier, allowing users to make reservations, return items, and track the status of their items in real time.

### Dependencies

- Docker
- Docker Compose

### To run

#### Clone Repository

```
$ git clone git@github.com:paccarrar0/ProjetoBackend.git
$ cd ProjetoBackend
```

#### Define the env variables

```
$ cp .env.example .env
```

#### Install the dependencies

```
$ ./run composer install
```

#### Up the containers

```
$ docker compose up -d
```

ou

```
$ ./run up -d
```

#### Create database and tables

```
$ ./run db:reset
```

#### Populate database

```
$ ./run db:populate
```

#### Run the tests

```
$ docker compose run --rm php ./vendor/bin/phpunit tests --color
```

or

```
$ ./run test
```

#### Run the linters

[PHPCS](https://github.com/PHPCSStandards/PHP_CodeSniffer/)

```
$ ./run phpcs
```

[PHPStan](https://phpstan.org/)

```
$ ./run phpstan
```
