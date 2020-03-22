<?php
namespace TotalVoice;

use PHPUnit\Framework\TestCase;

class RouteTest extends TestCase
{
    /**
     * @test
     */
    public function constructShouldConfigureTheAttributes()
    {
        $path = new Route([1, 2]);
        $this->assertAttributeSame([1,2], 'values', $path);
    }

    /**
     * @test
     */
    public function methodBuildShouldReturnPathAsString()
    {
        $path = new Route(['url', '/path']);
        $this->assertEquals('url/path', $path->build());
    }
}