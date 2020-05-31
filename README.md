<h2 align="center">
<img src="https://user-images.githubusercontent.com/121194/82691564-6b57da80-9c5e-11ea-87ec-639ad2255e8a.png"><br />
Tracking Movement
</h2>


<p align="center">
<a href="https://github.com/johnnymast/redbox-tracker/actions?query=workflow%3APhpcs"><img src="https://github.com/johnnymast/redbox-tracker/workflows/Phpcs/badge.svg" /></a>
<a href="https://scrutinizer-ci.com/g/johnnymast/redbox-tracker/?branch=master"><img src="https://scrutinizer-ci.com/g/johnnymast/redbox-tracker/badges/quality-score.png?b=master" /></a>
<a href="https://scrutinizer-ci.com/g/johnnymast/redbox-tracker/?branch=master"><img src="https://scrutinizer-ci.com/g/johnnymast/redbox-tracker/badges/coverage.png?b=master" /></a>
<a href="https://scrutinizer-ci.com/g/johnnymast/redbox-tracker/build-status/master"><img src="https://scrutinizer-ci.com/g/johnnymast/redbox-tracker/badges/build.png?b=master" /></a>
</p>
 
Redbox-tracker allows helps you to track visiting traffic to your Laravel website. New visitors along with their requests will be saved to the database.

# Getting started

## Prerequisites

We don't require much, but these are the minimum requirements for using Redbox-tracker. 

- PHP 7.3
- Laravel 7 or higher

There is one additional requirement if you are contributing to this package.
For development on the package itself, we require <code>pdo_sqlite</code> for testing.

## Installation  

The package can be installed using composer.

```bash
composer require redbox/tracker
```

The package will automatically register itself.

Publish configuration file:

```bash
php artisan vendor:publish --provider="Redbox\Tracker\Providers\TrackerServiceProvider"
```

Install the database tables:

```php
php artisan migrate
```
 
Create a listener for new visitors in your project: 

```bash
php artisan make:listener NewVisitorListener
```

In <code>App\Providers\EventServiceProvider</code> and update the <code>$listen</code> array with:

```php
    protected $listen = [
        // --
        \Redbox\Tracker\Events\NewVisitorEvent::class => [
            \App\Listeners\NewVisitorListener::class,
        ]
        // --
    ];
```

In <code>App\Listeners\NewVisitorListener</code> you now have access to the visitor data from <code>$event->visitor</code>.


```php
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        dd($event->visitor);
    }
```

## Documentation

For more detailed information about how to use this package, I would like to send you to the [project wiki](https://github.com/johnnymast/redbox-tracker/wiki).

## Disclaimer

This project is inspired by [Laravel Visitor Tracker](https://github.com/voerro/laravel-visitor-tracker). I created this version of this software because I need that functionality for a project of my own. 
This means I want all my dependencies for that projects 'Inhouse'.


## Author

This package is created and maintained by [Johnny Mast](mailto:mastjohnny@gmail.com). For feature requests or suggestions you could consider sending me an e-mail.

## Enjoy

Oh and if you've come down this far, you might as well [follow me](https://twitter.com/mastjohnny) on Twitter. If you like this software please consider giving it a start rating on GitHub.
 

## License
 
MIT License

Copyright (c) 2020 Johnny Mast

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

  
  
