<?php

$projectId = 1000000;
$url = '/api/v3/task/'.$projectId;
$response = $request->delete($url);
$data = $response->getData();

$logger->info('Результат удаления', $data);
