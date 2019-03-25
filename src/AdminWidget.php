<?php
/**
 * Created by PhpStorm.
 * User: floor12
 * Date: 15/10/2018
 * Time: 05:04
 */

namespace floor12\adminWidget;


use Yii;
use yii\base\Widget;
use yii\helpers\Html;

class AdminWidget extends Widget
{


    public $modules = [
        'shop' => [
            'title' => 'Магазин',
            'icon' => 'shopping-bag',
            'link' => '/shop/admin'
        ],
        'banner' => [
            'title' => 'Баннеры',
            'icon' => 'images ',
            'link' => '/banner/admin'
        ],
        'backup' => [
            'title' => 'Бекапы',
            'icon' => 'hdd',
            'link' => '/backup/admin'
        ],
        'user' => [
            'title' => 'Пользователи',
            'icon' => 'users',
            'link' => '/user/admin'
        ]
    ];

    private $_links = [];


    public function run()
    {
        if (!Yii::$app->getModule('pages')->adminMode())
            return;


        foreach ($this->modules as $module => $moduleData)
            if (Yii::$app->getModule($module))
                $this->_links[] = Html::a(FontAwesome::icon($moduleData['icon']), [$moduleData['link']], ['title' => $moduleData['title']]);

        return Html::tag('div', implode($this->_links), ['id' => 'f12-admin-menu']);
    }
}