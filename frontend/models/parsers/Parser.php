<?php

namespace frontend\models\parsers;

use Sunra\PhpSimple\HtmlDomParser;


class Parser
{
    public static function getContentByUrl($url)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_REFERER, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        $str = curl_exec($curl);
        curl_close($curl);
        return $str;
    }

    public static function getHtmlDomParserByUrl($url)
    {
        $html = static::getContentByUrl($url);
        $parser = HtmlDomParser::str_get_html($html);
        return $parser;
    }
}