<?php
/**
 * Обработка данных при заходе в настройки
 */

use SergeyPreobrazhensky\Megaplansdk\Logger\FileLogger;

include __DIR__.'/../../vendor/autoload.php';
$logger = FileLogger::infoLogger(__DIR__. '/debug.log');

$requestData = $_REQUEST;
// Адрес аккаунта в Мегаплане, например mp123456.megplan.ru
$megaplanAccount = $requestData['accountId'];
// Уникальный id аккаунта
$megaplanAccountId = $requestData['uniqueAccountId'];

// Токен приложения для дальнейшей авторизации
// $requestData['applicationToken'];

// Дата действия токена
// $requestData['expirationTime'];

// UUID приложения
// $requestData['applicationUuid'];

// неизменяемый хост аккаунта
// $requestData['permanentHost'];

// подпись пользователя Мегаплана для проверки
// $requestData['userSign'];

$requestData = file_get_contents('php://input');
$logger->info('requestContent', $requestData);
$decoded = json_decode($requestData);

$logger->info('decoded', $decoded);
