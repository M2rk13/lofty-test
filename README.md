# lofty-test
 
## Установка и запуск

1) После скачивания репозитория необходимо перейти через консоль в папку проекта и запустить контейнеры командой
`docker-compose up -d`

2) Далее нужно проследовать в PHP контейнер:
`docker exec -it test-php8 bash`

3) При необходимости переустановить фреймворк Yii2
`composer create-project --prefer-dist yiisoft/yii2-app-advanced lofty`

3.1) В случае переустановки фреймворка потребуется внести настройки БД:
`lofty/common/config/main-local.php:`

3.2) В случае переустановки фреймворка возможно понадобится повторно установить модули:
`yiisoft/yii2-jui`
`guzzlehttp/guzzle`

```php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=database:3306;dbname=test',
            'username' => 'docker',
            'password' => 'docker',
            'charset' => 'utf8',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
    ],
];
```

4) При необходимости повторно инициализировать PHP
`cd lofty`
`php init`

5) Теперь необходимо поднять миграции командой:
`php yii migrate/up`

6) Приложение готово к использованию

## Использование

1) Перед использованием необходимо пройти регистрацию через раздел SignUp

2) Далее нужно войти в систему через раздел Login

3) После утентификации доступны разделы Employees и Positions

### Employees и Positions

1) На страницах отображена вся информация по спискам с кнопками просмотра на отдельной странице, редактирования на отдельной странице и удаления.

2) В верхней части контента находится кнопка добавления новой записи, которая ведет на страницу добавления записи.

### Страница добавления / редактирования

1) Страница добавления / редактирования записи содержит в себе набор полей с валидацией и кнопку, совершающую действие

### Страница просмотра записи

1) Страница просмотра записи содержит в себе данные о записи и кнопки редактирования / удаления

## API

1) Взаимодействие с API требует валидации по токену, кроме просмотра списка Positions

2) Для удобства методы для работы с API вынесены в файл `Lofty-test-api.postman_collection.json`, импортируется через Postman

3) Для внесения токена необходимо сделать обращение к БД и скопировать значение `access_token` в Настройки коллекции Postman (edit -> auth -> Bearer Token)

4) Для подключения к бд использовать:
server : localhost
port : 3306
user : docker
password : docker
