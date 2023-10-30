<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class UpdateCryptoData extends Command
{
    protected $signature = 'crypto:update';
    protected $description = 'Fetch and update cryptocurrency data';

    public function handle()
    {
        $url = 'https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&ids=btc%2Ceth&category=tokenized-stock&order=market_cap_desc&per_page=100&page=1&sparkline=false&price_change_percentage=1hr&locale=en';

        $response = Http::get($url);
        $data = $response->json();

        if (isset($data['status']['error_code']) && $data['status']['error_code'] == 429) {
            logger(json_encode($data));
        } else {
            file_put_contents(public_path('crypto.json'), json_encode($data));
            logger(json_encode($data));
            $this->info('Cryptocurrency data has been updated.');
        }
    }
}
