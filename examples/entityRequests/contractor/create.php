<?php

$url = '/api/v3/contractorCompany/';
$params = [
    'contentType' => 'ContractorCompany',
    'name' => 'ООО "Ромашка"',
    'contactInfo' => [[
        'contentType' => 'ContactInfo',
        'isMain' => true,
        'type' => 'email',
        'value' => 'romashka45986521@gmail.com',
    ]],
    // Расширенное поле
    // 'Category183CustomFieldRegion' => 'Московская область'
];
$response = $request->post($url, $params);
$data = $response->getData();

$logger->info('Созданный объект', $data->data);
