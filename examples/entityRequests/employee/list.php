<?php

$url = '/api/v3/employee';
$params = [
   // Отдавать только запрашиваемые поля
   'onlyRequestedFields' => true,
    // Запрашиваемые поля
   'fields' => [
       'isOnline',
       'firstName',
       'lastName',
       'isWorking',
       'canLogin',
       'isOnline',
       'nearestVacation',
       'position',
       'contactInfo',
       'status',
       // ...
   ],
   'sortBy' => [[
       'contentType' => 'SortField',
       'fieldName' => 'name',
       'desc' => false,
   ]],
   'limit' => 10,
   // Id последней задачи из предыдущего результата для последовательной загрузки
   /*'pageAfter' => [
       'id' => '125320',
       'contentType' => 'Employee'
   ]*/
];
$response = $request->get($url, $params);
$data = $response->getData();

$logger->info(
    'общее количество'.
    $data->pagination->count
);
$logger->info(
    'Признак того, что еще есть незагруженные объекты'.
    $data->pagination->hasMoreNext
);

$logger->info('data', $data);
foreach ($data->data as $employee) {
    $logger->info('id', $employee->id);
    $logger->info('firstName', $employee->firstName);
    $logger->info('lastName', $employee->lastName);
    $logger->info('contactInfo', $employee->contactInfo);
    $logger->info('status', $employee->status);
    $logger->info('isOnline', $employee->isOnline);
}
