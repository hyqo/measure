# measure

![Packagist Version](https://img.shields.io/packagist/v/hyqo/measure?style=flat-square)
![Packagist PHP Version Support](https://img.shields.io/packagist/php-v/hyqo/measure?style=flat-square)
![GitHub Workflow Status](https://img.shields.io/github/workflow/status/hyqo/measure/run-tests?style=flat-square)

## Install

```sh
composer require hyqo/measure
```

## Usage

```php
Measure::start('foo');
Measure::start('bar');

usleep(100);
echo Measure::stop('foo'); // 100.00us

usleep(100);
echo Measure::stop('bar'); // 200.00us

Measure::getResults(); // ['foo'=>'100.00us','bar'=>'200.00us']
```
