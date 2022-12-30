<?php

$contractorCompanyId = 1000010;
$url = '/api/v3/contractorCompany/'.$contractorCompanyId;
$params = [
    'name' => 'Новое название',
    // Расширенное поле
    // 'Category183CustomFieldRegion' => 'Ленинградская область'
];
$response = $request->post($url, $params);
$data = $response->getData();

$logger->info('Измененный объект', $data->data);
