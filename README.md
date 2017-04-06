# DK Nonces

## Introduction

Plugin for testing dinamiko/nonces package.

## Table of Contents

* [Installation](#installation)
* [Usage](#usage)

## Installation

Clone this repo to your /wp-content/plugins/ directory:

```sh
$ git clone https://github.com/Dinamiko/dk-nonces.git
$ cd dk-nonces
```

Install plugin dependencies with [Composer](https://getcomposer.org):

```sh
$ composer install
```

Install dinamiko/nonces package dependencies:

```sh
$ cd dinamiko/nonces
$ composer install
```

Run the tests:

```sh
$ vendor/bin/phpunit
```

## Usage

Create a nonce:

```php
use Dinamiko\Nonces\Nonce;
$nonce = new Nonce( 'my-action' );
```

Verify a nonce:

```php
$nonce = new Nonce( 'my-action' );
$is_valid = $nonce->is_valid( $_POST['foo'] );
```
