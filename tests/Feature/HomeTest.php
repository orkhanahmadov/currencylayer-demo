<?php

namespace Tests\Feature;

use Illuminate\Http\Response;
use Tests\TestCase;

class HomeTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testResponse()
    {
        $response = $this->get('/');

        $response->assertStatus(Response::HTTP_OK);
    }
}
