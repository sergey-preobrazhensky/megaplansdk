<?php

$projectId = 1000001;
$url = '/api/v3/project/'.$projectId;
$params = [
    'name' => 'Новое название проекта',
    // Расширенное поле
    // 'Category130CustomFieldStepenVipolneniya' => 40
];
$response = $request->post($url, $params);
$data = $response->getData();

$logger->info('Измененный объект', $data);
