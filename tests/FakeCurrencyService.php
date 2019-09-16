<?php

namespace Tests;

use Orkhanahmadov\LaravelCurrencylayer\Contracts\CurrencyService;

class FakeCurrencyService implements CurrencyService
{
    /**
     * @var array
     */
    private $data;

    /**
     * FakeCurrencylayer constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function live($source, ...$currencies): array
    {
        return $this->data;
    }

    public function rate($source, $date, ...$currencies): array
    {
        return $this->data;
    }
}
