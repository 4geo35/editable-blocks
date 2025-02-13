### Установка

Добавить `"./vendor/4geo35/editable-blocks/src/resources/views/components/**/*.blade.php",
"./vendor/4geo35/editable-blocks/src/resources/views/admin/**/*.blade.php",
"./vendor/4geo35/editable-blocks/src/resources/views/livewire/admin/**/*.blade.php",` в `tailwind.admin.config.js`, созданный в пакете `tailwindcss-theme`.

Запустить миграции для создания таблиц `php artisan migrate`

Установить lightbox `npm install fslightbox`, добавить в `app.js`:

    import "fslightbox"
