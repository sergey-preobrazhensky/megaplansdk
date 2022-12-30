<?php

$url = '/api/v3/deal';
$params = [
    'filter' => [
       'contentType' => 'TradeFilter',
       'id' => null,
       'config' => [
           'contentType' => 'FilterConfig',
           'termGroup' => [
               'contentType' => 'FilterTermGroup',
               'join' => 'and',
               'terms' => [
                    // Примеры условий фильтрации:
                    // Фильтр по менеджеру
                   [
                       'contentType' => 'FilterTermRef',
                       'field' => 'manager',
                       'comparison' => 'equals',
                       'value' => [[
                           'id' => '1000003',
                           'contentType' => 'Employee',
                       ]],
                   ],
                   // Фильтр по статусу
                   /* [
                       'contentType' => 'FilterTermRef',
                       'field' => 'state',
                       'comparison' => 'equals',
                       'value' => [[
                            'contentType' => 'ProgramState',
                            'id' => 12,
                       ]]
                   ],*/
                   // ...
                   // Фильтр по расширенному полю, нужно передавать соответсвующую схему сделки в параметре program
                   /*[
                       'contentType' => 'FilterTermNumber',
                       'field' => 'Category1000053CustomFieldChislo',
                       'comparison' => 'equals',
                       'value' => 1
                   ]*/
               ],
           ],
       ],
        // Схема сделок
       'program' => [
           // Все схемы
           'id' => 'all',
           'contentType' => 'Program',
       ],
    ],
   // Отдавать только запрашиваемые поля
   'onlyRequestedFields' => true,
    // Запрашиваемые поля
   'fields' => [
       'number',
       'description',
       'state',
       'contractor',
       'manager',
       'description',
       'price',
       'cost',
       'positions',
       'timeUpdated',
       // ...
       // расширенное полей
       // 'Category1000053CustomFieldChislo',
   ],
   'sortBy' => [[
       'contentType' => 'SortField',
       'fieldName' => 'timeUpdated',
       'desc' => true,
   ]],
   'limit' => 10,
   // Последней объект из предыдущего результата для последовательной загрузки
   /*'pageAfter' => [
       'id' => '123456',
       'contentType' => 'deal'
   ]*/
];
$response = $request->get($url, $params);
$data = $response->getData();

$logger->info(
    'общее количество',
    $data->meta->pagination->count
);
$logger->info(
    'Признак того, что еще есть незагруженные объекты',
    $data->meta->pagination->hasMoreNext
);

$logger->info('Все данные', $data);

foreach ($data->data as $deal) {
    $logger->info('id', $deal->id);
    $logger->info('Номер', $deal->number);
    $logger->info('Статус', $deal->state);

    // поля могут не передаваться, если скрыты в настройках
    $logger->info('Клиент', $deal->contractor ?? 'скрыто');
    $logger->info('Менеджер', $deal->manager ?? 'скрыто');
    $logger->info('Сумма', $deal->price ?? 'скрыто');
    $logger->info('Позиции сделки', $deal->positions ?? 'скрыто');
}
