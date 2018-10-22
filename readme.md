# Recaptcha

A Laravel 5.5 package for working with [reCAPTCHA](https://www.google.com/recaptcha/admin).
Enjoy!

![demo](https://i.imgur.com/EOv0cXZ.png)

## Installation

```sh
composer require ilya-sp/recaptcha
./artisan vendor:publish --provider "Ilya\Recaptcha\RecaptchaServiceProvider"
```

## Usage

First, edit the published config file `config/recaptcha.php`
(tip: use env variables to hide keys from source control).


Then, in your controller:

```php
use Ilya\Recaptcha\RecaptchaRule as Recaptcha;

// in a method...
$data = request()->validate([
    recaptcha_input() => ['required', new Recaptcha],
    // or...
    recaptcha_input() => ['required', new Recaptcha('key_pair_name')],

    // your other stuff here...
]);
```

On the client side, use `recaptcha_script()` to load the necessary JS code,
and use `recaptcha()` or `recaptcha('key_pair_name')` to render the reCAPTCHA itself.
Example:

```html
<body>
    <form method="POST" action="...">
        {{ csrf_field() }}
        {{ recaptcha() }}

        <button>Send</button>
    </form>

    {{ recaptcha_script() }}
</body>
```

Also, to make error messages more friendly, add the following code
to the `custom` section of your `validation.php`
language file (`resources/lang/en/validation.php` if assuming that you're using the `en` locale):

```php
'custom' => [
    // other stuff...

    recaptcha_input() => [
        'required' => 'Failed the reCAPTCHA test.',
    ],
],
```

## Additional Information

MIT license.
