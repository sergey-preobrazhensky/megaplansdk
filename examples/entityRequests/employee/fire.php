<?php

$employeeId = 1000015;
$url = '/api/v3/employee/'.$employeeId.'/fire/';
$response = $request->post($url);
$data = $response->getData();

$logger->info('Уволенный сотрудник', $data->data);
