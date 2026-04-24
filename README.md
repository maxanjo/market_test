# Product Catalog REST API

Тестовое задание: реализация API-метода для поиска и фильтрации товаров интернет-магазина.

Сделал seed для удобной проверки (при написаний factory and seeds использовал ИИ)

## Особенности реализации (Архитектура)
* **Чистый контроллер:** Логика фильтрации вынесена из контроллера с помощью Local Scope (`scopeFilter` в модели Product).
* **Валидация:** Строгая проверка всех query-параметров через `ProductRequest`.
* **База данных:** Реалистичные Фабрики и Сидеры для удобного тестирования.
* **Оптимизация БД:** Настроены FullText индексы для поиска по строке и составные B-Tree индексы для частых фильтров сортировки.
* **Ответ API:** Форматирование вывода осуществляется через `ProductResource`.

## Установка и запуск

1. Склонируйте репозиторий:
`git clone https://github.com/maxanjo/market_test.git

2. Установите зависимости:
`composer install`

3. Настройте конфигурацию:
`cp .env.example .env`
`php artisan key:generate`

4. Укажите доступы к вашей базе данных MySQL/PostgreSQL в файле `.env`.

5. Запустите миграции и заполните базу фейковыми данными (создаст 10 категорий и 100 реалистичных товаров):
`php artisan migrate:fresh --seed`

6. Запустите локальный сервер:
`php artisan serve`

## Использование API

**Endpoint:** `GET /api/products`

**Доступные query-параметры фильтрации:**
* `q` (string) — поиск по подстроке в названии товара
* `price_from` (numeric) — цена от
* `price_to` (numeric) — цена до
* `category_id` (integer) — ID категории
* `in_stock` (boolean: 1/0, true/false) — наличие на складе
* `rating_from` (numeric) — рейтинг от (0 до 5)

**Доступные параметры сортировки:**
* `sort` — принимает значения: `price_asc`, `price_desc`, `rating_desc`, `newest` (по умолчанию)

**Пример запроса:**
`/api/products?q=Apple&price_from=1000&in_stock=1&sort=price_desc`