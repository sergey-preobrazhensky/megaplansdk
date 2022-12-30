<?php

$taskId = 96674;
$url = '/api/v3/task/'.$taskId;
$params = [
   'onlyRequestedFields' => true,
    // Запрашиваемые поля
   'fields' => [
       'name',
       'status',
       'deadline',
       'responsible',
       // ...
       // 'Category130CustomFieldPrioritet' - расширенное поле
   ],
];
$response = $request->get($url, $params);
$data = $response->getData();

$logger->info('data', $data);

$task = $data->data;
$logger->info('id', $task->id);
$logger->info('name', $task->name);
$logger->info('status', $task->status);
$logger->info('deadline', $task->deadline);
$logger->info('responsible_id', $task->responsible->id);
$logger->info('responsible_name', $task->responsible->name);
