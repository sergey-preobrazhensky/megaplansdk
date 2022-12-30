<?php

$dealId = 32;
$url = '/api/v3/deal/'.$dealId;
$params = [
    'contentType' => 'Deal',
    'description' => 'Новое описание',
    // ...
    // Расширенное поле
    // 'Category130CustomFieldStepenVipolneniya' => 10
];
$response = $request->post($url, $params);
$data = $response->getData();

if ($deal = $data->data) {
    $logger->info('id', $deal->id);
    $logger->info('Статус', $deal->state);
    $logger->info('Клиент', $deal->contractor);
    $logger->info('Менеджер', $deal->manager);
    $logger->info('Описание', $deal->description);
    $logger->info('Цена', $deal->price);
    $logger->info('Позиции сделки', $deal->positions);
}
