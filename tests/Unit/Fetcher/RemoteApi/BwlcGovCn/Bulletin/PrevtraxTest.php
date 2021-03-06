<?php

namespace Tests\Unit\Fetcher\RemoteApi\BwlcGovCn\Bulletin;

use GyTreasure\Fetcher\RemoteApi\BwlcGovCn\Bulletin\Prevtrax;
use GyTreasure\Fetcher\RemoteApi\BwlcGovCn\HtmlRequest;
use Mockery;
use PHPUnit\Framework\TestCase;

class PrevtraxTest extends TestCase
{
    /**
     * @var \Mockery\MockInterface|\GyTreasure\Fetcher\RemoteApi\BwlcGovCn\HtmlRequest
     */
    protected $htmlRequestMock;

    /**
     * @var \GyTreasure\Fetcher\RemoteApi\BwlcGovCn\Bulletin\Prevtrax
     */
    protected $prevtrax;

    protected function setUp()
    {
        parent::setUp();

        $this->htmlRequestMock  = Mockery::mock(HtmlRequest::class);

        $this->prevtrax         = new Prevtrax($this->htmlRequestMock);
    }

    protected function tearDown()
    {
        Mockery::close();

        parent::tearDown();
    }

    public function testCall()
    {
        $expects = [[
            'issue' => '627923',
            'winningNumbers' => ['03','04','10','05','08','09','01','07','06','02'],
        ]];

        $num   = '627923';
        $dates = '2017-07-10';
        $page  = 1;

        $this->htmlRequestMock
            ->shouldReceive('call')
            ->once()
            ->with('bulletin/prevtrax.html', compact('num', 'dates', 'page'))
            ->andReturn($this->_html());

        $returnArray = $this->prevtrax->call($num, $dates);

        $this->assertEquals($expects, $returnArray);
    }

    private function _html()
    {
        return '<table class="tb" width="100%">
						<tr>
							<th width="20%">期号</th>
							<th width="50%">开奖号码</th>
							<th width="30%">开奖公告</th>
						</tr>
						<tr class="">
								<td>627923</td>
								<td>03,04,10,05,08,09,01,07,06,02</td>
								<td>2017-07-10 11:07</td>
						</tr>
				</table>';
    }
}
