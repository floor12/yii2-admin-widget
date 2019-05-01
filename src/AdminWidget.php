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
    public $modulesAdditinal = [];

    public $modules = [
        'shop' => [
            'title' => 'Магазин',
            'icon' => IconHelper::SHOP,
            'link' => '/shop/admin'
        ],
        'banner' => [
            'title' => 'Баннеры',
            'icon' => IconHelper::BANNER,
            'link' => '/banner/admin'
        ],
        'mailing' => [
            'title' => 'Рассылки',
            'icon' => IconHelper::MAILING,
            'link' => '/mailing/admin'
        ],
        'callback' => [
            'title' => 'Заявки на звонок',
            'icon' => IconHelper::CALLBACK,
            'link' => '/callback/admin'
        ],
        'feedback' => [
            'title' => 'Обратная связь',
            'icon' => IconHelper::FEEDBACK,
            'link' => '/feedback/admin'
        ],
        'backup' => [
            'title' => 'Бекапы',
            'icon' => IconHelper::BACKUP,
            'link' => '/backup/admin'
        ],
        'user' => [
            'title' => 'Пользователи',
            'icon' => IconHelper::USER,
            'link' => '/user/admin'
        ],

    ];

    private $_links = [];


    public function run()
    {
        if (!Yii::$app->getModule('pages')->adminMode())
            return;

        AdminWidgetAsset::register($this->getView());

        foreach ($this->modules as $module => $moduleData)
            if (Yii::$app->getModule($module))
                $this->_links[] = Html::a("{$moduleData['icon']} <span>{$moduleData['title']}</span>", [$moduleData['link']]);

        $this->_links[] = Html::a(IconHelper::LOGOUT . " <span>Выход</span>", ['/user/frontend/logout']);

        return Html::tag('div', implode($this->_links), ['id' => 'f12-admin-menu']);
    }
}