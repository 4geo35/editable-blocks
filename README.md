### Установка

Добавить `"./vendor/4geo35/editable-blocks/src/resources/views/components/**/*.blade.php",
"./vendor/4geo35/editable-blocks/src/resources/views/admin/**/*.blade.php",
"./vendor/4geo35/editable-blocks/src/resources/views/livewire/admin/**/*.blade.php",` в `tailwind.admin.config.js`, созданный в пакете `tailwindcss-theme`.

Запустить миграции для создания таблиц `php artisan migrate`

Установить lightbox `npm install fslightbox`, добавить в `app.js`:

    import "fslightbox"


### Настройка

Параметр `groups` отвечает за группы блоков, группу можно вывести в любое место на сайте. В группе можно создавать доступные типы блоков и редактировать порядок вывода блоков. Если `allowedTypes` пусто, то выводит все доступные типы блоков.

    "groups" => [
        "about" => [
            "title" => "О нас",
        ],
        "projects" => [
            "title" => "Проекты",
            "allowedTypes" => ["imageText"],
        ],
    ],
    
Параметр `static` отвечает за создание фиксированных блоков, их нельзя удалить через панель администрирования и можно вывести на сайт по ключу.

    "static" => [
        "contacts" => [
            "title" => "Текст в контактах",
            "type" => "imageText",
        ],
        "benefits" => [
            "title" => "Аккордеон в преимуществах",
            "type" => "collapseText",
        ],
    ],
