# PHP Random.org Draws API

[![Build Status](https://travis-ci.org/naffiq/php-randomorg-draws.svg?branch=master)](https://travis-ci.org/naffiq/php-randomorg-draws)
[![Test Coverage](https://codeclimate.com/github/naffiq/php-randomorg-draws/badges/coverage.svg)](https://codeclimate.com/github/naffiq/php-randomorg-draws/coverage)
[![Code Climate](https://codeclimate.com/github/naffiq/php-randomorg-draws/badges/gpa.svg)](https://codeclimate.com/github/naffiq/php-randomorg-draws)


This library helps you with connecting your app to 
[Random.org's Third-Party Draws service](https://draws.random.org/).

### Installation

Preferable way to install this package is through composer:
 
```bash
$ composer require naffiq/php-randomorg-draws
```

### Usage

You have to register random.org account and provide login/password to `\naffiq\randomorg\DrawService`
constructor. Then you can create draws via `\naffiq\randomorg\DrawService::newDraw()` method, which
will spawn an object of `\naffiq\randomprg\Draw`.

```php
<?php

$service = new \naffiq\randomorg\DrawService('random.org_login', 'random.org_password');
$draw = $service->newDraw(
    'Title',                                    // Name of the draw
    1,                                          // ID of created draw, which will be passed to random.org
    ['user_1@email.com', 'user_2@email.com'],   // You can provide any unique identifiers of your participants
    1,                                          // Winners count 
    'test'                                      // Use 'private' or 'public' in production
    );

$draw->pushEntry('user_3@email.com'); // Adds new entry
```

To start draw run `\naffiq\randomorg\DrawService::holdDraw()` method with created `$draw`. In result
you will get instance of `\naffiq\randomorg\DrawResponse` class.

```php
<?php

/**
 * @var $service \naffiq\randomorg\DrawService
 * @var $draw \naffiq\randomorg\Draw
 */
$response = $service->holdDraw($draw);

var_dump($response->getWinners()); // Will output all winners of created draw
```

### Contributing and testing

Any contribution is highly welcomed. If you want to run test provide `RANDOMORG_LOGIN` and 
`RANDOMORG_PASSWORD` environment variables. Tests can initialize them from `.env` file. 
Just specify them as follows:
```.env
RANDOMORG_LOGIN=your_random_org_login
RANDOMORG_PASSWORD=your_random_org_password
```

And run
```bash
$ phpunit
```