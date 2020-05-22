
 [![Phpcs tests](https://github.com/johnnymast/redbox-tracker/workflows/Phpcs/badge.svg)](https://github.com/johnnymast/redbox-tracker/actions?query=workflow%3APhpcs)

<h2 align="center">
<img src="https://user-images.githubusercontent.com/121194/82691564-6b57da80-9c5e-11ea-87ec-639ad2255e8a.png"><br />
Tracking Movement
</h2>


<p align="center">
<a href="https://github.com/johnnymast/redbox-tracker/actions?query=workflow%3APhpcs"><img src="https://github.com/johnnymast/redbox-tracker/workflows/Phpcs/badge.svg" /></a>
</p>




# Redbox-tracker
WORK IN PROGRESS!

This project is inspired by [Laravel Visitor Tracker](https://github.com/voerro/laravel-visitor-tracker). I have created my own version of this software because I need that functionality for a project of my own. This means i want all my dependenties for that
projects 'Inhouse'.


## TODO

- [ ] add $except in middleware
- [ ] publish middleware
- [ ] collect more user information
- [x] fire event for new visitors

# Getting started

## Prerequisites

We don't require much bug these are the minimum requirements. 

- Php 7.2
- Laravel 6 or higher

## Installation  

The package can be installed using composer.

```bash
composer require redbox/tracker
```

The package will automatically register itself.

Publish configuration file and public assets:

```bash
php artisan vendor:publish --provider="Redbox\Tracker\Providers\TrackerServiceProvider"
```


## Documentation



## Author

This package is created and maintained by [Johnny Mast](mailto:mastjohnny@gmail.com). For feature requests or suggestions you could consider sending me an e-mail.

## Enjoy

Oh and if you've come down this far, you might as well [follow me](https://twitter.com/mastjohnny) on twitter.
 

## License

MIT License

Copyright (c) 2020 Johnny Mast

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

  
  
