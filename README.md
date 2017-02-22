[![Total Downloads](https://poser.pugx.org/acacha/adminlte-laravel-installer/downloads.png)](https://packagist.org/packages/acacha/adminlte-laravel-installer)
[![Latest Stable Version](https://poser.pugx.org/acacha/adminlte-laravel-installer/v/stable.png)](https://packagist.org/packages/acacha/adminlte-laravel-installer)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/acacha/adminlte-laravel-installer/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/acacha/adminlte-laravel-installer/?branch=master)
[![StyleCI](https://styleci.io/repos/48875160/shield?branch=master)](https://styleci.io/repos/48875160)
[![Build Status](https://travis-ci.org/acacha/adminlte-laravel-installer.svg?branch=master)](https://travis-ci.org/acacha/adminlte-laravel-installer)
[![Dependency Status](https://www.versioneye.com/user/projects/58adc66b9ceb450051827162/badge.svg?style=flat-square)](https://www.versioneye.com/user/projects/58adc66b9ceb450051827162)
# adminlte-laravel-installer

Installer for project [acacha/adminlte-laravel](https://github.com/acacha/adminlte-laravel)

# Requirements

This packages requires [acacha/llum](https://github.com/acacha/llum) package starting from version 2.0

# Install notes

```bash
composer global require "acacha/adminlte-laravel-installer=~3.0"
```

# Use

```bash
admilte-laravel install
```

For more info see https://github.com/acacha/adminlte-laravel

# Installer without llum

Use:

```bash
composer global require "acacha/adminlte-laravel-installer=~1.0"
```

Or use option --no-llum using installer:

```bash
admilte-laravel --no--llum install
```

#Avoid force overwrite during installation

Use:

```bash
admilte-laravel -F install
```

or:

```bash
admilte-laravel --dontforce install
```

# vendor:publish vs custom publish

The installer use a custom artisan command (admilte-laravel:publish) to publish files. You can use old behaviour forcing use of laravel vendor:publish (this command will not be supported in future)

```bash
admilte-laravel --use-vendor-publish install
```

# Add OAuth Social Login/Register with Laravel Socialite

Execute:

```bash
admilte-laravel social
```

And follow the wizard instructions to configure Login/Register using Social Networks.

More info at package [acacha/laravel-social](https://github.com/laravel/social)
