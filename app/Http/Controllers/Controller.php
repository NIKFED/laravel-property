<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use OpenApi\Attributes\Contact;
use OpenApi\Attributes\Info;
use OpenApi\Attributes\Server;

#[Info(
    version: '1.0',
    title: 'laravel property',
    contact: new Contact(name: 'Github Repository', url: 'https://github.com/NIKFED/laravel-property')
)]
#[Server(
    url: L5_SWAGGER_CONST_LOCAL_HOST,
    description: 'Localhost server api',
)]
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
