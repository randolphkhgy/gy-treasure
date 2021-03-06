<?php

namespace Tests\Unit\Fetcher\RemoteApi\Api1680210Com;

use Mockery;
use PHPUnit\Framework\TestCase;

use GyTreasure\Fetcher\Request;
use GyTreasure\Fetcher\RemoteApi\Api1680210Com\ApiRequest;
use GyTreasure\Fetcher\RemoteApi\Api1680210Com\ApiResponse;

class ApiRequestTest extends TestCase
{
    /**
     * @var \Mockery\MockInterface
     */
    protected $requestMock;

    /**
     * @var \GyTreasure\Fetcher\RemoteApi\Api1680210Com\ApiRequest
     */
    protected $apiRequest;

    public function setUp()
    {
        parent::setUp();

        $this->requestMock = Mockery::mock(Request::class);

        $this->apiRequest = new ApiRequest($this->requestMock);
    }

    public function tearDown()
    {
        Mockery::close();

        parent::tearDown();
    }

    public function testCall()
    {
        $path     = 'test/api.do';
        $message  = '执行成功';
        $data     = ['test' => 'Hello World!'];
        $response = json_encode(['errorCode' => 0, 'message' => $message, 'result' => $data]);

        $this->requestMock
            ->shouldReceive('get')
            ->with($this->apiRequest->apiUrl($path))
            ->once()
            ->andReturn($response);

        $returnValue = $this->apiRequest->call($path);

        $this->assertTrue((new ApiResponse($message, $data))->equals($returnValue));
    }

    /**
     * @expectedException \GyTreasure\Fetcher\RemoteApi\Exceptions\ApiUnreachableException
     */
    public function testApiUnreachableException()
    {
        $this->requestMock
            ->shouldReceive('get')
            ->once()
            ->andReturnNull();

        $this->apiRequest->call('test/api.do');
    }

    public function testParseResponse()
    {
        $data = [
            'test' => 'abc',
            'def'  => 'ha',
        ];

        $message  = '执行成功。';
        $response = json_encode([
            'errorCode' => 0,
            'message'   => $message,
            'result'    => $data
        ]);

        $returnValue = $this->apiRequest->parseResponse($response);

        $this->assertTrue((new ApiResponse($message, $data))->equals($returnValue));
    }

    /**
     * @expectedException \GyTreasure\Fetcher\RemoteApi\Exceptions\ApiParseException
     */
    public function testApiParseExceptionNull()
    {
        $response = null;
        $this->apiRequest->parseResponse($response);
    }

    /**
     * @expectedException \GyTreasure\Fetcher\RemoteApi\Exceptions\ApiParseException
     */
    public function testApiParseExceptionFalse()
    {
        $response = false;
        $this->apiRequest->parseResponse($response);
    }

    /**
     * @expectedException \GyTreasure\Fetcher\RemoteApi\Exceptions\ApiParseException
     */
    public function testApiParseExceptionEmptyArray()
    {
        $response = json_encode([]);
        $this->apiRequest->parseResponse($response);
    }

    /**
     * @expectedException \GyTreasure\Fetcher\RemoteApi\Exceptions\ApiErrorException
     * @expectedExceptionCode -1
     * @expectedExceptionMessage 测试错误讯息
     */
    public function testApiErrorException()
    {
        $response = json_encode(['errorCode' => -1, 'message' => '测试错误讯息', 'result' => []]);
        $this->apiRequest->parseResponse($response);
    }
}