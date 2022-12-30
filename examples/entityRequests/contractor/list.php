<?php

$url = '/api/v3/contractor';
$params = [
    'filter' => [
        'contentType' => 'CrmFilter',
        'id' => null,
        'config' => [
            'contentType' => 'FilterConfig',
            'termGroup' => [
                'contentType' => 'FilterTermGroup',
                'join' => 'and',
                'terms' => [
                    // Примеры условий фильтрации:
                    // Фильтр по создателю
                    [
                       'contentType' => 'FilterTermRef',
                       'field' => 'userCreated',
                       'comparison' => 'equals',
                       'value' => [[
                           'id' => '792',
                           'contentType' => 'Employee',
                       ]],
                   ],
                    // Фильтр по ответственному
                    [
                        'contentType' => 'FilterTermRef',
                        'field' => 'responsibles',
                        'comparison' => 'equals',
                        'value' => [[
                            'id' => '1000014',
                            'contentType' => 'Employee',
                        ]],
                    ],
                    // ...
                    // Фильтр по расширенному числовому полю
                    /*[
                        'contentType' => 'FilterTermNumber',
                        'field' => 'Category183CustomFieldDdd',
                        'comparison' => 'equals',
                        'value' => 1
                    ],*/
                ],
            ],
        ],
    ],
   // Отдавать только запрашиваемые поля
   'onlyRequestedFields' => true,
    // Запрашиваемые поля
   'fields' => [
       'name',
       'type',
       'responsibles',
       'contactInfo',
       // Расширенное поле
       // Category183CustomFieldRegion
   ],
   'sortBy' => [[
       'contentType' => 'SortField',
       'fieldName' => 'name',
       'desc' => false,
   ]],
   'limit' => 10,
   // Последний объект из предыдущего результата для последовательной загрузки
   /*'pageAfter' => [
       'id' => '125320',
       'contentType' => 'contractorCompany'
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
    (bool) $data->meta->pagination->hasMoreNext
);

$logger->info('data', $data);
foreach ($data->data as $contractor) {
    $logger->info('id', $contractor->id);
    $logger->info(
        'Название',
        'ContractorHuman' === $contractor->contentType ?
            $contractor->firstName.' '.$contractor->lastName :
            $contractor->name
    );
    $logger->info('Контактная информация', $contractor->contactInfo);
    $logger->info('Ответственные', $contractor->responsibles);
}
