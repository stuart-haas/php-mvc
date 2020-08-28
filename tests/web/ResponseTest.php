<?php

use app\web\Response;
use PHPUnit\Framework\TestCase;

final class ResponseTest extends TestCase {

    public function testWillReturnJson()
    {
        $mockData = array('foo' => 'bar');

        $mock = $this->createMock(Response::class);

        $mock->method('sendJson')
            ->with($mockData)
            ->willReturn(json_encode($mockData));
        
        $this->assertEquals(json_encode($mockData), $mock->sendJson($mockData));
    }
}