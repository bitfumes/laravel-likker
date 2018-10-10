# Likker

[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Travis](https://img.shields.io/travis/Bitfumes/Likker.svg?style=flat-square)]()
[![Total Downloads](https://img.shields.io/packagist/dt/Bitfumes/Likker.svg?style=flat-square)](https://packagist.org/packages/bitfumes/likker)

## Introduction

This package helps you to have like system in any model. It has very simple api to like and unlike.

## Install

`composer require Bitfumes/Likker`

## Usage

### Prepare Likable Model

Use `Likable` contract and `canBeLiked` trait in your model which can be liked.

```php
use Illuminate\Database\Eloquent\Model;
use Bitfumes\Likker\Contracts\Likeable;
use Bitfumes\Likker\Traits\CanBeLiked;

class Post extends Model implements Likeable
{
    use CanBeLiked;
}
```

### Prepare Liker Model

Use `Liker` contract and `canLike` trait in your model which can like.

```php
use Illuminate\Foundation\Auth\User as Authenticatable;
use Bitfumes\Likker\Contracts\Liker;
use Bitfumes\Likker\Traits\CanLike;

class User extends Authenticatable implements Liker
{
    use CanLike;
}
```

### Methods Available

#### Likes

Like a model

```php
// Like by authenticated user
$post->likeIt();
// Like by any user
$post->likeIt($user);
```

#### UnLikes

Unlike already liked model

```php
// Remove Like by authenticated user
$post->unLikeIt();
// Like by any user
$post->unLikeIt($user);
```

#### Toggle Like

It can toggle like.

```php
// Toggle like by authenticated user
$post->toggleLike();
// Toggle like by any user
$post->toggleLike($user);
```

#### Check if Model is alread liked or not

```php
// Return boolean
$post->isLiked();
```

## Like Counts

```php
// it counts the like for given model
$post->countLikes();
```

## Testing

Run the tests with:

```bash
vendor/bin/phpunit
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security-related issues, please email sarthak@bitfumes.com instead of using the issue tracker.

## License

The MIT License (MIT). Please see [License File](/LICENSE.md) for more information.
