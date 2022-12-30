<?php

$taskId = 1000010;
$url = '/api/v3/task/'.$taskId;
$params = [
    'name' => 'New name2',
    // Расширенное поле
    // 'Category130CustomFieldStepenVipolneniya' => 40
];
$response = $request->post($url, $params);
$data = $response->getData();

$logger->info('Измененный объект задачи', $data);
