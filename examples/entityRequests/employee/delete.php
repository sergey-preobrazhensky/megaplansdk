<?php

$employeeId = 1000015;
$url = '/api/v3/employee/'.$employeeId;
$response = $request->delete($url);
$data = $response->getData();

$logger->info('Результат удаления', $data);
