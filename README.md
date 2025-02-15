# <img src="https://raw.githubusercontent.com/gearmagicru/gm-wd-lightgallery/refs/heads/main/assets/images/icon.svg" width="64px" height="64px" align="absmiddle"> Виджет галереи "LightGallery"

[![Latest Stable Version](https://img.shields.io/packagist/v/gearmagicru/gm-wd-lightgallery.svg)](https://packagist.org/packages/gearmagicru/gm-wd-lightgallery)
[![Total Downloads](https://img.shields.io/packagist/dt/gearmagicru/gm-wd-lightgallery.svg)](https://packagist.org/packages/gearmagicru/gm-wd-lightgallery)
[![Author](https://img.shields.io/badge/author-anton.tivonenko@gmail.com-blue.svg)](mailto:anton.tivonenko@gmail)
[![Source Code](https://img.shields.io/badge/source-gearmagicru/gm--wd--lightgallery-blue.svg)](https://github.com/gearmagicru/gm-wd-lightgallery)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg)](https://github.com/gearmagicru/gm-wd-lightgallery/blob/master/LICENSE)
![Component type: widget](https://img.shields.io/badge/component%20type-widget-green.svg)
![Component ID: gm-wd-lightgallery](https://img.shields.io/badge/component%20id-gm.wd.lightgallery-green.svg)
![php 8.2+](https://img.shields.io/badge/php-min%208.2-red.svg)

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