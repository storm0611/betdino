<?php namespace App\Sport\Provider\Phoenix\Market;

use App\Sport\Provider\SportGameSnapshot;
use App\Sport\Provider\SportMarketHandler;
use App\Sport\Provider\SportMarketTranslation;

class PhoenixMarketWinner extends SportMarketHandler {

    function isHandling(string $market, string $runner): bool {
        return $market === 'Победитель' && in_array($runner, ["1", "2"]);
    }

    function isWinner(string $runner, SportGameSnapshot $snapshot): string {
        $data = $this->getData($snapshot->id());

        return (($data->match()->winner() === 'home' && $runner === '1')
            || ($data->match()->winner() === 'away' && $runner === '2')) ? $this->win() : $this->lose();
    }

    public function translation(string $market, string $runner): SportMarketTranslation {
        return (new SportMarketTranslation())->market("sport.market.winner")->runner($runner);
    }

}
