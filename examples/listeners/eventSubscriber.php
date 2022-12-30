<?php
/**
 * Обработка подписки на события
 */
include 'autoload.php';
$logger = new logger\ConsoleLogger(\logger\AbstractLogger::LEVEL_INFO);

$requestContent = file_get_contents('php://input');
$decoded = json_decode($requestContent);

// Тип события: on_after_update|on_after_create|on_after_drop
$event = $decoded->event;
// Данные модели
$data = $decoded->data;

$accountInfo = $decoded->accountInfo;
// UUID приложения
$integrationUuid = $accountInfo->integrationUuid;
// UUID события
$eventUuid = $accountInfo->uuid;
// Тип модели: ContractorHuman, ContractorCompany, Deal и т.п.
$modelName = $accountInfo->model;

$logger->info(
    'Данные о событии',
    [
      'Данные модели' => $data,
      'UUID приложения' => $integrationUuid,
      'UUID события' => $eventUuid,
      'Тип модели' => $modelName,
  ]
);
