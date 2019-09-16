<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Orkhanahmadov\LaravelCurrencylayer\Contracts\CurrencyService;
use Tests\FakeCurrencyService;
use Tests\TestCase;

class CurrencyExchangeTest extends TestCase
{
    use RefreshDatabase;

    public function testLiveCurrencyRates()
    {
        $this->withoutExceptionHandling();
        $this->app->instance(
            CurrencyService::class,
            new FakeCurrencyService($data = ['EUR' => 1.2345, 'CHF' => 0.22223])
        );

        $response = $this->getJson('currencies/exchange');

        $response->assertStatus(Response::HTTP_OK);
        $response->assertExactJson($data);
    }

    public function testRatesWithDate()
    {
        $this->withoutExceptionHandling();
        $this->app->instance(
            CurrencyService::class,
            new FakeCurrencyService($data = ['EUR' => 22.333, 'CHF' => 4.5222])
        );

        $response = $this->getJson('currencies/exchange?date=2019-02-20');

        $response->assertStatus(Response::HTTP_OK);
        $response->assertExactJson($data);
    }

    /**
     * @dataProvider validationProvider
     * @param string $input
     */
    public function testValidation(string $input)
    {
        $response = $this->getJson('currencies/exchange?' . $input);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function validationProvider()
    {
        return [
            ['date=abc'],
            ['date=10.02.2019'],
            ['date='. today()->addDay()->format('Y-m-d')],
        ];
    }
}
