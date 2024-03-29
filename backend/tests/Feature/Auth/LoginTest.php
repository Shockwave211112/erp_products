<?php

namespace Tests\Feature\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Tests\TestCase;

class LoginTest extends TestCase
{
    protected $method = Request::METHOD_POST;
    protected string $uri = '/api/auth/login';

    public function testShouldResponseWithHttpOk()
    {
        $this->defaultTest(
            $this->method,
            $this->uri,
            data: [
                'email' => config('products.email'),
                'password' => config('products.user_pwd'),
            ],
            needAuth: false,
        )->assertJsonStructure(['token']);
    }

    public function testShouldResponseWithHttpUnprocessableIfNoParams()
    {
        $this->defaultTest(
            $this->method,
            $this->uri,
            Response::HTTP_UNPROCESSABLE_ENTITY,
            needAuth: false,
        );
    }

    public function testShouldResponseWithHttpUnprocessableIfInvalidParams()
    {
        $this->defaultTest(
            $this->method,
            $this->uri,
            Response::HTTP_UNPROCESSABLE_ENTITY,
            data: [
                'email' => 'fsafas.com',
                'password' => '222',
            ],
            needAuth: false,
        );
    }

    public function testShouldResponseWithHttpForbiddenIfWrongPassword()
    {
        $this->defaultTest(
            $this->method,
            $this->uri,
            Response::HTTP_FORBIDDEN,
            data: [
                'email' => config('products.email'),
                'password' => '22222222',
            ],
            needAuth: false,
        );
    }
}
