<?php

$url = '/api/v3/program';
$response = $request->get($url, $params);
$data = $response->getData();

$logger->info(
    'общее количество',
    $data->meta->pagination->count
);
$logger->info('Все данные', $data);

foreach ($data->data as $program) {
    $logger->info('id', $program->id);
    $logger->info('Название', $program->name);
}
