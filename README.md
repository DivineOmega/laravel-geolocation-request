# Laravel Geolocation Request

The Laravel Geolocation Request package provides an easy
way to geolocate requests to their country of origin, simply
by calling a `$request->country()` method.

## Installation

To install the Laravel Geolocation Request package, just
run the following Composer command.

```bash
composer require divineomega/laravel-geolocation-request
``` 

## Usage

To use geolocation enabled requests within your Laravel controller 
methods, you can replace the `use Illuminate\Http\Request` line 
at the top of your controllers, as shown in the usage example below.

```php
<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use DivineOmega\LaravelGeolocationRequest\Http\Requests\GeolocationRequest as Request;

class UserController extends Controller
{
    /**
     * Store a new user.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $user = new \App\User();
        $user->name = $request->name;
        
        // $request->country() will perform geolocation,
        // and return a detailed country object.
        
        $user->countryName = $request->country()->name;
        $user->countryCode = $request->country()->isoCodeAlpha3;
        
        $user->save();
        
        // ...
    }
}
```

If you are using custom request objects, you can
change them to extend the provided `GeolocationRequest` class.
If you unable to extend your custom request object, or 
simply do not wish to, you can add geolocation functionality
by using the provided `GeolocatableRequest` trait.