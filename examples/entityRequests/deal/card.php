<?php

$dealId = 32;
$url = '/api/v3/deal/'.$dealId;
$params = [
   'onlyRequestedFields' => true,
    // Запрашиваемые поля
   'fields' => [
       'name',
       'state',
       'contractor',
       'manager',
       'description',
       'price',
       'cost',
       'positions',
       // ...
       // 'Category130CustomFieldPrioritet' - расширенное поле
   ],
];
$response = $request->get($url, $params);
$data = $response->getData();

$logger->info('data', $data);

if ($deal = $data->data) {
    $logger->info('id', $deal->id);
    $logger->info('Статус', $deal->state);
    $logger->info('Клиент', $deal->contractor);
    $logger->info('Менеджер', $deal->manager);
    $logger->info('Описание', $deal->description);
    $logger->info('Цена', $deal->price);
    $logger->info('Позиции сделки', $deal->positions);
}
