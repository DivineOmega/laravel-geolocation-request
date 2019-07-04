<?php

namespace DivineOmega\LaravelGeolocationRequest\Http\Requests;

use DivineOmega\LaravelGeolocationRequest\Traits\GeolocatableRequest;
use Illuminate\Http\Request;

class GeolocationRequest extends Request
{
    use GeolocatableRequest;
}