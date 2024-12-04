<?php

namespace Tests\Browser\Users;

use PHPUnit\Framework\TestCase as FrameworkTestCase;

class AuthenticatedTest extends FrameworkTestCase
{
    public function test_should_redirect_if_not_authenticated_to_login(): void
    {
        $page = file_get_contents('http://web/common');

        $statusCode = $http_response_header[0];
        $location = $http_response_header[10];

        $this->assertEquals('HTTP/1.1 302 Found', $statusCode);
        $this->assertEquals('Location: /login', $location);
    }

    public function test_should_allow_access_if_authenticated(): void
    {
        $opts = [
        "http" => [
        "header" => "Cookie: valid_session_cookie"
        ]
        ];
        $context = stream_context_create($opts);
        $page = file_get_contents('http://web/', false, $context);

        $statusCode = $http_response_header[0];

        $this->assertEquals('HTTP/1.1 200 OK', $statusCode);
    }
}
