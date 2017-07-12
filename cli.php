#!/usr/bin/env php
<?php

require_once './vendor/autoload.php';

$isWin = (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN');

// 若是 Windows系统, 使用 UTF-8 编码
($isWin) && system('chcp 65001');

$process = GyTreasure\ApiFacades\RemoteApi\TrendCaipiao163Com\DrawNumbers::forge();

$data = $process->drawRangeIssues('ssc', '170711001', '170711120');

print_r($data);
