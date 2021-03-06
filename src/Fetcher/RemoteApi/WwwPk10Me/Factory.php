<?php

namespace GyTreasure\Fetcher\RemoteApi\WwwPk10Me;

use GyTreasure\Fetcher\RemoteApi\WwwPk10Me\Exceptions\ApiWrongIdException;
use GyTreasure\Fetcher\RemoteApi\WwwPk10Me\Pk10\GetData;
use GyTreasure\Fetcher\RemoteApi\WwwPk10Me\Pk10\GetHistoryData;

class Factory
{
    /**
     * @param  string  $id
     * @return \GyTreasure\Fetcher\RemoteApi\WwwPk10Me\ApiPrototype\HistoryData
     * @throws \GyTreasure\Fetcher\RemoteApi\WwwPk10Me\Exceptions\ApiWrongIdException
     */
    public function historyData($id)
    {
        switch ($id) {
            case 'pk10':
                return GetHistoryData::forge();
            default:
                throw new ApiWrongIdException('Wrong id: ' . $id);
        }
    }

    /**
     * @param  string  $id
     * @return \GyTreasure\Fetcher\RemoteApi\WwwPk10Me\ApiPrototype\ApiGetData
     * @throws \GyTreasure\Fetcher\RemoteApi\WwwPk10Me\Exceptions\ApiWrongIdException
     */
    public function apiGetData($id)
    {
        switch ($id) {
            case 'pk10':
                return GetData::forge();
            default:
                throw new ApiWrongIdException('Wrong id: ' . $id);
        }
    }
}
