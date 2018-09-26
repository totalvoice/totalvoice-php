<?php
namespace TotalVoice\Api;

use TotalVoice\ClientInterface;

abstract class Api
{
    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * Service constructor.
     * @param ClientInterface $client
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    abstract public function getRota();
}