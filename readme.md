# Laravel Api Action

This package simplifies creating api (json) endpoints for your laravel application by reducing routing, authorization, validation and controller logic to a single class.

```php
class UserReadAction extends ActionController
{
    public function method(): string 
    {
        return 'GET';
    }

    public function uri(): string 
    {
        return '/users/{user}';
    }

    public function allow(Request $request): bool 
    {
        return true;
    }

    public function rules(Request $request): array 
    {
        return [];
    }

    public function handle(User $user): User
    {
        return $user;
    }
}
```

This will action will
- register a GET-Route for `/users/{user}`
- authorizes request
- validates request
- handle logic

## Installation

Via Composer

``` bash
$ composer require kaydomrose/laravel-api-action
```

## Usage

First, create an action via artisan command.  

```bash
$ php artisan make:action MyAction
```

This creates a new class `app/Http/Actions/MyAction.php`.  

Next, register your action in your `routes/api.php`

```php
LaravelApiAction::routes([
    MyAction::class,
]);
```

Done!

## Documentation

### Routing (required)

```php
public function method(): string {
    return 'GET';
}

public function uri(): string {
    return '/users/{user}';
}
```
Specify http verb and uri for your action.  
See [https://laravel.com/docs/master/routing#available-router-methods](https://laravel.com/docs/master/routing#available-router-methods) for available verbs.

Above example will be translated to
```php
Route::get('/users/{user}', /* ... */);
```

### Authorization (required)

```php
    public function allow(Request $request): bool 
    {
        return true;
    }
```

Check whether the current request is authorized or not.  
Works just like [form request authorization](https://laravel.com/docs/8.x/validation#authorizing-form-requests).

### Validation (required)

```php
    public function rules(Request $request): array 
    {
        return [];
    }
```

Specify rules for request validation as seen in [form builder validation](https://laravel.com/docs/8.x/validation#creating-form-requests).

### Handle (required)
```php
    public function handle() {
        /* Your logic */
    }
```

This is where you put your action logic, just like you would normally do in your controller.  
Also supports [dependency injection](https://laravel.com/docs/8.x/controllers#dependency-injection-and-controllers) and [route model binding](https://laravel.com/docs/8.x/routing#route-model-binding).

Your return value will be wrapped with `response()->json()`, so don't wrap it yourself.  
Just return raw data.

### Customize http status (optional)

```php
    public function responseStatusCode(): int {
        return 200;
    }
```

Customize response status code.  
Default is `200`.

### Customize validation messages (optional) 

```php
    public function validationMessages(): array {
        return [];
    }
```

Customize [validation error messages](https://laravel.com/docs/8.x/validation#customizing-the-error-messages).  
Default is `[]`.

## Change log

Please see the [changelog](changelog.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```
