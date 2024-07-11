<p align="center"><img src="/art/cyberpanel.png" width="50%" alt="cyberpanel-logo"></p>

<h1 align="center">📦 Unofficial SDK for PHP with Type hinting</h1>

[![PHP Version Require](http://poser.pugx.org/gkimani/cyberpanel/require/php)](https://packagist.org/packages/gkimani/cyberpanel)
[![Version](http://poser.pugx.org/gkimani/cyberpanel/version)](https://packagist.org/packages/gkimani/cyberpanel)
[![Total Downloads](http://poser.pugx.org/gkimani/cyberpanel/downloads)](https://packagist.org/packages/gkimani/cyberpanel)
![GitHub Issues or Pull Requests](https://img.shields.io/github/issues/josephgodwinkimani/cyberpanel-php)

[![Unit Tests](https://github.com/josephgodwinkimani/cyberpanel-php/actions/workflows/tests.yml/badge.svg)](https://github.com/josephgodwinkimani/cyberpanel-php/actions/workflows/tests.yml)
[![Static Analysis by Psalm](https://github.com/josephgodwinkimani/cyberpanel-php/actions/workflows/psalm.yml/badge.svg)](https://github.com/josephgodwinkimani/cyberpanel-php/actions/workflows/psalm.yml)
[![Static Analysis by PHPStan](https://github.com/josephgodwinkimani/cyberpanel-php/actions/workflows/phpstan.yml/badge.svg)](https://github.com/josephgodwinkimani/cyberpanel-php/actions/workflows/phpstan.yml)


## Introduction

Consume CyberPanel APIs inside your PHP Application

- [x] User
- [x] Package
- [x] Website
- [x] DNS
- [x] Database
- [x] Email
- [x] Child Domain
- [x] FTP
- [x] Backup
- [ ] Partner 

## Install

Install the SDK using [Composer](https://getcomposer.org/).

```bash
composer require gkimani/cyberpanel
```

## Usage

```
// replace the class Website with either: 

--> Ftp, User, Package, ChildDomain, Email, Database, Dns, Backup

$cyberPanelClient = new Website('https://panel.cyberpanel.net', 'admin', 'password');
$response = $cyberPanelClient->createWebsite(
        'admin', 
        'cyberpanel.net',
        'Default',
        'usman@cyberpersons.com',
        'PHP 8.1',
        'admin',
        0,
        0,
        0
);

// $response handles exceptions for errors that occur during HTTP requests

```

## Security

If you discover any security related issues, please email josephgodwinke@gmail.com instead of using the issue tracker.

## Credits

Thanks to everyone who has contributed to this project so far. You can read the contribution guide [here](.github/CONTRIBUTING.md).

<a href="https://github.com/josephgodwinkimani/cyberpanel-php/graphs/contributors">
  <img src="https://contrib.rocks/image?repo=josephgodwinkimani/cyberpanel-php" />
</a>

## License

The MIT License. Please see [License File](LICENSE.md) for more information.