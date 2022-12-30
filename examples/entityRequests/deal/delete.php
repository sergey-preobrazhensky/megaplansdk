<?php

$dealId = 34;
$url = '/api/v3/deal/'.$dealId;
$response = $request->delete($url);
$data = $response->getData();

$logger->info('Результат удаления', $data);
