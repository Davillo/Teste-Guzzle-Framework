<?php
require 'vendor/autoload.php';

use Goutte\Client;
use GuzzleHttp\Client as GuzzleClient;

$goutteClient = new Client();
$guzzleClient = new GuzzleClient(array(
    'timeout' => 60,
));
$goutteClient->setClient($guzzleClient);

$crawler = $goutteClient->request('GET', 'http://www.guiatrabalhista.com.br/guia/salario_minimo.htm');

$table = $crawler->filter('table')->filter('tr')->each(function ($tr, $i) {
    return $tr->filter('td')->each(function ($td, $i) {
        return trim($td->text());
    });
});

print_r($table);

