<?php

namespace frontend\models\parsers;

use Sunra\PhpSimple\HtmlDomParser;

use frontend\models\StartLinks;
use frontend\models\VideoPage;

class DeprecatedParser
{
    public $name = 'deprecated';

    public static function getVideoLinksByStartLink(StartLinks $link)
    {
        $html = HtmlDomParser::file_get_html($link->url);

        $mainDiv = $html->find('#search_results')[0];

        $foundLinks = [];
        foreach($mainDiv->find('a') as $a) {

            if (substr($a->href, 0, 6) == '/post/' )
            {
                $parentNode = $a->parentNode();

                if (array_key_exists('id', $parentNode->attr) && $parentNode->attr['id'] == 'topVid_container') {
                    continue;
                }
                //we found our url
                $tmp = [];
                $tmp['href'] = explode('?', $a->href, 2)[0];
                $tmp['title'] = $a->title;
                //$tmp['post_time'] = $a->find('.post_time')[0]->title;
                $tmp['post_time'] = null;

                $imageNode = $a->find('img')[0];

                $tmp['image'] = $imageNode->src;
                $foundLinks[] = $tmp;
            }
        }
        return $foundLinks;
    }

    public static function addUnknownVideos(StartLinks $startLink)
    {
        $foundLinks = static::getVideoLinksByStartLink($startLink);

        $host = parse_url($startLink->url, PHP_URL_HOST);
        $scheme = parse_url($startLink->url, PHP_URL_SCHEME);
        foreach($foundLinks as $link) {
            // check if exist in db

            $url = $scheme . '://' . $host . $link['href'];;
            $videoLink = VideoPage::findOne(['url' => $url]);

            if (empty($videoLink)) {

                $videoLink = new VideoPage();
                $videoLink->start_link_id = $startLink->start_link_id;
                $videoLink->image_url = $link['image'];
                $videoLink->tittle = $link['title'];
                $videoLink->post_time = $link['post_time'];
                $videoLink->url = $url;
                $videoLink->save();
            }
        }
    }
}