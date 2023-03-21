<?php

namespace App\Console\Commands;

use App\Library\Services\Currency\Enum\Currency;
use App\Library\Services\CurrencyAdapter\CurrencyService;
use App\Models\Currency as CurrencyModel;
use Illuminate\Console\Command;

class UpdateCurrenciesAdapterCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'currencies:sync:adapter';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update currencies from services.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        foreach (Currency::ALLOWED_CURRENCIES as $currency) {
            $amount = (new CurrencyService())->getMinAmount($currency);
            CurrencyModel::updateOrCreate([
                'currency' => $currency->name
            ], [
                'amount' => $amount
            ]);
            $this->info($currency->name . " currency updated.");
        }
        $this->info("all currencies updated");

        return 0;
    }
}
