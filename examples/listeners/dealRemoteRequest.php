<?php
/**
 * Обработка внешнего запроса из сделки/бизнес процесса
 */

use SergeyPreobrazhensky\Megaplansdk\Logger\FileLogger;

include __DIR__.'/../../vendor/autoload.php';

$logger = FileLogger::infoLogger(__DIR__. '/debug.log');

$requestContent = file_get_contents('php://input');
$decoded = json_decode($requestContent);

// Данные сделки
$dealData = $decoded->data->deal;

$logger->info('Все данные сделки', $dealData);

$logger->info('Id', $dealData->Id);
$logger->info('Описание', $dealData->Description);
$logger->info('Клиент', $dealData->Contractor);
// ...
