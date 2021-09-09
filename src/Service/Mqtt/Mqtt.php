<?php

namespace App\Service\Mqtt;

use Psr\Log\LoggerInterface;
use Symfony\Component\HttpClient\HttpClient;
use Exception;
use PhpMqtt\Client\Exceptions\MqttClientException;
use PhpMqtt\Client\MqttClient;
use App\Service\Relacional\Relacional;
use App\Constant\Constant;

/**
 * Class Mqtt
 * @package App\Service\Mqtt
 */
class Mqtt
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var Relacional
     */
    private $relacionalService;

    /**
     * @param LoggerInterface $logger
     * @param Relacional $relacionalService
     */
    public function __construct(LoggerInterface $logger, Relacional $relacionalService)
    {
        $this->logger = $logger;
        $this->relacionalService = $relacionalService;
    }

    /**
     * @return void
     */
    public function publishMessage(string $message)
    {
        try {
            $mqtt = new MqttClient(Constant::MQTT_URL, Constant::MQTT_PORT, Constant::MQTT_CLIENTID_PUBLISH);
            $mqtt->connect();
            $mqtt->publish(Constant::MQTT_TOPIC_SYNTELIX, $message, MqttClient::QOS_AT_MOST_ONCE);
            $mqtt->disconnect();
        } catch (MqttClientException $e) {
            $this->logger->error('Error MqttClient: ' . $e->getMessage());
        }
    }

    /**
     * @return void
     */
    public function subscribe()
    {
        try {
            $mqtt = new MqttClient(Constant::MQTT_URL, Constant::MQTT_PORT, Constant::MQTT_CLIENTID_SUBSCRIBE);
            $mqtt->connect();
            $mqtt->subscribe(Constant::MQTT_TOPIC_SYNTELIX, function ($topic, $message) {
                $this->relacionalService->persistTrack(json_decode($message, true));
            }, MqttClient::QOS_AT_MOST_ONCE);
            $mqtt->loop(true);
            $mqtt->disconnect();
        } catch (MqttClientException $e) {
            $this->logger->error('Error MqttClient: ' . $e->getMessage());
        }
    }
}
