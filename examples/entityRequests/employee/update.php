<?php

$employeeId = 1000010;
$url = '/api/v3/employee/'.$employeeId;
$params = [
    'birthday' => [
        'contentType' => 'DateOnly',
        'day' => 1,
        'month' => 0, // месяц нумеруется с 0
        'year' => 1990,
    ],
];
$response = $request->post($url, $params);
$data = $response->getData();

$logger->info('Измененный объект', $data->data);
