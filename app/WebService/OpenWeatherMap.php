<?php

namespace App\WebService;

class OpenWeatherMap 
{
    /**
     * URL base das APIs
     * @var string
     */
    const BASE_URL = 'https://api.openweathermap.org';

    /**
     * Chave de acesso da API
     * @var string
     */
    private $apiKey;

    /**
     * Método responsável por construir a classe definindo a chave da API
     * @param string $apiKey
     */
    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * Método responsável por obter o clima atual de uma cidade
     * @param string $cidade
     * @param string $uf
     * @return array
     */
    public function consultarClimaAtual($cidade,$uf)
    {
        return $this->get('/data/2.5/weather', [
            'q' => $cidade.',BR-'.$uf.',BRA'
        ]);
    }

    /**
     * Método responsável por executar a consulta via GET na API
     * @param string
     * @param array
     * @return array
     */
    private function get($resource,$params = [])
    {
        //PARÂMETROS PARA CONSULTA
        $params['units'] = 'metric';
        $params['lang']  = 'pt_br';
        $params['appid'] = $this->apiKey;

        //ENDPOINT
        $endPoint = self::BASE_URL.$resource.'?'.http_build_query($params);

        //INICIA O CURL
        $curl = curl_init();

        //CONFIGURAÇÕES DO CURL
        curl_setopt_array($curl,[
            CURLOPT_URL            => $endPoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST  => 'GET'
        ]);

        //RESPONSE
        $response = curl_exec($curl);

        //FECHA A CONEXÃO DO CURL
        curl_close($curl);

        return json_decode($response, true);
    }
}