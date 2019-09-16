<?php

namespace App\Http\Controllers;

use App\Http\Requests\Currency\ExchangeRequest;
use Orkhanahmadov\LaravelCurrencylayer\Contracts\CurrencyService;

class CurrencyExchangeController
{
    /**
     * @var CurrencyService
     */
    private $currencyService;

    /**
     * CurrencyExchangeController constructor.
     *
     * @param CurrencyService $currencyService
     */
    public function __construct(CurrencyService $currencyService)
    {
        $this->currencyService = $currencyService;
    }

    /**
     * @param ExchangeRequest $request
     *
     * @return array|float
     */
    public function __invoke(ExchangeRequest $request)
    {
        if ($date = $request->input('date')) {
            return $this->currencyService->rate('USD', $date, 'EUR', 'CHF');
        }

        return $this->currencyService->live('USD', 'EUR', 'CHF');
    }
}
