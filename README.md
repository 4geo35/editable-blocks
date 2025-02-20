### Установка

Добавить `"./vendor/4geo35/editable-blocks/src/resources/views/components/**/*.blade.php",
"./vendor/4geo35/editable-blocks/src/resources/views/admin/**/*.blade.php",
"./vendor/4geo35/editable-blocks/src/resources/views/livewire/admin/**/*.blade.php",` в `tailwind.admin.config.js`, созданный в пакете `tailwindcss-theme`.

Добавить `"./vendor/4geo35/editable-blocks/src/resources/views/components/**/*.blade.php",` в `tailwind.config.js`, созданный в пакете `tailwindcss-theme`.

Запустить миграции для создания таблиц `php artisan migrate`

Установить lightbox `npm install fslightbox`, добавить в `app.js`:

    import "fslightbox"

### Вывод

Что бы вывести созданные блоки на сайт, фасад который кэширует данные:

    $contactsData = BlockRenderActions::getByKey('contacts');
    $benefitsData = BlockRenderActions::getByKey("benefits");

    $aboutData = BlockRenderActions::getByGroup("about");

    $example = Example::query()->first();
    $exampleData = BlockRenderActions::getByModel($example);

Компоненты для вывода на сайт:
    
    @if ($exampleData)
        @foreach($exampleData as $block)
            <x-dynamic-component :component="$block->render_type_component" :block="$block" class="mb-indent" />
        @endforeach
    @endif

    @if ($aboutData)
        @foreach($aboutData as $block)
            <x-dynamic-component :component="$block->render_type_component" :block="$block" class="mb-indent" />
        @endforeach
    @endif

    <x-dynamic-component :component="$contactsData->render_type_component" :block="$contactsData" class="mb-indent" />
    <x-dynamic-component :component="$benefitsData->render_type_component" :block="$benefitsData" class="mb-indent" />
    

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

Параметр `models` отвечает за блоки прикрепленные к модели. Модель должна реализовывать `ShouldBlocksInterface`, все необходимое есть в `ShouldBlocks`. По умолчанию группой для модели является ее таблица, но можно поменять это переопределив метод `getBlockGroupAttribute`. Если нет ограничений на типы блоков, можно оставить пустой массив для модели.

    "models" => [
        "examples" => [
            "allowedTypes" => ["collapseText", "imageText"],
        ],
    ],

Что бы вывести блоки на страницу редактирования модели достаточно добавить два компонента:

    <livewire:eb-manage-blocks :model="$example" />
    <livewire:eb-block-list :model="$example" />
