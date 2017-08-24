Встановлення
============

## Встановлення через Composer

Рекомендується встановлювати це розширення за допомогою [Composer](http://getcomposer.org/download/).

Виконайте

```
php composer.phar require --prefer-dist yiisoft/yii2-debug
```

або додайте

```
"yiisoft/yii2-debug": "~2.0.0"
```

до секції require вашого файлу `composer.json`.


## Конфігурація додатка

Для підключення розширення додайте наступні рядки до вашого файлу конфігурації, щоб активувати налагоджувальний модуль:

```php
'bootstrap' => ['debug'],
'modules' => [
    'debug' => 'yii\debug\Module',
]
```

За замовчуванням налагоджувальний модуль працює лише тоді, коли доступ до веб-сайту здійснюється з локальної машини. Якщо ви хочете використовувати
його на віддаленому (проміжному) сервері, то додайте параметр `allowedIPs` до конфігурації, вказавши вашу IP-адресу:

```php
'bootstrap' => ['debug'],
'modules' => [
    'debug' => [
        'class' => 'yii\debug\Module',
        'allowedIPs' => ['1.2.3.4', '127.0.0.1', '::1']
    ]
]
```

Якщо ви використовуєте опцію `enableStrictParsing` менеджера URL, додайте наступні рядки до ваших правил (`rules`):

```php
'urlManager' => [
    'enableStrictParsing' => true,
    'rules' => [
        // ...
        'debug/<controller>/<action>' => 'debug/<controller>/<action>',
    ],
],
```

> Примітка: налагоджувач зберігає інформацію про кожний запит у директорію `@runtime/debug`. Якщо у вас виникли проблеми при використанні
> налагоджувача, такі як дивні повідомлення про помилки під час його роботи, або панель налагодження відсутня чи не показує ніяких запитів, перевірте
> чи веб-сервер має достатньо прав для доступу до цієї директорії та чи присутні у ній файли.


### Додаткова конфігурація для журналювання та профілювання

Журналювання та профілювання є простими, але потужними інструментами, які можуть допомогти вам зрозуміти хід виконання як
фреймворку так і додатку. Ці інструменти є корисними для середовища розробки та для робочого середовища.

Коли в робочому середовищі, ви повинні зберігати у журналі лише значно важливі повідомлення вручну, як описано у
розділі посібника [Журналювання](https://github.com/yiisoft/yii2/blob/master/docs/guide-uk/runtime-logging.md). Продовження зберігання усіх повідомлень в робочому режимі значно знизить швидкодію.

У середовищі розробки, чим більше інформації зберігається у журналі, тим краще, і це особливо корисно для запису наслідків виконання (трасування).

Для того, щоб побачити повідомлення трасування, які допоможуть вам зрозуміти, що відбувається "під капотом" фреймворку, вам
необхідно встановити рівень трасування у файлі конфігурації:

```php
return [
    // ...
    'components' => [
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0, // <-- тут
```

За замовчуванням рівень трасування автоматично встановлюється в `3`, якщо Yii працює в режимі налагодження, який визначається наявністю
наступного рядка у файлі `index.php`:

```php
defined('YII_DEBUG') or define('YII_DEBUG', true);
```

> Примітка: Переконайтеся, що режим налагодження вимкнений у робочому середовищі, оскільки це може зробити істотний несприятливий для швидкодії
ефект. Крім того, режим налагодження може спричинити витік конфіденційної інформації до кінцевих користувачів.