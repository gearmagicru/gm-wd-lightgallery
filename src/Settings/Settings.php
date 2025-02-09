<?php
/**
 * Виджет веб-приложения GearMagic.
 * 
 * @link https://gearmagic.ru
 * @copyright Copyright (c) 2015 Веб-студия GearMagic
 * @license https://gearmagic.ru/license/
 */

namespace Gm\Widget\LightGallery\Settings;

use Gm\Panel\Helper\ExtCombo;
use Gm\Panel\Widget\SettingsWindow;

/**
 * Настройки галереи "LightGallery".
 * 
 * @link https://www.lightgalleryjs.com/docs/settings/
 * 
 * @author Anton Tivonenko <anton.tivonenko@gmail.com>
 * @package Gm\Widget\LightGallery\Settings
 * @since 1.0
 */
class Settings extends SettingsWindow
{
    /**
     * {@inheritdoc}
     * 
     * Т.к. виджет вызывает {@see \Gm\Backend\Marketplace\WidgetManager}, то
     * необходимо указать свой путь к ресурсам (иначе, URL-путь будет указан 
     * относительно менеджера).
     */
    public array $css = [
        '@module::/gm/gm.wd.lightgallery/assets/css/settings.css'
    ];

    /**
     * {@inheritdoc}
     */
    protected function init(): void
    {
        parent::init();

        // панель формы (Gm.view.form.Panel GmJS)
        $this->form->autoScroll = true;
        $this->form->bodyPadding = 1;

        // окно компонента (Ext.window.Window Sencha ExtJS)
        $this->width = 700;
        $this->height = 800;
        $this->resizable = false;
        $this->responsiveConfig = [
            'height < 900' => ['height' => '99%'],
            'width < 640' => ['width' => '99%'],
        ];
    }

    /**
     * Возвращает вариант выбора эффекта анимации.
     * 
     * @return array<string, string>
     */
    protected function getEasingData(): array
    {
        return [
            ['ease', 'Ease'],
            ['ease-in', 'Ease in'],
            ['ease-out', 'Ease out'],
            ['ease-in-out', 'Ease in out'],
            ['linear', 'Linear']
        ];
    }

