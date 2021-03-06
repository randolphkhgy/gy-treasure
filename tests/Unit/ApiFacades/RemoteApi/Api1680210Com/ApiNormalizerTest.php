<?php

namespace Tests\Unit\ApiFacades\RemoteApi\Api1680210Com;

use GyTreasure\ApiFacades\RemoteApi\Api1680210Com\ApiNormalizer;
use PHPUnit\Framework\TestCase;

class ApiNormalizerTest extends TestCase
{
    /**
     * 重庆时时彩
     */
    public function testChongqingSsc()
    {
        $id         = '10002';
        $issue      = '20170717-001';
        $apiIssue   = '20170717001';

        $returnValue = ApiNormalizer::convertIssue($id, $issue);
        $this->assertEquals($apiIssue, $returnValue);

        $returnValue = ApiNormalizer::formatIssue($id, $apiIssue);
        $this->assertEquals($issue, $returnValue);
    }

    /**
     * 十一运夺金
     */
    public function testShiyix5()
    {
        $id         = '10008';
        $issue      = '20170711-01';
        $apiIssue   = '17071101';

        $returnValue = ApiNormalizer::convertIssue($id, $issue);
        $this->assertEquals($apiIssue, $returnValue);

        $returnValue = ApiNormalizer::formatIssue($id, $apiIssue);
        $this->assertEquals($issue, $returnValue);
    }

    /**
     * 排列3, 体彩P3
     */
    public function testPailie3()
    {
        $id         = '10043';
        $issue      = '2017001';
        $apiIssue   = '17001';

        $returnValue = ApiNormalizer::convertIssue($id, $issue);
        $this->assertEquals($apiIssue, $returnValue);

        $returnValue = ApiNormalizer::formatIssue($id, $apiIssue);
        $this->assertEquals($issue, $returnValue);
    }

    /**
     * 北京PK拾
     */
    public function testPK10()
    {
        $id         = '10001';
        $apiNumbers = ['03', '09', '10', '04', '08', '07', '06', '02', '01', '05'];
        $numbers    = ['3', '9', '10', '4', '8', '7', '6', '2', '1', '5'];

        $returnArray = ApiNormalizer::formatNumbers($id, $apiNumbers);
        $this->assertSame($numbers, $returnArray);
    }
}
