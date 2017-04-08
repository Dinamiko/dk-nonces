# DK Nonces

## Introduction

Plugin for testing [Dinamiko Nonces Package](https://github.com/Dinamiko/Nonces)

## Table of Contents

* [Installation](#installation)
* [Usage](#usage)

## Installation

Clone this repo to your /wp-content/plugins/ directory:

```sh
$ git clone https://github.com/Dinamiko/dk-nonces.git
$ cd dk-nonces
```

Install Dinamiko Nonces Package with [Composer](https://getcomposer.org):

```sh
$ composer require dinamiko/nonces
```

## Usage

Create a nonce:

```php
$nonce = new Dinamiko\Nonces\Nonce( 'my-action' );
$nonce_value = (string) $nonce;
```

Create a nonce field:

```php
$nonce = new Dinamiko\Nonces\Nonce( 'my-action' );
$field = $nonce->create_field();
```

Create a nonce URL:

```php
$nonce = new Dinamiko\Nonces\Nonce( 'my-action' );
$url = $nonce->create_url( 'http://example.com' );
```

Verify a nonce:

```php
$nonce = new Dinamiko\Nonces\Nonce( 'my-action' );
$is_valid = $nonce->is_valid( $_POST['foo'] );
```
