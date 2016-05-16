<?php
/**
 * @author    jhrncar
 * @copyright PIXEL FEDERATION
 * @license   Internal use only
 */

namespace Druid\Tests\Driver\Guzzle;

use Druid\Driver\ConnectionConfig;
use Druid\Driver\Guzzle\Connection;
use Druid\Driver\Guzzle\Driver;

class DriverTest extends \PHPUnit_Framework_TestCase
{

    public function testConnect()
    {
        $driver = new Driver();

        $configMock = $this->getMockBuilder(ConnectionConfig::class)->disableOriginalConstructor()->getMock();
        $connection = $driver->connect($configMock);
        $this->assertInstanceOf(Connection::class, $connection);
    }

    public function testProxyConnect()
    {
        $driver = new Driver();

        $configMock = $this
            ->getMockBuilder(ConnectionConfig::class)
            ->setMethods(['getProxy'])
            ->disableOriginalConstructor()
            ->getMock();
        
        $configMock->expects($this->any())->method('getProxy')->willReturn('tcp://localhost:8080');

        $connection = $driver->connect($configMock);
        $this->assertInstanceOf(Connection::class, $connection);
    }
}
