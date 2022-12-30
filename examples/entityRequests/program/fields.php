<?php

$programId = 6;
$url = '/api/v3/program/'.$programId.'/fields';
$response = $request->get($url, $params);
$data = $response->getData();

$logger->info('data', $data);

foreach ($data->data as $program) {
    $logger->info('id', $program->id);
    $logger->info('Название', $program->hrName);
    $logger->info('Системное имя', $program->name);
    $logger->info('Тип', $program->type);
    if (isset($program->refContentType)) {
        $logger->info('Типы моделей, на которые ссылается поле', $program->refContentType);
    }
    if (isset($program->enumValues)) {
        $logger->info('Набор допустимых значений', $program->enumValues);
    }
}
