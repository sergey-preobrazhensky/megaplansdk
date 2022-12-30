<?php

$responsibleId = 1000003;
$programId = 5;

$url = '/api/v3/deal/';
$params = [
    'contentType' => 'Deal',
    // Схема сделки
    'program' => [
        'contentType' => 'Program',
        'id' => $programId,
    ],
    'manager' => [
        'contentType' => 'Employee',
        'id' => $responsibleId,
    ],
    'description' => 'Описание',
    // ...
    // Расширенное поле
    // 'Category130CustomFieldStepenVipolneniya' => 10
];
$response = $request->post($url, $params);
$data = $response->getData();

if ($deal = $data->data) {
    $logger->info('Id созданной сделки', $deal->id);
    $logger->info('Номер созданной сделки', $deal->number);
}
