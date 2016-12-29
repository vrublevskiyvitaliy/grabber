<?php

namespace frontend\helpers;

use Yii;
use yii\helpers\Url;

class SideMenuHelper
{
    static public function getItemUrl($item)
    {
        if (isset($item['url']) && isset($item['url'][0])) {
            return Url::toRoute($item['url']);
        }

        return false;
    }

    static public function isActiveItem($item)
    {
        $pageRoute = Yii::$app->controller->getRoute();
        $pageParams = Yii::$app->request->getQueryParams();

        if (isset($item['url']) && is_array($item['url']) && isset($item['url'][0])) {
            $route = $item['url'][0];
            if ($route[0] !== '/' && Yii::$app->controller) {
                $route = Yii::$app->controller->module->getUniqueId() . '/' . $route;
            }

            if (ltrim($route, '/') !== $pageRoute) {
                return false;
            }

            unset($item['url']['#']);
            if (count($item['url']) > 1) {
                $params = $item['url'];
                unset($params[0]);
                foreach ($params as $name => $value) {
                    if ($value !== null && (!isset($pageParams[$name]) || $pageParams[$name] != $value)) {
                        return false;
                    }
                }
            }

            return true;
        }

        return false;
    }

    static public function hasActiveChild($item)
    {
        foreach ($item['items'] as $subItem) {
            if (SideMenuHelper::isActiveItem($subItem)) {
                return true;
            }
        }

        return false;
    }
}