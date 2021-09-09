<?php

namespace App\Service\Util;

use Psr\Log\LoggerInterface;
use Symfony\Component\HttpClient\HttpClient;
use Exception;

/**
 * Class Util
 * @package App\Service\Util
 */
class Util
{
    /**
     * @var LoggerInterface $logger
     */
    protected $logger;

    /**
     * llamadaPost
     *
     * @param  mixed $servicio
     * @param  mixed $parametros
     * @return void
     */
    public function llamadaPost($servicio, $parametros, $respuesta = 'array')
    {
        $resultado = null;
        try {
            $client = HttpClient::create(['verify_peer' => false]);
            $response = $client->request('POST', $servicio, $parametros);

            $resultado['statusCode'] = $response->getStatusCode();
            $resultado['headers'] = $response->getHeaders();

            if ($respuesta == 'array') {
                $resultado['resultado'] = $response->toArray();
            } else if ($respuesta == 'raw') {
                $resultado['resultado'] = $response->getContent(false);
            }
        } catch (Exception $ex) {
            $this->logger->error('[UTIL] Error en llamada POST: ' . $ex->getMessage());
        }

        return $resultado;
    }

    /**
     * llamadaGet
     *
     * @param  mixed $servicio
     * @param  mixed $parametros
     * @return void
     */
    public function llamadaGet($servicio, $parametros, $respuesta = 'array')
    {
        $resultado = null;

        try {
            $client = HttpClient::create(['verify_peer' => false]);
            $response = $client->request('GET', $servicio, $parametros);
            $resultado['statusCode'] = $response->getStatusCode();
            $resultado['headers'] = $response->getHeaders();

            if ($respuesta == 'array') {
                $resultado['resultado'] = $response->toArray();
            } else if ($respuesta == 'raw') {
                $resultado['resultado'] = $response->getContent(false);
            }
        } catch (Exception $ex) {
            $this->logger->error('[UTIL] Error en llamada GET: ' . $ex->getMessage());
        }

        return $resultado;
    }

    /**
     * @required
     * @param LoggerInterface $logger
     */
    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }
}
