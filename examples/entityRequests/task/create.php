<?php

$responsibleId = 1000003;

$url = '/api/v3/task/';
$params = [
    'contentType' => 'Task',
    'name' => 'Название задачи',
    'responsible' => [
        'contentType' => 'Employee',
        'id' => $responsibleId,
    ],
    'subject' => 'Описание задачи',
    'isUrgent' => false,
    'isTemplate' => false,
    // Расширенное поле
    // 'Category130CustomFieldStepenVipolneniya' => 10
];
$response = $request->post($url, $params);
$data = $response->getData();

$logger->info('Созданный объект задачи', $data);
