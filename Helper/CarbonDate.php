<?php

namespace Nicosomb\WallabagCarbondateBundle\Helper;

use Psr\Log\LoggerInterface;
use GuzzleHttp\Client;

class CarbonDate
{
    private $server;
    private $client;
    private $logger;

    public function __construct($server, Client $client, LoggerInterface $logger)
    {
        $this->server = $server;
        $this->client = $client;
        $this->logger = $logger;
    }

    /**
     * Fetch CarbonDate to retrieve creation date.
     *
     * @param string $url URL of the entry
     *
     * @return \DateTime
     */
    public function fetchDate($url)
    {
        $response = $this->client->get($this->server.'/cd?url='.$url);
        $body = $response->getBody();
        $content = json_decode($body->getContents());

        $creationDate = $content->{'Estimated Creation Date'};

        if ('' === $creationDate) {
            return null;
        }

        $date = new \DateTime();
        $date->setTimestamp(strtotime($creationDate));

        return $date;
    }
}
