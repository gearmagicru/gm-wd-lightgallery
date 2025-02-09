<?php
/**
 * Этот файл является частью виджета веб-приложения GearMagic.
 * 
 * Файл конфигурации настроек виджета.
 * 
 * @link https://gearmagic.ru
 * @copyright Copyright (c) 2015 Веб-студия GearMagic
 * @license https://gearmagic.ru/license/
 */

return [
    'getCaptionFromTitleOrAlt' => true, // загаловок картинки из тегов alt или title
    'supportLegacyBrowser'   => true, // поддержка устаревших браузеров
    'allowMediaOverlap'      => false, // разрешить медиа перекрытие
    'easing'                 => 'ease', // CSS-свойство плавности для анимация
    'index'                  => 0, // первый слайд
    'hideBarsDelay'          => 0, // задержка скрытия элементов управления
    'speed'                  => 400, // длительность перехода
    'startAnimationDuration' => 400, // длительность анимации при увеличении изображения
    'backdropDuration'       => 300, // длительность фонового перехода
    'slideDelay'             => 0, // задержка смены слайдов
    'slideEndAnimation'      => true, // включить анимацию для последнего слайда
    'hideScrollbar'          => true, // скрыть полосу прокрутки при открытии галереи
    'loadYouTubePoster'      => true, // автоматически загружать изображение постера для видео YouTube
    'videoMaxSize'           => '1280-720', // максимальный размер видео
    'keyPress'               => true, // включить навигацию с помощью клавиатуры
    'escKey'                 => true, // включить кнопку «Esc»
    'enableSwipe'            => true, // включить свайп
    'enableDrag'             => true, // включить перетаскивание
    'closeOnTap'             => true, // закрыть щелчком
    'resetScrollPosition'    => true, // сбросить позицию прокрутки
    'mousewheel'             => true, // включить колесико мыши
    'download'               => true, // возможность скачать
    'hideControlOnEnd'       => false, // скрыть кнопку «предыдущий/следующий»
    'closable'               => true, // позволяет закрыть галерею
    'counter'                => true, // показывать счётчик
    'controls'               => true, // показывать управление
    'showMaximizeIcon'       => false, // показать кнопку полного размера
    'showCloseIcon'          => true, // показать кнопку закрытия
    'loop'                   => true, // повтор
    'width'                  => '100%', // ширина галереи
    'height'                 => '100%', // высота галереи
    'iframeWidth'            => '100%', // ширина iframe
    'iframeHeight'           => '100%', // высота iframe
    'iframeMaxWidth'         => '100%', // маск. ширина iframe
    'iframeMaxHeight'        => '100%', // маск. высота iframe
    'preload'                => 2 // предварительная загрузка
];
