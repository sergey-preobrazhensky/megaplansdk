<?php

$responsibleId = 1000003;

$url = '/api/v3/project/';
$params = [
    'contentType' => 'Project',
    'name' => 'Название нового проекта',
    'responsible' => [
        'contentType' => 'Employee',
        'id' => $responsibleId,
    ],
    'subject' => 'Описание нового проекта',
    'isTemplate' => false,
    // Расширенное поле
    // 'Category131CustomFieldStepenVipolneniya' => 10
];
$response = $request->post($url, $params);
$data = $response->getData();

$logger->info('Созданный объект задачи', $data);
