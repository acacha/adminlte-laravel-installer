[![Total Downloads](https://poser.pugx.org/acacha/adminlte-laravel-installer/downloads.png)](https://packagist.org/packages/acacha/adminlte-laravel-installer)
[![Latest Stable Version](https://poser.pugx.org/acacha/adminlte-laravel-installer/v/stable.png)](https://packagist.org/packages/acacha/adminlte-laravel-installer)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/acacha/adminlte-laravel-installer/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/acacha/adminlte-laravel-installer/?branch=master)
[![StyleCI](https://styleci.io/repos/48875160/shield?branch=master)](https://styleci.io/repos/48875160)
[![Build Status](https://travis-ci.org/acacha/adminlte-laravel-installer.svg?branch=master)](https://travis-ci.org/acacha/adminlte-laravel-installer)

# adminlte-laravel-installer

Installer for project [acacha/adminlte-laravel](https://github.com/acacha/adminlte-laravel)

# Install notes

```bash
composer global require "acacha/adminlte-laravel-installer"
```

# Use

Use this commands inside a fresh new Laravel project:

```bash
laravel new project && cd project
adminlte-laravel install
```

For more info see https://github.com/acacha/adminlte-laravel

# vendor:publish vs custom publish

The installer use a custom artisan command (admilte-laravel:publish) to publish files. You can use old behaviour forcing use of laravel vendor:publish (this command will not be supported in future)

```bash
admilte-laravel --use-vendor-publish install
```

# Add OAuth Social Login/Register with Laravel Socialite

Execute:

```bash
adminlte-laravel social
```

And follow the wizard instructions to configure Login/Register using Social Networks.

More info at package [acacha/laravel-social](https://github.com/acacha/laravel-social)
