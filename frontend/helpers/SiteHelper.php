<?php

namespace frontend\helpers;

use Yii;

use yii\helpers\Url;

class SiteHelper
{
    public static $pageToParams = [
        'problem-downloads' => [
            'is_downloaded' => 'problem',
        ],
        'downloaded' => [
            'is_downloaded' => 'yes'
        ],
        'to-download' => [
            'toDownload' => 'yes'
        ],
        'like' => [
            'like_status' => 'like'
        ],
        'best' => [
            'like_status' => 'best'
        ],
        'general' => [
            'is_hidden' => 'no',
            'is_downloaded' => 'no',
        ],
        'downloading' => [
            'toDownload' => 'downloading'
        ],
        '' => [],
    ];

    public static $pageToTitle = [
        'problem-downloads' => 'Problem downloads',
        'downloaded' => 'Downloaded',
        'to-download' => 'To Download',
        'like' => 'Liked video',
        'best' => 'Best video',
        'general' => 'General',
        'downloading' => 'Downloading',
        '' => 'All Video Pages',
    ];

    public static function setSearchParams($page, &$searchParams)
    {
        if (empty($page)) return;

        $params = static::$pageToParams[$page];

        foreach ($params as $paramName => $value) {
            $searchParams['VideoPageSearch'][$paramName] = $value;
        }
    }

    public static function getTitleByPage($page)
    {
        if (!array_key_exists($page, static::$pageToTitle)) {
            return '';
        } else {
            return static::$pageToTitle[$page];
        }
    }

    public static function isShowFileSizeColumn($page)
    {
        if (!array_key_exists($page, static::$pageToParams)) {
            return false;
        } else {
            $params = static::$pageToParams[$page];
            return array_key_exists('is_downloaded', $params) && $params['is_downloaded'] <> 'no';
        }
    }

    public static function getMenuForNavBar()
    {
        $allNameOfPages = array_keys(static::$pageToTitle);

        $menu = [];
        foreach ($allNameOfPages as $page) {
            $tmp = [];
            $tmp['label'] = static::$pageToTitle[$page];
            if (!empty($page)) {
                $tmp['url'] = Url::to(['video-page/index', 'page' => $page]);
            } else {
                $tmp['url'] = Url::to(['video-page/index']);
            }
            $menu[] = $tmp;
        }

        return $menu;
    }

    public static function getParserByName($parserName) {
        $type = 'frontend\\models\\parsers\\' . $parserName . 'Parser';
        return Yii::createObject($type);
    }
}