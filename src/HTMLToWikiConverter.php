<?php

namespace HealthVector;

class HTMLToWikiConverter {
    private $files;
    private $convertedFiles;

    public static function convert($fromDirectory, $toDirectory) {
        $instance = new HTMLToWikiConverter();
        $instance->loadFiles($fromDirectory);
        $instance->convertFiles();
        $instance->saveFiles($toDirectory);
    }

    /**
     * @param string $directory
     */
    public function loadFiles($directory) {
        foreach (glob("{$directory}/**/index.php") as $filename) {
            $this->files[$filename] = file_get_contents($filename);
        }
    }

    private function extractHeaders($php) {
        $extractedHeaders = [];
        preg_match_all("#\"(?P<type>h\d)\"[,\s]*\"(?P<text>[^\"]+)\"#u", $php, $matchedData, PREG_SET_ORDER);

        foreach ($matchedData as $match) {
            $extractedHeaders[ $match['type'] ] = $match['text'];
        }

        return $extractedHeaders;
    }

    private function removePhpCode($php) {
        $html = preg_replace("/<\?(php)*.*?\?>/usm", "", $php);
        return $html;
    }

    private function convertFormatTags($html) {
        $tagRegexps = [
            "#</?(i|em)>#"     => "''",
            "#</?(b|strong)>#" => "'''",
        ];

        foreach ($tagRegexps as $regexp => $replacement) {
            $html = preg_replace($regexp, $replacement, $html);
        }

        return $html;
    }

    private function convertLinks($html) {
        return preg_replace("#<a.*?href=['\"]*([^\"' ]+).*?>(.*?)</a>#", "[$1 $2]", $html);
    }

    private function parseTagAttrs($tag) {
        if (empty($tag)) {
            return [];
        }

        $attrs = [];
        preg_match_all('#(?P<attr>[a-z]+)=[\'"]*(?P<value>[^>\'"]*)#', $tag, $matches, PREG_SET_ORDER);
        if (empty($matches)) {
            return [];
        }

        foreach ($matches as $match) {
            $attrs[ $match['attr'] ] = $match['value'];
        }

        return $attrs;
    }

    private function convertImages($html) {
        preg_match_all("#<img.*?>#", $html, $imgTags);
        foreach ($imgTags[0] as $imgTag) {
            $attrs = $this->parseTagAttrs($imgTag);
            $src = isset($attrs['src']) ? $attrs['src'] : '';
            $absoluteSrc = 'https://healthvector.ru/'.$src;
            $caption = isset($attrs['alt']) ? $attrs['alt'] : '';

            $wikiTag = "[{$absoluteSrc}|{$caption}]";
            $html = str_replace($imgTag, $wikiTag, $html);
        }

        return $html;
    }

    private function convertList($list, $symbol) {
        $convertedList = [];
        preg_match_all('#<li>(?P<text>.*?)</li>#us', $list, $bullets, PREG_SET_ORDER);
        foreach ($bullets as $bullet) {
            $convertedList[] = $symbol.' '.$bullet['text'];
        }

        return implode("\n", $convertedList);
    }

    private function convertLists($html) {
        preg_match_all('#<ul>.*?</ul>#us', $html, $unorderedLists);
        foreach ($unorderedLists[0] as $list) {
            $convertedList = $this->convertList($list, '*');
            $html = str_replace($list, $convertedList, $html);
        }

        preg_match_all('#<ol>.*?</ol>#us', $html, $orderedLists);
        foreach ($orderedLists[0] as $list) {
            $convertedList = $this->convertList($list, '#');
            $html = str_replace($list, $convertedList, $html);
        }

        return $html;
    }

    private function convertTable($table) {
        $wikiTable = "{|\n";

        preg_match_all('#<tr>(?P<cells>.*?)</tr>#us', $table, $rows, PREG_SET_ORDER);
        foreach ($rows as $row) {
            $wikiTable .= "|-\n";
            preg_match_all('#<t(?P<type>d|h)>(?P<content>.*?)</t(d|h)>#us', $row[0], $cells, PREG_SET_ORDER);
            foreach ($cells as $cell) {
                $cellSymbol = $cell['type'] == 'h' ? '!' : '|';
                $wikiTable .= $cellSymbol.' '.$cell['content']."\n";
            }
        }

        $wikiTable.= "|}\n";

        return $wikiTable;
    }

    private function convertTables($html) {
        preg_match_all('#<table.*?>.*?</table>#us', $html, $tables);
        foreach ($tables[0] as $table) {
            $wikiTable = $this->convertTable($table);
            $html = str_replace($table, $wikiTable, $html);
        }

        return $html;
    }

    private function convertHeaders($html) {
        preg_match_all('#<h(?P<level>\d)>(?P<text>.*?)</h\d>#us', $html, $headers, PREG_SET_ORDER);
        foreach ($headers as $header) {
            $headerTag = str_repeat('=', $header['level']);
            $wikiHeader = $headerTag.' '.$header['text'].' '.$headerTag;
            $html = str_replace($header[0], $wikiHeader, $html);
        }

        return $html;
    }

    private function tidy($html) {
        $tidy = preg_replace("#^[ \t]+#um", '', $html);
        $tidy = preg_replace("#\n{3,}#um", "\n\n", $tidy);

        return $tidy;
    }

    private function removeHtmlTags($html) {
        return preg_replace("#<.*?>#us", "", $html);
    }

    private function convertHtmlToWiki($html) {
        $wiki = $this->convertFormatTags($html);
        $wiki = $this->convertHeaders($wiki);
        $wiki = $this->convertLinks($wiki);
        $wiki = $this->convertImages($wiki);
        $wiki = $this->convertLists($wiki);
        $wiki = $this->convertTables($wiki);
        $wiki = $this->removeHtmlTags($wiki);
        $wiki = $this->tidy($wiki);

        return $wiki;
    }

    private function addHeaderTags($headers, $html) {
        $headersHtml = "";
        foreach ($headers as $tag => $text) {
            $headersHtml .= "<{$tag}>{$text}</{$tag}>\n";
        }

        return $headersHtml.$html;
    }

    /**
     * @param string $php
     * @return mixed|string
     */
    private function convertPhpToWiki($php) {
        $headers = $this->extractHeaders($php);
        $html = $this->removePhpCode($php);
        $html = $this->addHeaderTags($headers, $html);
        $wiki = $this->convertHtmlToWiki($html);
        return $wiki;
    }

    public function convertFiles() {
        foreach ($this->files as $filename => $fileContents) {
            $this->convertedFiles[ $filename ] = $this->convertPhpToWiki($fileContents);
        }
    }

    private function convertToWikiFilename($filename) {
        $filename = str_replace('www/', '', $filename);
        $filename = str_replace('/', '_', $filename);
        $filename = str_replace('_index.php', '.txt', $filename);

        return $filename;
    }

    /**
     * @param string $directory
     */
    public function saveFiles($directory) {
        foreach ($this->convertedFiles as $filename => $wikiContents) {
            $newFilename = $this->convertToWikiFilename($filename);
            $fullName = $directory.'/'.$newFilename;
            file_put_contents($fullName, $wikiContents);
            echo $fullName."\n";
        }
    }
}