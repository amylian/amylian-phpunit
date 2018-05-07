# Package amylian/amylian-phpunit
Extensions for PHPUnit

The package providers a set of additional classes for PHPUnit

## Installation

To install this library, run the command below and you will get the latest version

``` bash
composer require amylian/amylian-phpunit --dev
```

## Additinal Assertions

### assertClassExists 

add `use \abexto\amylian\phpunit\traits\AssertClassExistsTrait;` to your test class declaration and call `$this->assertClassExists(\My\Fully\Qualified\ClassName::class)`. 
