<?php

return [
    'type'      => 'ssc',
    'is_owner'  => true,
    'issuerule' => 'Ymd-[n4]|0,1,0',
    'issueset'  => [
        [
            'starttime'     => '00:00:00',
            'firstendtime'  => '00:01:00',
            'endtime'       => '04:59:00',
            'cycle'         => 60,
            'endsale'       => 0,
            'inputcodetime' => 0,
            'droptime'      => 0,
            'status'        => 1,
            'sort'          => 0,
        ], [
            'starttime'     => '07:00:00',
            'firstendtime'  => '07:01:00',
            'endtime'       => '00:00:00',
            'cycle'         => 60,
            'endsale'       => 0,
            'inputcodetime' => 0,
            'droptime'      => 0,
            'status'        => 1,
            'sort'          => 1,
        ],
    ],
];
