<?php
/**
 * Этот файл является частью виджета веб-приложения GearMagic.
 * 
 * Пакет русской локализации.
 * 
 * @link https://gearmagic.ru
 * @copyright Copyright (c) 2015 Веб-студия GearMagic
 * @license https://gearmagic.ru/license/
 */

return [
    '{name}'        => 'LightGallery',
    '{description}' => 'Виджет галереи',

    // Settings
    '{settings.title}' => 'Настройка виджета "LightGallery"',
    // Settings: вкладки
    'Lightgallery parameters' => 'Параметры LightGallery',
    'Version' => 'Версия',
    // Settings: вкладка / параметры LightGallery
    'Get caption from title or alt' => 'Загаловок картинки из тегов alt или title',
    'Support legacy browsers' => 'Поддержка устаревших браузеров',
    'Allow media overlap' => 'Разрешить медиа перекрытие',
    'if true, toolbar, captions and thumbnails will not overlap with media element'
        => 'если включено, панель инструментов, подписи и миниатюры не будут перекрываться с элементом мультимедиа',
    'Animation' => 'Анимация',
    'Slide animation CSS easing property' => 'CSS-свойство плавности для анимация',
    'First slide' => 'Первый слайд',
    'slide that should load initially' => 'слайд который должен загружаться изначально',
    'Delay for hiding gallery controls, ms.' => 'Задержка скрытия элементов управления, мс.',
    'Transition duration, ms.' => 'Длительность перехода, мс.',
    'Zoom from image animation duration, ms.' => 'Длительность анимации при увеличении изображения, мс.',
    'Backdrop transition duration, ms.' => 'Длительность фонового перехода, мс.',
    'Delay slide transitions, ms.' => 'Задержка смены слайдов, мс.',
    'this is useful if you want to do any action in the current slide before moving to next slide' 
        => 'это удобно, если вы хотите выполнить какое-либо действие на текущем слайде, прежде чем перейти к следующему слайду',
    'Enable slideEnd animation' => 'Включить анимацию для последнего слайда',
    'Hide scrollbar when gallery is opened' => 'Скрыть полосу прокрутки при открытии галереи',
    'Video' => 'Видео',
    'Automatically load poster image for YouTube videos' => 'Автоматически загружать изображение постера для видео YouTube',
    'Video max size' => 'Максимальный размер видео',
    'Control' => 'Управление',
    'Enable keyboard navigation' => 'Включить навигацию с помощью клавиатуры',
    'Enabled key «Esc»' => 'Включить кнопку «Esc»',
    'close the gallery by pressing the «Esc» key' => 'закрыть галерею нажатием клавиши «Esc»',
    'Enable swipe' => 'Включить свайп',
    'enables swipe support for touch devices' => 'Включает поддержку свайп для сенсорных устройств',
    'Enable drag' => 'Включить перетаскивание',
    'enables desktop mouse drag support' => 'включает поддержку перетаскивания мышью на рабочем столе',
    'Close on tap' => 'Закрыть щелчком',
    'allows clicks on black area to close gallery' => 'позволяет закрывать галерею щелчком по черной области',
    'Reset scroll position' => 'Сбросить позицию прокрутки',
    'reset to previous scrollPosition when lightGallery is closed' => 'сброс к предыдущей позиции прокрутки при закрытии галереи',
    'Enable mouse wheel' => 'Включить колесико мыши',
    'ability to navigate to next/prev slides on mousewheel' => 'возможность перехода к следующему/предыдущему слайду с помощью колесика мыши',
    'Control interface' => 'Интерфейс управления',
    'Allows to download' => 'Позволяет скачивать',
    'Hide prev/next button' => 'Скрыть кнопку «предыдущий/следующий»',
    'applies only to first/last image' => 'применяется только для первого/последнего изображения',
    'Allows to close the gallery' => 'Позволяет закрыть галерею',
    'if false user won\'t be able to close the gallery at all' => 'если выключено, то пользователь не сможет закрыть галерею',
    'Show counter' => 'Показывать счётчик',
    'whether to show total number of images and index number of currently displayed image' 
        => 'показывать общее количество изображений и порядковый номер текущего отображаемого изображения',
    'Show controls' => 'Показывать управление',
    'if false, prev/next buttons will not be displayed' => 'если не включено, кнопки «Назад/Далее» отображаться не будут',
    'Show maximize icon' => 'Показать кнопку полного размера',
    'useful for creating inline galleries' => 'полезно для создания встроенных галерей',
    'Show close icon' => 'Показать кнопку закрытия',
    'if false, close button won\'t be displayed' => 'если отключено, кнопка закрытия не будет отображаться',
    'Loop' => 'Повтор',
    'enable the ability to return to the beginning of the gallery from the last slide' 
        => 'включает возможность возврата к началу галереи с последнего слайда',
    'Gallery size' => 'Размеры галереи',
    'Width, px, %' => 'Ширина, пкс., %',
    'Height, px, %' => 'Высота, пкс., %',
    'iframe size' => 'Размеры iframe',
    'Max width, px, %' => 'Макс. ширина, пкс., %',
    'Max height, px, %' => 'Макс. высота, пкс., %',
    'Preload' => 'Предварительная загрузка',
    'Number of preload slides' => 'Количество слайдов предварительной загрузки',
    'version' => 'версия',
    'site' => 'сайт',
    'license' => 'лицензия',
    'Open source license' => 'Лицензия с открытым исходным кодом',
    
    // Settings: всплывающие сообщения / текст
    'Widget settings successfully changed' => 'Настройки виджета "LightGallery" успешно сохранены.',

    // ShortcodeSettings
    '{shortcodesettings.title}' => 'Добавление шорткода виджета "LightGallery"',
    // ShortcodeSettings: поля
    'Media gallery album' => 'Альбом медиагалереи',
];
