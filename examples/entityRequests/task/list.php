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
                    // Примеры условий фильтрации:
                    // Фильтр по автору
                    /*[
                       'contentType' => 'FilterTermRef',
                       'field' => 'userCreated',
                       'comparison' => 'equals',
                       'value' => [[
                           'id' => '792',
                           'contentType' => 'Employee'
                       ]]
                   ],*/
                   // Фильтр по ответственному
                   /*[
                       'contentType' => 'FilterTermRef',
                       'field' => 'responsible',
                       'comparison' => 'equals',
                       'value' => [[
                           'id' => '844',
                           'contentType' => 'Employee'
                       ]]
                   ],*/
                   // Фильтр по статусу
                   /*[
                       'contentType' => 'FilterTermEnum',
                       'field' => 'status',
                       'comparison' => 'equals',
                       'value' => ['filter_overdue'] // просроченные задачи
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
       'status',
       'deadline',
       'responsible',
       // ...
       // 'Category130CustomFieldPrioritet' - расширенное поле
   ],
   'sortBy' => [[
       'contentType' => 'SortField',
       'fieldName' => 'activity',
       'desc' => true,
   ]],
   'limit' => 1,
   // Id последней задачи из предыдущего результата для последовательной загрузки
   /*'pageAfter' => [
       'id' => '125320',
       'contentType' => 'Task'
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
foreach ($data->data as $task) {
    $logger->info('id', $task->id);
    $logger->info('name', $task->name);
    $logger->info('status', $task->status);
    $logger->info('deadline', $task->deadline);
    $logger->info('responsible_id', $task->responsible->id);
    $logger->info('responsible_name', $task->responsible->name);
}
