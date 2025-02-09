<?php
/**
 * Виджет веб-приложения GearMagic.
 * 
 * @link https://gearmagic.ru
 * @copyright Copyright (c) 2015 Веб-студия GearMagic
 * @license https://gearmagic.ru/license/
 */

namespace Gm\Widget\LightGallery;

use Gm;
use Gm\Helper\Html;
use Gm\Db\Sql\Select;
use Gm\Db\Sql\Expression;
use Gm\View\ClientScript;
use Gm\View\WidgetResourceTrait;

/**
 * Виджет галереи "LightGallery".
 * 
 * Пример использования с менеджером виджетов:
 * ```php
 * $gallery = Gm::$app->widgets->get('gm.wd.lightgallery', ['galleryId' => 1, 'sort' => 'index', limit' => 10, 'settings' => ['download' => false]]);
 * $gallery->run();
 * ```
 * 
 * Пример использования c шорткодом:
 * ```php
 * echo $this->shortcode('[lightgallery id="1" sort="index" limit="10" download="false"]');
 * ```
 * 
 * Пример использования в шаблоне:
 * ```php
 * echo $this->widget('gm.wd.lightgallery', [
 *     'galleryId'  => 1,
 *     'mode'       => 'list',
 *     'sort'       => ['default' => 'index,a'],
 *     'pagination' => ['defaultLimit' => 20],
 *     'pager'      => [
 *         'itemTpl'       => '<li>{link}</li>',
 *         'activeItemTpl' => '<li class="active">{link}</li>',
 *         'options'       => ['class' => 'justify-content-center']
 *      ],
 *      'settings' => ['download' => false]
 * ]);
 * ```
 * 
 * Пример использования с namespace:
 * ```php
 * use Gm\Widget\LightGallery\Widget as Gallery;
 * 
 * echo Gallery::widget(['mode' => 'list', pagination' => ['defaultLimit' => 20]]);
 * ```
 * если namespace ранее не добавлен в PSR, необходимо выполнить:
 * ```php
 * Gm::$loader->addPsr4('Gm\Widget\LightGallery\\', Gm::$app->modulePath . '/gm/gm.wd.lightgallery/src');
 * ```
 * @link https://www.lightgalleryjs.com/
 * 
 * @author Anton Tivonenko <anton.tivonenko@gmail.com>
 * @package Gm\Widget\LightGallery
 * @since 1.0
 */
class Widget extends \Gm\View\Widget\ListView
{
    use WidgetResourceTrait;

    /**
     * @var string Режим "items" отключает запросы к виджету (сортировка, лимиты, пагинация).
     */
    public const MODE_ITEMS = 'items';

    /**
     * @var string Режим "list" включате только запрос пагинациия виджета.
     */
    public const MODE_LIST = 'list';

    /**
     * @var string Режим "full" включает запросы к виджету (сортировка, лимиты, пагинация).
     */
    public const MODE_FULL = 'full';

    /**
     * HTML-атрибуты тега для отображения обёртки содержимого галереи.
     * 
     * По умолчанию тег "div".

     * @var array
     */
    public array $wrapperOptions = [];

    /**
     * Уникальный идентификатор поставщика данных.
     * 
     * Применяется для {@see \Gm\Data\Provider\BaseProvider::$id}.
     * 
     * @var string
     */
    public string $providerId = '';

    /**
     * Идентификатор фотоальбома.
     * 
     * @var int|null
     */
    public ?int $galleryId = null;

    /**
     * Массив записей атрибутов изображений.
     * 
     * Указывается или получается из запроса {@see Widget::getItems()}.
     * 
     * @var array<int, array<string, mixed>>|null
     */
    public ?array $items = null;

    /**
     * Режим работы виджета.
     * 
     * @var string
     */
    public string $mode = self::MODE_FULL;

    /**
     * Имена столбцов (полей) таблицы изображений в виде массива пар "псевдоним - имя поля".
     * 
     * @see Widget::getDataQuery()
     * 
     * @var array
     */
    public array $columns = [
        'id'       => 'id',
        'index'    => 'index',
        'name'     => 'name',
        'desc'     => 'description',
        'imageSrc' => 'item_url',
        'thumbSrc' => 'image_url',
    ];

    /**
     * Параметры конфигурации пагинации элементов данных.
     * 
     * Устанавливает поставщику данных {@see Widget::$dataProvider} пагинацию. Если 
     * параметры конфигурации не указаны, то будет использовать параметры по умолчанию
     * {@see Widget::$defaultPagination}.
     * 
     * @see Widget:initDataProvider()
     *
     * @var array
     */
    public array $pagination = [];

