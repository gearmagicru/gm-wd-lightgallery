<?php
/**
 * Виджет веб-приложения GearMagic.
 * 
 * @link https://gearmagic.ru
 * @copyright Copyright (c) 2015 Веб-студия GearMagic
 * @license https://gearmagic.ru/license/
 */

namespace Gm\Widget\LightGallery\Model;

use Gm\Panel\Data\Model\WidgetSettingsModel;

/**
 * Модель настроек виджета.
 * 
 * @author Anton Tivonenko <anton.tivonenko@gmail.com>
 * @package Gm\Widget\LightGallery\Model
 * @since 1.0
 */
class Settings extends WidgetSettingsModel
{
    /**
     * {@inheritdoc}
     */
    public function maskedAttributes(): array
    {
        return [
            'getCaptionFromTitleOrAlt' => 'getCaptionFromTitleOrAlt', // загаловок картинки из тегов alt или title
            'supportLegacyBrowser'   => 'supportLegacyBrowser', // поддержка устаревших браузеров
            'allowMediaOverlap'      => 'allowMediaOverlap', // разрешить медиа перекрытие
            'easing'                 => 'easing', // CSS-свойство плавности для анимация
            'index'                  => 'index', // первый слайд
            'hideBarsDelay'          => 'hideBarsDelay', // задержка скрытия элементов управления
            'speed'                  => 'speed', // длительность перехода
            'startAnimationDuration' => 'startAnimationDuration', // длительность анимации при увеличении изображения
            'backdropDuration'       => 'backdropDuration', // длительность фонового перехода
            'slideDelay'             => 'slideDelay', // задержка смены слайдов
            'slideEndAnimation'      => 'slideEndAnimation', // включить анимацию для последнего слайда
            'hideScrollbar'          => 'hideScrollbar', // скрыть полосу прокрутки при открытии галереи
            'loadYouTubePoster'      => 'loadYouTubePoster', // автоматически загружать изображение постера для видео YouTube
            'videoMaxSize'           => 'videoMaxSize', // максимальный размер видео
            'keyPress'               => 'keyPress', // включить навигацию с помощью клавиатуры
            'escKey'                 => 'escKey', // включить кнопку «Esc»
            'enableSwipe'            => 'enableSwipe', // включить свайп
            'enableDrag'             => 'enableDrag', // включить перетаскивание
            'closeOnTap'             => 'closeOnTap', // закрыть щелчком
            'resetScrollPosition'    => 'resetScrollPosition', // сбросить позицию прокрутки
            'mousewheel'             => 'mousewheel', // включить колесико мыши
            'download'               => 'download', // возможность скачать
            'hideControlOnEnd'       => 'hideControlOnEnd', // скрыть кнопку «предыдущий/следующий»
            'closable'               => 'closable', // позволяет закрыть галерею
            'counter'                => 'counter', // показывать счётчик
            'controls'               => 'controls', // показывать управление
            'showMaximizeIcon'       => 'showMaximizeIcon', // показать кнопку полного размера
            'showCloseIcon'          => 'showCloseIcon', // показать кнопку закрытия
            'loop'                   => 'loop', // повтор
            'width'                  => 'width', // ширина галереи
            'height'                 => 'height', // высота галереи
            'iframeWidth'            => 'iframeWidth', // ширина iframe
            'iframeHeight'           => 'iframeHeight', // высота iframe
            'iframeMaxWidth'         => 'iframeMaxWidth', // маск. ширина iframe
            'iframeMaxHeight'        => 'iframeMaxHeight', // маск. высота iframe
            'preload'                => 'preload' // предварительная загрузка
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'getCaptionFromTitleOrAlt' => 'Get caption from title or alt',
            'supportLegacyBrowser'   => 'Support legacy browsers',
            'allowMediaOverlap'      => 'Allow media overlap',
            'easing'                 => 'Slide animation CSS easing property',
            'index'                  => 'First slide',
            'hideBarsDelay'          => 'Delay for hiding gallery controls, ms.',
            'speed'                  => 'Transition duration, ms.',
            'startAnimationDuration' => 'Zoom from image animation duration, ms.',
            'backdropDuration'       => 'Backdrop transition duration, ms.',
            'slideDelay'             => 'Delay slide transitions, ms.',
            'slideEndAnimation'      => 'Enable slideEnd animation',
            'hideScrollbar'          => 'Hide scrollbar when gallery is opened',
            'loadYouTubePoster'      => 'Automatically load poster image for YouTube videos',
            'videoMaxSize'           => 'Video max size',
            'keyPress'               => 'Enable keyboard navigation',
            'escKey'                 => 'Enabled key «Esc»',
            'enableSwipe'            => 'Enable swipe',
            'enableDrag'             => 'Enable drag',
            'closeOnTap'             => 'Close on tap',
            'resetScrollPosition'    => 'Reset scroll position',
            'mousewheel'             => 'Enable mouse wheel',
            'download'               => 'Allows to download',
            'hideControlOnEnd'       => 'Hide prev/next button',
            'closable'               => 'Allows to close the gallery',
            'counter'                => 'Show counter',
            'controls'               => 'Show controls',
            'showMaximizeIcon'       => 'Show maximize icon',
            'showCloseIcon'          => 'Show close icon',
            'loop'                   => 'Loop',
            'width'                  => 'Width, px, %',
            'height'                 => 'Height, px, %',
            'iframeWidth'            => 'Width, px, %',
            'iframeHeight'           => 'Height, px, %',
            'iframeMaxWidth'         => 'Max width, px, %',
            'iframeMaxHeight'        => 'Max height, px, %',
            'preload'                => 'Preload'
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function formatterRules(): array
    {
        return [
            [
                [
                    'getCaptionFromTitleOrAlt', 'supportLegacyBrowser', 'allowMediaOverlap', 'slideEndAnimation', 
                    'hideScrollbar', 'loadYouTubePoster', 'keyPress', 'escKey', 'enableSwipe', 'enableDrag', 
                    'closeOnTap', 'resetScrollPosition', 'mousewheel', 'download', 'hideControlOnEnd', 'closable', 
                    'counter', 'controls', 'showMaximizeIcon', 'showCloseIcon', 'loop'
                ], 'logic' => [true, false]
            ],
            [
                [
                    'index', 'hideBarsDelay', 'speed', 'startAnimationDuration', 'backdropDuration', 'slideDelay', 'preload'
                ], 'type' => 'int'
            ]
        ];
    }
}