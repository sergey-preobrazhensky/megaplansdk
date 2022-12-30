<?php

$url = '/api/v3/employee/';
$params = [
    'contentType' => 'Employee',
    'firstName' => 'Иван',
    'lastName' => 'Иванов',
    'contactInfo' => [[
        'contentType' => 'ContactInfo',
        'isMain' => true,
        'type' => 'email',
        'value' => 'ivanovivan5937561@gmail.com',
    ]],
];
$response = $request->post($url, $params);
$data = $response->getData();

$logger->info('Созданный объект', $data->data);
