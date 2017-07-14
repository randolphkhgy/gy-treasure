<?php

namespace GyTreasure\Fetcher\RemoteApi\ChartCp360Cn\Kaijiang;

use GyTreasure\Fetcher\RemoteApi\ChartCp360Cn\HtmlRequest;

class Sd implements HistoryListInterface
{
    const API_PATH = 'kaijiang/sd';

    protected $htmlRequest;

    /**
     * Sd constructor.
     * @param HtmlRequest $htmlRequest
     */
    public function __construct(HtmlRequest $htmlRequest)
    {
        $this->htmlRequest = $htmlRequest;
    }

    /**
     * @return static
     */
    public static function forge()
    {
        return new static(HtmlRequest::forge());
    }

    /**
     * @param  string|null  $lotId
     * @param  string|null  $spanType
     * @param  string|null  $span
     * @return array
     */
    public function call($lotId = null, $spanType = null, $span = null)
    {
        $query  = compact('lotId', 'spanType', 'span');
        $html   = $this->htmlRequest->call(static::API_PATH, $query);

        $parser = new Type1HtmlTableParser();
        $data   = $parser->parse($html);

        return $data;
    }
}
