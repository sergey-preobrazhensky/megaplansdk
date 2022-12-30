<?php

$contractorCompanyId = 1000003;
$url = '/api/v3/contractor/'.$contractorCompanyId;
$params = [
   'onlyRequestedFields' => true,
    // Запрашиваемые поля
   'fields' => [
       'name',
       'responsibles',
       'timeUpdated',
       'type',
       // Расширенное поле
       // Category183CustomFieldRegion
   ],
];
$response = $request->get($url, $params);
$data = $response->getData();

$contractorCompany = $data->data;
$logger->info('Название комании', $contractorCompany->name);
$logger->info('Ответственные', $contractorCompany->responsibles);
$logger->info('Время изменения', $contractorCompany->timeUpdated);
$logger->info('Тип', $contractorCompany->type);
