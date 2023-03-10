Библиотека переехала сюда https://github.com/megaplan/megaplansdk

Библиотека для работы с Мегапланом
====================

PHP-библиотека для работы по API с CRM Мегаплан, обработки внешних из Мегаплана запросов и данных, отправляемых по подписке

Возможности
-------------------
Библиотека позволяет реализовать для взаимодействия с Мегапланом как входящие запросы, так и обработку потоков данных из системы:

- механизм авторизации,
- логирование,
- примеры чтения / создания / изменения / удаления основных объектов 
- обработка запросов при установке приложения и запросе настроек,
- обработка внешних запросов из бизнес-процессов,
- обработка запросов при подписке на события

Структура директорий
-------------------
src:
- **MegaplanRequest.php**: основной класс для api-запросов
- **MegaplanResponse.php**: класс ответа, возвращаемый при работе MegaplanRequest

src/logger: 

* интерфейс и реализации классов логирования

examples:
- **getTokenByPassword.php**: получение токена по логину и паролю пользователя

examples/listeners:

обработка запросов из Мегаплана

- **dealRemoteRequest.php**: пример обработки внешнего запроса из бизнес-процессов
- **eventSubscriber.php**: пример обработки подписки на события
- **preferences.php**: пример обработки запроса установки приложения или перехода в настройки

examples/entityRequests:

* примеры запросов на чтение / создание / изменение / удаление основных сущностей