    /**
     * Возвращает вкладку "Параметры Lightgallery".
     * 
     * @return array
     */
    protected function getTabGallery(): array
    {
        return [
            'title'       => '#Lightgallery parameters',
            'bodyPadding' => 10,
            'autoScroll'  => true,
            'layout'      => 'anchor',
            'defaults'    => [
                'xtype'      => 'textfield',
                'labelWidth' => 250,
                'labelAlign' => 'right'
            ],
            'items' => [
                [
                    'xtype'      => 'checkbox',
                    'ui'         => 'switch',
                    'name'       => 'getCaptionFromTitleOrAlt',
                    'fieldLabel' => '#Get caption from title or alt',
                    'inputValue' => 1
                ],
                [
                    'xtype'      => 'checkbox',
                    'ui'         => 'switch',
                    'name'       => 'supportLegacyBrowser',
                    'fieldLabel' => '#Support legacy browsers',
                    'inputValue' => 1
                ],
                [
                    'xtype'      => 'checkbox',
                    'ui'         => 'switch',
                    'name'       => 'allowMediaOverlap',
                    'fieldLabel' => '#Allow media overlap',
                    'boxLabel'   => '#if true, toolbar, captions and thumbnails will not overlap with media element',
                    'cls'        => 'gm-wd-lightgallery__checkbox',
                    'inputValue' => 1
                ],
                [
                    'xtype'    => 'fieldset',
                    'title'    => '#Animation',
                    'defaults' => [
                        'labelWidth' => 320,
                        'labelAlign' => 'right',
                    ],
                    'items' => [
                        ExtCombo::local(
                            '#Slide animation CSS easing property', 'easing', 
                            $this->getEasingData(),
                            [
                                'width' => 500
                            ]
                        ),
                        [
                            'xtype'      => 'numberfield',
                            'name'       => 'index',
                            'fieldLabel' => '#First slide',
                            'note'       => '#slide that should load initially',
                            'minValue'   => 0,
                            'width'      => 410
                        ],
                        [
                            'xtype'      => 'numberfield',
                            'name'       => 'hideBarsDelay',
                            'fieldLabel' => '#Delay for hiding gallery controls, ms.',
                            'minValue'   => 0,
                            'width'      => 410
                        ],
                        [
                            'xtype'      => 'numberfield',
                            'name'       => 'speed',
                            'fieldLabel' => '#Transition duration, ms.',
                            'minValue'   => 0,
                            'width'      => 410
                        ],
                        [
                            'xtype'      => 'numberfield',
                            'name'       => 'startAnimationDuration',
                            'fieldLabel' => '#Zoom from image animation duration, ms.',
                            'minValue'   => 0,
                            'width'      => 410
                        ],
                        [
                            'xtype'      => 'numberfield',
                            'name'       => 'backdropDuration',
                            'fieldLabel' => '#Backdrop transition duration, ms.',
                            'minValue'   => 0,
                            'width'      => 410
                        ],
                        [
                            'xtype'      => 'numberfield',
                            'name'       => 'slideDelay',
                            'fieldLabel' => '#Delay slide transitions, ms.',
                            'note'       => '#this is useful if you want to do any action in the current slide before moving to next slide',
                            'minValue'   => 0,
                            'width'      => 410
                        ],
                        [
                            'xtype'      => 'checkbox',
                            'ui'         => 'switch',
                            'name'       => 'slideEndAnimation',
                            'fieldLabel' => '#Enable slideEnd animation',
                            'inputValue' => 1
                        ],
                        [
                            'xtype'      => 'checkbox',
                            'ui'         => 'switch',
                            'name'       => 'hideScrollbar',
                            'fieldLabel' => '#Hide scrollbar when gallery is opened',
                            'inputValue' => 1
                        ]
                    ]
                ],
                [
                    'xtype'    => 'fieldset',
                    'title'    => '#Video',
                    'defaults' => [
                        'labelWidth' => 320,
                        'labelAlign' => 'right',
                    ],
                    'items' => [
                        [
                            'xtype'      => 'checkbox',
                            'ui'         => 'switch',
                            'name'       => 'loadYouTubePoster',
                            'fieldLabel' => '#Automatically load poster image for YouTube videos',
                            'inputValue' => 1
                        ],
                        [
                            'xtype'      => 'textfield',
                            'name'       => 'videoMaxSize',
                            'fieldLabel' => '#Video max size',
                            'emptyText' => '1280-720',
                            'width'      => 410
                        ]
                    ]
                ],
                [
                    'xtype'    => 'fieldset',
                    'title'    => '#Control',
                    'defaults' => [
                        'labelWidth' => 290,
                        'labelAlign' => 'right',
                    ],
                    'items' => [
                        [
                            'xtype'      => 'checkbox',
                            'ui'         => 'switch',
                            'name'       => 'keyPress',
                            'fieldLabel' => '#Enable keyboard navigation',
                            'inputValue' => 1
                        ],
                        [
                            'xtype'      => 'checkbox',
                            'ui'         => 'switch',
                            'name'       => 'escKey',
                            'fieldLabel' => '#Enabled key «Esc»',
                            'boxLabel'   => '#close the gallery by pressing the «Esc» key',
                            'cls'        => 'gm-wd-lightgallery__checkbox',
                            'inputValue' => 1
                        ],
                        [
                            'xtype'      => 'checkbox',
                            'ui'         => 'switch',
                            'name'       => 'enableSwipe',
                            'fieldLabel' => '#Enable swipe',
                            'boxLabel'   => '#enables swipe support for touch devices',
                            'cls'        => 'gm-wd-lightgallery__checkbox',
                            'inputValue' => 1
                        ],
                        [
                            'xtype'      => 'checkbox',
                            'ui'         => 'switch',
                            'name'       => 'enableDrag',
                            'fieldLabel' => '#Enable drag',
                            'boxLabel'   => '#enables desktop mouse drag support',
                            'cls'        => 'gm-wd-lightgallery__checkbox',
                            'inputValue' => 1
                        ],
                        [
                            'xtype'      => 'checkbox',
                            'ui'         => 'switch',
                            'name'       => 'closeOnTap',
                            'fieldLabel' => '#Close on tap',
                            'boxLabel'   => '#allows clicks on black area to close gallery',
                            'cls'        => 'gm-wd-lightgallery__checkbox',
                            'inputValue' => 1
                        ],
                        [
                            'xtype'      => 'checkbox',
                            'ui'         => 'switch',
                            'name'       => 'resetScrollPosition',
                            'fieldLabel' => '#Reset scroll position',
                            'boxLabel'   => '#reset to previous scrollPosition when lightGallery is closed',
                            'cls'        => 'gm-wd-lightgallery__checkbox',
                            'inputValue' => 1
                        ],
                        [
                            'xtype'      => 'checkbox',
                            'ui'         => 'switch',
                            'name'       => 'mousewheel',
                            'fieldLabel' => '#Enable mouse wheel',
                            'boxLabel'   => '#ability to navigate to next/prev slides on mousewheel',
                            'cls'        => 'gm-wd-lightgallery__checkbox',
                            'inputValue' => 1
                        ]
                    ]
                ],
                [
                    'xtype'    => 'fieldset',
                    'title'    => '#Control interface',
                    'defaults' => [
                        'labelWidth' => 290,
                        'labelAlign' => 'right',
                    ],
                    'items' => [
                        [
                            'xtype'      => 'checkbox',
                            'ui'         => 'switch',
                            'name'       => 'download',
                            'fieldLabel' => '#Allows to download',
                            'inputValue' => 1
                        ],
                        [
                            'xtype'      => 'checkbox',
                            'ui'         => 'switch',
                            'name'       => 'hideControlOnEnd',
                            'fieldLabel' => '#Hide prev/next button',
                            'boxLabel'   => '#applies only to first/last image',
                            'cls'        => 'gm-wd-lightgallery__checkbox',
                            'inputValue' => 1
                        ],
                        [
                            'xtype'      => 'checkbox',
                            'ui'         => 'switch',
                            'name'       => 'closable',
                            'fieldLabel' => '#Allows to close the gallery',
                            'boxLabel'   => '#if false user won\'t be able to close the gallery at all',
                            'cls'        => 'gm-wd-lightgallery__checkbox',
                            'inputValue' => 1
                        ],
                        [
                            'xtype'      => 'checkbox',
                            'ui'         => 'switch',
                            'name'       => 'counter',
                            'fieldLabel' => '#Show counter',
                            'boxLabel'   => '#whether to show total number of images and index number of currently displayed image',
                            'cls'        => 'gm-wd-lightgallery__checkbox',
                            'inputValue' => 1
                        ],
                        [
                            'xtype'      => 'checkbox',
                            'ui'         => 'switch',
                            'name'       => 'controls',
                            'fieldLabel' => '#Show controls',
                            'boxLabel'   => '#if false, prev/next buttons will not be displayed',
                            'cls'        => 'gm-wd-lightgallery__checkbox',
                            'inputValue' => 1
                        ],
                        [
                            'xtype'      => 'checkbox',
                            'ui'         => 'switch',
                            'name'       => 'showMaximizeIcon',
                            'fieldLabel' => '#Show maximize icon',
                            'boxLabel'   => '#useful for creating inline galleries',
                            'cls'        => 'gm-wd-lightgallery__checkbox',
                            'inputValue' => 1
                        ],
                        [
                            'xtype'      => 'checkbox',
                            'ui'         => 'switch',
                            'name'       => 'showCloseIcon',
                            'fieldLabel' => '#Show close icon',
                            'boxLabel'   => '#if false, close button won\'t be displayed',
                            'cls'        => 'gm-wd-lightgallery__checkbox',
                            'inputValue' => 1
                        ],
                        [
                            'xtype'      => 'checkbox',
                            'ui'         => 'switch',
                            'name'       => 'loop',
                            'fieldLabel' => '#Loop',
                            'boxLabel'   => '#enable the ability to return to the beginning of the gallery from the last slide',
                            'cls'        => 'gm-wd-lightgallery__checkbox',
                            'inputValue' => 1
                        ]
                    ]
                ],
                [
                    'xtype'    => 'fieldset',
                    'title'    => '#Gallery size',
                    'defaults' => [
                        'xtype'      => 'textfield',
                        'labelWidth' => 150,
                        'labelAlign' => 'right',
                        'width'      => 250,
                        'emptyText'  => '100%'
                    ],
                    'items' => [
                        [
                            'name'       => 'width',
                            'fieldLabel' => '#Width, px, %'
                        ],
                        [
                            'name'       => 'height',
                            'fieldLabel' => '#Height, px, %'
                        ]
                    ]
                ],
                [
                    'xtype'    => 'fieldset',
                    'title'    => '#iframe size',
                    'defaults' => [
                        'xtype'      => 'textfield',
                        'labelWidth' => 150,
                        'labelAlign' => 'right',
                        'width'      => 250,
                        'emptyText'  => '100%'
                    ],
                    'items' => [
                        [
                            'name'       => 'iframeWidth',
                            'fieldLabel' => '#Width, px, %'
                        ],
                        [
                            'name'       => 'iframeHeight',
                            'fieldLabel' => '#Height, px, %'
                        ],
                        [
                            'name'       => 'iframeMaxWidth',
                            'fieldLabel' => '#Max width, px, %'
                        ],
                        [
                            'name'       => 'iframeMaxHeight',
                            'fieldLabel' => '#Max height, px, %'
                        ]
                    ]
                ]
            ]
        ];
    }

