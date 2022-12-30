<?php

$contractorCompanyId = 1000069;
$url = '/api/v3/contractor/'.$contractorCompanyId;
$response = $request->delete($url);
$data = $response->getData();

$logger->info('Результат удаления', $data);
