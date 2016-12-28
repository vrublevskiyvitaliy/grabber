<?php

namespace frontend\models\parsers;

use Sunra\PhpSimple\HtmlDomParser;

use frontend\models\StartLinks;
use frontend\models\VideoPage;
use yii\base\Exception;

class YoutubeSearchParser extends Parser
{
    public $name = 'YoutubeSearch';

    public static function getVideoLinksByStartLink(StartLinks $link)
    {
        $html = static::getHtmlDomParserByUrl($link->url);

        $blocks = $html->find('.yt-lockup-dismissable');
        $foundLinks = [];
        foreach($blocks as $block) {

            try {

                $h3 = $block->find('.yt-lockup-title')[0];
                $a = $h3->find('a')[0];

                $tmp = [];
                $tmp['href'] = $a->href;
                $tmp['title'] = $a->title;

                $imageNode = $block->find('.yt-thumb-simple');
                if (!array_key_exists(0, $imageNode)) {
                    throw new Exception('Bad');
                } else {
                    $imageNode = $imageNode[0];
                }
                $imageNode = $imageNode->find('img');
                if (!array_key_exists(0, $imageNode)) {
                    throw new Exception('Bad');
                } else {
                    $imageNode = $imageNode[0];
                }
                if (isset($imageNode->attr['data-thumb'])) {
                    $tmp['image'] = $imageNode->attr['data-thumb'];
                } else {
                    $tmp['image'] = $imageNode->src;
                }
                $tmp['post_time'] = null;

                $foundLinks[] = $tmp;
            } catch (Exception $e) {
                continue;
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