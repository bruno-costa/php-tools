<?php

namespace Yq\Services;

use GuzzleHttp\RequestOptions;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

/**
 * Class Pusher
 * @package App\Services
 * @see https://firebase-php.readthedocs.io/en/latest/cloud-messaging.html
 */
class Pusher
{
    /*
     * @see https://github.com/kreait/firebase-php/blob/master/docs/cloud-messaging.rst#sending-a-fully-configured-raw-message
     */
    public function sendForTopic($topicName, $title, $body)
    {
        $firebase = $this->getFirebase();

        return $firebase->getMessaging()->send([
            'topic' => $topicName,
            'notification' => [
                'title' => $title,
                'body' => $body,
            ]
        ]);
    }

    /**
     * @return \Kreait\Firebase
     */
    public function getFirebase()
    {
        $serviceAccount = ServiceAccount::fromJsonFile(config_path("firebase-admin-sdk.json"));

        return $firebase = (new Factory)
            ->withServiceAccount($serviceAccount)
            ->create();
    }

    public function sendForDevice($deviceToken, $title, $body)
    {
        $firebase = $this->getFirebase();

        return $firebase->getMessaging()->send([
            'token' => $deviceToken,
            'notification' => [
                'title' => $title,
                'body' => $body,
            ]
        ]);
    }

    public function createTopic($name, $tokens)
    {
        $topic = $name;
        $registrationTokens = is_array($tokens) ? $tokens : [$tokens];

        $firebase = $this->getFirebase();

        return $firebase
            ->getMessaging()
            ->subscribeToTopic($topic, $registrationTokens);
    }
}
