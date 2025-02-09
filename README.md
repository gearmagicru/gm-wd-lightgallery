# <img src="https://raw.githubusercontent.com/gearmagicru/gm-wd-lightgallery/refs/heads/main/assets/images/icon.svg" width="64px" height="64px" align="absmiddle"> Виджет галереи "LightGallery"

Виджет предназначен для вывода и просмотра изображений на странице сайта с помощью лайтбокса "LightGallery".

## Пример применения
### с менеджером виджетов:
```
$gallery = Gm::$app->widgets->get(
    'gm.wd.lightgallery', 
    ['galleryId' => 1, 'sort' => 'index', limit' => 10, 'settings' => ['download' => false]]
);
$gallery->run();
```
### c шорткодом:
```
echo $this->shortcode('[lightgallery id="1" sort="index" limit="10" download="false"]');
```
### в шаблоне:
```
echo $this->widget('gm.wd.lightgallery', [
    'galleryId'  => 1,
    'mode'       => 'list',
    'sort'       => ['default' => 'index,a'],
    'pagination' => ['defaultLimit' => 20],
    'pager'      => [
        'itemTpl'       => '<li>{link}</li>',
        'activeItemTpl' => '<li class="active">{link}</li>',
        'options'       => ['class' => 'justify-content-center']
     ],
     'settings' => ['download' => false]
]);
```
### с namespace:
```
use Gm\Widget\LightGallery\Widget as Gallery;
echo Gallery::widget(['mode' => 'list', pagination' => ['defaultLimit' => 20]]);
```
если namespace ранее не добавлен в PSR, необходимо выполнить:
```
Gm::$loader->addPsr4('Gm\Widget\LightGallery\\', Gm::$app->modulePath . '/gm/gm.wd.lightgallery/src');
```

## Установка

Для добавления виджета в ваш проект, вы можете просто выполнить команду ниже:

```
$ composer require gearmagicru/gm-wd-lightgallery
```

или добавить в файл composer.json вашего проекта:
```
"require": {
    "gearmagicru/gm-wd-lightgallery": "*"
}
```

После добавления виджета в проект, воспользуйтесь Панелью управления GM Panel для установки его в редакцию вашего веб-приложения.

## Ресурсы
- [Сайт LightGallery](https://www.lightgalleryjs.com/)