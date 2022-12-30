<?php

$employeeId = 1000003;
$url = '/api/v3/employee/'.$employeeId;
$params = [
   'onlyRequestedFields' => true,
    // Запрашиваемые поля
   'fields' => [
       'firstName',
       'lastName',
       'contactInfo',
       'status',
       'isOnline',
       // ...
   ],
];
$response = $request->get($url, $params);
$data = $response->getData();

$logger->info('data', $data);

$employee = $data->data;
$logger->info('id', $employee->id);
$logger->info('firstName', $employee->firstName);
$logger->info('lastName', $employee->lastName);
$logger->info('contactInfo', $employee->contactInfo);
$logger->info('status', $employee->status);
$logger->info('isOnline', $employee->isOnline);
