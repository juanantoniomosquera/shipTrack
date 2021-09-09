<?php

namespace App\Constant;

/**
 * Constant
 */
class Constant
{
    //const MQTT_URL = 'broker.mqttdashboard.com';
    const MQTT_URL = 'broker.hivemq.com';
    const MQTT_PORT = 1883;
    const MQTT_CLIENTID_PUBLISH = 'test-publish-syntelix';
    const MQTT_CLIENTID_SUBSCRIBE = 'test-subscribe-syntelix';
    const MQTT_TOPIC_SYNTELIX = 'topic/syntelix/test';
}
