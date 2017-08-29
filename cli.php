#!/usr/bin/env php
<?php

require_once './vendor/autoload.php';

$isWin = (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN');

// 若是 Windows系统, 使用 UTF-8 编码
($isWin) && system('chcp 65001');

$process = GyTreasure\ApiFacades\RemoteApi\Api1680210Com\DrawNumbers::forge();

$data = $process->drawDateGroupIssues('10001', new \Carbon\Carbon());

print_r($data);
