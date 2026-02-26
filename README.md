# ru-declension-laravel

Быстрое склонение русских существительных по числу для Laravel.

## Возможности

- Склонение через `Facade` и helper-функцию
- Встроенная словарная база в SQLite (поставляется с пакетом)
- Пользовательский словарь через публикуемый конфиг
- Приоритет пользовательского словаря над SQLite
- Минимальные накладные расходы: кэширование результатов в памяти процесса

## Требования

- PHP 8.1+
- расширения `pdo` и `pdo_sqlite`
- Laravel 10 / 11 / 12

## Установка

```bash
composer require smoke585/ru-declension-laravel
```

Опубликовать конфиг:

```bash
php artisan vendor:publish --tag=ru-declension-config
```

## Использование

```php
use SmoKE585\RUDeclensionLaravel\Facades\RUDeclension;

RUDeclension::make(3, 'балл'); // 3 балла
RUDeclension::make('балл', 3); // 3 балла
RUDeclension::make(3, 'балл', RUDeclension::MODE_WORD); // балла

RUDeclension(5, 'балл'); // 5 баллов
```

## Конфиг

`config/ru-declension.php`

```php
return [
    'sqlite_path' => null, // null = встроенная база пакета
    'strict' => false,
    'user_dictionary' => [
        'комментарий' => ['комментарий', 'комментария', 'комментариев'],
    ],
];
```

Поддерживаются оба формата `user_dictionary`:

```php
'слово' => ['слово', 'слова', 'слов']
```

```php
'слово' => ['one' => 'слово', 'few' => 'слова', 'many' => 'слов']
```

## Формат таблицы SQLite

Таблица `forms`:

- `lemma`
- `one`
- `few`
- `many`
