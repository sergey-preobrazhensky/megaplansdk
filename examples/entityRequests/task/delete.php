<?php

$taskId = 1000013;
$url = '/api/v3/task/'.$taskId;
$response = $request->delete($url);
$data = $response->getData();

$logger->info('Результат удаления', $data);
