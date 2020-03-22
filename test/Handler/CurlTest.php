<?php
namespace TotalVoice\Handler;

use PHPUnit\Framework\TestCase;
use TotalVoice\ClientException;

class CurlTest extends TestCase
{
    /**
     * @var Curl
     */
    private $curl;
    
    protected function setUp()
    {
        $this->curl = new Curl();
    }

    /**
     * @test
     */
    public function serializeMethodShouldReturnExceptionCaseNotArray()
    {
        $this->expectException(ClientException::class);
        $this->curl->serialize('');
    }

    /**
     * @test
     */
    public function serializeShouldReturnStringJSON()
    {
        $return = $this->curl->serialize(['id' => '1']);
        $this->assertEquals('{"id":"1"}', $return);
    }
}