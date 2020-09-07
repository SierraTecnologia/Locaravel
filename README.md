# Locaravel












































**Locaravel** - A remarkably magical tools for geolocation

[![Build Status](https://travis-ci.org/SierraTecnologia/Locaravel.svg?branch=master)](https://travis-ci.org/SierraTecnologia/Locaravel)
[![Maintainability](https://api.codeclimate.com/v1/badges/8c00a046fec32d8b8ac7/maintainability)](https://codeclimate.com/github/SierraTecnologia/Locaravel/maintainability)
[![Packagist](https://img.shields.io/packagist/dt/sierratecnologia/locaravel.svg)](https://packagist.org/packages/sierratecnologia/locaravel)
[![license](https://img.shields.io/github/license/mashape/apistatus.svg)](https://packagist.org/packages/sierratecnologia/locaravel)

[ EM DESENVOLVIMENTO ]

## Requirements

1. PHP 7+
2. OpenSSL

### Installation

Start a new Laravel project:
```php
composer create-project laravel/laravel your-project-name
```

Then run the following to add Locaravel
```php
composer require "sierratecnologia/locaravel"
```

Time to publish those assets!
```php
php artisan vendor:publish --provider="Locaravel\LocaravelProvider"
```

## Documentation

mkdir storage/geo
cd storage/geo
wget http://download.geonames.org/export/dump/allCountries.zip && unzip allCountries.zip && rm allCountries.zip
wget http://download.geonames.org/export/dump/hierarchy.zip && unzip hierarchy.zip && rm hierarchy.zip


## Changelog

Refer to the [Changelog](CHANGELOG.md) for a full history of the project.


## Support

The following support channels are available at your fingertips:

- [Chat on Slack](https://bit.ly/sierratecnologia-slack)
- [Help on Email](mailto:help@sierratecnologia.com.br)
- [Follow on Twitter](https://twitter.com/sierratecnologia)


## Contributing & Protocols

Thank you for considering contributing to this project! The contribution guide can be found in [CONTRIBUTING.md](CONTRIBUTING.md).

Bug reports, feature requests, and pull requests are very welcome.

- [Versioning](CONTRIBUTING.md#versioning)
- [Pull Requests](CONTRIBUTING.md#pull-requests)
- [Coding Standards](CONTRIBUTING.md#coding-standards)
- [Feature Requests](CONTRIBUTING.md#feature-requests)
- [Git Flow](CONTRIBUTING.md#git-flow)


## Security Vulnerabilities

If you discover a security vulnerability within this project, please send an e-mail to [help@sierratecnologia.com.br](help@sierratecnologia.com.br). All security vulnerabilities will be promptly addressed.


## About SierraTecnologia

SierraTecnologia is a software solutions startup, specialized in integrated enterprise solutions for SMEs established in Rio de Janeiro, Brazil since June 2008. We believe that our drive The Value, The Reach, and The Impact is what differentiates us and unleash the endless possibilities of our philosophy through the power of software. We like to call it Innovation At The Speed Of Life. That’s how we do our share of advancing humanity.


## License

This software is released under [The MIT License (MIT)](LICENSE).

(c) 2008-2020 SierraTecnologia, Some rights reserved.

