# Mlify


[![License](https://poser.pugx.org/rebing/graphql-laravel/license)](https://packagist.org/packages/rebing/graphql-laravel)

A lightweight package for sending notifications to Firebase


## Installation:

#### Require the package via Composer:
```bash
composer require imanborumand/mlify
```

#### Publish config:
```bash
php artisan vendor:publish --tag=mlify-config
```

#### Set Your Firebase Authentication Key [important]
+ go to config directory
+ in mlify.php set auth_key to your firebase Auth key




## Usage

```php
Mlify::setParams(
      'this is title',
      'this is body', 
      ['post_id' => 1, 'index_img' => 'http://yourapp.com/custom.jpg']
    )->sendTo(['user token or list of tokens ']);
```

description:

setParams method:
`set title, body and custom data`

sendTo method: 
`This method has an input argument, which is a list of users' Firebase tokens to which you want to send a notification. This list can contain one or more tokens`