    /**
     * Параметры конфигурации сортировщика элементов данных.
     * 
     * Устанавливает поставщику данных {@see Widget::$dataProvider} сортировщик. Если 
     * параметры конфигурации не указаны, то будет использовать параметры по умолчанию
     * {@see Widget::$defaultSort}.
     * 
     * @see Widget:initDataProvider()
     *
     * @var array
     */
    public array $sort = [];

    /**
     * Параметры конфигурации пагинации элементов данных по умолчанию.
     * 
     * @see Widget:initDataProvider()
     *
     * @var array
     */
    public array $defaultPagination = [
        'pageParam'    => 'page',
        'limitParam'   => 'limit',
        'defaultLimit' => 15,
        'limitFilter'  => [15, 30, 50, 100],
        'maxLimit'     => 100
    ];

    /**
     * Параметры конфигурации сортировщика элементов данных по умолчанию.
     * 
     * @see Widget:initDataProvider()
     *
     * @var array
     */
    public array $defaultSort = [
        'param'   => 'sort',
        'default' => 'index,a',
        'filter'  => [
            'index' => 'index',
            'name'  => 'name'
        ]
    ];

    /**
     * {@inheritdoc}
     */
    protected array $defaultSettings = [
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

    /**
     * {@inheritdoc}
     */
    public function init(): void
    {
        // атрибут "id" тега "div" (подставляется в объяление JS)
        if (empty($this->options['id'])) {
            $this->options['id'] = uniqid();
        }
        
        parent::init();
    }

    /**
     * {@inheritdoc}
     */
    public function initDataProvider(): void
    {
        /** @var array $provider Параметры провайдера */
        $provider = $this->dataProvider ?: [];

        if (is_array($provider))  {
            // идентификатор поставщика данных
            if ($this->providerId !== null) {
                $provider['id'] = $this->providerId;
            }

            // сортировка элементов
            if ($this->sort)
                $sort = array_merge($this->defaultSort, $this->sort);
            else
                $sort = $this->defaultSort;

            // пагинация элементов
            if ($this->pagination)
                $pagination = array_merge($this->defaultPagination, $this->pagination);
            else
                $pagination = $this->defaultPagination;

            // режим отключате параметры запроса
            if ($this->mode === self::MODE_ITEMS) {
                $sort['param'] = false;
                $pagination['pageParam'] = false;
                $pagination['limitParam'] = false;
            } else
            // режим только пагинации
            if ($this->mode === self::MODE_LIST) {
                $sort['param'] = false;
                $pagination['limitParam'] = false;
            }
    
            // общее количество элементов
            if ($pagination['pageParam'] !== false) {
                $pagination['totalCount'] = $this->getDataCount();
            }

            $this->dataProvider = array_merge($provider, [
                'class'        => '\Gm\Data\Provider\QueryProvider',
                'query'        => $this->getDataQuery(),
                'pagination'   => $pagination,
                'sort'         => $sort,
                'processItems' => [$this, 'processItems'],
            ]);
        }

        parent::initDataProvider();
    }

    /**
     * {@inheritdoc}
     * 
     * [lightgallery id="1" mode="list" sort="index,a" limit="10" page="1"...]
     * 
     * Следующие атрибуты шорткода, которые буду определяться:
     * - id       -> galleryId, идентификатор галереи в базе данных;
     * - mode     -> mode, Режим работы виджета;
     * - download -> configSettings['download'], возможность скачать;
     * - counter  -> configSettings['counter'], показывать счётчик;
     * - width    -> configSettings['width'], ширина галереи;
     * - height   -> configSettings['height'], высота галереи
     * - closable -> configSettings['closable'], позволяет закрыть галерею
     * - controls -> configSettings['controls'], показывать управление
     */
    protected function initAttributes(array $attr): void
    {
        if (isset($attr['id']))    $this->galleryId = (int) $attr['id'];
        if (isset($attr['mode']))  $this->mode = $attr['mode'];
        if (isset($attr['sort']))  $this->sort['default'] = $attr['sort'];
        if (isset($attr['limit'])) $this->pagination['defaultLimit'] = (int) $attr['limit'];
        if (isset($attr['page']))  $this->pagination['page'] = (int) $attr['page'];
        if (isset($attr['download'])) {
            $this->configSettings['download'] = $attr['download'] === 'true' || $attr['download'] == 1;
        }
        if (isset($attr['counter'])) {
            $this->configSettings['counter'] = $attr['counter'] === 'true' || $attr['counter'] == 1;
        }
        if (isset($attr['width'])) $this->configSettings['width'] = $attr['width'];
        if (isset($attr['height'])) $this->configSettings['height'] = $attr['height'];
        if (isset($attr['closable'])) {
            $this->configSettings['closable'] = $attr['closable'] === 'true' || $attr['closable'] == 1;
        }
        if (isset($attr['controls'])) {
            $this->configSettings['controls'] = $attr['controls'] === 'true' || $attr['controls'] == 1;
        }
    }

    /**
     * Предварительная обработка элементов перед их выводом.
     * 
     * @param array $items Элементы данных.
     * 
     * @return array
     */
    public function processItems(array $items): array
    {
        return $items;

    }

    /**
     * @see Widget::getDataFilter()
     * 
     * @var array
     */
    protected array $filter;

    /**
     * Возвращает условия выбора изображений для SQL-оператора WHERE.
     * 
     * Применяется при получении общего количества записей и формирования SQL-запроса.
     * 
     * @see Widget::getDataCount()
     * @see Widget::getDataQuery()
     * 
     * @return array
     */
    public function getDataFilter(): array
    {
        if (isset($this->filter)) {
            return $this->filter;
        }

        $filter =  ['visible' => 1, 'gallery_id' => $this->galleryId];
        return $this->filter = $filter;
    }

    /**
     * Возвращает общее количество записей.
     * 
     * @return int
     * 
     * @throws \Gm\Db\Adapter\Exception\CommandException Ошибка выполнения SQL-запроса
     */
    public function getDataCount(): int
    {
        /** @var \Gm\Db\Adapter\Driver\AbstractCommand $command */
        $command = Gm::$app->db
            ->createCommand(
                (new Select())
                    ->from('{{gallery_items}}')
                    ->columns(['count' => new Expression('COUNT(*)')])
                    ->where($this->getDataFilter())
        );
        /** @var array|null $row */
        $row = $command->queryOne();
        return $row ? $row['count'] : 0;
    }

    /**
     * Возвращает объект запроса.
     * 
     * @return Select|\Gm\Db\ActiveRecord
     */
    public function getDataQuery()
    {
        return (new Select())
            ->columns($this->columns)
            ->from('{{gallery_items}}')
            ->where($this->getDataFilter());
    }

    /**
     * {@inheritdoc}
     */
    protected function renderItem(array $item, int $index): string
    {
        return '<a href="' . $item['imageSrc'] . '" title="' . $item['name']  .'"><img src="' . $item['thumbSrc'] . '" /></a>';
    }

    /**
     * {@inheritdoc}
     */
    public function renderItems(): string
    {
        $rows  = [];
        $items = $this->getItems();
        foreach ($items as $index => $item) {
            $before = $this->renderBeforeItem($item, $index);
            if ($before !== null) {
                $rows[] = $before;
            }

            $rows[] = $this->renderItem($item, $index);

            $after = $this->renderAfterItem($item, $index);
            if ($after !== null) {
                $rows[] = $after;
            }
        }
        return implode($this->itemsSeparator, $rows);
    }

    /**
     * Возвращает элементы данных (изображения).
     * 
     * @return array<int, array<string, mixed>>
     */
    protected function getItems(): array
    {
        if ($this->items === null) {
            $this->items = $this->dataProvider->getItems();
        }
        return $this->items;
    }

    /**
     * Возвращает скрипт параметров настроек виджета.
     * 
     * @return string
     */
    public function getScriptOptions(): string
    {
        $params = $this->getAllSettingWithoutDefaults();
        return $this->formatScriptParams($params);
    }

    /**
     * Возвращает скрипт подключения.
     *
     * @return string
     */
    protected function getScript(): string
    {
        $options  = $this->getScriptOptions();
        return 'lightGallery(document.getElementById("' . $this->options['id'] .  '"), {' . $options . '});';
    }

    /**
     * Регистрирует скрипты виджета.
     * 
     * @return void
     */
    protected function registerScriptFiles(): void
    {
        $url = $this->getAssetsUrl();
        // LightGallery
        Gm::$app->clientScript
            ->appendPackage('lightgallery', [
                'position' => ClientScript::POS_END,
                'js'       => ['lightgallery.min.js' => [$url . '/dist/lightgallery.min.js']],
                'css'      => ['lightgallery.css'    => [$url . '/dist/css/lightgallery.css']]
            ])
            ->registerPackage('lightgallery')
            ->registerJs($this->getScript(), ClientScript::POS_END, 'lightgallery');
    }

    /**
     * {@inheritdoc}
     */
    public function run(): mixed
    {
        $items = $this->getItems();
        if (is_callable($this->itemsView))
            $content = call_user_func($this->itemsView, $items, $this);
        else {
            if (sizeof($items) > 0)
                $content = $this->renderItems();
            else
                $content = $this->showEmptyText ? $this->renderEmptyText() : '';
        }

        $container =  Html::tag('div', $content, $this->options);

        if ($content) {
            $container = $container . $this->renderPager();
            $this->registerScriptFiles();  
        }

        return Html::tag('div', $container, $this->wrapperOptions);
    }
}