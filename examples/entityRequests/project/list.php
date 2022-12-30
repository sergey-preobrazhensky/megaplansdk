<?php

$url = '/api/v3/task';
$params = [
    'filter' => [
       'contentType' => 'TaskFilter',
       'id' => null,
       'config' => [
           'contentType' => 'FilterConfig',
           'termGroup' => [
               'contentType' => 'FilterTermGroup',
               'join' => 'and',
               'terms' => [
                   [
                       'contentType' => 'FilterTermEnum',
                       'field' => 'type',
                       'comparison' => 'equals',
                       'value' => ['project'],
                   ],
                    // Примеры условий фильтрации:
                    // Фильтр по автору
                    /*[
                       'contentType' => 'FilterTermRef',
                       'field' => 'userCreated',
                       'comparison' => 'equals',
                       'value' => [[
                           'id' => '1000003',
                           'contentType' => 'Employee'
                       ]]
                   ],
                   // Фильтр по ответственному
                   [
                       'contentType' => 'FilterTermRef',
                       'field' => 'responsible',
                       'comparison' => 'equals',
                       'value' => [[
                           'id' => '1000003',
                           'contentType' => 'Employee'
                       ]]
                   ],
                   // Фильтр по статусу
                   [
                       'contentType' => 'FilterTermEnum',
                       'field' => 'status',
                       'comparison' => 'equals',
                       'value' => ['filter_actual'], // актуальные проекты
                   ],
                   // Фильтр по расширенному полю
                   [
                       'contentType' => 'FilterTermEnum',
                       'field' => 'Category131CustomFieldStepenVipolneniya',
                       'comparison' => 'equals',
                       'value' => 20
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
       'deadline',
       'responsible',
       // ...
       // 'Category131CustomFieldStepenVipolneniya' - расширенное поле
   ],
   // Сортировка по активности
   'sortBy' => [[
       'contentType' => 'SortField',
       'fieldName' => 'activity',
       'desc' => true,
   ]],
   'limit' => 1,
   // Id последнего объекта из предыдущего результата для последовательной загрузки
   /*'pageAfter' => [
       'id' => '1000000',
       'contentType' => 'Project'
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

$logger->info('data', $data);
foreach ($data->data as $project) {
    $logger->info('id', $project->id);
    $logger->info('Название', $project->name);
    $logger->info('Дедлайн', $project->deadline);
    $logger->info('id ответственного', $project->responsible->id);
    $logger->info('Имя ответственного', $project->responsible->name);
}
