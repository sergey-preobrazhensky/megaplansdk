<?php

$programId = 6;
$url = '/api/v3/program/'.$programId;
$response = $request->get($url, $params);
$data = $response->getData();

$logger->info('data', $data);

if ($program = $data->data) {
    $logger->info('id', $program->id);
    $logger->info('Название', $program->name);
    $logger->info('Сценарии', $program->triggers);
    $logger->info('Статусы', $program->states);
    $logger->info('Переходы', $program->transitions);
    $logger->info('Роли', $program->roles);
}
