<p align="center"><a href="https://github.com/tombenevides" target="_blank"><img src="https://banners.beyondco.de/Metavel.png?theme=light&packageManager=composer+require&packageName=tombenevides%2Fmetavel&pattern=architect&style=style_1&description=Simple+way+to+integrate+Metabase+with+Laravel&md=1&showWatermark=0&fontSize=100px&images=chart-pie" width="650"></a></p>

<p align="center">
  <a href="https://github.com/tombenevides/metavel/actions"><img alt="Total Downloads" src="https://github.com/tombenevides/metavel/actions/workflows/tests.yml/badge.svg?branch=main"></a>
  <a href="https://github.com/tombenevides/metavel/issues"><img alt="Issues Open" src="https://img.shields.io/github/issues/tombenevides/metavel"></a>
  <a href="https://packagist.org/packages/tombenevides/metavelr"><img alt="Total Downloads" src="https://img.shields.io/packagist/dt/tombenevides/metavel"></a>
  <a href="https://packagist.org/packages/tombenevides/metavel"><img alt="Latest Version" src="https://img.shields.io/packagist/v/tombenevides/metavel"></a>
  <a href="https://packagist.org/packages/tombenevides/metavel"><img alt="License" src="https://img.shields.io/packagist/l/tombenevides/metavel"></a>
</p>

---

Metabase is an open source business intelligence platform where you can create charts/grids (known as questions) or a collection of questions (known as dashboards) as a custom visualization for your data. One of Metabase's features is embedding. Therefore, this package provides blade components that abstract the platform integration, allowing you to easily embed your question/dashboard in a Laravel application.

## REQUIREMENTS
> **[PHP 8.1+](https://www.php.net/releases/)**
>
> **[Laravel 10](https://github.com/laravel/laravel)**


## HOW TO INSTALL

To install the package, just use [composer](https://getcomposer.org):

```bash
composer require tombenevides/metavel
```

## HOW TO USE

### Configuring Metabase credentials

After installing, publish your config file using:

```bash
php artisan vendor:publish --tag=metavel-config
```

This will create a `metavel.php` file in your config folder. There, you'll see the environment variables to set the Metabase's base url and secret key.

```env
METAVEL_BASE_URL #Metabase base url
METAVEL_SECRET_KEY #Metabase secret key
```

You will also find in the config file a *expiration_time* option. Since the communication between Laravel and Metabase works with JWT, using this option you can set an exp date for you generated token. The value is in seconds using NumericDate format. 

### Call the component

After setting the platform credentials, you just need to call the match component in your blade file. There's two components, one for questions and other for dahsboards:

```blade
<body>
  <x-metavel-question :resource=89 />
  
  <x-metavel-dashboard :resource=10 />
</body>
```

The components have some properties that you can set to customize the embbeding. Most of them are optional, except for **resource**, which is the ID of the element on Metabase (question or dashboard). Besides that, you can also set:

| Property  | Type    | default value | Description                                      |
|-----------|---------|---------------|--------------------------------------------------|
| params    | array   | [ ]           | if your question/dashboard have implicit filters |
| bordered  | boolean | true          | to load (or not) borders in the element          |
| titled    | boolean | true          | to load (or not) the element original title      |
| darkTheme | boolean | false         | to load (or not) the element with dark theme     |
| width     | int     | 1366          | set the width of the element                     |
| height    | int     | 768           | set the height of the element                    |

### Styling

As a blade component, you can add HTML attributes as classes for styling, for example. The Metabase element is loaded in an iframe but it's encapsulated by a div that receives the attributes, as shown below::

```php
<body>
  <x-metavel-question :resource=89 class="w-full" />
</body>
```

This will generate:

```html
<div class="w-full">
   <iframe....
</div>
```

## LICENSE

**Metavel** is a software under the [MIT License](LICENSE)

## UPDATES

👋 Follow the author [@devatreides](https://twitter.com/devatreides) on Twitter to know more about the last updates and other projects. Say Hi!
