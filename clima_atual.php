<?php

require __DIR__. '/vendor/autoload.php';

use App\WebService\OpenWeatherMap;

$obOpenWeatherMap = new OpenWeatherMap("fcaa1e5f78714689a420a4502be16fa9");

$cidade = 'São Paulo';
$uf     = 'SP';

$dadosClima = $obOpenWeatherMap->consultarClimaAtual($cidade,$uf);
echo '<pre>';
print_r($dadosClima);
echo '</pre>';
exit;

//RETORNO
echo 'Cidade: ' .$cidade.'/'.$uf . PHP_EOL;

echo 'Temperatura: ' .($dadosClima['main']['temp'] ?? 'Desconhecido') . PHP_EOL;

echo 'Sensação Térmica: ' .($dadosClima['main']['feels_like'] ?? 'Desconhecido') . PHP_EOL;

echo 'Clima: ' .($dadosClima['weather'][0]['description'] ?? 'Desconhecido') . PHP_EOL;