    /**
     * Возвращает вкладку "Версия".
     * 
     * @return array
     */
    protected function getTabVersion(): array
    {
        return [
            'title'       => '#Version',
            'bodyPadding' => 10,
            'autoScroll'  => true,
            'layout'      => 'anchor',
            'defaults'    => [
                'labelWidth' => 70,
                'labelAlign' => 'right',
            ],
            'items' => [
                [
                    'xtype'      => 'displayfield',
                    'ui'         => 'parameter',
                    'fieldLabel' => '#version',
                    'value'      => '2.8.0-beta.3'
                ],
                [
                    'xtype'      => 'displayfield',
                    'ui'         => 'parameter',
                    'fieldLabel' => '#site',
                    'value'      => '<a target="_blank" href="https://www.lightgalleryjs.com/">https://www.lightgalleryjs.com/</a>'
                ],
                [
                    'xtype'      => 'displayfield',
                    'ui'         => 'parameter',
                    'fieldLabel' => '#license',
                    'value'      => '<a target="_blank" href="https://www.lightgalleryjs.com/license/">https://www.lightgalleryjs.com/license/</a>'
                ],
                [
                    'xtype' => 'label',
                    'ui'    => 'header-line',
                    'text'  => '#Open source license'
                ],
                [
                    'cls' => 'x-form-display-field',
                    'html' => 'If you are creating an open source application under a license compatible with the <a href="https://www.gnu.org/licenses/gpl-3.0.html" target="_blank">GNU GPL license v3</a>, you may use this project under the terms of the GPLv3. Questions? <a href="https://www.gnu.org/licenses/gpl-faq.html#GPLRequireSourcePostedPublic" target="_blank">Read the GPL FAQ</a>. or <a href="http://greendrake.info/publications/js-gpl" target="_blank">this blog post.</a>'
                ]
            ]
        ];
    }

    /**
     * Возвращает панель вкладок.
     * 
     * @return array
     */
    protected function getTabPanel(): array
    {
        return [
            'xtype'           => 'tabpanel',
            'activeTab'       => 0,
            'ui'              => 'flat-light',
            'enableTabScroll' => true,
            'anchor'          => '100% 100%',
            'autoRender'      => true,
            'items'           => [
                $this->getTabGallery(),
                $this->getTabVersion()
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function beforeRender(): bool
    {
        parent::beforeRender();

        $this->form->items = $this->getTabPanel();
        return true;
    }
}