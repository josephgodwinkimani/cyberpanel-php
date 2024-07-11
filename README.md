<p align="center"><img src="/art/cyberpanel.png" width="50%" alt="cyberpanel-logo"></p>

<h1 align="center">📦 Unofficial SDK for PHP with Type hinting</h1>

[![Unit Tests](https://github.com/josephgodwinkimani/cyberpanel-php/actions/workflows/tests.yml/badge.svg)](https://github.com/josephgodwinkimani/cyberpanel-php/actions/workflows/tests.yml)
[![Static Analysis](https://github.com/josephgodwinkimani/cyberpanel-php/actions/workflows/static-analysis.yml/badge.svg)](https://github.com/josephgodwinkimani/cyberpanel-php/actions/workflows/static-analysis.yml)

![CodeFactor Grade](https://img.shields.io/codefactor/grade/github/josephgodwinkimani/cyberpanel-php?style=for-the-badge)
![GitHub issues](https://img.shields.io/github/issues-raw/josephgodwinkimani/cyberpanel-php?style=for-the-badge)
[![GitHub license](https://img.shields.io/github/license/josephgodwinkimani/cyberpanel-php?style=for-the-badge)](https://github.com/josephgodwinkimani/cyberpanel-php/blob/master/LICENSE)

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